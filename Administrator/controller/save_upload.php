<?php
include "database.php";

$jenisdata 	= $_POST['jenis-data'];

if($jenisdata == 'user'){
	$target_dir = "../data/user/";
} 
else {
	$target_dir = "../data/buku/";
}

$namaVariable 	= "file_" . $jenisdata;
$namaDoang		= '';
if (!empty($_FILES[$namaVariable]["tmp_name"])){	
	$target_file 	= $target_dir . basename($_FILES[$namaVariable]["name"]);
	$uploadOk	 	= 1;
	$imageFileType 	= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$namaDoang 		= date('YmdHis') . ".$imageFileType";
	$namabaru		= $target_dir . $namaDoang ;

	$check = getimagesize($_FILES[$namaVariable]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} 



	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES[$namaVariable]["tmp_name"], $namabaru)) {
			echo "The file ". basename( $_FILES[$namaVariable]["name"]). " has been uploaded.";
				
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}

if($jenisdata == 'user'){
	// $sqlbuku = "INSERT INTO data_buku ($nim, $nama_lengkap, $password, $namaDoang) VALUE (null, 'nama_lengkap', 'password', 'file_user')";
	include ('save_user.php');
} else {
	// $sqlbuku = "INSERT INTO data_buku ($id_buku, $judul_buku, $pengarang_buku, $isbn, $penerjemah_buku, $pengarang_buku, $penerbit, $kota_terbit, $tahun_terbit, $absraksi, $jumlah_buku, $namaDoang) VALUE (null, 'judul_buku', 'pengarang_buku', isbn, 'penerjemah_buku', 'penyunting_buku', 'penerbit', 'kota_terbit', tahun_terbit, 'abstaksi', jumlah_buku, 'file_buku')";
	include ('save_buku.php');
}
?>