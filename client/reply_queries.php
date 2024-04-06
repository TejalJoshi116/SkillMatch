<?php 
session_start();
if(isset($_POST['rep']))
{
  if($_SESSION["id"])
  {
  $_SESSION["queryid"]=$_POST['rep'];
  header("Location:reply_to_query.php");
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
  <a href="client_dashboard.php">Dashboard</a>
  <a href="profile.php">Client Profile</a>
  <a href="projectregister.php">Add New Project</a>
  <!--<a href="kyc.php">Know Your Club</a-->
  <!--<a href="schedule.php">Schedule</a>-->
  <a href="filterdate.php">Filter Project by Date</a>
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
<a href="../login/login_client.php">You are not logged in</a>
<?php
    }
    ?>
    <a href="../login/logout.php">Logout</a>
    
  </div>
  
  
</div>
<br>
<h2 style = "color:green;"><center> Unresponded Queries Asked For the Project </center></h2>

<?php 
    
    if(isset($_SESSION["eventid"])){
        $connect=mysqli_connect('localhost','root','','skillmatch');
        if(mysqli_connect_errno())
        {
            echo 'Failed to connect to database: '.mysqli_connect_error();
        }
        else{
            $eve = $_SESSION["eventid"]; 
            $sql = mysqli_query($connect,"SELECT u.UserId, u.Registered_Name, q.Timestamp, q.Query, e.Event_Name, q.Query_Id FROM events as e JOIN queries as q JOIN user as u
            ON e.Event_Id = q.Event_Id AND u.UserId = q.UserId WHERE e.Event_Id= '$eve'  ORDER BY q.Timestamp DESC ")  or die("Error2: " . mysqli_error($connect));;
            ?>
            <input hidden type="text" class="btn btn-primary" style= "" value="Reply"/>
            <div class="not">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Timestamp</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Registered Name</th>
                    <th scope="col">Query</th>
                    <th scope="col">Reply</th>
                </tr>
                </thead>
                <tbody>
            <?php
            while($row = mysqli_fetch_array($sql))
            {
                echo "<tr>";
                echo "<th scope='row'>".$row[2]."</th>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[3]."</td>";
                ?>

                <td>
                <form action="reply_queries.php" method="post">
                <input hidden type="text"  name="rep" value="<?php echo $row[5]; ?>" />
                <input  type="submit" class="btn btn-warning"  value="Reply"/>
                </form>
                </td>

                <?php
                echo "</tr>";
            }
        }
        $connect->close();
    }
?>


  </tbody>
</table>
</div>

</body>

</html>