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
  <a href="profile.php">Client Profile</a>
  <a href="projectregister.php">Add New Project</a>
  <a class="active" href="display_registrants.php">Selection</a>
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
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* Add your custom CSS styles here */
        .registrant-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Applicants List</h2>
    <div class="row">
        <?php
            // Connect to the database
            $connect = mysqli_connect("localhost", "root", "", "skillmatch");
            if(mysqli_connect_errno())
               {
                    echo 'Failed to connect to database: '.mysqli_connect_error();
               }

               $project_Id = $_POST['project_Id'];

                // Output the project_Id
                echo "<p>Project ID: $project_Id</p>";
               
            // Check if the event ID is provided in the POST request
            if(isset($_POST['project_Id']) && isset($_SESSION["id"])) {
               // echo "Here_inside if";
               //  $temp = $_POST['project_Id'];
               //  echo $temp;
                // Construct the SQL query to fetch registrants' data
                $query = "SELECT u.Registered_Name, u.UserId, u.Contact_No, u.Mail_Id, rl.Time_Stamp 
                FROM user u JOIN applicants_list rl ON u.UserId = rl.UserId
                WHERE rl.project_Id = ?";

               // Prepare the statement
               $stmt = mysqli_prepare($connect, $query);

               // Bind the parameter
               mysqli_stmt_bind_param($stmt, "i", $project_Id);

               // Execute the query
               mysqli_stmt_execute($stmt);

               // Get the result
               $result = mysqli_stmt_get_result($stmt);
                echo "Here_got result";
                
                // Check if there are registrants
                if(mysqli_num_rows($result) > 0) {
                    // Loop through the results and display them as cards
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-md-4'>
                                <div class='registrant-card'>
                                    <h4>".$row['Registered_Name']."</h4>
                                    <p><strong>User ID:</strong> ".$row['UserId']."</p>
                                    <p><strong>Contact No:</strong> ".$row['Contact_No']."</p>
                                    <p><strong>Mail ID:</strong> ".$row['Mail_Id']."</p>
                                    <p><strong>Timestamp:</strong> ".$row['Time_Stamp']."</p>
                                    <form action='select_registrant.php' method='post'>
                                        <input type='hidden' name='user_id' value='".$row['UserId']."'>
                                        <input type='hidden' name='project_Id' value='".$project_Id."'>
                                        <input type='submit' class='btn btn-primary' value='Select'>
                                    </form>

                                    <form action='view_profile.php' method='post'>
                                        <input type='hidden' name='user_id' value='".$row['UserId']."'>
                                        <input type='submit' class='btn btn-success' value='View Profile'>
                                    </form>
                                </div>
                              </div>";
                    }
                }
                
                else {
                    echo "<div class='col-md-12'><p>No applicants found for this project.</p></div>";
                }
                
                // Close the database connection
                mysqli_close($connect);
            } elseif(isset($_POST['project_Id']))
            {
                echo "<div class='col-md-12'><p>No Session ID</p></div>";
            }
            elseif(isset($_SESSION["id"]))
            {
                echo "<div class='col-md-12'><p>No Post project_Id</p></div>";
            }
            else {
                echo "<div class='col-md-12'><p>Invalid request.</p></div>";
            }
        ?>
    </div>
</div>

</body>
</html>