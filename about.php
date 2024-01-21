<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <script src="https://kit.fontawesome.com/cc41ff3053.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/landing.css">
</head>

<body>
    <div class="topnav" id="nav">
        <h2 class="logo"><img src="assets/img/todoc.svg" alt=""></h2>
        <div class="navigation">
            <nav>
                <a href="#" class="active">Features</a>
                <a href="index.php">Home</a>
                <a href="login.php" class="btn-lgn">Login</a>
            </nav>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
        </div>
    </div>


    <section class="parallax">
        <!-- <img src="assets/img/printil_printil.png" id="hill1"> -->
        <div class="hero">
            <h1 style="color:#FF9900;" id="text">Si <span style="color: #505ABB;">TODO</span></h1>
            <h2 style="font-size: 42px; color: #505ABB;">Make it  <span style="color: #FF9900;">Simple</span></h2>
            <p style="margin: 40px 0px;">Mengelola tugas lebih efisien tanpa harus menuliskan secara manual pada kertas</p>
            <div class="btnget" id="btnget">
                <a id="start" href="login.php">Get Started</a>
                <!--<a id="contact" href="">Contact Us<i style="padding-left: 10px;" class="fa-regular fa-paper-plane"></i></a>-->
            </div>
        </div>
        <div class="ilustdo">
            <img src="assets/img/illustdo.svg" alt="">
        </div>
    </section>

    <div class="sec">
    <!-- Showcase -->
        <div class="showcase-container">
            <section class="showcase">
                <div class="showcase-image">
                    <img src="assets/img/Task.png" alt="">
                </div>
                <div class="showcase-text">
                    <h1>Kelola tugas dengan mudah</h1>
                    <p>Mengelola list tugas lebih efisien tanpa harus menuliskan secara manual</p>
                </div>
            </section>
            <section class="showcase">
                <div class="showcase-image">
                    <img src="assets/img/Sub Task.png" alt="">
                </div>
                <div class="showcase-text">
                    <h1>Tambahkan Subtask</h1>
                    <p>Buat Subtask dan tetapkan tanggal jatuh tempo, penanda(Pending-On Progres-Done) sehingga tidak ada tugas yang terlewatkan.</p>
                </div>
            </section>
            <section class="showcase">
                <div class="showcase-image">
                    <img src="assets/img/Category.png" alt="">
                </div>
                <div class="showcase-text">
                    <h1>Category</h1>
                    <p>Kelompokkan tugas menurut kategori agar lebih mudah dalam mengelola</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <h3>Si TODO INFORMATION</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor eligendi quisquam 
                eveniet, illum pariatur sed cum illo est accusamus impedit recusandae veritatis 
                minus? Animi asperiores quod, maiores dolores voluptatem autem.</p>
            <ul class="social">
                <li><a href="#"><i class="fab fa-facebook fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram fa-lg"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus fa-lg"></i></a></li>
            </ul>
        </div>
        <div class="footer-copyright">
            <div>
                <small>&copy; Copyright By Kelompok2</small>
            </div>
        </div>
    </footer>

</body>
<script src="assets/script/landing.js"></script>
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