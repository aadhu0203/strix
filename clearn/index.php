<?php
session_start();

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sign-up logic
    if (isset($_POST["signup"])) {
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["pass"];

        if (!empty($email) && !empty($password) && !is_numeric($email)) {
            // Use backticks around column names with spaces
            $query = "INSERT INTO signup (`First Name`, `Last Name`, Email, Username, Password) VALUES ('$firstname','$lastname','$email','$username','$password')";

            mysqli_query($conn, $query);

            echo "<script type='text/javascript'> alert('Successfully Registered')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Enter Valid Info')</script>";
        }
    }

    // Sign-in logic
    if (isset($_POST["signin"])) {
        $username = $_POST["signin_username"];
        $password = $_POST["signin_pass"];

        if (!empty($username) && !empty($password) && !is_numeric($username)) {
            $query = "SELECT * FROM signup WHERE Username = '$username' LIMIT 1";
            $result = mysqli_query($conn, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data["Password"] == $password) {
                    header("location: login.php");
                    exit;
                }
            }
            echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Learning App SignUp/Login </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form action="" method="POST">
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="text" name="fname" required>
                    <label for="">First Name</label>
                </div>
                <div class="input-group">
                    <input type="text" name="lname" required>
                    <label for="">Last Name</label>
                </div>
                <div class="input-group">
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-group">
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="pass" required>
                    <label for="">Password</label>
                </div>
                <button type="submit" name="signup" class="btn">Sign Up</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="#" class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper sign-in">
            <form action="" method="POST">
                <h2>Login</h2>
                <div class="input-group">
                    <input type="text" name="signin_username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-group">
                    <input type="password" name="signin_pass" required>
                    <label for="">Password</label>
                    
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="signin" class="btn">Login</button>
                <div class="sign-link">
                    <p>Don't have an account? <a href="#" class="signUp-link">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
