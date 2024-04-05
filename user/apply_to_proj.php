<?php
session_start();

if(isset($_POST["apply"]))
{
  $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
     $project_id = $_SESSION["project_id"];
     $user_id = $_SESSION["id"];
     // echo $user_id;
     
     // Define the status for the application (default: pending)
     $status = 'pending';
     
     // Build the INSERT query
     $query1 = mysqli_query($connect, "INSERT INTO applications (project_id, user_id, application_date, status) VALUES ('$project_id', '$user_id', CURRENT_TIMESTAMP, '$status')") or die("Error: " . mysqli_error($connect));
        // Redirect to a success page or perform any other actions as needed
     //    header("Location: application_success.php");
     $applicationSubmitted = true;
    }    
  $connect->close();    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply to Project</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
       
<style>
  <?php include "styles.css" ?>
  /* <img src="hdx.jpg" width="200" height="200" class="ribbon"> */
  /* background-image: url('hdx.jpg'),url('hdx.jpg');
  background-repeat: repeat,repeat;
  background-attachment: scroll,scroll;
  background-position: right top,left top;
  background-blend-mode: lighten,lighten;
  background-size: 500px,500px ; */
</style>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}


.row {
  
  margin-right: 20px;
  margin-left: 20px;
}

.list_of_proj {
  
  margin-right: 20px;
  margin-left: 20px;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav-right {
  float: right;
}
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapssible:hover {
  background-color: #111;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
  

</style>
</head>
<body>
  

<script src =  "js/jquery.js"></script>
     <script src = "js/bootstrap.min.js"></script>



<div class="topnahv">
    <h3 style="color:green; font-size:2rem; font-family: Verdana,sans-serif;" >SkillMatch</h3>

</div>
<div class="topnav">
<a href="user_dashboard.php">Dashboard</a>	
  
  <a href="profile.php">User Profile</a>
  <a href="browse.php">Browse projects</a>
  <a href="current_projects.php">Current Projects</a>
  <!-- <a href="kyc.php">Know Your Club</a>
  <a href="schedule.php">Schedule</a> -->
  
  <!-- <a href="view_sent_queries.php">View Unresponded Queries</a> -->
  <!-- <a href="user_notifications.php">View Notifications</a> -->
  <a class= "active" href="aboutus.php">About The Team</a>


<!-- Content Section -->

    <?php
    if(isset($_SESSION["id"])) {
     ?>
   
     <div class="topnav-right">
       <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>
   
       <?php
       }
       else{
   ?>
   <a href="../login/login_user.php">You are not logged in</a>
   <?php
       }
       ?>
       <a href="../login/logout.php">Logout</a>
       
     </div>
     
     
   </div>

   <?php
// Display an alert if the application has been successfully submitted
if($applicationSubmitted) {
    echo '<div class="alert alert-success" role="alert">';
    echo 'Application submitted successfully!';
    echo '</div>';
}
?>   
   <!-- <br>
   <h2 class= "list_of_proj"; style="color:black;">List of Projects:</h2>
   <br> -->
   <?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {   
        // Fetch project details based on session variable
        $project_id = $_SESSION["project_id"];
        $query1=mysqli_query($connect,"SELECT * FROM projects WHERE project_id='$project_id'") or die("Error: " . mysqli_error($connect));
        $row=mysqli_fetch_array($query1);
    ?>
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"><?php echo $row['project_title']; ?></h4>
            <p class="card-text"><?php echo $row['project_description']; ?></p>
            <p class="card-text">Deadline: <?php echo $row['deadline']; ?></p>
            <p class="card-text">Payment: <?php echo $row['payment_amount']; ?></p>
        </div>
    </div>
    <?php
    }
    $connect->close();
    ?>

    <!-- Application form section -->
    <form action="apply_to_proj.php" method="post">
        <input type="submit" name="apply" class="btn btn-primary" value="Apply to Project" />
    </form>
</div>

<!-- Footer Section -->
<div class="footer">
    <!-- Footer content -->
</div>

</body>
</html>
