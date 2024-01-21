<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="todo.svg" type="image/x-icon" />
    <link rel="stylesheet" href="assets/css/landing.css">
</head>

<body style="background-color: #111827;">
    <div class="container">

        <div class="topnav" id="nav">
            <h2 class="logo"><img src="assets/img/todoc.svg" alt=""></h2>
            <div class="navigation">
                <nav>
                    <a href="about.php">Features</a>
                    <a href="#" class="active">Home</a>
                    <a href="login.php" class="btn-lgn">Login</a>
                </nav>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
            </div>
        </div>

        <div class="hbout">
            <!-- About -->
            <section class="text">
                <video src="assets/land_vid.mp4" muted autoplay loop></video>
                <h1 style="font-size: 42px;">Si TODO</h1>
                <h2 style="font-size: 42px;">Make it <span style="color: #FF9900;">Simple</span></h2>
                <p style="margin: 10px 0px 40px 0px; font-size: 28px;">Mengelola tugas lebih efisien tanpa harus menuliskan secara manual pada kertas</p>
                <div class="btnget">
                    <a id="start" href="login.php">Get Started</a>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <h3>Si TODO INFORMATION</h3>
            <p>TodoList adalah untuk mencatat kigiatan kita sehari hari
                dari sini saya membuat aplikasi todolist berbasis web ini untuk mempermudah mencatat
                kegiatan kita sehari hari oke oke
            </p>
            <ul class="social">
                <li><a href="#"><i class="fab fa-facebook fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus fa-lg"></i></a></li>
            </ul>
        </div>
        <div class="footer-copyright">
            <div>
                <small>my rivaldi pratama putra</small>
            </div>
        </div>
    </footer>


</body>
<script src="assets/script/landing.js" defer></script>
<script>
    function myFunction() {
        var x = document.getElementById("nav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else if (x.className === "topnav sticky") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

</html>