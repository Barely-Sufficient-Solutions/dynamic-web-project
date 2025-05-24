<?php
session_start();
require_once './settings.php';

// Create DB connection
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// If already logged in, redirect to applied.php
if (isset($_SESSION['applicant_logged_in']) === true) {
    header("Location: /dynamic-web-project/applied.php");
    exit();
}

$login_error_message = "";

// Handle login form submission
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
            // Success: store session values and redirect
            $_SESSION['applicant_logged_in'] = true;
            $_SESSION['eoi_username'] = $username_input;
            $_SESSION['eoiNumber'] = $user['EOInumber'];
            header("Location: ./application_login.php");
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
