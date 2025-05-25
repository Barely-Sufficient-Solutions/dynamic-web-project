<?php
session_start();
require_once './settings.php';

$eoi_query_message = "";
$show_manager_content = false;

if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    $show_manager_content = true;
} else {
  header("Location: ./login.php");
  exit();
}


$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    echo "<main><p>Error: Unable to connect to the database.</p></main>";
    exit();
}

// Handle login
//if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
//    $username_attempt = trim($_POST['username']);
//    $password_attempt = $_POST['password'];
//
//    $query = "SELECT * FROM managers WHERE username = ?";
//    $stmt = mysqli_prepare($conn, $query);
//    if ($stmt) {
//        mysqli_stmt_bind_param($stmt, 's', $username_attempt);
//        mysqli_stmt_execute($stmt);
//        $result = mysqli_stmt_get_result($stmt);
//        $manager_data = mysqli_fetch_assoc($result);
//        mysqli_stmt_close($stmt);
//
//        if ($manager_data && password_verify($password_attempt, $manager_data['password'])) {
//            $_SESSION['manager_logged_in'] = true;
//            $_SESSION['manager_username'] = $manager_data['username'];
//            session_regenerate_id(true);
//            header("Location: manage.php");
//            exit();
//        } else {
//            $login_error_message = "Invalid username or password.";
//        }
//    }
//}

// Already logged in

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./login.php");
    exit();
}

// Base query for EOIs
$eoi_query = "SELECT EOInumber, jobReferenceNumber, firstName, lastName, status FROM eoi";
$where = [];
$params = [];
$types = "";

$managerUsername = isset($_SESSION['manager_username']) ? htmlspecialchars($_SESSION['manager_username']) : '';

// Handle search
if ($show_manager_content && isset($_POST['search'])) {
    if (!empty($_POST['job_ref'])) {
        $where[] = "jobReferenceNumber LIKE ?";
        $params[] = "%" . trim($_POST['job_ref']) . "%";
        $types .= "s";
    }
    if (!empty($_POST['first_name'])) {
        $where[] = "firstName LIKE ?";
        $params[] = "%" . trim($_POST['first_name']) . "%";
        $types .= "s";
    }
    if (!empty($_POST['last_name'])) {
        $where[] = "lastName LIKE ?";
        $params[] = "%" . trim($_POST['last_name']) . "%";
        $types .= "s";
    }
}

// Handle delete
if ($show_manager_content && isset($_POST['delete']) && !empty($_POST['delete_job_ref'])) {
    $delete_job_ref = trim($_POST['delete_job_ref']);
    $del_stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE jobReferenceNumber = ?");
    mysqli_stmt_bind_param($del_stmt, 's', $delete_job_ref);
    if (mysqli_stmt_execute($del_stmt)) {
        $eoi_query_message = "Deleted EOIs with Job Ref: $delete_job_ref";
    } else {
        $eoi_query_message = "Failed to delete EOIs.";
    }
    mysqli_stmt_close($del_stmt);
}

// Handle status update
if ($show_manager_content && isset($_POST['update_status'], $_POST['eoi_id'], $_POST['new_status'])) {
    $eoi_id = (int)$_POST['eoi_id'];
    $new_status = $_POST['new_status'];
    $allowed_statuses = ['New', 'Current', 'Final'];

    if (in_array($new_status, $allowed_statuses)) {
        $up_stmt = mysqli_prepare($conn, "UPDATE eoi SET status = ? WHERE EOInumber = ?");
        mysqli_stmt_bind_param($up_stmt, 'si', $new_status, $eoi_id);
        if (mysqli_stmt_execute($up_stmt)) {
            $eoi_query_message = "Status updated.";
        } else {
            $eoi_query_message = "Status update failed.";
        }
        mysqli_stmt_close($up_stmt);
    }
}

// Handle sorting
if ($show_manager_content && isset($_POST['sort_by'])) {
    $allowed_sort_fields = ['EOInumber', 'jobReferenceNumber', 'firstName', 'lastName', 'status'];
    $sort_field = $_POST['sort_by'];

    if (in_array($sort_field, $allowed_sort_fields)) {
        $eoi_query .= " ORDER BY " . $sort_field;
    }
} else {
    $eoi_query .= " ORDER BY EOInumber";
}

// Apply WHERE conditions if searching
if (!empty($where)) {
    $eoi_query = "SELECT EOInumber, jobReferenceNumber, firstName, lastName, status FROM eoi WHERE " . implode(" AND ", $where);
    $eoi_query .= " ORDER BY EOInumber";
    $stmt = mysqli_prepare($conn, $eoi_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        $eoi_result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    }
} else {
    $eoi_result = mysqli_query($conn, $eoi_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HR Management Portal</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<?php include('header.inc'); ?>
<main>


<h1>Welcome, <?php echo htmlspecialchars($managerUsername); ?></h1>
<p><a href="manage.php?logout">Logout</a></p>
<?php if (!empty($eoi_query_message)): ?>
  <p><strong><?php echo htmlspecialchars($eoi_query_message); ?></strong></p>
<?php endif; ?> 
<!-- Search Form -->
<section>
  <h2>Search EOIs</h2>
  <form method="post" action="manage.php">
    <label>Job Ref: <input type="text" name="job_ref"></label>
    <label>First Name: <input type="text" name="first_name"></label>
    <label>Last Name: <input type="text" name="last_name"></label>
    <input type="submit" name="search" value="Search">
  </form>
</section>
<!-- Delete Form -->
<section>
  <h2>Delete EOIs by Job Ref</h2>
  <form method="post" action="manage.php">
    <label>Job Reference: <input type="text" name="delete_job_ref" required></label>
    <input type="submit" name="delete" value="Delete">
  </form>
</section>
<!-- Sort Form -->
<section>
  <h2>Sort EOIs</h2>
  <form method="post" action="manage.php">
    <label>Sort by:
      <select name="sort_by">
        <option value="EOInumber">EOI Number</option>
        <option value="jobReferenceNumber">Job Reference</option>
        <option value="firstName">First Name</option>
        <option value="lastName">Last Name</option>
        <option value="status">Status</option>
      </select>
    </label>
    <input type="submit" name="sort" value="Sort">
  </form>
</section>
<!-- EOI Table -->
<section>
  <h2>EOI List</h2>
  <table border="1">
    <thead>
      <tr>
        <th>EOI #</th>
        <th>Job Ref</th>
        <th>Applicant</th>
        <th>Status</th>
        <th>Update Status</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($eoi_result && mysqli_num_rows($eoi_result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($eoi_result)): ?>
        <tr>
          <td><?php echo $row['EOInumber']; ?></td>
          <td><?php echo htmlspecialchars($row['jobReferenceNumber']); ?></td>
          <td><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></td>
          <td><?php echo htmlspecialchars($row['status']); ?></td>
          <td>
            <form method="post" action="manage.php">
              <input type="hidden" name="eoi_id" value="<?php echo $row['EOInumber']; ?>">
              <select name="new_status">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
              </select>
              <input type="submit" name="update_status" value="Update">
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No EOIs found.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</section>

</main>
<?php include('footer.inc'); ?>
</body>
</html>
