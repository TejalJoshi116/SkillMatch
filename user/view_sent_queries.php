<!-- DB -->
<?php
session_start()
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
  .not {
    
    width: 1000px;
    margin: 0 auto;
    /* background-color:black;*/
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
  <a href="loggedinpage.php">Events</a>
  <a href="profile.php">User Profile</a>
  <a href="dashboard.php">Dashboard</a>
  <a href="schedule.php">Schedule</a>
  <a href="filterdate.php">Filter Event By Date</a>
  <a class= "active" href="view_sent_queries.php">View Unresponded Queries</a>
  <a href="user_notifications.php">View Notifications</a>
  <a href="aboutus.php">About The Team</a>
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
<center><h3> View Unresponded Queries </h3></center>
<?php 
    
    if(isset($_SESSION["project_Id"])){
        $connect=mysqli_connect('localhost','root','','skillmatch');
        if(mysqli_connect_errno())
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
      }
        else{
            $eve = $_SESSION["project_Id"]; 
            $sql = mysqli_query($connect,"SELECT u.UserId, u.Registered_Name, m.Timestamp, m.message, p.project_Name FROM projects as p JOIN messages as m JOIN `user` as u
            ON p.project_Id = m.project_Id AND u.UserId = m.UserId WHERE p.project_Id= '$eve'  ORDER BY m.Timestamp DESC LIMIT 10")  or die("Error2: " . mysqli_error($connect));
        }
      
?>
 <?php 
    if(isset($_SESSION["id"])){
        $connect=mysqli_connect('localhost','root','','skillmatch');
        if(mysqli_connect_errno())
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
            $id = $_SESSION["id"];
            $sql = mysqli_query($connect,"SELECT p.project_Name, q.Timestamp, q.Query FROM projects as p JOIN queries as q
            ON p.project_Id = q.project_Id WHERE q.UserId= '$id' ORDER BY q.Timestamp DESC LIMIT 10")  or die("Error2: " . mysqli_error($connect));
   ?>

            <div class="not">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Timestamp</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Query Sent</th>
                </tr>
                </thead>
                <tbody>
            <?php
            while($row = mysqli_fetch_array($sql))
            {
                echo "<tr>";
                echo "<th scope='row'>".$row[1]."</th>";
                echo "<td>".$row[0]."</td>";
                
                echo "<td>".$row[2]."</td>";
                echo "</tr>";
            }
        }
    }
?>

  </tbody>
</table>
</div>



    
</body>

</html>
