<?php

session_start();


if( !isset ($_SESSION ["submit"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';

//ambil data url
$id = $_GET["id"];

// query data berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//cek data masuk
if( isset($_POST["submit"])){

//cek data berhasil diubah / belum
if (ubah($_POST) > 0)
{
	echo "
	<script> 
		alert('berhasil diubah');
		document.location.href = 'index.php';
	</script>";
} 
else
{
	echo "
	<script> 
		alert('gagal diubah');
		document.location.href = 'index.php';
	</script>";
}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ubah data mahasiswa</title>
</head>
<body>
	<h1>Ubah Data</h1>

	<form action="" method="post"  enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nim" >NIM : </label>
				<input type="text" name="nim" required value="<?php echo $mhs["nim"]; ?>">
			</li>
			<li>
				<label for="nama" >Nama : </label>
				<input type="text" name="nama" required value="<?php echo $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="email" >Email : </label>
				<input type="text" name="email" required value="<?php echo $mhs["email"]; ?>">
			</li>
			<li>
				<label for="jurusan" >Jurusan : </label>
				<input type="text" name="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="gambar" >Gambar : </label><br>
				<td><img src="img/<?= $mhs["gambar"];  ?>" width="100" ></td>
		
				<input type="file" name="gambar" >
			</li>
			<li>
				<button type="submit" name="submit"> Ubah !</button>
			</li>
		</ul>
		
	</form>

</body>
</html>