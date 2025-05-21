<?php

require_once("settings.php");
$databaseConnection = mysqli_connect($host, $username, $password, $database);
if (!$databaseConnection) {
    die("Connection failed: " . mysqli_connect_error());
}

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
    if (isset($_POST["html"])) $skills[] = sanitiseInput($_POST["html"]);
    if (isset($_POST["css"])) $skills[] = sanitiseInput($_POST["css"]);
    if (isset($_POST["javascript"])) $skills[] = sanitiseInput($_POST["javascript"]);
    if (isset($_POST["python"])) $skills[] = sanitiseInput($_POST["python"]);
    if (isset($_POST["java"])) $skills[] = sanitiseInput($_POST["java"]);
    if (isset($_POST["sql"])) $skills[] = sanitiseInput($_POST["sql"]);
    if (isset($_POST["git"])) $skills[] = sanitiseInput($_POST["git"]);

    $otherSkills = isset($_POST["other_skills"]) ? sanitiseInput($_POST["other_skills"]) : null;

    $skillsJsonEncoded = json_encode($skills);

    // Validate all inputs to ensure they match
    $isPass = true;
    $errorList = [];
    if (!$firstName) {
        array_push($errorList, "No first name entered!");
    } elseif (strlen($firstName) > 20) {
        array_push($errorList, "First name can only be up to 20 characters!");
    }

    if (!$lastName) {
        array_push($errorList, "No last name entered!");
    } elseif (strlen($lastName) > 20) {
        array_push($errorList, "Last name can only be up to 20 characters!");
    }

    if (!$dateOfBirth) {
        array_push($errorList, "No date of birth entered!");
    } elseif (!preg_match($dateOfBirth, "\b(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/(\d{4})\b")) {
        array_push($errorList, "Invalid date of birth! Make sure you enter it as dd/mm/yyyy!");
    } else {
        list($day, $month, $year) = explode("/", $dateOfBirth);
        if (!checkdate($month, $day, $year)) {
            array_push($errorList, "Invalid date of birth! Make sure you only use real dates!");
        }
    }

    if (!$gender) {
        array_push($errorList, "No gender entered!");
    } elseif (!in_array($gender, ["male", "female", "other"])) {
        array_push($errorList, "Gender inputted not found! This is an unexpected issue, please contact the developers if you see this!");
    }

    if (!$streetAddress) {
        array_push($errorList, "No street address entered!");
    } elseif (strlen($streetAddress) > 40) {
        array_push($errorList, "Street address can only be up to 40 characters!");
    }

    if (!$suburb) {
        array_push($errorList, "No suburb entered!");
    } elseif (strlen($suburb) > 40) {
        array_push($errorList, "Suburb can only be up to 40 characters!");
    }

    if (!$state) {
        array_push($errorList, "No state entered!");
    } elseif (!in_array($state, ["qld", "nsw", "vic", "nt", "wa", "sa", "act", "tas"])) {
        array_push($errorList, "State not found! This is an unexpected issue, please contact the developers if you see this!");
    }

    if (!$postcode) {
        array_push($errorList, "No postcode entered!");
    } elseif (!preg_match("^\d{4}$", $postcode)) {
        array_push($errorList, "Invalid postcode entered! Ensure it is 4 digits, even if it starts with 0s!");
    } else {
        $postcodeInt = (int)$postcode;
        if ($suburb == "qld") {
            if (!(($postcode >= 4000 and $postcode <= 4999) or (($postcode >= 9000 and $postcode <= 9999)))) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "nsw") {
            if (!(($postcode >= 1000 and $postcode <= 1999) or (($postcode >= 2000 and $postcode <= 2599)) or (($postcode >= 2619 and $postcode <= 2899)) or (($postcode >= 2921 and $postcode <= 2999)))) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "vic") {
            if (!(($postcode >= 3000 and $postcode <= 3996) or (($postcode >= 8000 and $postcode <= 8999)))) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "nt") {
            if (!($postcode >= 800 and $postcode <= 999)) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "wa") {
            if (!(($postcode >= 6000 and $postcode <= 6797) or (($postcode >= 6800 and $postcode <= 6999)))) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "sa") {
            if (!($postcode >= 5000 and $postcode <= 5999)) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "act") {
            if (!(($postcode >= 200 and $postcode <= 299) or (($postcode >= 2600 and $postcode <= 2618)) or (($postcode >= 2900 and $postcode <= 2920)))) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        } elseif ($suburb == "tas") {
            if (!($postcode >= 7000 and $postcode <= 7999)) {
                array_push($errorList, "Invalid postcode entered! Ensure your postcode matches your state!");
            }
        }
    }

    if (!$emailAddress) {
        array_push($errorList, "No email address entered!");
    } elseif (!preg_match("^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$", $emailAddress)) {
        array_push($errorList, "Invalid email format entered! Ensure it follows the template name@domain.tld!");
    }

    if (!$phoneNumber) {
        array_push($errorList, "No phone number entered!");
    } elseif (!preg_match("^0\d(?:\s?\d){7,9}$", $phoneNumber)) {
        array_push($errorList, "Invalid phone number format entered! Ensure you are not using the +61 format!");
    }

    // If form is valid, continue, otherwise redirect back and alert any errors.
    if (empty($errorList)) {
        echo "good boy";
        // Create SQL query
        $query = "INSERT INTO `eoi`(`jobReferenceNumber`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `streetAddress`, `suburb`, `state`, `postcode`, `emailAddress`, `phoneNumber`, `skillsList`, `otherSkills`) VALUES ('$referenceNumber','$firstName',$lastName','$dateOfBirth','$gender','$streetAddress','$suburb','$state','$postcode','$emailAddress','$phoneNumber','$skillsJsonEncoded','$otherSkills')";
        // Execute SQL query
        $result = mysqli_query($databaseConnection, $query);
        header("Location: applied.php");
        mysqli_close($databaseConnection);
    } else {
        // Show all errors on the apply page
        $encodedErrorList = json_encode($errorList);
        header("Location: apply.php?errors=$encodedErrorList");
        mysqli_close($databaseConnection);
    }
} else {
    // Redirect back to apply page
    header("Location: apply.php");
}

function sanitiseInput($input) {
   $input = trim($input);
   $input = stripslashes($input);
   $input = htmlspecialchars($input);
}

?>