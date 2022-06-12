<?php 

//koneksi database
$koneksidb = mysqli_connect("localhost","root","","project");

//FUNCTION AMBIL DATA
function query($query){
	global $koneksidb;

	//ambil data dari tabel database
	$result = mysqli_query($koneksidb , $query);
	$wadah = [];

	while ( $isi = mysqli_fetch_assoc ($result)){
		$wadah[] = $isi;
	}

	return $wadah;
}

//FUNCTION TAMBAH DATA
function tambah($data){
	//global untuk mengambil konkesi
	global $koneksidb;


	//mengambil data dari elemen post
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	
	//upload gambar
	$gambar = upload();
	if( !$gambar){
		return false;
	}
	//uploa(); untuk memanggil function upload,jika gambar gagal maka insert tidak dijalankan


	//query insert data
	$query =" INSERT INTO mahasiswa 
			VALUES 
	('', '$nim', '$nama', '$email', '$jurusan', '$gambar')
	";

	mysqli_query($koneksidb, $query);

	return mysqli_affected_rows($koneksidb);
}


//FUNCTION UPLOAD
function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];



	//cek gambar belumm di upload
	if( $error === 4) {
	
		echo "<script> 
		alert('pilih gambar terlebih dahulu') 
		</script>";
		return false;
	}



	//cek gambar file yg di upload
	$ekstensiFileGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	//strtolower adalah mengubah string dipaksa ke ukuran kecil

	if ( !in_array($ekstensiGambar, $ekstensiFileGambarValid) )
	//jika tidak ada file ektensi pada array 
	{

		echo "<script> alert('yang di upload bukan gambar') </script>";
		return false;
	}



	//cek membatasi ukuran file
	//1 juta = 1Mb
	if ( $ukuranFile > 100000000000000 ){

		echo "<script> alert('ukuran terlalu besar') </script>";
		return false;
	}


	//lolos pengecekan
	move_uploaded_file($tmpName, 'img/' . $namaFile);

	//gambar siap diupload
		$namaFilebaru = uniqid();
		$namaFilebaru .= '.';
		$namaFilebaru .= $ekstensiGambar;


	return $namaFile;

		
	

}

//FUNCTION HAPUS DATA
function hapus($id) {
	global $koneksidb;
	mysqli_query($koneksidb, " DELETE FROM mahasiswa WHERE id = $id ");

	return mysqli_affected_rows($koneksidb);
}

//FUNCTION UBAH DATA
function ubah($data) {

	global $koneksidb;

//mengambil data dari elemen post
	$id = $data["id"];
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	}
	else{
		$gambar = upload();
	}


//query UPDATE DATA
	$query =" UPDATE mahasiswa 
			SET nim = '$nim',nim = '$nim',nama = '$nama',email = '$email',jurusan = '$jurusan',gambar = '$gambar' 
			WHERE id = $id ";

	mysqli_query($koneksidb, $query);

	return mysqli_affected_rows($koneksidb);
}

 
//FUNCTION SEARCHING
function btncarimahasiswa($keyword){
	global $koneksidb;

	$query = " SELECT * FROM mahasiswa WHERE namaMahasiswa LIKE '%$keyword%' OR
		NIM LIKE '%$keyword%' OR
		emailMahasiswa LIKE '%$keyword%' OR
		jurusanMahaiswa LIKE '%$keyword%'
		ORDER BY id DESC";

	return query($query);
}

function btncaripegawai($keyword){
	global $koneksidb;

	$query = " SELECT * FROM mahasiswa WHERE namaMahasiswa LIKE '%$keyword%' OR
		NIM LIKE '%$keyword%' OR
		emailMahasiswa LIKE '%$keyword%' OR
		jurusanMahaiswa LIKE '%$keyword%'
		ORDER BY id DESC";

	return query($query);
}

function btncaripetugas($keyword){
	global $koneksidb;

	$query = " SELECT * FROM mahasiswa WHERE namaMahasiswa LIKE '%$keyword%' OR
		NIM LIKE '%$keyword%' OR
		emailMahasiswa LIKE '%$keyword%' OR
		jurusanMahaiswa LIKE '%$keyword%'
		ORDER BY id DESC";

	return query($query);
}

function btncarialat($keyword){
	global $koneksidb;

	$query = " SELECT * FROM mahasiswa WHERE namaMahasiswa LIKE '%$keyword%' OR
		NIM LIKE '%$keyword%' OR
		emailMahasiswa LIKE '%$keyword%' OR
		jurusanMahaiswa LIKE '%$keyword%'
		ORDER BY id DESC";

	return query($query);
}

//FUNCTION DAFTAR MAHASISWA
function daftar($data){
	global $koneksidb;
	
	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksidb, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksidb, $data["password2"]); 

	//cek user yang sama
	$cekusers = mysqli_query($koneksidb, "SELECT username FROM users WHERE username = '$username' ");

	if(mysqli_fetch_assoc($cekusers) ){
		echo "<script> 
					alert('username udah ada');
				</script>";
		return false;		
	}

	//cek password
	if( $password !== $password2 ){
		echo "<script> 
					alert('password harus sama');
				</script>";

		return false;
	}

	// enkripsi password
	$password = password_hash($password , PASSWORD_DEFAULT);

	// input ke database
	mysqli_query($koneksidb, "INSERT INTO users VALUES('', '$username', '$password')");

	return mysqli_affected_rows($koneksidb);
}

 ?>