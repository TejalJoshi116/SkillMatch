<?php
  session_start();
  if(isset($_POST['project_name']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['project_name'];
  header("Location:projectedit.php");
  }
}
$flag = 0;
if(isset($_POST['rew']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['rew'];
  header("Location:viewreview.php");
  }
}
if(isset($_POST['reply']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['reply'];
  header("Location:reply_queries.php");
  }
}
if(isset($_POST['collab']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['collab'];
  header("Location:addcollab.php");
  }
}
if(isset($_POST["msgss"]))
{
  if($_SESSION["id"])
  {
    $_SESSION["projectid"]=$_POST['msgss'];
    header("Location:posted_messages.php");
  }
}
if(isset($_POST['status']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['status'];
  header("Location:send_messages.php");
  }
}
if(isset($_POST['regis']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['regis'];
  header("Location:delete_registrants.php");
  }
}

if(isset($_POST['del']))
{

  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['del'];
  $eve=$_SESSION["projectid"];
  $conn=mysqli_connect('localhost','root','','skillmatch');
  $delete=false;
  //check connion
  if(mysqli_connect_errno($conn))
  {
      echo 'Failed to conn to database: '.mysqli_conn_error();
  }
  else{
      $id = $eve;
      $result1=mysqli_query($conn,"DELETE FROM project_client_list WHERE project_id = '$id'") or die("Error1: " . mysqli_error($conn));
      $result2=mysqli_query($conn,"DELETE FROM project_contact WHERE project_id = '$id'") or die("Error2: " . mysqli_error($conn));
      $result3=mysqli_query($conn,"DELETE FROM users_list WHERE project_id = '$id'") or die("Error3: " . mysqli_error($conn));
      $result4=mysqli_query($conn,"DELETE FROM review WHERE project_id = '$id'") or die("Error4: " . mysqli_error($conn));
      $result5=mysqli_query($conn,"DELETE FROM messages WHERE project_Id = '$id'") or die("Error5: " . mysqli_error($conn));
      $sql = "DELETE FROM `skillmatch`.`projects` WHERE project_Id = '$id'" or die("Error4: " . mysqli_error($conn));
      if($conn->query($sql) == true){
          // print "Successfully Deleted". "<br>";
          
          $delete = true;
          $result='<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Form</strong> Sucessfully submitted.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
          echo "<center>".'Deleting........'."</center>"."<br>";
        echo '<center><br>'."Redirecting to Dashboard.....".'</center>';
        echo "<script>setTimeout(\"location.href = 'org_dashboard.php';\",3000);</script>";
      }
      else{        
          echo "ERROR: $sql <br> $conn->error";
      }
      // Close the database connection
      $conn->close();
  }
}
} 

if(isset($_POST['ert']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['ert'];
  $eve=$_SESSION["projectid"];
  $connect = mysqli_connect("localhost", "root", "", "skillmatch");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv'); 
      ob_start();
      ob_end_clean();
      $output = fopen("php://output", "w");  
      
      fputcsv($output, array('Registered Name', 'Roll No', 'Contact No', 'MailId','Timestamp'));  
      $query = "SELECT u.Registered_Name,u.UserId,u.Contact_No,u.Mail_Id, rl.Time_Stamp from user u,registrants_list rl where u.UserId=rl.UserId and rl.project_Id=$eve";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row); 
      }
        
      fclose($output); 
       ob_start();
      $flag = 1;
  }
}

