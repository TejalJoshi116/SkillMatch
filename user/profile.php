<?php
session_start();

$connect=mysqli_connect('localhost','root','','skillmatch');
if(mysqli_connect_errno())
{
    echo 'Failed to connect to database: '.mysqli_connect_error();
}
else
{   
    $user_id = $_SESSION["id"];

    // Fetch user details from the database
    $query = mysqli_query($connect, "SELECT * FROM users WHERE user_id='$user_id'") or die("Error: " . mysqli_error($connect));
    $user_row = mysqli_fetch_assoc($query);
    echo $user_row;

    // Fetch user portfolio details from the database
    $portfolio_query = mysqli_query($connect, "SELECT * FROM user_portfolio WHERE user_id='$user_id'") or die("Error: " . mysqli_error($connect));
    $portfolio_row = mysqli_fetch_assoc($portfolio_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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

/* .active, .collapsible:hover {
  background-color: #555;
} */

.content {
  padding: 0 18px;
  display: none;
  /* /overflow: hidden;/ */
  background-color: #f1f1f1;
}







/* 

body{ 
     background: -webkit-linear-gradient(left, #3931af, #00c6ff); 
} */
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
#responsive-image {  width: 200px;  height: 200px; } 
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
    left:365px;
    bottom:90px;
}

</style>
</head>
<body>
    <div class="topnav">
        <!-- Top navigation content -->
    </div>
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <!-- Display user profile image -->
                    <img src="<?php echo "../" . $user_row['profile_picture']; ?>" id="responsive-image" alt="Profile Picture">
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3><?php echo $user_row['display_name']; ?></h3>
                    <h6><?php echo $user_row['email']; ?></h6>
                    <!-- Display other user details -->
                </div>
            </div>
            <div class="col-md-2">
                <!-- Edit Profile Button -->
                <form action="profile.php" method="POST">
                    <input type="submit" name="btnAddMore" value="Edit Profile"/>
                    <?php 
                    if(isset($_POST["btnAddMore"]))
                    {
                        // Your code for handling profile edit submission
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="row" id="page5">
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User ID</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $user_row['user_id']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?php echo $user_row['email']; ?></p>
                            </div>
                        </div>
                        <!-- Display other user details -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
