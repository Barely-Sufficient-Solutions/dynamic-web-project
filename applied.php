<?php
session_start();
require_once './settings.php';

if (empty($_SESSION['applicant_logged_in']) || empty($_SESSION['eoi_id'])) {
    header("Location: application_login.php");
    exit();
}

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$eoi_id = $_SESSION['eoi_id'];
$query = "SELECT EOInumber, firstName, lastName, username, jobReferenceNumber, status FROM eoi WHERE EOInumber = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $eoi_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$applicant = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$applicant) {
    session_unset();
    session_destroy();
    header("Location: application_login.php");
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: application_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Submitted</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include "header.inc"; ?>
    <main>
        <section>
            <h1>Welcome, <?php echo htmlspecialchars($applicant['firstName']); ?>!</h1>
            <p><strong>EOI Number:</strong> <?php echo $applicant['EOInumber']; ?></p>
            <p><strong>Job Reference:</strong> <?php echo htmlspecialchars($applicant['jobReferenceNumber']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($applicant['username']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($applicant['status']); ?></p>

            <?php if (isset($_SESSION['show_password_once'])): ?>
                <p style="color:green;"><strong>Your password:</strong> <?php echo htmlspecialchars($_SESSION['show_password_once']); ?></p>
                <?php unset($_SESSION['show_password_once']); ?>
            <?php endif; ?>

            <p><a href="applied.php?logout">Logout</a></p>
        </section>
    </main>
    <?php include "footer.inc"; ?>
</body>
</html>

<?php mysqli_close($conn); ?>
