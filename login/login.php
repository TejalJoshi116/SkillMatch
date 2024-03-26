<?php
session_start();
$message = "";

if (isset($_POST['login'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'SkillMatch_db') or die('Unable to connect');

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Client login
    if ($username == "client" && $password == "client_password") {
        $_SESSION["user_type"] = "client";
        header("Location: ../client_dashboard.php");
        exit();
    }

    // Student/Professional login
    $hash = hash('sha256', $password);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION["user_type"] = "student_professional";
        $_SESSION["user_id"] = $row['user_id']; // Assuming 'user_id' is the primary key of the 'users' table
        header("Location: ../student_professional_dashboard.php");
        exit();
    } else {
        $message = "Invalid username or password!";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SkillMatch</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="message"><?php echo $message; ?></div>
            </div>
        </div>
    </div>
</body>
</html>
