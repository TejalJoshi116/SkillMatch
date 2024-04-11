<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login/login_client.php");
    exit();
}

if (!isset($_POST['view_applicants']) || empty($_POST['view_applicants'])) {
    header("Location: client_dashboard.php");
    exit();
}

$project_Id = $_POST['view_applicants'];

$conn = mysqli_connect('localhost', 'root', '', 'skillmatch');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to database: ' . mysqli_connect_error();
    exit();
}

$query = "SELECT u.UserId, u.Display_Name, u.Picture, u.Mail_Id as Email ,al.upload
          FROM user u
          INNER JOIN applicants_list al ON u.UserId = al.UserId
          WHERE al.project_Id = '$project_Id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants for Project</title>
    <!-- Add your CSS stylesheets or link bootstrap if necessary -->
</head>

<body>
    <h2>Applicants for Project</h2>
    <form action="update_applicant.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Display Name</th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Resume</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['UserId']; ?></td>
                        <td><?php echo $row['Display_Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><img src="<?php echo $row['Picture']; ?>" alt="Profile Picture" style="width: 50px; height: 50px;"></td>
                        <td><a href="<?php echo $row['upload']; ?>" download>View Resume</a></td>
                        <td><input type="radio" name="selected_applicant" value="<?php echo $row['UserId']; ?>"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <input type="hidden" name="project_id" value="<?php echo $project_Id; ?>">
        <input type="submit" value="Select Applicant">
    </form>
</body>

</html>

<?php
mysqli_close($conn);
?>
