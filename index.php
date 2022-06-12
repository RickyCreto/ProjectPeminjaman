<?php

session_start();

if( !isset ($_SESSION ["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';

$datamahasiswa = query("SELECT * FROM mahasiswa ORDER BY idMahasiswa DESC");

$datapegawai = query("SELECT * FROM pegawai ORDER BY idPegawai DESC");

$datapetugas = query("SELECT * FROM petugas ORDER BY idPetugas DESC");


// tombol cari ditekan menggunakan fungsi btncari
if( isset ($_POST ["btncari"]) ) {
	$datamahasiswa = btncarimahasiswa($_POST ["keyword"]);

}

?>


<br>
<!DOCTYPE html>
<html>

	<head>
        <title>Data Mahasiswa</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    </head>

	<body>

		<a href="datamahasiswa.php">mahasiswa</a>

		<a href="datapegawai.php">pegawai</a>

		<a href="dataalat.php">Alat</a>



			<h1>Daftar Mahasiswa</h1>
				<a href="tambah.php">Tambah Mahasiswa</a>
				<br>


		<form action="" method="post"  enctype="multipart/form-data">
		
			<input type="text" name="keyword" autofocus placeholder="search" autocomplete="off" required>
			<button type="submit" name="btncari"> Cari</button>

		</form>

		<table border="1" cellpadding="10" cellspacing="0">

			<tr>
				<th>Aksi</th>
				<th>No.</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>no Telepon</th>
				<th>Jurusan</th>
				<th>Email</th>
			</tr>

			<?php foreach ($datamahasiswa as $datamhs) : ?> 
				
				<?php $i =1; ?> 

			<tr>
				<td><?= $i;  ?></td>
				<td>
					<a href="ubah.php?id=<?= $datamhs["idMahasiswa"];?>"> Ubah </a> |
					<a href="hapus.php?id=<?= $datamhs["idMahasiswa"];?>" onclick="return confirm( 'yakin?');"> Hapus </a>
				</td>
				<td><?= $datamhs["NIM"];  ?></td>
				<td><?= $datamhs["namaMahasiswa"];  ?></td>
				<td><?= $datamhs["jurusanMahasiswa"];  ?></td>
				<td><?= $datamhs["noTeleponMahasiswa"];  ?></td>
				<td><?= $datamhs["emailMahasiswa"];  ?></td>
			</tr>

			<?php $i++; ?>
			<?php endforeach; ?>

		</table>

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

		<br>

		
		<table border="1" cellpadding="10" cellspacing="0">
		
			<tr>
				<th>No.</th>
				<th>Aksi</th>
				<th>NIP</th>
				<th>Nama</th>
				<th>Unit Kerja</th>
				<th>no Telepon</th>
				<th>Email</th>
			</tr>
		
			<?php $i =1; ?> 
		
			<?php foreach ($datapetugas as $dataptgs) : ?> 
			<tr>
				<td><?= $i;  ?></td>
				<td>
					<a href="ubah.php?id=<?= $dataptgs["idPetugas"];?>"> Ubah </a> |
					<a href="hapus.php?id=<?= $dataptgs["idPetugas"];?>" onclick="return confirm( 'yakin?');"> Hapus </a>
				</td>
				<td><?= $dataptgs["NIP"];  ?></td>
				<td><?= $dataptgs["namaPetugas"];  ?></td>
				<td><?= $dataptgs["unitKerja"];  ?></td>
				<td><?= $dataptgs["noTeleponPetugas"];  ?></td>
				<td><?= $dataptgs["emailPetugas"];  ?></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
		
		</table>

		<a href="logout.php"> Logout</a>

	</body>
</html>