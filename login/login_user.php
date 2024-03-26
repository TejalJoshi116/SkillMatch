<?php
session_start();
$message = "";

if (isset($_POST["user_name"]) && isset($_POST["password"])) {
    $con = mysqli_connect('localhost', 'root', '', 'skillmatch') or die('Unable To connect');

    $username = mysqli_real_escape_string($con, $_POST["user_name"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $hash = hash('sha256', $password);

    $result = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username . "' AND password_hash = '$hash'");
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["username"] = $row['username'];
        $_SESSION["user_type"] = $row['user_type'];

        // Update last login time
        mysqli_query($con, "UPDATE users SET last_login = CURRENT_TIMESTAMP() WHERE user_id='" . $row['user_id'] . "'");

        header("Location: ../dashboard.php"); // Redirect to dashboard or logged-in page
        exit();
    } else {
        $message = "Invalid Username or Password!";
    }

    mysqli_close($con);
}

if (isset($_SESSION["user_id"])) {
    header("Location: ../dashboard.php"); // Redirect to dashboard if already logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
background-image: url('https://getwallpapers.com/wallpaper/full/e/7/4/90169.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content:end; 

}

.card{
height: 340px;
margin-top: auto;
margin-bottom: 250px;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.home-redirect a{
     color: white; /* Set text color to white */

}

.links a{
margin-left: 4px;
}

.signup-link {
            color: white; /* Set text color to white */
            text-align: left; /* Center-align the text */
        }
/*.signup-link a {
            color: white; 
            text-decoration: underline; 
        }*/

.topframe {
    display: flex;
    align-items: center;
}

#logo {
    margin-right: 10px; /* Adjust margin as needed */
}

</style>

</head>



</head>

<body>
     <div class="topframe"> 
          <div class="top" id="logo">
               <img src="SkillMatch_logo-removebg-preview.png" alt="Skill Match logo" height="100px" width="100px">
          </div> 
          <div class="top" id="heading">
               <h1>Skill Match</h1>
          </div>
     </div>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>User Sign In</h3>
                </div>
                <div class="card-body">
                    <form name="frmUser" method="post">
                        <div class="message" style="color: white;"><?php echo $message; ?></div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="user_name" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="signup-link">New to SkillMatch? <a href="../signup/signup.php">Sign Up here!</a></p>

                    <div class="home-redirect">
                         <a href="../Homepage/home.php">Go back to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
