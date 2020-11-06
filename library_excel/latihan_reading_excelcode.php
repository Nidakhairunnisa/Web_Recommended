<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once 'SimpleXLSX.php';
echo '<h1>Parse books.xslx</h1><pre>';
if ( $xlsx = SimpleXLSX::parse('data buku.xlsx') ) {
	$data = $xlsx->rows();
	foreach ($data as $satuan){
	echo $code_buku = $satuan[0].'.jpg';
	echo "  ";
	echo $judul_buku = $satuan[1];
	echo "<br>";
	include ('save_gambar_fromexcel.php');
	}
}


?>