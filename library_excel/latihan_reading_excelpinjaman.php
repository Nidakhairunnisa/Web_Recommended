<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once 'SimpleXLSX.php';
echo '<h1>Parse books.xslx</h1><pre>';
if ( $xlsx = SimpleXLSX::parse('book1.xlsx') ) {
	$data = $xlsx->rows();
	foreach ($data as $satuan){
	$nama_dicari = $satuan[0];
	$judul_buku = $satuan[1];
	$tanggal_pinjam = $satuan[2];
	$tanggal_pinjam = explode (' ', $tanggal_pinjam);
	$tanggal_pinjam_br = $tanggal_pinjam[0];
	
	include 'get_nim_user.php';
	
	$tanggal_kembali = date('Y-m-d', strtotime($tanggal_pinjam_br. ' + 7 days'));
	$tanggal_kembali_jam = $tanggal_kembali . " 00:00:00";
	
	$status = "";

	date_default_timezone_set('Asia/Jakarta');

	$tanggal_hari_ini =  date('Y-m-d H:i:s');

	if ($tanggal_kembali_jam < $tanggal_hari_ini){
		$status = "terlewat";
	} else {
		$status = "dipinjam";
	}

	// ada 2 status
	// 1 : sedang pinjam 
	// 2 : terlewat 
	$harga_sewa = 0;
	$denda = 0;
	//echo "nama : " . $nama_dicari . " [$nim] pinjam buku : " . $judul_buku . " status :" . $status;
	//echo "<br>";
	//echo "tanggal pinjam : " . $tanggal_pinjam_br . " harus kembali : " . $tanggal_kembali;
	//echo "<br>======<br>";
	include('save_pinjaman_fromexcel.php');
	}
	
} else {
	echo SimpleXLSX::parseError();
}
echo '<pre>';

?>