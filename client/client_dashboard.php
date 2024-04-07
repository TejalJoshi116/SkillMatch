<!-- DB -->
<?php
  session_start();
  if(isset($_POST['project_name']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['project_name'];
  header("Location:projectedit.php");
  }
}
$flag = 0;
if(isset($_POST['rew']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['rew'];
  header("Location:viewreview.php");
  }
}
if(isset($_POST['reply']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['reply'];
  header("Location:reply_queries.php");
  }
}
if(isset($_POST['collab']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['collab'];
  header("Location:addcollab.php");
  }
}
if(isset($_POST["msgss"]))
{
  if($_SESSION["id"])
  {
    $_SESSION["project_Id"]=$_POST['msgss'];
    header("Location:posted_messages.php");
  }
}
if(isset($_POST['status']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['status'];
  header("Location:send_messages.php");
  }
}
if(isset($_POST['regis']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['regis'];
  header("Location:delete_registrants.php");
  }
}

if(isset($_POST['del'])) {
  if($_SESSION["id"]) {
      $_SESSION["project_Id"]=$_POST['del'];
      $eve=$_SESSION["project_Id"];
      $conn=mysqli_connect('localhost','root','','skillmatch');
      $delete=false;
      if(mysqli_connect_errno()) {
          echo 'Failed to connect to database: '.mysqli_connect_error();
      } else {
          $id = $eve;
          $result1=mysqli_query($conn,"DELETE FROM project_client_list WHERE project_Id = '$id'") or die("Error1: " . mysqli_error($conn));
          $result2=mysqli_query($conn,"DELETE FROM project_contact WHERE project_Id = '$id'") or die("Error2: " . mysqli_error($conn));
          $result3=mysqli_query($conn,"DELETE FROM applicants_list WHERE project_Id = '$id'") or die("Error3: " . mysqli_error($conn));
          $result4=mysqli_query($conn,"DELETE FROM review WHERE project_Id = '$id'") or die("Error4: " . mysqli_error($conn));
          $result5=mysqli_query($conn,"DELETE FROM messages WHERE project_Id = '$id'") or die("Error5: " . mysqli_error($conn));
          $sql = "DELETE FROM `skillmatch`.`projects` WHERE project_Id = '$id'" or die("Error6: " . mysqli_error($conn));
          if($conn->query($sql) == true){
              $delete = true;
              $result='<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Form</strong> Successfully submitted.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
              echo "<center>".'Deleting........'."</center>"."<br>";
              echo '<center><br>'."Redirecting to Dashboard.....".'</center>';
              echo "<script>setTimeout(\"location.href = 'org_dashboard.php';\",3000);</script>";
          } else {        
              echo "ERROR: $sql <br> $conn->error";
          }
          $conn->close();
      }
  }
} 

if(isset($_POST['ert']))
{
  if($_SESSION["id"])
  {
  $_SESSION["project_Id"]=$_POST['ert'];
  $eve=$_SESSION["project_Id"];
  $connect = mysqli_connect("localhost", "root", "", "skillmatch");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv'); 
      ob_start();
      ob_end_clean();
      $output = fopen("php://output", "w");  
      
      fputcsv($output, array('Registered Name', 'Roll No', 'Contact No', 'MailId','Timestamp'));  
      $query = "SELECT u.Registered_Name,u.UserId,u.Contact_No,u.Mail_Id, rl.Time_Stamp from user u,registrants_list rl where u.UserId=rl.UserId and rl.Event_Id=$eve";  
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
  $_SESSION["project_Id"]=$_POST['fee_'];
  $eve=$_SESSION["project_Id"];
  $connect = mysqli_connect("localhost", "root", "", "skillmatch");  
  
  $zip_file = $eve.'.zip';
  $zip = new ZipArchive();
  if ( $zip->open($zip_file, ZipArchive::CREATE) !== TRUE) 
  {
	  exit("message");
  }
  $sq = mysqli_query($connect, "SELECT upload FROM registrants_list WHERE Event_Id = $eve");
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
  <a class="active" href="client_dashboard.php">Dashboard</a>
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

<h2 style="color:black;">List of Projects:</h2>
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
        $idx = $_SESSION["id"];
        // echo $idx;
        $query1 = mysqli_query($connect, "SELECT p.project_Name, p.project_Date, p.Picture, p.project_Id, p.fee
        FROM projects AS p 
        JOIN project_client_list AS pcl ON p.project_Id = pcl.project_Id
        JOIN client AS c ON pcl.client_id = c.client_id
        WHERE p.project_Date >= CURDATE() 
        AND pcl.client_id = '$idx'
        ORDER BY p.project_Date") or die("Error: " . mysqli_error($connect));

        // $query1=mysqli_query($connect,"select p.project_Name, p.project_Date, p.Picture, pl.Location_Name, ps.Status, p.project_Id, p.fee
        // from projects as p 
        // join project_location as pl
        // join project_status as ps
        // join client as c
        // join project_client_list as pcl
        // join client_type as ct
        // on p.Location_Id=pl.Location_Id 
        // and p.Status_Id=ps.Status_Id
        // and p.project_Id = pcl.project_Id 
        // and pcl.client_id = c.client_id
        // and c.client_Type_Id = ct.client_Type_Id 
        // where p.project_Date >= CURDATE() 
        // AND pcl.client_id = '$idx'
        // order by p.project_Date") or die("Error: " . mysqli_error($connect));
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
            <p class="card-text"style="color:gray;">Fee: Rs. <?php echo $row1[4]; ?></p>
            <!-- <p class="card-text"style="color:gray;">Status:   -->
              <!-- <?php echo $row1[4]; ?></p> --> 
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="project_name" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit Project"/>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="download_registrants" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Download Applicants list"/>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="del" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete Event" onclick="myfunction()"/>
            </form>
            <!-- <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="collab" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Collaboration Options"/>
            </form> -->
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="msgss" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="View Sent Messages"/>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="status" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Send Notification to All Applicants"/>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="reply" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Reply/ Address Queries"/>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="regis" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Delete Applicants"/>
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


<!-- <br><br>
<button type="button" class="collapsible" >All Inactive Projects</button>
<div class="card lg-12"   id = "content"> -->
<!-- <?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    { 
        $idx = $_SESSION["id"];
        $query1=mysqli_query($connect,"select p.project_Name, p.project_Date, p.Picture, pl.Location_Name, ps.Status, p.project_Id , p.fee
        from projects as p 
        join project_location as pl
        join project_status as ps
        join client as c
        join project_client_list as pcl
        join client_type as ct
        on p.Location_Id=pl.Location_Id 
        and p.Status_Id=ps.Status_Id
        and p.project_Id = pcl.project_Id 
        and pcl.client_id = c.client_id
        and c.client_Type_Id = ct.client_Type_Id 
        where p.project_Date < CURDATE() 
        AND pcl.client_id = '$idx'
        order by p.project_Date") or die("Error: " . mysqli_error($connect));
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
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="project_Id" value="<?php echo $row1[5]; ?>" />
            <input  type="submit" class="btn btn-primary" value="Edit Project"/>
            </form>
            <!-- More form actions here -->
          <?php
          if($row1[6])
          {
            ?>
            </form>
            <form action="client_dashboard.php" method="post">
            <input hidden type="text"  name="download_fee_receipts" value="<?php echo $row1[5]; ?>" />
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
?> -->
<!-- </div> -->

<br><br>

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
