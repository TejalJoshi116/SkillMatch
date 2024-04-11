<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

#responsive-image {  width: 100%;  height: 200px; } 

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
.content {
  padding: 0 18px;
  display: none;
  /overflow: hidden;/
  background-color: #f1f1f1;
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff; 
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;     
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work input{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
#page5{
    position:relative;
    left:355px;
    bottom:95px;
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
  <a class="active" href="profile.php">Client Profile</a>
  <a href="projectregister.php">Add New Project</a>
  <!--<a href="applicants.php">Applicants Club</a-->
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
<br><?php

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

$query = "SELECT u.UserId, u.Registered_Name, u.Mail_Id as Email ,al.upload
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


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants for Project</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        a {
            color: blue;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Applicants for Project</h2>
    <form action="update_applicant.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    
                    <th>Resume</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['UserId']; ?></td>
                        <td><?php echo $row['Registered_Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
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
