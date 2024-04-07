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
<link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css'>
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
.text{
    position:absolute;
    bottom: 260px;
     left:350px; 
}
#bt1{
  position:relative;
  left:45px;
  top:170px;
  
}
#bt2{
  position:relative;
  left:50px;
  top:170px;
  
}
.par{
  position:absolute;

}
.tet{
  position:relative;
  left:120px;
  bottom:160px;
}

body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
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
  <a class="active" href="filterdate.php">Filter Project by Date</a>
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

<form action="filterdate.php" method="post">
Start Date
<input type= "date" id = "date_" name = "sdate_" value = <?php echo date("m/d/Y"); ?> size="20" /><br><br>
End Date
<input type= "date" id = "date_" name = "edate_" size="20" />
<input type="submit" value="submit" name="submit">
</form>
<hr style="height:2px; color:black; background-color:black">
<?php
if(isset($_POST['submit'])){
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        
        {
            $sdate = $_POST['sdate_']; 
            $edate =$_POST['edate_']; 
        }

        $query1=mysqli_query($connect,"SELECT p.project_Name, p.project_Date, pl.Location_Name, ps.Status, pc.contact_no, p.project_Id 
        FROM projects AS p 
        JOIN project_location AS pl ON p.Location_Id = pl.Location_Id 
        JOIN project_status AS ps ON p.Status_Id = ps.Status_Id 
        JOIN project_contact AS pc ON p.project_Id = pc.project_Id 
        WHERE p.project_Date >= '$sdate' AND p.project_Date <= '$edate' 
        ORDER BY p.project_Date") or die("Error: " . mysqli_error($connect));
          

        
        echo "<table border='2'>
        <tr>
        </tr>"."<h4>Projects Scheduled Between ".$sdate." and ".$edate."</h4>"."<tr>
        <th width='200px'>Project Name</th>
        <th>Project Date</th>
        <th>Location Name</th>
        <th>Status</th>
        <th width='200px'>Client Contacts</th>
        <th>Contacts</th>
        </tr>";
        // Execute the query
        
        while($row1=mysqli_fetch_array($query1))
        {
            echo "<tr>";
            echo "<td>" . $row1[0] . "</td>";
            echo "<td>" . $row1[1] . "</td>";
            echo "<td>" . $row1[2] . "</td>";
            echo "<td>" . $row1[3] . "</td>";
            $query2 = mysqli_query($connect,"SELECT c.client_Name
            FROM projects AS p 
            JOIN client AS c 
            JOIN project_client_list AS pcl
            ON p.project_Id = pcl.project_Id
            AND pcl.client_id = c.client_id
            WHERE pcl.project_Id =  $row1[5] AND p.project_Date >= '$sdate' AND p.project_Date <= '$edate' 
            ORDER BY p.project_Date") or die("Error: " . mysqli_error($connect));?>
            <td> <?php 
                $zz = mysqli_query($connect,"SELECT COUNT(*)
                FROM projects AS p 
                JOIN client AS c 
                JOIN project_client_list AS pcl
                ON p.project_Id = pcl.project_Id
                AND pcl.client_id = c.client_id
                WHERE pcl.project_Id =  $row1[5] AND p.project_Date >= '$sdate' AND p.project_Date <= '$edate' 
                ORDER BY p.project_Date") or die("Error: " . mysqli_error($connect));   
                $z1 = mysqli_fetch_array($zz);
                while($row2=mysqli_fetch_array($query2)) 
                {
                    if($z1[0] ==1){
                        echo $row2[0];
                    }
                    else{
                        echo $row2[0]." and ";
                    }
                    $z1[0] = $z1[0]-1;  
                }
                
            ?></td>

            <?php
            echo "<td>" . $row1[4] . "</td>";
            echo "</tr>"; 


            
        }
    }
    echo "<br>";
    $connect->close(); }    
?>
