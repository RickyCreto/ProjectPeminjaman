<?php

session_start();

if( !isset ($_SESSION ["login"]) ){
	header("Location: login.php");
	exit;
}
require 'functions.php';

//cek pakah tombol sumit udah ditekan
if( isset($_POST["submit"])){

	//ambil data dari elemen dalam form

	


	// cek apakah data behasil di tambahkan atau tidak
if (tambah($_POST) > 0)
{
	echo "
	<script> 
		alert('berhasil');
		document.location.href = 'index.php';
	</script>";
} 
else
{
	echo "
	<script> 
		alert('gagal');
		document.location.href = 'index.php';
	</script>";
}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>tambah data mahasiswa</title>
</head>
<body>
	<h1>Tambah Data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nim" >NIM : </label>
				<input type="text" name="nim" required >
			</li>
			<li>
				<label for="nama" >Nama : </label>
				<input type="text" name="nama" required>
			</li>
			<li>
				<label for="email" >Email : </label>
				<input type="text" name="email" required>
			</li>
			<li>
				<label for="jurusan" >Jurusan : </label>
				<input type="text" name="jurusan" required>
			</li>
			<li>
				<label for="gambar" >Gambar : </label>
				<input type="file" name="gambar" required>
			</li>
			<li>
				<button type="submit" name="submit"> Tambah !</button>
			</li>
		</ul>
		
	</form>

</body>
</html>