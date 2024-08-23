<nav class="navbar fixed-top bg-white shadow" style="z-index:3;" id="navigation">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">ISFHS</a>

    <span style="font-size:23px;cursor:pointer;" class="px-2" onclick="showSidenav()" id="btnShowSidenav">&#9776</span>
    </div>
</nav>
<script>
    function showSidenav(){
        document.getElementById('sidenav').style.width = "230px";
        $('#btnShowSidenav').hide();
        //document.getElementById('sidenav-menu').style.width = "100%";
    }
</script>