if(isset($_POST['fee_']))
{
  if($_SESSION["id"])
  {
  $_SESSION["projectid"]=$_POST['fee_'];
  $eve=$_SESSION["projectid"];
  $connect = mysqli_connect("localhost", "root", "", "skillmatch");  
  
  $zip_file = $eve.'.zip';
  $zip = new ZipArchive();
  if ( $zip->open($zip_file, ZipArchive::CREATE) !== TRUE) 
  {
	  exit("message");
  }
  $sq = mysqli_query($connect, "SELECT upload FROM registrants_list WHERE project_Id = $eve");
  while($rowzz = mysqli_fetch_array($sq)){
    $var = strrpos($rowzz[0],$eve."/");
    // echo $rowzz[0].$var."<br>";
    $zip->addFile($rowzz[0],substr($rowzz[0], $var+ strlen($eve)+1));
  }
  $zip->close();
  header('Content-type: application/zip');
	header('Content-Disposition: attachment; filename="'.basename($zip_file).'"');
	header("Content-length: " . filesize($zip_file));
	header("Pragma: no-cache");
  header("Expires: 0");
  
  ob_clean();
  flush();
  readfile($zip_file);
  unlink($zip_file);
  exit;
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
  <a  href="client_dashboard.php">Dashboard</a>
  <a href="profile.php">Client Profile</a>
  <a class= "active" href="projectregister.php">Add New Project</a>
  <!--<a href="kyc.php">Know Your Club</a>-->
  <!--<a href="schedule.php">Schedule</a>-->
  <a href="filterdate.php">Filter Projects by Date</a>
  <a  href="aboutus.php">About The Team</a>
<?php
if(isset($_SESSION["id"])) {
  ?>

  <div class="topnav-right">
    <a href="#"><?php echo "Welcome, ". $_SESSION["name"]."!"; ?></a>

    <?php
    }
    else{
?>
<a href="../login/login_organizer.php">You are not logged in</a>
<?php
    }
    ?>
    <a href="../login/logout.php">Logout</a>
    
  </div>
  
  
</div>
<br>

<h2 style="color:black;">List of projects Hosted By Your Club:</h2>
<br>
<button type="button" class="collapsible">All Active projects</button>
<div class="card lg-12"   id = "content">
  <?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $idx = $_SESSION["id"];
        // echo $idx;
        $query1=mysqli_query($connect,"select e.project_Name,e.project_Date,e.Picture, L.Location_Name, S.Status, e.project_Id, e.fee
        from projects as e 
        join project_location as L
        join project_status as S 
        join project_organizer as eo
        join project_org_list as eol
        join organizer_type as o
        on e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id
        and e.project_Id = eol.project_Id 
        and eol.Organizer_id = eo.Organizer_Id
        and eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where e.project_Date >= CURDATE() 
        AND eol.Organizer_id = '$idx'
        order by e.project_Date") or die("Error: " . mysqli_error($connect));
        // Change Roll No. to Session Authentication Details
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo "../".$row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="project_name" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit project"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="ert" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download Registrants list"/>
            </form>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="rew" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Reviews"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="del" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete project" onclick="myfunction()"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="collab" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Collaboration Options"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="msgss" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Sent Messages"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="status" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Send Notification to All Registrants"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="reply" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Reply/ Address Queries"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="regis" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete Registrants"/>
            </form>
          <?php
          if($row1[6])
          {
            ?>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="fee_" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download zip of User Fee Receipts"/>
            </form>
            <?php
          }
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
<button type="button" class="collapsible" >All Inactive projects</button>
<div class="card lg-12"   id = "content">
<?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno($connect))
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    { 
        $idx = $_SESSION["id"];
        $query1=mysqli_query($connect,"select e.project_Name,e.project_Date,e.Picture, L.Location_Name, S.Status, e.project_Id , e.fee
        from projects as e 
        join project_location as L
        join project_status as S 
        join project_organizer as eo
        join project_org_list as eol
        join organizer_type as o
        on e.Location_Id=L.Location_Id 
        and e.Status_Id=S.Status_Id
        and e.project_Id = eol.project_Id 
        and eol.Organizer_id = eo.Organizer_Id
        and eo.Organizer_Type_Id = o.Organizer_Type_Id 
        where e.project_Date < CURDATE() 
        AND eol.Organizer_id = '$idx'
        order by e.project_Date") or die("Error: " . mysqli_error($connect));
        // Change Roll No. to Session Authentication Details
        echo '<div class="row">' ;
        while($row1=mysqli_fetch_array($query1))
        {
          echo '<div class="col-lg-3">' ;
          echo '<div class="card" style="width: 22rem;">' ;
          ?>
          <img class="card-img-top" width="300px" height="300px" src="<?php echo "../".$row1[2]; ?>" alt="Card image">
         <?php
            echo '<div class="card-body">';
          ?>
            <h4 class="card-title"><?php echo $row1[0]; ?></h4>
            <p class="card-text"style="color:gray;">Date:     <?php echo $row1[1]; ?></p>
            <p class="card-text"style="color:gray;">Location: <?php echo $row1[3]; ?></p>
            <p class="card-text"style="color:gray;">Status:   <?php echo $row1[4]; ?></p>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="project_name" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit project"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="ert" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download Registrants list"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="rew" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Reviews"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="del" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete project"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="collab" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Collaboration Options"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="msgss" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Sent Messages"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="status" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Send Notification to All Registrants"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="regis" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete Registrants"/>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="reply" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Reply/ Address Queries"/>
            </form>
          <?php
          if($row1[6])
          {
            ?>
            </form>
            <form action="org_dashboard.php" method="post">
            <input hidden type="text"  name="fee_" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download zip of User Fee Receipts"/>
            </form>
            <?php
          }
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
  coll[i].addprojectListener("click", function() {
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

<script>
  function myfunction()
{
  alert("Are you sure, you want to delete?");
}
</script>   
<?php
if($flag == 1)
{
  ob_end_clean();
  $flag = 0;
}
?>