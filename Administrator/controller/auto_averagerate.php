<?php
include "database.php";
require "objek_buku.php";

// pengambilan judul buku doang
$sql = "SELECT * FROM data_rating,pinjam_buku WHERE data_rating.id_pinjam = pinjam_buku.id_pinjam ORDER BY pinjam_buku.judul_buku ASC";
$result = $conn->query($sql);

$id_pinjam = array();
$judul_buku = array();
$data_buku = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$judul_buku = mysqli_real_escape_string($conn, $row['judul_buku']);
		$rate = $row['rating'];
		$id_pinjam = $row['id_pinjam'];
		addRate($judul_buku, $rate, $id_pinjam);
	}
}	
$berhasil = false ;

foreach ($data_buku as $bukunya){
	$judul_buku = $bukunya->judul_buku;
	$average_rate = $bukunya->averageRate;
	
	$sql2 = "UPDATE data_buku SET average_rate = '$average_rate' WHERE judul_buku = '$judul_buku'";

	// lanjutkan eksekusi
	$result = $conn->query($sql2);
	if ($result === TRUE) {
		$berhasil = true;
		echo "kini average rate buku " .$bukunya->judul_buku . " menjadi " . $average_rate . "<br>";
	}
}
echo "data " . sizeof($data_buku) . " terdata <br>";
echo "status " . $berhasil;
$conn->close();


function addRate($judulBuku, $rateScore, $id){
	global $data_buku;
	
	$ketemuSama=false;
	
	for($index=0; $index<sizeof($data_buku); $index++){
			$buku = $data_buku[$index];
			// jika bukunya sesuai dgn yg ada di array
			if(strpos($buku->judul_buku, $judulBuku)!== false){
				$buku->totalRate += $rateScore;
				$buku->manyRate += 1;
				$buku->hitungAverage();
				$ketemuSama = true;
				
				////$buku->cetakData();
				break;
			}
	}
	
	if($ketemuSama == false){
		
		$buku = new Buku();
		$buku->id = $id;
		$buku->judul_buku = $judulBuku;
		$buku->totalRate += $rateScore;
		$buku->manyRate += 1;
		$buku->hitungAverage();
		$data_buku[] = $buku;
		//$buku->cetakData();
	}
	
}
?>