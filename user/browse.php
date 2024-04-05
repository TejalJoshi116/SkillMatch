<?php
session_start();
// echo $_SESSION["name"];
if(isset($_POST['project_id']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_id"]=$_POST["project_id"];
  header("Location:apply_to_proj.php");
  }
}
// if(isset($_POST['ask']))
// {
//   if($_SESSION["id"])
//   {
//   $_SESSION["eventname"]=$_POST["ask"];
//   header("Location:send_query.php");
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
<br>
<h2 class= "list_of_proj"; style="color:black;">List of Projects:</h2>
<br>
<?php
$connect=mysqli_connect('localhost','root','','skillmatch');
if(mysqli_connect_errno())
{
    echo 'Failed to connect to database: '.mysqli_connect_error();
}
else
{
    $query=mysqli_query($connect,"SELECT * FROM projects") or die("Error: " . mysqli_error($connect));

    $count = 0; // Initialize count for cards in each row
    echo '<div class="row">';
    while($row=mysqli_fetch_array($query))
    {
        if ($count % 3 == 0 && $count != 0) {
            echo '</div>'; // Close the previous row
            echo '<div class="row">'; // Open a new row
        }
        echo '<div class="col-lg-4">'; // Adjusted to col-lg-4 for 3 cards per row
        echo '<div class="card" style="width: 22rem;height: 23rem">';
        echo '<div class="card-body">';
        echo '<h4 class="card-title">' . $row['project_title'] . '</h4>';
        echo '<p class="card-text"> ' . $row['project_description'] . '</p>';
        echo '<p class="card-text">Deadline: ' . $row['deadline'] . '</p>';
        echo '<p class="card-text">Payment: ' . $row['payment_amount'] . '</p>';
        echo '<form action="browse.php" method="post">';
        echo '<input hidden type="text" name="project_id" value="' . $row['project_id'] . '" />';
        echo '<input type="submit" class="btn btn-primary" value="View Project" />';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $count++; // Increment the count
    }
    echo '</div>'; // Close the last row
}
$connect->close();
?>


</body>
</html>