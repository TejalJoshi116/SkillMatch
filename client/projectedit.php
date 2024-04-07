<!-- DB but error -->
<?php
session_start();
?>
<?php
if(isset($_POST['submit']))
{
    $connect=mysqli_connect('localhost','root','','skillmatch');
    $insert=false;
    //check connection
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else{
    //echo 'Connected Successfully!!';
        $eve=$_SESSION["project_Id"];
        //$name = $_POST['name_'];
        if(isset($_POST['date_']))
        {
            $date = $_POST['date_'];  
        }
        if(isset($_POST['date_']))
        {
            $start = $_POST['date_'];  
        }
        if(isset($_POST['end_time_']))
        {
            $end = $_POST['end_time_'];  
        }
        if(isset($_POST['desc_']))
        {
            $desc = $_POST['desc_'];  
        }
        if(isset($_POST['limit_']))
        {
            $limit = $_POST['limit_'];  
        }
        if(isset($_POST['cone_']))
        {
            $cone = $_POST['cone_'];  
        }
        if(isset($_POST['conp_']))
        {
            $conp = $_POST['conp_'];  
        }
        if(isset($_POST['type_id']))
        {
            $type = $_POST['type_id'];  
        }
        if(isset($_POST['location_id']))
        {
            $loc = $_POST['location_id'];  
        }
        if(isset($_POST["fee"]))
        {
            $fee = $_POST['conp_'];  
        }


        if(!empty($name)){ 
            mysqli_query($connect,"UPDATE projects SET project_Name = $name WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($date)){ 
            mysqli_query($connect,"UPDATE projects SET project_Date = '$date' WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($start)){ 
            mysqli_query($connect,"UPDATE projects SET project_Start_Time = '$start' WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($end)){ 
            mysqli_query($connect,"UPDATE projects SET project_End_Time = '$end' WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($desc)){ 
            mysqli_query($connect,"UPDATE projects SET Description = '$desc' WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($limit)){ 
            mysqli_query($connect,"UPDATE projects SET project_Limit = $limit WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($loc)){ 
            mysqli_query($connect,"UPDATE projects SET Location_Id = $loc WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($type)){ 
            mysqli_query($connect,"UPDATE projects SET project_Type_Id = $type WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }
        if(!empty($fee)){ 
            mysqli_query($connect,"UPDATE projects SET fee = $fee WHERE project_Id = $eve") or die("Error2: " . mysqli_error($connect));
            
        }


      
        // $image = $_FILES['image']['tmp_name'];
        // $image = addslashes(file_get_contents($image))
        
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
</style>

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
<?php
    $connect=mysqli_connect('localhost','root','','skillmatch');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to database: '.mysqli_connect_error();
    }
    else
    {
        $eve=$_SESSION["project_Id"];
        //echo $eve;
        $query1=mysqli_query($connect,"SELECT * FROM projects WHERE project_Id='$eve'") or die("Error1: " . mysqli_error($connect));
        $row1=mysqli_fetch_array($query1);
        //echo $row1[1];
        $l=$row1[7];
        //$query4=mysqli_query($connect,"SELECT project_Type_Name FROM project_type WHERE project_Type_Id='$row1[7]'") or die("Error4: " . mysqli_error($connect));
       // $row7=mysqli_fetch_array($query4);
        //$query5=mysqli_query($connect,"SELECT `Status` FROM event_status WHERE Status_Id='$row1[9]'") or die("Error5: " . mysqli_error($connect));
        //$row6=mysqli_fetch_array($query5);
        //echo $row1[1];
    }
    
    ?>
</div>

    <body>
    <form enctype="multipart/form-data" action="projectedit.php" method="post">
            <tr>
                <td>
                    Project Name : 
                </td>
                <td>
                    <input type= "text" id = "name_" name = "name_" placeholder="<?php echo $row1[1]; ?>" maxlength="128" size="60" disabled required/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                 Project Date : 
                </td>
                <td>
                    <input type= "date" id = "date_" name = "date_" value="<?php echo $row1[2]; ?>" size="20" />   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                Project Start date : 
                </td>
                <td>
                    <input type= "date" id = "date_" name = "date_" value="<?php echo $row1[2]; ?>" size="20" />    
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                Project End date : 
                </td>
                <td>
                    <input type= "date" id = "date_" name = "date_" value="<?php echo $row1[2]; ?>" size="20" />   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                Project Description : 
                </td>
                <td>
                    <textarea type= "text" id = "desc_" name = "desc_" placeholder="<?php echo $row1[4]; ?>" maxlength="4096" cols="100" rows="5"></textarea>
                </td>   
            </tr> <br> <br> 

            <tr>
                <td>
                Project Limit : 
                </td>
                <td>
                    <input type= "number"  name = "limit_" placeholder="<?php echo $row1[6]; ?>" maxlength="4096" size="60"/>   
                </td>   
            </tr> <br> <br> 
            <tr>
                <td>
                Project Type :
                </td>
                <td>
                    <select name ="type_id" id = "type_id" > 
                        <option selected value="<?php echo $row7[0]; ?>"><?php echo $row7[0]; ?></option>
                        <?php 
                            $conn=mysqli_connect('localhost','root','','skillmatch'); 
                            $result=mysqli_query($conn,'SELECT project_Type_Id,project_Type_Name FROM project_type ORDER BY project_Type_Name'); 
                            while($row=mysqli_fetch_assoc($result)) {
                                echo "<option value='$row[project_Type_Id]'>$row[project_Type_Name]</option>"; 
                            } 
                        ?> 
                    </select>
                </td>
            </tr> <br><br>
            <tr>
                <td>
                Project payment :
                </td>
                <td>
                    <select name ="conp_" id = "limit_"> 
                        <option selected value = "<?php echo $row1[11]?>"><?php 
                        if($row1[11])
                        {
                            echo "Yes, There is fee payment";
                            echo "</option>";
                            echo "<option value=0>No, There is no fee payment</option> ";
                        }
                        else
                        {
                            echo "No, There is no fee payment";
                            echo "</option>";
                            echo "<option value=1>Yes, There is fee payment</option> ";
                        }
                        ?>
                    </select>
                </td>
            </tr> <br><br> 
            <input type="submit" name="submit" value="Submit"/>
            <input type="reset" value="Reset"/>
            <br><br>    

        </form>
        
    </body>
</html>
