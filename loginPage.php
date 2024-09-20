<?php
session_start(); // Start the session at the very top

include "templates/header.php";
require_once('db_connector.php');

// Initialize variables
$emailError = "";
$passwordError = "";
$checkError = "";
$email = "";
$password = "";
$messageError = "";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $check = isset($_POST["checkme"]);
    $error = false;

    // Validate email
    if (empty($email)) {
        $error = true;
        $emailError = "Email must be inputted <br>";
    }

    // Validate password
    if (empty($password)) {
        $error = true;
        $passwordError = "Password must be inputted <br>";
    }

    // Validate checkbox
    if (empty($check)) {
        $error = true;
        $checkError = "Check the checkbox. <br>";
    }

    // Process login if no errors
    if (!$error) {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["user_password"])) {
                $_SESSION['name'] = $row["user_id"];
                header("Location: mainDash.php");
                exit(); // Ensure script stops execution after redirection
            } else {
                $messageError = "Incorrect Password";
            }
        } else {
            $messageError = "User not found";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/lognew.css">
    <title>Login</title>
</head>
<body>
    <div class="loginContainer">
        <div class="loginTitle">
            <h1 id="loginTitle">Note<span id="spanLogo">It!</span></h1>
        </div>
        <div class="formContainer">
            <form action="" method="post">
                <label for="">Email:</label><br>
                <input class="nameText" type="text" name="email" placeholder="Enter your Email" value="<?php echo htmlspecialchars($email); ?>"><br>
                <label for="" id="emailError"><?php echo $emailError; ?></label><br>
                <label for="">Password:</label><br>
                <input class="passwordText" type="password" name="password" placeholder="Enter Password" value="<?php echo htmlspecialchars($password); ?>"><br>
                <label for="" id="passwordError"><?php echo $passwordError; ?></label><br>
                <input id="checkbox" type="checkbox" name="checkme">
                <label for="">Sign Me In</label>
                <a class="forgotPass" href="forgot_password.php">Forgot Password?</a><br>
                <label for="" id="checkError"><?php echo $checkError; ?></label>
                <button class="signInBtn">SIGN IN</button>
                <label for="" id="passwordError"><?php echo $messageError; ?></label>
            </form>
        </div>
    </div>
</body>
</html>