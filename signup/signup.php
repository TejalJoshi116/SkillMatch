<?php
include("../connect.php"); // Assuming this file includes your database connection

session_start();
$message = "";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["user_type"])) {
    $con = mysqli_connect('localhost', 'root', '', 'skillmatch') or die('Unable To connect');

    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $user_type = mysqli_real_escape_string($con, $_POST["user_type"]);
    $hash = hash('sha256', $password);

    // Check if the username is already taken in user_auth or client_auth tables
    $check_username_query = "SELECT * FROM user_auth WHERE username='$username' UNION SELECT * FROM client_auth WHERE username='$username'";
    $check_username_result = mysqli_query($con, $check_username_query);
    if (mysqli_num_rows($check_username_result) > 0) {
        $message = "Username already exists. Please choose a different username.";
    } else {
        // Insert new user into the appropriate authentication table based on user_type
        if ($user_type === 'professional') {
            $insert_query = "INSERT INTO user_auth (username, password_hash) VALUES ('$username', '$hash')";
            if (mysqli_query($con, $insert_query)) {
                $UserId = mysqli_insert_id($con);
                echo "$UserId";
                // Insert corresponding entry into user table
                $insert_query_2 = "INSERT INTO user (UserId, Registered_Name) VALUES ('$UserId','$username')";
                if (mysqli_query($con, $insert_query_2)) {
                    $message = "Registration successful. You can now login.";
                } else {
                    $message = "Error: " . mysqli_error($con);
                }
            } else {
                $message = "Error: " . mysqli_error($con);
            }
        
        } elseif ($user_type === 'client') {
            $insert_query = "INSERT INTO client_auth (username, password_hash) VALUES ('$username', '$hash')";
            if (mysqli_query($con, $insert_query)) {
                $client_id = mysqli_insert_id($con);
                // Insert corresponding entry into clients table
                $insert_query_2 = "INSERT INTO client (client_id,client_Name) VALUES ('$client_id', '$username')";
                
                if (mysqli_query($con, $insert_query_2)) {
                    $message = "Registration successful. You can now login.";
                } else {
                    $message = "Error: " . mysqli_error($con);
                }
            } else {
                $message = "Error: " . mysqli_error($con);
            }
        } else {
            $message = "Invalid user type.";
        }

    
    }

    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Numans');

        html, body {
            background-image: url('https://getwallpapers.com/wallpaper/full/e/7/4/90169.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }

        .topframe {
            display: flex;
            align-items: center;
        }
        

        #logo {
            margin-right: 10px; /* Adjust margin as needed */
        }

        .container {
          height: 100%;
          align-content:center; 
        }

        .card {
            height: 480px;
            margin-top: auto;
            margin-bottom: 400px;
            width: 400px;
            background-color: rgba(0,0,0,0.5) !important;
        }

        .social_icon span {
            font-size: 60px;
            margin-left: 10px;
            color: #FFC312;
        }

        .social_icon span:hover {
            color: white;
            cursor: pointer;
        }

        .card-header h3 {
            color: white;
        }

        .social_icon {
            position: absolute;
            right: 20px;
            top: -45px;
        }

        .input-group-prepend span {
            width: 50px;
            background-color: #FFC312;
            color: black;
            border: 0 !important;
        }

        input:focus {
            outline: 0 0 0 0 !important;
            box-shadow: 0 0 0 0 !important;
        }

        .remember {
            color: white;
        }

        .remember input {
            width: 20px;
            height: 20px;
            margin-left: 15px;
            margin-right: 5px;
        }

        .login_btn {
            color: black;
            background-color: #FFC312;
            width: 100px;
        }

        .login_btn:hover {
            color: black;
            background-color: white;
        }

        .links {
            color: white;
        }

        .links a {
            margin-left: 4px;
        }

        .signup-link {
            color: white;
            text-align: left;
        }

        .signup-link a {
            color: white;
            text-decoration: underline;
        }

        .card-footer{
          color: white;
        }
    </style>
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
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="user_type">Register as</label>
                                <select class="form-control" id="user_type" name="user_type" required>
                                    <option value="">Select</option>
                                    <option value="client">Client</option>
                                    <option value="professional">Student/Professional</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Register">
                            </div>
                        </form>
                        <div class="message text-danger"><?php echo $message; ?></div>
                    </div>
                    <div class="card-footer">
                        <?php
                        if (isset($_POST["user_type"]) && $_POST["user_type"] === 'client') {
                            echo '<p>Already have an account? <a href="../login/login_client.php">Login here</a></p>';
                        } else if (isset($_POST["user_type"]) && $_POST["user_type"] === 'user') {
                            echo '<p>Already have an account? <a href="../login/login_user.php">Login here</a></p>';
                        } else {

                            // +++ Always goes to else as unless you press register, usertype is not selected

                            echo '<p>Already have an account? <a href="../login/login_user.php">Login here</a></p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>