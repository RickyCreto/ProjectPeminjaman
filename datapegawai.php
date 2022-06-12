<?php

session_start();

if( !isset ($_SESSION ["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';


$datapegawai = query("SELECT * FROM pegawai ORDER BY idPegawai DESC");




// tombol cari ditekan
if( isset ($_POST ["btncari"]) ) {
	$datamahasiswa = btncarimahasiswa($_POST ["keyword"]);

}

?>


<br>
<!DOCTYPE html>
<html>
<head>



    <title>Halaman Admin</title>
</head>
<body>

<a href="datamahasiswa.php">mahasiswa</a>

<a href="datapegawai.php">pegawai</a>

<a href="dataalat.php">Alat</a>



	<h1>Daftar Mahasiswa</h1>
	<a href="tambah.php">Tambah Mahasiswa</a>
	<br>
	<br>

	<form action="" method="post"  enctype="multipart/form-data">
		
		<input type="text" name="keyword" autofocus placeholder="search" autocomplete="off" required>
		<button type="submit" name="btncari"> Cari</button>

	</form>



<br>

<table border="1" cellpadding="10" cellspacing="0">

	<tr>
		<th>No.</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>no Telepon</th>
		<th>Email</th>
		<th>Aksi</th>
	</tr>

	<?php $i =1; ?> 
	<?php foreach ($datapegawai as $datapgw) : ?> 

	<tr>
		<td><?= $i;  ?></td>
		<td><?= $datapgw["NIK"];  ?></td>
		<td><?= $datapgw["namaPegawai"];  ?></td>
		<td><?= $datapgw["noTeleponPegawai"];  ?></td>
		<td><?= $datapgw["emailPegawai"];  ?></td>
		<td>
			<a href="ubah.php?id=<?= $datapgw["idPegawai"];?>"> Ubah </a> |
			<a href="hapus.php?id=<?= $datapgw["idPegawai"];?>" onclick="return confirm( 'yakin?');"> Hapus </a>
		</td>
	</tr>

	<?php $i++; ?>
	<?php endforeach; ?>

</table>



<a href="logout.php"> Logout</a>

</body>
</html>