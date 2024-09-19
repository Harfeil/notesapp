<?php

    session_start();

    include "templates/header.php";
    require_once('db_connector.php');

        $email = "";
        $password = "";
        $cPassword = "";
        $emailError = "";
        $passwordError = "";
        $cPasswordError = "";
        $accError = "";
        $status = isset($_SESSION["status"]) ? $_SESSION["status"] : "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $cPassword = $_POST["cPassword"];
        $error = false;

        if(empty($email)){
            $error = true;
            $emailError = "Email must be inputted <br>";
        } else {
            $error = false;
        }

        if (!preg_match("/[A-Z]/", $password)) {
            $error = true;
            $passwordError = "Password must contain at least one capital letter.<br>";
        }

        if (!preg_match("/[^a-zA-Z0-9]/", $password)){ 
            $error = true;
            $passwordError = "Password must contain at least one special character.<br>";
        }

        if(empty($password)){
            $error = true;
            $passwordError = "Password must be inputted <br>";
        }
        
        if($cPassword !== $password){
            $error = true;
            $cPasswordError = "Password not match";
        }

        if(empty($cPassword)){
            $error = true;
            $cPasswordError = "Confirm Password must be inputted <br>";
        }

        if($error === false){
            $sql = "SELECT user_password FROM users WHERE user_email = '$email'";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET user_password = '$hashedpassword' WHERE user_email = '$email'";

                if ($connection->query($sql) === TRUE) {
                } else {
                    $connection->error;
                }
                $email = "";
                $password = "";
                $cPassword = "";
            }else{
                $accError = "Email not found";
            }
        }

    }
?>
<link rel="stylesheet" href="styles/forgotPass.css">



<div class="loginContainer">
    <div class="loginTitle">
        <h1 id="loginTitle">Note<span id="spanLogo">It!</span></h1>
    </div>
    <div class="formContainer">
        <form action="reset_password.php" method="post">
            <label for="email">Email:</label><br>
            <input id="email" type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
            <label for="emailError" class="error"><?php echo $emailError; ?></label><br>
            <button id="submit" name="submit_password_btn">Submit</button><br>
            <label for="status" class="status"><?php echo $status; ?></label><br>
        </form>
    </div>
</div>
</body>
</html>