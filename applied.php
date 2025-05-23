<?php 
session_start();
require_once './settings.php';
$login_error_message = "";
$eoi_query_message = "";
$show_manager_content = false;
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    echo "<main><p>Error: Unable to connect to the database.</p></main>";
    exit();
}
$eoi_username = isset($_SESSION['eoi_username']) ? sanitiseInput($_SESSION['eoi_username']) : "Error displaying";
$firstName = isset($_SESSION['firstName']) ? sanitiseInput($_SESSION['firstName']) : "Error displaying";
$password = isset($_SESSION['generated_password']) ? $_SESSION['generated_password'] : "Error displaying";
$eoiNumber = isset($_SESSION['eoiNumber']) ? $_SESSION['eoiNumber'] : "Error displaying";

function sanitiseInput($input) {
    $input = trim(stripslashes(htmlspecialchars($input)));
return $input;
}

if (!$eoiNumber) {
    header("apply.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./application_login.php");
    exit();
}

$query = "SELECT status FROM eoi WHERE EOInumber = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $eoiNumber);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$eoiResult = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application submitted!</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include "header.inc"; ?>
    <main>
        <section>
            <h1>Hi, <?php echo($firstName);?>. Your unique ID is: <strong><?php echo($eoiNumber);?></strong></h1>
            <h1> Your username is: <?php echo ($eoi_username);?> </h1>
            <h1>Your password is: <?php echo ($password); ?></h1>
            <br>
            <h1>Your current status is: <?php echo ($eoiResult['status']); ?></h1>
            <p><a href="applied.php?logout">Logout</a></p>
        </section>
    </main>
    <?php include "footer.inc"; ?>
</body>
</html>

<?php   mysqli_close($conn);    ?>