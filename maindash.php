

<?php
require_once('db_connector.php');

session_start();
// Check if the user is logged in, if not then redirect to login page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST["editNotes"])){
      $name = $_POST['name'];
      $message = $_POST['message'];
      $currentDate = date("Y-m-d");
      $id = $_POST['id'];

      $sql = "UPDATE note_tbl SET note_name = '$name',note_message = '$message', note_date = '$currentDate' WHERE note_id = '$id'";

        if ($connection->query($sql) === TRUE) {
        } else {
          $connection->error;
        }
    }
          

    if (isset($_POST["addNotes"])) {
    
      $name = $_POST['name'];
      $message = $_POST['message'];
      $currentDate = date('Y-m-d');
      $status = "New";
      $user_id = $_SESSION["name"];

      if(empty($name)){
        $name = "Untitled Notes";
      }

      if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $name = "Untitled Notes";
      }

      $sql = "INSERT INTO note_tbl (note_name, note_date, note_message, note_status, user_id) VALUES ('$name' , '$currentDate','$message', '$status', '$user_id')";
      $result = $connection->query($sql);
    }
    
     if (isset($_POST['noteIdStat']) && isset($_POST['status'])){

      $status = $_POST["status"];
      $id = $_POST["noteIdStat"];

      $sql = "UPDATE note_tbl SET note_status = '$status' WHERE note_id = '$id'";

      if ($connection->query($sql) === TRUE) {
      } else {
        $connection->error;
      }
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/cssnewdashboard.css">
    <title>Document</title>
</head>
<body>

<?php

   if(!isset($_SESSION["name"])) {
      header("Location: loginpage.php");
    }

?>
<div class="dashboardContainer">
    <div class="sidebar">
        <div class="logo">
            <h1>Note<span id="spanLogo">It!</span></h1>
        </div>
        <div class="listContainer">
            <ul class = "linkList">
                <li class = "active"> <img width="18" height="18" src="images/notes.png" alt=""> <a href="maindash.php">All Notes</a></li>
                <li > <img width="18" height="18" src="images/heart.png" alt=""> <a href="favoritePage.php">Favorite</a></li>
                <li > <img id = "archiveImage" width="18" height="23" src="images/archive.png" alt=""> <a href="archivePage.php"><div id = "archiveTxt"><p>Archives</p></div></a></li>
                <li> <img width="18" height="18" src="images/logout.png" alt=""> <a href="index.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="dashboardContent">
        <div class="notesContainer" id = "notesContainer">
          <div class="topBar">
              <div class="titleNotes">
                  <h1 class="allNotes">All Notes</h1>
              </div>
              <div class="searchNav">
                  <input id="searchNotes" type="text" placeholder="Search" name = "searchName">
              </div>
              <div class="addBtn">
                  <button id="addNotesBtn">+</button>
                  <label for="" id = "addNtsLbl">Add Notes</label>
              </div>
          </div>
            <div id="popupForm" class="popup-form">

                <div class="notesFormContainer" id = "notesFormContainer">

                  <h2 id="titleForm">Add Notes</h2><br>
                    <form action="" method="post" id="notesForm">

                        <label for="" id = "notesNameLbl">Notes Name:</label><br><br>
                        <input type="text" id = "idDisplay" name = "id" hidden>
                        <input id="notesName" type="text" placeholder="Untitled Notes" name = "name">
                        <textarea name="message" id="messageContainerForm" cols="70" rows="30"></textarea>
                        <button id="addBtn" name = "addNotes">Add Notes</button>
                        <button id="cnlBtn">Cancel</button>
                    </form>
                    
                </div>
            </div>
            <div class="addedNoteContainer" id="addedNoteContainer">
              
              <?php
                  require_once('db_connector.php');

                  $name = $_SESSION["name"];
                  $listDisplay = "Archive";
                  $deleteDisplay = "";

                  if (isset($_POST['query'])){
                    $search = $_POST["query"];
                    $sql = "SELECT * FROM note_tbl WHERE (note_status = 'New' OR note_status = 'Favorite') AND (note_name LIKE '%$search%') AND user_id = '$name'";
                  } else {
                    $sql = "SELECT * FROM note_tbl WHERE (note_status = 'New' OR note_status = 'Favorite') AND user_id = '$name'";
                  }
                  $result = $connection->query($sql);

                  if(!$result){
                      die("Invalid query: ". $connection->error);
                  }

                  while($row = $result->fetch_assoc()){
                    
                      if($row["note_status"] === 'New'){
                        $path = 'images/notFav.png';
                        $height = "60";
                        $width = "60";
                        $marginTop = "-50px";
                        $marginLeft = "60px";
                        $trashMarginTop = "-58px";
                        $alt = "New";
                        $name = "Add to Favorite";  
                      }else if($row["note_status"] === 'Favorite'){
                        $path = 'images/favorite.PNG';
                        $height = "45";
                        $width = "40";
                        $marginTop = "-45px";
                        $marginLeft = "70px";
                        $trashMarginTop = "-50px";
                        $alt = "Favorite";
                        $name = "Remove Favorite"; 
                      }else if($row["note_status"] === 'Archived'){
                        $listDisplay = "Restore";
                        $deleteDisplay = "Delete Permanent";
                      }else{
                        $listDisplay = "Archive";
                      }
                      echo "
                      <div class = 'newNote' id = 'newNote'>
                        <h2 class='noteName'>$row[note_name]</h2>
                        <div class='imgCont'>
                          <img class='dotsImg' width='20' height='20'src='images/dots.PNG'>
                          <ul id = 'menu-list' class='menu-list' style='display: none;'>
                              <li data-noteId = '$row[note_id]' data-name = '$row[note_name]' 
                              data-message = '$row[note_message]'
                              data-date = '$row[note_date]' class='editBtn' onclick = 'editNotes()' id = 'editBtn'>Edit</li>
                              <li data-status = '$row[note_status]' id = 'listFav' class='listFav' onclick = 'favToggle($row[note_id])'>$name  </li>
                              <li data-status = '$row[note_status]' id = 'listArc' class='listArc' onclick = 'archiveToggle($row[note_id])'>$listDisplay</li>
                              <li data-status = '$row[note_status]' id = 'listArc' class='listArc'>$deleteDisplay</li>
                          </ul>
                        </div>
                        <div class = 'messageContainer' id = 'messageContainer' >
                          <p data-noteId = '$row[note_id]' data-name = '$row[note_name]' data-message = '$row[note_message]' data-date = '$row[note_date]' class='editBtn' id = 'noteMessage' onclick = 'editNotes()'>$row[note_message]</p>
                        </div>
                        <div class = 'dateContainer'>
                          <h5>$row[note_date]</h5>
                        </div>
                      
                      </div>
                      ";
                  }
                ?>
            </div>
        </div>
    </div>
</div>

<script>

    function favToggle(id){

      let listDisplay = document.getElementById("listFav");

      if (event.target.classList.contains("listFav")) {
        status = event.target.getAttribute('data-status');
      }
      console.log(status);

      if(status === "New"){
        status = "Favorite";
      }else if(status === "Favorite"){
        status = "New";
      }

      console.log(status);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
          console.log('Request successful');
          location.reload();
        } else {
          console.error('There was a problem with the request.');
          }
        }
      };

      xhr.onerror = function() {
        console.error('Error occurred during request.');
      };
      
      xhr.send("noteIdStat="+id+"&&status="+status);
    }

    function archiveToggle(id){

      let listDisplay = document.getElementById("listFav");

      if (event.target.classList.contains("listArc")) {
        status = event.target.getAttribute('data-status');
      }
      console.log(status);

      if(status !== "Archived"){
        status = "Archived";
      }else{
        status = "New";
      }

      console.log(status);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
          console.log('Request successful');
          location.reload();
        } else {
          console.error('There was a problem with the request.');
          }
        }
      };

      xhr.onerror = function() {
        console.error('Error occurred during request.');
      };
      
      xhr.send("noteIdStat="+id+"&&status="+status);
    }


    let container = document.getElementById("popupForm");
     
    document.getElementById('searchNotes').addEventListener('input', function() {
      search(this.value);
    });

    function search(query) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '', true); // Provide the correct URL of search.php
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          updateNotes(xhr.responseText);
        }
      };
      xhr.send('query=' + query);
    }

    function updateNotes(responseText) {
      // Parse the responseText as HTML
      const parser = new DOMParser();
      const newNotes = parser.parseFromString(responseText, 'text/html').body.querySelectorAll('.newNote');

      // Get the target container
      const container = document.getElementById('addedNoteContainer');

      // Remove existing notes from the container
      container.innerHTML = '';

      // Append new notes to the container
      newNotes.forEach(function(newNote) {
          container.appendChild(newNote);
      });
    }

    document.addEventListener("DOMContentLoaded", function() {
      
      let dotsBtn = document.querySelectorAll(".imgCont");
      let editBtn = document.querySelectorAll(".editBtn");
      dotsBtn.forEach(function(btn) {
        btn.addEventListener('click', function() {
          let menuList = btn.querySelector('.menu-list');
          menuList.style.display = menuList.style.display === 'block' ? 'none' : 'block';
        });
      });
    });

    function editNotes(){
      let form = document.getElementById("popupForm");
      let title = document.getElementById("titleForm");
      let noteTitle = document.getElementById("notesName");
      let messageInput = document.getElementById("messageContainerForm");
      let idDisplay = document.getElementById("idDisplay");
      let addBtn = document.getElementById("addBtn");
      
      if (event.target.classList.contains("editBtn")) {
         id = event.target.getAttribute('data-noteId');
         name = event.target.getAttribute('data-name');
         message = event.target.getAttribute('data-message');
      }
      
      addBtn.textContent = "Save";
      addBtn.name = "editNotes";
      idDisplay.value = id;
      messageInput.value = message; 
      noteTitle.value = name;
      title.textContent = "Note";
      form.style.display = "block";
    }

    let noteForm = document.getElementById("popupForm");
    let btn = document.getElementById("addNotesBtn");
    let formTitle = document.getElementById("titleForm");
    
    btn.addEventListener("click", function(){
      formTitle.textContent = "ADD NOTES";
      noteForm.style.display = "Block";
    });

    cnlBtn.addEventListener("click", function(){
      noteForm.style.display = "none";
    });



</script>

</body>
</html>