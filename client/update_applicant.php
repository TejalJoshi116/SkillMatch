<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login/login_client.php");
    exit();
}

if (!isset($_POST['selected_applicant']) || empty($_POST['selected_applicant']) || !isset($_POST['project_id']) || empty($_POST['project_id'])) {
    header("Location: send_messages.php");
    exit();
}

$selected_applicant = $_POST['selected_applicant'];
$project_id = $_POST['project_id'];

$conn = mysqli_connect('localhost', 'root', '', 'skillmatch');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to database: ' . mysqli_connect_error();
    exit();
}

// Update project_client_list
$update_query = "UPDATE project_client_list SET UserId = '$selected_applicant' WHERE project_Id = '$project_id'";
if (!mysqli_query($conn, $update_query)) {
    echo "Error updating project_client_list: " . mysqli_error($conn);
    exit();
}

// Update projects status
$update_status_query = "UPDATE projects SET Status_Id = 4 WHERE project_Id = '$project_id'";
if (!mysqli_query($conn, $update_status_query)) {
    echo "Error updating projects status: " . mysqli_error($conn);
    exit();
}

echo "Applicant selected successfully! Redirecting to client dashboard...";

mysqli_close($conn);
?>

<script>
    setTimeout(function() {
        window.location.href = 'send_messages.php';
    }, 3000); // 3000 milliseconds = 3 seconds
</script>
