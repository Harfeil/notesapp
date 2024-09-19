
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashnewboard.css">
    <title>Document</title>
</head>
<body>

<div class="dashboardContainer">
   
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
       <div class ="MyContainer">
        <div class ="secondContainer">
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
          <h1>My_Notes</h1>
        </div>
        <div class ="secondContainer">
          <h1>My_Notes</h1>
          <p>My_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_NotesMy_Notes</p>
        </div>
        <div class ="secondContainer">
          <h1>My_Notes</h1>
          <h1>axbnhgfvkmjhnklmam,.,.jhalkhiulhyutwrk,fnj,mxchnkfjshfl.ksasdsadasdsddsadsddsdsdsadasagahahjahahahahahaygaytyayayayayaaaaaaaaayyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyullllllllllullllllllllluuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu</h1>
        </div>
        <div class ="secondContainer">
          <h1>My_Notes</h1>
        </div>
        <div class ="secondContainer">
          <h1>My_Notes</h1>
        </div>
          <div class ="secondContainer">
          <h1>My_Notes</h1>
       </div>
       <div class ="secondContainer">
          <h1>My_Notes</h1>
          </div>
          <div class ="secondContainer">
          <h1>My_Notes</h1>
        </div>
        <div class ="secondContainer">
          <h1>My_Notes</h1>
    </div>
    <div class ="secondContainer">
          <h1>My_Notes</h1>
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