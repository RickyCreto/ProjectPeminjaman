<?php

require 'functions.php';

if(isset($_POST["register"]) ) {

    if( daftar($_POST) > 0) {

        echo "<script>
                alert (' user berhasil ditambahkan');
            </script>";
    }
    else{

        echo mysqli_error($koneksidb);
    }
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
    <h1> Halaman Registrasi </h1>
    <a href="login.php"> Masuk </a>
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
            <label for="password2"> password lagi : </label>
            <input type="password" name="password2" id="password2">
        </li>

        <li>
            <button type="submit" name="register"> Registrasi </button>
        </li>


    </ul>

</form>

</body>
</html>