<?php

session_start();

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/newlandcss.css">
    <title>Document</title>
    <?php
        if(!isset($_SESSION['name'])) {
            header("Location: loginPage.php");
          exit();
        }
        if(isset($_SESSION["name"])) {
        header("Location: mainDash.php");
        }
    ?>
</head>
<body>
<?php

    include "templates/header.php";

?>
    <div class = "contents">
        <div class = "imgContainer">
            <img src="images/landing.PNG" alt="">
        </div>
        <div class = "contentText">
            <div class = "text">
                <h1>Note<span id = "spanLogo">It!</span></h1>
            </div>
            <div class = "bodyText">
                <p>Meet NoteIt!, the modernized app that makes note-taking a breeze. Jot down ideas effortlessly, organize them with ease, and retrieve information lightning-fast. Its customized formatting options and ideal sharing capabilities make NoteIt! an  indispensable tool for maximizing your efficiency.</p>
            </div>
            
        </div>
    </div>
</body>
</html>