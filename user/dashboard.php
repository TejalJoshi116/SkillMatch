<?php
session_start();
//echo $_SESSION["name"];
if(isset($_POST['project_name']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_name"]=$_POST['project_name'];
  header("Location:register.php");
  }
}
if(isset($_POST['ask']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_name"]=$_POST["ask"];
  header("Location:send_query.php");
  }
}
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

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  /overflow: hidden;/
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
  <a href="loggedinpage.php">Projects</a>
  <a href="profile.php">User Profile</a>
  <a class= "active" href="dashboard.php">Dashboard</a>
  <a href="schedule.php">Schedule</a>
  <a href="filterdate.php">Filter Project By Date</a>
  <a href="view_sent_queries.php">View Unresponded Queries</a>
  <a href="user_notifications.php">View Notifications</a>
  <a href="aboutus.php">About The Team</a>
<?php
if(isset($_SESSION["id"])) {
  ?>

  <div class="topnav-right">
    <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>

    <?php
    }
    else
    {
      ?>
      <a href="../login/login_user.php">You are not logged in</a>
    
<?php
}
?>
<a href="../login/logout.php">Logout</a>

</div>
     
</div>
<br>

<h2 style="color:black;">List of Projects Registered In:</h2>
<br>
<button type="button" class="collapsible">All Active Projects</button>
<div class="card lg-12"   id = "content">
  <?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {

      $a1=$_SESSION["id"];
      $query1 = mysqli_query($connect, "SELECT DISTINCT p.project_Name, p.project_Date, p.Picture, ps.Status 
      FROM projects AS p 
      JOIN applicants_list AS al ON al.project_Id = p.project_Id
      JOIN project_status AS ps ON p.Status_Id = ps.Status_Id
      JOIN project_client_list AS pcl ON pcl.project_Id = p.project_Id
      JOIN client AS c ON pcl.client_id = c.client_id
      WHERE p.project_Date >= CURDATE() 
      AND al.UserId = '$a1'
      ORDER BY p.project_Date") 
      or die("Error: new0 " . mysqli_error($connect));
  
      // $a1=$_SESSION["id"];
      //   $query1=mysqli_query($connect,"select distinct p.project_Name, p.project_Date, p.Picture, pl.Location_Name, ps.Status 
      //   from projects as p 
      //   join project_location as pl
      //   join applicants_list as al
      //   join project_status as ps 
      //   join client as c
      //   join project_client_list as pcl
      //   join client_type as ct
      //   on p.Location_Id=pl.Location_Id 
      //   and p.Status_Id=ps.Status_Id
      //   and p.project_Id = pcl.project_Id 
      //   and al.project_Id = p.project_Id
      //   and pcl.client_id = c.client_id
      //   and c.client_id = ct.client_id 
      //   where p.project_Date >= CURDATE() 
      //   AND al.UserId = '$a1'
      //   order by p.project_Date") or die("Error: new0 " . mysqli_error($connect));
        // Change Roll No. to Session Authentication Details
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[3]; ?></p>
            <form action="dashboard.php" method="post">
            <input hidden type="text"  name="project_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Project"/>
            </form>
            <form action="dashboard.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
            </form>
          <?php
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '<br>';
        }
        echo '</div>';
      }
    $connect->close();
?>
</div>


<br><br>
<button type="button" class="collapsible" >All Inactive Projects</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $a1=$_SESSION["id"];
        $query1 = mysqli_query($connect, "SELECT DISTINCT p.project_Name, p.project_Date, p.Picture, ps.Status 
                                  FROM projects AS p 
                                  JOIN applicants_list AS al ON p.project_Id = al.project_Id
                                  JOIN project_status AS ps ON p.Status_Id = ps.Status_Id
                                  JOIN project_client_list AS pcl ON p.project_Id = pcl.project_Id
                                  JOIN client AS c ON pcl.client_id = c.client_id
                                  WHERE p.project_Date < CURDATE() 
                                  AND al.UserId = '$a1'
                                  ORDER BY p.project_Date") 
          or die("Error: new1 " . mysqli_error($connect));

        // Change Roll No. to Session Authentication Details
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          $row1[2] = "../".$row1[2];
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo $row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[3]; ?></p>
            <form action="dashboard.php" method="post">
            <input hidden type="text"  name="project_name" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Project"/>
            </form>
            <form action="dashboard.php" method="post">
            <input hidden type="text"  name="ask" value="<?php echo $row1[0]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Ask Query to the Organizer"/>
            </form>
          <?php
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '<br>';
        }
        echo '</div>';
      }
    $connect->close();
?>
</div>

<br><br>


  
<br>
    
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}

</script>

        
    
</body>
</html>
