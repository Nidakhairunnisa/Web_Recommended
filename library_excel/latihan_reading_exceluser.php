<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once 'SimpleXLSX.php';
echo '<h1>Parse books.xslx</h1><pre>';
if ( $xlsx = SimpleXLSX::parse('book2.xlsx') ) {
	$data = $xlsx->rows();
	foreach ($data as $satuan){
	$nim = $satuan[0];
	$nama_lengkap = $satuan[1];
	
	
	
	include('save_user_fromexcel.php');
	}
	
} else {
	echo SimpleXLSX::parseError();
}
echo '<pre>';

?>