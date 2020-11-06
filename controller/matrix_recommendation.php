<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	include ('database.php');
	//include ('recommended/recommend.php');
	include ('calculator.php');
	
	$sql0 = "SELECT * FROM data_buku ORDER BY judul_buku ASC LIMIT 75";
	
	$sql1 = "SELECT * FROM data_rating as dr, pinjam_buku as pb WHERE dr.id_pinjam = pb.id_pinjam ORDER BY dr.nim ASC LIMIT 75";
	
	$conn0 = mysqli_connect($servername, $username, $password, $dbname);
	
	$dataBuku0 = mysqli_query($conn0, $sql0);
	
	$dataGenre;
	$dataPenerbit;
	$dataPengarang;
	$dataJudulBuku;
	
	$matrixBookOri;
	
	// set all attributes to global variables above
	setAllAttributes($dataBuku0,false);
	
	// test data genre, penerbit, dan pengarang
	// echo "<pre>";
	// print_r($dataGenre);
	// print_r($dataPenerbit);
	// print_r($dataPengarang);
	// echo "</pre>";
	
	// membuat matrix buku dengan index
	// echo "<pre>";
	 // print_r($matrixBookOri);
	 // echo "</pre>";
	
	echo "<hr>";
	// coba test similarity attributes
	//echo "<pre>";
	$matrixAttribScore = simAttributes();
	//print_r($matrixAttribScore);
	//echo "</pre>";
	
	$conn1 = mysqli_connect($servername, $username, $password, $dbname);
	$dataRating = mysqli_query($conn1, $sql1);
		
	$matrix = array();
	$matrixRate = array();
	
	$namaPersonAwal = '';
		
    while($row = mysqli_fetch_array($dataRating)) {
			
			
			 $sql2 = "SELECT * FROM data_user WHERE nim=$row[nim]";
			 //echo $sql2 . "<br>";
			
			 $dataOrang = mysqli_query($conn1, $sql2);
			 $dataOrangBeneran = mysqli_fetch_array($dataOrang);
			 //$nama = str_replace(" ", "-", $dataOrangBeneran['nama_lengkap']);
			$nama = $dataOrangBeneran['nama_lengkap'];
			
			if($namaPersonAwal == ''){
				$namaPersonAwal = $nama;
			}else if ($nama == $namaPersonAwal){
				
			}else if ($nama != $namaPersonAwal){
				// clear data rate ketika beda orang
				$matrixRate = array();
				$namaPersonAwal = $nama;
			}
			
			$matrixRate[$row['judul_buku']] = $row['rating'];
			$matrix[$nama] = $matrixRate;
			
			
			
			
	 }
	
	// dapatkan average perorang	
	
	$averageRate = 0;
	foreach ($matrix as $nama=>$dataArray){
			$averageRate = getAverageRate($matrix, $nama);
			
			$matrix[$nama]['average'] = $averageRate;
	}
	
	
	
	// echo "<pre>";
	// $matrixPublisher=getAllAttributes($dataBuku0, 'penerbit');
	// print_r($matrixPublisher);
	// echo "</pre>";
	
	// echo "<pre>";
	// $matrixAuthor=getAllAttributes($dataBuku0, 'pengarang');
	// print_r($matrixAuthor);
	// echo "</pre>";
	
	  // echo "<pre>" ;
	 // // print_r(getAverageRate($matrix, "DWI FEBRIANINGSIH"));
	 // print_r($matrix);
	  // echo "</pre>";
	
	 
	  // echo "<pre>" ;
	  // $dataBuku = getAllBooks($matrix);
	  // $dataMentah = getPersonIdenticalBook($matrix,$dataBuku);
	  // print_r($dataMentah);
	  // echo "</pre>";
	
	  // data buku
	  // echo "<pre>" ;
	  //$dataBuku = getAllBooks($matrix);
	  // //print_r($dataBuku);
	  // echo "</pre>";
	  
	  // // data orang
	  // echo "<pre>" ;
	  //$dataPerson = getAllPersons($matrix);
	  // //print_r($dataPerson);
	  // echo "</pre>";
	  
	  // // data sblm hitung cosin
	  // echo "<pre>";
	  // $dataSiap = combinePersonAndBook($dataPerson, $dataBuku, $matrix);
	  // //print_r($dataSiap);
	  // echo "</pre>";
	  
	   // // data menghitung cosin buku A & B
	  // // echo "<pre>";
	  // // $hasilCoba = sim("Laskar pelangi", "Mimpi bayang jingga");
	  // // print_r($hasilCoba);
	  // // echo "</pre>";
	  
	  // // menghitung similarity untuk seluruh buku
	  // $dataBuku = getAllBooks($matrix);
	  // $dataMentah = getPersonIdenticalBook($matrix,$dataBuku);
	  // $dataPerson = getAllPersons($matrix);
	  
	  // $dataSiap = combinePersonAndBook($dataPerson, $dataBuku, $matrix);
	  // $dataSimAll = getAllSim();
	  
	  // echo "<pre>";
	  // print_r($dataSimAll);
	  // echo "</pre>";
	  
	  // // // menghitung adjusted weight untuk 1 org thdp buku A
	  // // echo "<pre>";
	  // // $dataWeight = weightSum("ADINDA SARAH MAULIDINA", "Tokyo");
	  // // print_r($dataWeight);
	  // // echo "</pre>";
	 
	// mendapati nilai simgabungan
	//echo "<pre>";
	$dataPerson = getAllPersons($matrix);
	$dataBuku = getAllBooks($matrix);
	$dataSiap = combinePersonAndBook($dataPerson, $dataBuku, $matrix);
	$dataSimAll = getAllSim();
	$dataSimGabunganSuper = simCombination();
	//print_r($dataSimGabunganSuper);
	//echo "</pre>";
	 
	  // //menghitung adjusted weight untuk 1 org thdp allbuku 
	  // echo "<pre>";
	  // $dataWeight = weightSumAll("ADINDA SARAH MAULIDINA");
	  // print_r($dataWeight);
	 // echo "</pre>";
	 
	 
	  
?>