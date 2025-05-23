<?php
require_once 'settings.php';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$insert_query = "
INSERT INTO eoi (
    jobReferenceNumber, firstName, lastName, dateOfBirth, gender,
    streetAddress, suburb, state, postcode, emailAddress,
    phoneNumber, skillsList, otherSkills, status
) VALUES
    ('NULL', 'Alice', 'Johnson', '1990-01-01', 'Female', '123 Main St', 'Richmond', 'VIC', '3121', 'alice@example.com', '0412345678', 'HTML,CSS', 'Quick learner', 'New'),
    ('NULL', 'Bob', 'Smith', '1985-05-15', 'Male', '45 George St', 'Brunswick', 'VIC', '3056', 'bob@example.com', '0398765432', 'JavaScript,PHP', '', 'Current'),
    ('NULL', 'Charlie', 'Lee', '1993-08-20', 'Non-binary', '78 Swan Rd', 'Carlton', 'NSW', '2016', 'charlie@example.com', '0401122334', 'Testing,Automation', 'Detail oriented', 'Final'),
    ('NULL', 'Dana', 'White', '1991-11-11', 'Female', '56 Bay St', 'Fitzroy', 'VIC', '3065', 'dana@example.com', '0411222333', 'UX,UI', 'Creative thinker', 'New'),
    ('NULL', 'Eli', 'Nguyen', '1988-03-30', 'Male', '99 King St', 'Southbank', 'QLD', '4006', 'eli@example.com', '0422333444', 'Networking,Security', '', 'Current');
";

if (mysqli_query($conn, $insert_query)) {
    echo "Test EOIs inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
  