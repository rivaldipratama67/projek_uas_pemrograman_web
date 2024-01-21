<?php
    include("connection.php");


    // Login___________________
    if (isset($_POST["login"])) {
        $email = htmlentities(strip_tags(trim($_POST["email"])));
        $password = htmlentities(strip_tags(trim($_POST["password"])));

        $error_message = "";

        if (empty($email)) {
            $error_message = $error_message. "- Email belum diisi <br>";
        }
        // .= sama dengan  $error_message. 
        if (empty($password)) {
            $error_message .= "- Password belum diisi <br>";
        }

        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password_sha1 = sha1($password);

        $query = "
        SELECT * FROM user 
        WHERE email = '$email' AND password = '$password_sha1'";
        $result = mysqli_query($connection, $query);
        
        $count = mysqli_num_rows($result);
        $fetchData = mysqli_fetch_array($result);
        if($count > 0){
            session_start();
            $id_user = $fetchData['id_user'];
            $level = $fetchData['level'];
            if($level === '1'){
                $_SESSION['id_user'] = $id_user;
                $_SESSION['email'] = $email;
                $_SESSION['level'] = $level;
                header('location:admin.php');
            }else if($level === '0'){
                $_SESSION['id_user'] = $id_user;
                $_SESSION['email'] = $email;
                $_SESSION['level'] = $level;
                header('location:home.php');
            }
        }else{
            echo "<script>alert('Password Atau Email salah');</script>";
        }
    }
    else {
        $error_message = "";
        $email = "";
        $password = "";
    }

    // Registration_____________
    if (isset($_POST["regis"])) {
        $email = htmlentities(strip_tags(trim($_POST["email"])));
        $username = htmlentities(strip_tags(trim($_POST["username"])));
        $password = htmlentities(strip_tags(trim($_POST["password"])));

        $error_message="";

        $email = mysqli_real_escape_string($connection, $email);
        $query = "SELECT * FROM user WHERE email='$email'";
        $query_result = mysqli_query($connection, $query);

        $data_amount = mysqli_num_rows($query_result);
        if ($data_amount >= 1 ) {
            $error_message .= " - Email Yang Sama Telah Terdaftar <br>";
        }

        if ($error_message === "") {
            $email = mysqli_real_escape_string($connection, $email );
            $username = mysqli_real_escape_string($connection, $username );
            $password = mysqli_real_escape_string($connection, $password );

            $password = sha1($password);
            $query = "INSERT INTO user VALUES";
            $query .= "(null,'$email', '$username', '$password', '0' , now())";
    
            $result = mysqli_query($connection, $query);
    
            if($result) {
                header("Location: login.php");
            }
            else {
                die ("Query gagal dijalankan: ".mysqli_errno($connection). " - ".mysqli_error($connection));
            }
        }

    } 
    else {
        $error_message = "";
        $email = "";
        $username = "";
        $password = "";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"> -->
    <script src="https://kit.fontawesome.com/cc41ff3053.js" crossorigin="anonymous"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* ===== Google Font Import - Poformsins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgb(80,90,187);
            background: linear-gradient(16deg, rgba(80,90,187,1) 24%, rgba(255,153,0,1) 94%);
        }

        .error {
            background-color: #ffecec;
            padding: 10px 15px;
            margin: 0 0 20px 0;
            border: 1px solid red;
            box-shadow: 1px 0px 3px red;
        }

        .container{
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 20px;
        }

        .container .forms{
            display: flex;
            align-items: center;
            height: 440px;
            width: 200%;
            transition: height 0.2s ease;
        }


        .container .form{
            width: 50%;
            padding: 30px;
            background-color: #fff;
            transition: margin-left 0.18s ease;
        }

        .container.active .login{
            margin-left: -50%;
            opacity: 0;
            transition: margin-left 0.18s ease, opacity 0.15s ease;
        }

        .container .signup{
            opacity: 0;
            transition: opacity 0.09s ease;
        }
        .container.active .signup{
            opacity: 1;
            transition: opacity 0.2s ease;
        }

        .container.active .forms{
            height: 600px;
        }
        .container .form .title{
            position: relative;
            font-size: 27px;
            font-weight: 600;
        }

        .form .title::before{
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            background-color: #4070f4;
            border-radius: 25px;
        }

        .form .input-field{
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 30px;
        }

        .input-field input{
            position: absolute;
            height: 100%;
            width: 100%;
            padding: 0 35px;
            border: none;
            outline: none;
            font-size: 16px;
            border-bottom: 2px solid #ccc;
            border-top: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .input-field input:is(:focus, :valid){
            border-bottom-color: #4070f4;
        }

        .input-field i{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 23px;
            transition: all 0.2s ease;
        }

        .input-field input:is(:focus, :valid) ~ i{
            color: #4070f4;
        }

        .input-field i.icon{
            left: 0;
        }
        .input-field i.showHidePw{
            right: 0;
            cursor: pointer;
            padding: 10px;
        }

        /* .form .checkbox-text{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
        }

        .checkbox-text .checkbox-content{
            display: flex;
            align-items: center;
        }

        .checkbox-content input{
            margin-right: 10px;
        } */

        .form .text{
            color: #333;
            font-size: 14px;
        }

        .form a.text{
            color: #4070f4;
            text-decoration: none;
        }
        .form a:hover{
            text-decoration: underline;
        }

        .form .button{
            margin-top: 35px;
        }

        .form .button input{
            border: none;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 6px;
            background-color: #4070f4;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button input:hover{
            background-color: #265df2;
        }

        .form .login-signup{
            margin-top: 30px;
            text-align: center;
        }
        
        .btn-home{
            text-decoration: none;
            color: #265df2;
        }
        .btn-home:hover{
            text-decoration: underline;
        }
    </style>
         
    <title>Portal</title>
</head>
<body>
    <div class="container">
        <div class="forms">
            <!-- Login Form -->
            <div class="form login">
                <?php
                    if ($error_message !== "")
                    echo "<div class='error'>$error_message</div>";
                ?>
                <span class="title">Login</span>

                <form action="login.php" method="post">
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email" value="<?php echo $email ?>" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" value="<?php echo $password ?>" required>
                        <i class="fa-sharp fa-solid fa-key"></i>
                        <i class="fa-solid fa-eye-slash showHidePw"></i>
                    </div>

                    <!-- <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="#" class="text">Forgot password?</a>
                    </div> -->

                    <div class="input-field button">
                        <input name="login" type="submit" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Belum punya akun?
                        <a href="#" class="text signup-link">Register Disini</a>
                    </span>
                    <br>
                    <span class="text">Kembali ke
                        <a href="index.php" class="btn-home">Home Page</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <?php
                    if ($error_message !== "")
                    echo "<div class='error'>$error_message</div>";
                ?>
                <span class="title">Registration</span>

                <form action="login.php" method="post">
                    <div class="input-field">
                        <input type="text" name="username" value="<?php echo $username ?>" placeholder="Enter your name" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" value="<?php echo $email ?>" placeholder="Enter your email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" value="<?php echo $password ?>" class="password" placeholder="Create a password" required>
                        <i class="fa-sharp fa-solid fa-key"></i>
                        <i class="fa-solid fa-eye-slash showHidePw"></i>
                    </div>
                    <!-- <div class="input-field">
                        <input type="password" class="password" placeholder="Confirm a password" required>
                        <i class="fa-sharp fa-solid fa-key"></i>
                        <i class="fa-sharp fa-solid fa-eye-slash showHidePw"></i>
                    </div> -->

                    <!-- <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div> -->

                    <div class="input-field button">
                        <input name="regis" type="submit" value="Register">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Sudah punya akun?
                        <a href="#" class="text login-link">Login Dimari</a>
                    </span>
                    <br>
                    <span class="text">Kembali ke
                        <a href="index.php" class="btn-home">Home Page</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/script/login.js"></script>
</body>
</html>
