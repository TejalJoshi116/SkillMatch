<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Progress</title>
</head>

<body>
    <h2>Project Progress</h2>
    <?php
    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];

        $conn = mysqli_connect('localhost', 'root', '', 'skillmatch');
        if (mysqli_connect_errno()) {
            echo 'Failed to connect to database: ' . mysqli_connect_error();
            exit();
        }

        $query = "SELECT * FROM projects WHERE id = $project_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $project = mysqli_fetch_assoc($result);
            $project_name = $project['project_name'];
            $final_project_folder = $project['final_project_folder'];
    ?>
            <p>Project Name: <?php echo $project_name; ?></p>
            <p><a href="<?php echo $final_project_folder; ?>" download>Download Final Project Folder</a></p>
    <?php
        } else {
            echo "Project not found";
        }
        mysqli_close($conn);
    } else {
        echo "Project ID not provided";
    }
    ?>
</body>

</html>

