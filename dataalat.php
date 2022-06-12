<?php

session_start();

if( !isset ($_SESSION ["login"]) ){
	header("Location: login.php");
	exit;
}

require 'functions.php';


$dataalat  = query("SELECT * FROM alat ORDER BY idAlat DESC");


// tombol cari ditekan menggunakan fungsi btncari
if( isset ($_POST ["btncari"]) ) {
	$$dataalat  = btncarialat($_POST ["keyword"]);

}

?>
<!DOCTYPE html>
<html>

    <head>
        <title>Data Alat</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    </head>


    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Data Alat</h1>
                    <a href="tambah.php" class="btn btn-primary">Tambah Alat</a>
                    <br>
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="keyword" autofocus placeholder="search" autocomplete="off" required>
                        <button type="submit" name="btncari"> Cari</button>
                    </form>
                    <br>
                    <br>
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>No.</th>
                            <th>Aksi</th>
                            <th>Nama Alat</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>

                        </tr>
                        <?php $i =1; ?>
                        <?php foreach ($dataalat as $dataalat) : ?>
                            <tr>
                                <td><?= $i;  ?></td>
                                <td>
                                    <a href="ubah.php?id=<?= $dataalat["idAlat"]; ?>">Ubah</a>
                                    <a href="hapus.php?id=<?= $dataalat["idAlat"]; ?>" onclick="return confirm('Apakah anda yakin?');">Hapus</a>
                                </td>
                                <td><?= $dataalat["namaAlat"]; ?></td>
                                <td><?= $dataalat["jenisAlat"]; ?></td>
                                <td><?= $dataalat["jumlahAlat"]; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </body>

</html>