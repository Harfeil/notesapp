<link rel="stylesheet" href="styles/header.css">
<body>
<div class = "header">
    <div class = "logo">
        <h1>Note<span id = "spanLogo">It!</span></h1>
    </div>
    <div class = "links">
        <h5 id = "links" onclick = "changePage('index.php')">HOME</h5>
        <h5 id = "links" onclick = "changePage('register.php')">REGISTER</h5>
        <h5 id = "links" onclick = "changePage('loginPage.php')">SIGN IN</h5>
    </div>

    

</div>

<script>

    function changePage(link){
        window.location.href = link;
    }

    let linkBtns = document.querySelectorAll("#links");

    linkBtns.forEach(function(linkBtn) {
        linkBtn.addEventListener("click", function() {
            linkBtn.classList.add("Active");
        });
    });

</script>