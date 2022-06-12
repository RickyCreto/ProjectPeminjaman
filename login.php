<?php

session_start();

//cek kalo udah login
if( isset ($_SESSION ["login"]) ){
	header("Location: index.php");
	exit; 
}

require 'functions.php';

//cek login
if(isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $ceklogin = mysqli_query($koneksidb, "SELECT * FROM users WHERE username = '$username'");

    //cek username 
    if ( mysqli_num_rows($ceklogin) === 1){

        //cek password
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify($password, $row["password"]) ){
            //set session
                $_SESSION["login"] = true;


            header("Location: index.php");
            exit;
        }

    }

    $error = true;
}

?>

<!DOCTYPE html>
<html>
<head>


    <title>Halaman Login</title>
    <style> 
    label {
        display: block;
    }
    
    </style>
</head>
<body>
    <h1> Halaman Login </h1>

    <?php if(isset($error) ) : ?>
        <p style ="color: red; font-style: italic;"> username salah </p>

    <?php endif  ?>
    <a href="registrasi.php"> Daftar </a>


<form action"" method="post">
    <ul>
        <li>
            <label for="username"> username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password"> password : </label>
            <input type="password" name="password" id="password">
        </li>

        <li>
            <button type="submit" name="login"> Login </button>
        </li>


    </ul>

</form>

</body>
</html>