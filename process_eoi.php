<?php

require_once("settings.php");
$databaseConnection = mysqli_connect($host, $username, $password, $database);

if (($_SERVER["REQUEST_METHOD"] == "POST") && ($databaseConnection)) {
    // Get all relevant variables from POST request and sanitise them if they exist
    $referenceNumber = isset($_POST["referencenumber"]) ? sanitiseInput($_POST["referencenumber"]) : null;
    $firstName = isset($_POST["firstname"]) ? sanitiseInput($_POST["firstname"]) : null;
    $lastName = isset($_POST["lastname"]) ? sanitiseInput($_POST["lastname"]) : null;
    $dateOfBirth = isset($_POST["dob"]) ? sanitiseInput($_POST["dob"]) : null;
    $gender = isset($_POST["gender"]) ? sanitiseInput($_POST["gender"]) : null;
    $streetAddress = isset($_POST["streetaddress"]) ? sanitiseInput($_POST["streetaddress"]) : null;
    $suburb = isset($_POST["suburb"]) ? sanitiseInput($_POST["suburb"]) : null;
    $state = isset($_POST["state"]) ? sanitiseInput($_POST["state"]) : null;
    $postcode = isset($_POST["postcode"]) ? sanitiseInput($_POST["postcode"]) : null;
    $emailAddress = isset($_POST["email"]) ? sanitiseInput($_POST["email"]) : null;
    $phoneNumber = isset($_POST["phone"]) ? sanitiseInput($_POST["phone"]) : null;
    $skills = [];
    isset($_POST["html"]) ? $skills[] = sanitiseInput($_POST["html"]);
    isset($_POST["css"]) ? $skills[] = sanitiseInput($_POST["css"]);
    isset($_POST["javascript"]) ? $skills[] = sanitiseInput($_POST["javascript"]);
    isset($_POST["python"]) ? $skills[] = sanitiseInput($_POST["python"]);
    isset($_POST["java"]) ? $skills[] = sanitiseInput($_POST["java"]);
    isset($_POST["sql"]) ? $skills[] = sanitiseInput($_POST["sql"]);
    isset($_POST["git"]) ? $skills[] = sanitiseInput($_POST["git"]);
    $otherSkills = isset($_POST["other_skill"]) ? sanitiseInput($_POST["other_skill"]) : null;

    // Validate all inputs to ensure they match
} else {
    // Redirect back to apply page
    header("apply.php")
}

function sanitiseInput($input) {
   $input = trim($input);
   $input = stripslashes($input);
   $input = htmlspecialchars($input);
}

?>