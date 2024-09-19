<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashboard.css">
    <title>Document</title>
</head>
<body>

<div class="dashboardContainer">
    <div class="sidebar">
        <div class="logo">
            <h1>Note<span id="spanLogo">It!</span></h1>
        </div>
        <div class="listContainer">
            <ul>
                <li> <img width="20" height="20" src="images/notes.png" alt=""> All Notes</li>
                <li> <img width="20" height="20" src="images/heart.png" alt=""> Favorites</li>
                <li> <img width="20" height="25" src="images/archive.png" alt=""> Archives</li>
                <li> <img width="20" height="20" src="images/logout.png" alt=""> Logout</li>
            </ul>
        </div>
    </div>
    <div class="dashboardContent">
        <div class="topBar">
            <div class="titleNotes">
                <h1 class="allNotes">All Notes</h1>
                <div class="line"></div>
            </div>
            <div class="searchNav">
                <input id="searchNotes" type="text" placeholder="   Search">
            </div>
            <div class="addBtn">
                <button id="addNotesBtn">+</button>
                <label for="">Add Notes</label>
            </div>
        </div>
        <div class="notesContainer">
            <div id="popupForm" class="popup-form">

                <div class="notesFormContainer">

                    <h2 id="titleForm"></h2><br>

                    <form action="" method="post" id="notesForm">

                        <label for="">Notes Name:</label><br><br>
                        <input id="notesName" type="text" placeholder="Untitled Notes">

                        <p id="noteMessage" contenteditable="true" class="messageCont">
                    </form>
                    <div class="buttonContainer">
                        <button id="addBtn" onclick="createDiv()">Add Notes</button>
                        <button id="cnlBtn" onclick="resetForm()">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="addedNoteContainer" id="addedNoteContainer">
            </div>
        </div>
    </div>
</div>

<script>

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

    let divCount = 0;

    window.onload = function() {
      const savedDivs = JSON.parse(localStorage.getItem('mylocalstorage'));
      if (savedDivs) {
        savedDivs.forEach(div => {
          createDivFromStorage(div);
        });
        attachButtonListeners();
      }
    };


    function createDiv() {
        const noteName = document.getElementById('notesName');
        const name = noteName.value.trim();
        const notes = document.getElementById("noteMessage").textContent;

        if (name !== '') {
            let divId;
            let isNewNote = true;

            if (formTitle.textContent === "EDIT NOTES") {
                divId = noteForm.getAttribute('data-editing-id');
                isNewNote = false;
            } else {
                divCount++;
                divId = `div${divCount}`;
            }

            const newDiv = document.createElement('div');
            newDiv.setAttribute('id', divId);
            newDiv.classList.add('newNote');
            newDiv.innerHTML = `
                <h2 class="noteName">${name}</h2>
                <div class="imgCont">
                    <img class="dotsImg" width="20" height="20" src="images/dots.PNG">
                    <ul class="menu-list" style="display: none;">
                        <li class="editBtn">Edit</li>
                        <li>Add to Favorite</li>
                        <li>Archive</li>
                    </ul>
                </div>
                <h5 class="noteMessage">${notes}</h5>
            `;

            const divContainer = document.getElementById('addedNoteContainer');

            if (isNewNote) {
                divContainer.appendChild(newDiv);
            } else {
                const existingDiv = document.getElementById(divId);
                divContainer.replaceChild(newDiv, existingDiv);
            }
            attachButtonListeners();
            resetForm();
            saveDivsToLocalStorage();
        } else {
            alert('Please enter a name for the note.');
        }
    }

    function resetForm() {
        const noteName = document.getElementById('notesName');
        const noteMessage = document.getElementById("noteMessage");
        noteName.value = '';
        noteMessage.textContent = '';
        formTitle.textContent = "ADD NOTES";
        noteForm.style.display = "none";
        noteForm.removeAttribute('data-editing-id');
        addBtn.textContent = "Save";
    }

    function createDivFromStorage(div) {
        const newDiv = document.createElement('div');
        newDiv.setAttribute('id', div.id);
        newDiv.classList.add('newNote');
        newDiv.innerHTML = `
        <h2 class="noteName">${div.name}</h2>
        <div class="imgCont">
            <img class="dotsImg" width="20" height="20" src="images/dots.PNG">
            <ul class="menu-list" style="display: none;">
                <li class="editBtn">Edit</li>
                <li>Add to Favorite</li>
                <li>Archive</li>
            </ul>
        </div>
        <h5 class="noteMessage"> ${div.notes}</h5>
      `;

        const divContainer = document.getElementById('addedNoteContainer');
        divContainer.appendChild(newDiv);
    }

    function saveDivsToLocalStorage() {
        const divContainer = document.getElementById('addedNoteContainer');
        const divs = divContainer.querySelectorAll('.newNote');
        const savedDivs = [];

        divs.forEach(div => {
            savedDivs.push({
                id: div.id,
                name: div.querySelector('h2').textContent,
                notes: div.querySelector('h5').textContent
            });
        });

        localStorage.setItem('mylocalstorage', JSON.stringify(savedDivs));
    }

    function attachButtonListeners() {
        let menuBtns = document.querySelectorAll(".dotsImg");
        menuBtns.forEach(button => {
            button.addEventListener('click', function() {
                const list = this.nextElementSibling;
                list.style.display = list.style.display === 'block' ? 'none' : 'block';
                const menuItems = list.querySelectorAll('.editBtn');
                menuItems.forEach(item => {
                    item.addEventListener('click', function() {
                        const divId = item.closest('.newNote').id;
                        const noteName = item.closest('.newNote').querySelector('.noteName').textContent;
                        const noteMessage = item.closest('.newNote').querySelector('.noteMessage').textContent;
                        notesName.value = noteName;
                        noteMessage.textContent = noteMessage;
                        formTitle.textContent = "EDIT NOTES";
                        noteForm.setAttribute('data-editing-id', divId);
                        noteForm.style.display = "block";
                        addBtn.textContent = "Save";
                    });
                });
            });
        });
    }


</script>

</body>
</html>