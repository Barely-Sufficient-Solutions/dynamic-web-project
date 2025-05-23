<?php
session_start();

require_once './settings.php';

if (empty($conn)) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}

if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header("Location: manage.php");
}

$login_error_message = "";

if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    $conn = @mysqli_connect($host, $username, $password, $database); // from setting php

    if (!$conn) {
        $login_error_message = "Database connection error. Please try again later.";
    } else {
        $username_attempt_sanitised = $_POST['username'];
        $password_attempt_sanitised = $_POST['password']; // no trim for verification
        $query = "SELECT * FROM managers WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username_attempt_sanitised);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $manager_data = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($manager_data && password_verify($password_attempt_sanitised, $manager_data['password'])) {
                // login success
                session_regenerate_id(true);
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_username'] = $_POST['username'];
                header("Location: manage.php"); // setting up the user's session and redirect to manage
                exit();
            } else {
                $login_error_message = "Invalid username or password";
            } 
        }else {
            $login_error_message = "Login system error. Please try again later.";
        }
        if ($conn) {
            mysqli_close($conn);
        } 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login - BSS HR Portal</title>
    <link rel="stylesheet" href="./styles/styles.css">
<head>

<body>
    <?php include "header.inc" ?>
    <main>
        <section>
            <h2>Manager Login</h2>
            <?php
            if (!empty($login_error_message)) {
                echo "<p style='color:red;'>". htmlspecialchars($login_error_message) . "</p>"; }
            ?>
            <form method='post' action="./login.php">
                <label>Username: <input type="text" name="username" required value="<?php echo isset($_POST['manager_username']) ? htmlspecialchars($_POST['manager_username']) : ''; ?>"></label><br>
                <!-- prev line: sees if there was a username previously submitted then displays that username or if not an empty string -->
                <label>Password: <input type="text" name="password" required> </label><br> <!-- no need to update pwd -->
                <input type="submit" name="login" value="login">
            </form>
        </section>
    </main>

    <?php include "./footer.inc" ?>
</body>
</html>