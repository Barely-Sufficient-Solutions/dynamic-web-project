<?php
session_start();
require_once './settings.php';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Already logged in? Go straight to applied.php
if (!empty($_SESSION['applicant_logged_in']) && !empty($_SESSION['eoi_id'])) {
    header("Location: applied.php");
    exit();
}

$login_error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $username_input = trim($_POST['username']);
    $password_input = $_POST['password'];

    $query = "SELECT EOInumber, username, password FROM eoi WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username_input);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user && password_verify($password_input, $user['password'])) {
            // Login successful
            $_SESSION['applicant_logged_in'] = true;
            $_SESSION['eoi_id'] = $user['EOInumber'];
            $_SESSION['eoi_username'] = $user['username'];
            $_SESSION['show_password_once'] = $password_input; // Store plain password temporarily
            header("Location: applied.php");
            exit();
        } else {
            $login_error_message = "Invalid username or password.";
        }
    } else {
        $login_error_message = "Login error. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applicant Login - BSS HR Portal</title>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <?php include "header.inc"; ?>
    <main>
        <section>
            <h2>Applicant Login</h2>

            <?php if (!empty($login_error_message)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($login_error_message); ?></p>
            <?php endif; ?>

            <form method="post" action="application_login.php">
                <label>Username:
                    <input type="text" name="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </label><br>
                <label>Password:
                    <input type="password" name="password" required>
                </label><br>
                <input type="submit" name="login" value="Login">
            </form>
        </section>
    </main>
    <?php include "footer.inc"; ?>
</body>
</html>
