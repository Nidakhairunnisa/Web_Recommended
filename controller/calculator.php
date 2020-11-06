<?php

function printKeterangan($judul1, $judul2, $dataSim){
	echo "<pre>";
	echo "buku " . $judul1 . " dan " . $judul2;
	echo " bernilai ". $dataSim['genre'] . "," . $dataSim['penerbit'] . "," . $dataSim['pengarang'] . " = " . $dataSim['score'];
	echo "</pre>";
	
}

function isEquals($nomorA, $nomorB){
	
	if($nomorA == $nomorB){
		return 1;
	}
	
	return 0;
	
}

function shiftOneData(){
	$anArray = array();
	// we just pushed 1 empty data at the beginning
	$anArray[] = null;
	
	return $anArray;
}

function addDataToArray($oneData, $arrayBox){
	
	if(in_array($oneData, $arrayBox)){
		// do nothing if already exists bro!
	}else {
		//otherwise let's combine aja
		$arrayBox[] = $oneData;
	}
	
	return $arrayBox;
	
}

function getAverageRate($matrix, $orang){
		
		$jumlahBuku = 0;
		$nilaiRataFinal = 0;
		$nilai=0;
		
		foreach($matrix as $nama=>$dataArray){
			
			if($nama == $orang){
			
				foreach($dataArray as $judul=>$rate){
					$nilai+=$rate;
				}
			
			$jumlahBuku = sizeof($dataArray);
			}
			
		}
		
		$nilaiRataFinal = number_format((float)($nilai/$jumlahBuku), 2, '.', '');;
		
		return $nilaiRataFinal;
}
	
function getCosineSimilarity1Person($matrix){
	
	$simCons = 0;
	
	$judulCheck = "";
	$dataBuku= array();
	$ru = 1;
	
	// get to know the books name first
	foreach($matrix as $nama=>$dataArray){
		
		foreach($dataArray as $judul=>$rate){
			
			if($judul != 'average'){
				// karena last key itu ialah averageRate
				$ru *= $rate-$dataArray['average'];
			}else{
				return $ru;
			}
			
		}
		
	}
	
}

function getAllBooks($matrix){
	
	$allBooksName = array();
	
	foreach ($matrix as $nama=>$dataArray){
		foreach ($dataArray as $judul=>$rate){
			
			// jika bukan average, 
			// maka ini ialah buku dan rate
			if($judul != 'average'){
				
				// periksa dulu apakah nama judul buku ini sudah pernah 
				// masuk list? jika blm maka masukkan.
				if(!in_array($judul, $allBooksName)){
					$allBooksName[] = $judul;
				}
			}
			
		}
	}
	
	return $allBooksName;
}

function getAllPersons($matrix){
	
	$allPersonName = array();
	
	foreach ($matrix as $nama=>$dataArray){
		
		// periksa dulu apakah nama orang ini
		// masuk list? jika blm maka masukkan.
		if(!in_array($nama, $allPersonName)){
			$allPersonName[] = $nama;
		}
		
	}
	
	return $allPersonName;
}

function setAllAttributes($dataMentahSQL, $showName=false){
	 global $dataGenre;
	 global $dataPenerbit;
	 global $dataPengarang;
	 global $dataJudulBuku;
	 // matrixbook ori akan terisi dari sini ke luar
	 global $matrixBookOri;
	 
	 $dataGenre = shiftOneData();
	 $dataPenerbit = shiftOneData();
	 $dataPengarang = shiftOneData();
	 $dataJudul = shiftOneData();
	
	 while($row = mysqli_fetch_array($dataMentahSQL)) {
		$judulBuku = $row['judul_buku'];
		$namaPengarang = $row['pengarang_buku'];
		$namaPenerbit = $row['penerbit'];
		$namaGenre = $row['genre'];
		
		$dataJudul = addDataToArray($judulBuku, $dataJudul);
		$dataPengarang = addDataToArray($namaPengarang, $dataPengarang);
		$dataPenerbit = addDataToArray($namaPenerbit, $dataPenerbit);
		$dataGenre = addDataToArray($namaGenre, $dataGenre);
		
		$dataAttribute = array();
		if($showName == false){
				$dataAttribute['judul'] = getIndex($judulBuku, $dataJudul);
				$dataAttribute['genre'] = getIndex($namaGenre, $dataGenre);
				$dataAttribute['penerbit'] = getIndex($namaPenerbit, $dataPenerbit);
				$dataAttribute['pengarang'] = getIndex($namaPengarang, $dataPengarang);
		}else{
			$dataAttribute['judul'] = $judulBuku;
			$dataAttribute['genre'] = $namaGenre;
			$dataAttribute['penerbit'] = $namaPenerbit;
			$dataAttribute['pengarang'] = $namaPengarang;
		}
	
		
		$matrixBookOri[$judulBuku] = $dataAttribute;
		
	 }
	 
	
}

function getRate($namaOrang, $judulBuku, $matrix){
	$nilai = 0;
	
	foreach($matrix as $nama=>$anotherData){
		foreach($anotherData as $judul=>$score)	{
			if($namaOrang == $nama && $judulBuku == $judul){
				$nilai = $score;
			}
		}
		
	}
	
	return $nilai;
	
}

function getIndex($nilai, $arrayBox){
	$post = 0;
	foreach($arrayBox as $value){
		if($value == $nilai){
			return $post;
		}
		
		$post++;
	}
	
	return -1;
}

function createBookMatrix($dataMentahSQL){
	$matrix = array();
	$innerData = array();
	
	 while($row = mysqli_fetch_array($dataMentahSQL)) {
		 $judul = $row['judul_buku'];
		 
		 $innerData['genre'] = $row['genre'];
		 $innerData['penerbit'] = $row['penerbit'];
		 $innerData['pengarang_buku'] = $row['pengarang_buku'];
		 
		 $matrix[$judul] = $innerData;
		 // renewal
		 $innerData = array();
	 }
	 
	 return $matrix;
	
}

function simCombination(){
	
	// mengkalikan dengan persentase 60% trhadap sim lama
	// mengkalikan dengan persentase 40% trhadap simattribute
	// lalu dijumlahkan
	global $dataBuku; 
	$sim = array();
	$simAttribute = array(); // bersambung...
	
	$sim = getAllSim();
	$simAttribute = getAllSimAttribute();
	$simGabungan = array();
	
	// foreach($sim as $key=>$val){
		
		// foreach($val as $key2=>$val2){
			
			// // memberikan perkalian 60% terhadap
			// // sim (lama)
			// $nilaiBaru = $val2*0.6;
			// $val[$key2] = $nilaiBaru;
			// // diupdate sim awal
			// $sim[$key] = $val;
		// }
		
	// }
	
	// foreach($simAttribute as $key){
		// foreach($key as $innerData => $val){
				// $value = $val['score'];
				// $nilaiBaru = $value * 0.4;
				// $val['score'] = $nilaiBaru;
				// // diupdate sim attribute
				// $simAttribute[$key] = $val;
		// }
	// }
	
	// menyimpan nilai gabungan dari persentase yg sdh terkalikan 60% dan 40%
	// terhadap all books
	foreach($dataBuku as $judul1){
		foreach($dataBuku as $judul2){
			//checkpoint penilaian 
			// sim yg default 0 - tidak sama 
			$nilaiSimAwal = 0;
			$nilaiSimAttribute = 0;
			
			$nilaiSimAwal = getSimScore($judul1, $judul2);
			$nilaiSimAttribute = getSimAttribute($judul1, $judul2);
			
			// echo "<pre>";
			// $datax = "judul  :" . $judul1;
			// $datax .= " judul2  :" . $judul2;
			// $datax .= " score  :" . $nilaiSimAttribute;
			// print_r($datax);
			// echo "</pre>";
			
			//echo "nilai attrib " . $nilaiSimAttribute. "<br>";
			if($judul1 != $judul2){
			$simGabungan[$judul1][$judul2] = ($nilaiSimAwal*0.6) + ($nilaiSimAttribute*0.4);			
			}
				
		}
			
	}
	
	return $simGabungan;
	
}

function getTotalSims($judul1, $judul2, $simLama, $simAttribute){
	
	$nilaiSimAwal = 0;
	$nilaiSimAttribute = 0;
	// looping dari kedua result
	// lalu totalkan
	// .... (bersambung)
	foreach($simLama as $data=>$isi){
		foreach($isi as $key=>$value){
			// key disini ialah judul buku pasangannya
			if($key==$judul1 && $isi==$judul2){
				$nilaiSimAwal = $value;
				break;
			}else if($isi==$judul1 && $key==$judul2){
				$nilaiSimAwal = $value;
				break;
			}
			
		}
	}
	
	foreach($simAttribute as $data=>$isi){
		foreach($isi as $nama=>$value){
			if($nama==$judul2 && $data==$judul1){
				$nilaiSimAttribute = $value['score'];
				break;
			}
		}
	}
	
	$hasil = $nilaiSimAwal+$nilaiSimAttribute;
	return $hasil;
	
}

function simAttributes(){
	
	global $matrixBookOri;
	
	$dataMatrixScore = array();
	
	foreach($matrixBookOri as $judulBuku=>$data){
		$dataMatrixScore = simAttribute($dataMatrixScore,$judulBuku, $data);
	}
	
	return $dataMatrixScore;
	
}

function simAttribute($arrayBox, $judulBuku1, $dataAttribute){
	
	global $matrixBookOri;
	
	$scoreJudul=0;
	$scoreGenre=0;
	$scorePenerbit=0;
	$scorePengarang=0;
	$indexJudul=0;
	$indexGenre=0;
	$indexPenerbit=0;
	$indexPengarang=0;
	
	$indexJudul = $dataAttribute['judul'];
	$indexGenre = $dataAttribute['genre'];
	$indexPenerbit = $dataAttribute['penerbit'];
	$indexPengarang = $dataAttribute['pengarang'];
	
	foreach($matrixBookOri as $judulBuku=>$data){
		foreach($data as $attribute => $index){
			if($attribute == 'genre'){
				$scoreGenre = isEquals($indexGenre, $index);
			}
			if($attribute == 'penerbit'){
				$scorePenerbit = isEquals($indexPenerbit, $index);
			}
			if($attribute == 'pengarang'){
				$scorePengarang = isEquals($indexPengarang, $index);
			}
			if($attribute == 'judul'){
				$scoreJudul = isEquals($indexJudul, $index);
			}
			
		}
			$dataSim = array();
			$dataSim['judul'] = $scoreJudul;
			$dataSim['genre'] = $scoreGenre;
			$dataSim['penerbit'] = $scorePenerbit;
			$dataSim['pengarang'] = $scorePengarang;
			$hasil = ($scoreJudul*0.837)+($scoreGenre*0.054)+($scorePenerbit*0.116)+($scorePengarang*0.558);
			
			$dataSim['score'] = $hasil;
			
			$arrayBox[$judulBuku1][$judulBuku] = $dataSim;
			//printKeterangan($judulBuku1, $judulBuku, $dataSim);
	}
	
	return $arrayBox;
	
}

function getSimAttribute($judul1, $judul2){
	return simAttributeCompare($judul1, $judul2);
}

function simAttributeCompare($judulBuku1, $judulBuku2){
	// ambil score yg tlah tercipta dari array matrix sblmnya
	global $matrixAttribScore;
	$nilai=0;
	
	foreach($matrixAttribScore as $judulBuku1 =>$data){
		
		foreach($data as $judulBuku2 => $dataAttrib){
			// echo "<pre>";
			// $datax = "judul  :" . $judul1;
			// $datax .= " judul2  :" . $judul2;
			// $datax .= " score  :" . $dataAttrib['score'];
			// print_r($datax);
			// //print_r($dataAttrib);
			// echo "</pre>";
			// if($key==$judulBuku1 && $data==$judulBuku2){
			
			// $nilaiSimAttribute = $val;
			// }
			// if($judul1 == $judulBuku1){
				// $nilai = $dataAttrib['score']; 
				// break;
			// }
			
		}
		
	}
	if(isset($matrixAttribScore[$judulBuku1][$judulBuku2])){
	$data = $matrixAttribScore[$judulBuku1][$judulBuku2];
	$nilai = $data['score'];
	}
	
	return $nilai;
	
}

function combinePersonAndBook($dataPerson, $dataBook, $matrix){
	
	$dataResult = array();
	foreach($dataPerson as $namaOrang){
		
		foreach($dataBook as $judulBuku){
			// kita siapkan data buku and person
			// dengan score rate dari yg ia miliki
			$nilaiRate = getRate($namaOrang, $judulBuku, $matrix);
			$dataResult[$namaOrang][$judulBuku] = $nilaiRate;
		}
		
	}
	
	return $dataResult;
	
}
function getSimScore($judul1, $judul2){
	return sim($judul1, $judul2);
}

function sim($i,$j) {
    global $dataSiap;
	global $dataPerson;
	global $dataBuku;
	
	$item1 = 0;
    $item2 = 0;

	$ujung = count($dataBuku)-1;
	
    // calculate the sums for the ith and jth items
    // minus each users' avg rating.
	
    for ($index = 0; $index < count($dataSiap); $index++) {
		
		$nama = $dataPerson[$index];
		
		if ($index == 0 || $index==$ujung){
			if (count($dataSiap) > 0){
				$avgDt = array_sum($dataSiap[$nama])/count($dataSiap);

				$item1 += ($dataSiap[$nama][$i] - $avgDt);
				$item2 += ($dataSiap[$nama][$j] - $avgDt);
			}
		}
    }

	//echo 'item1 : '.$item1.' >> '.$item2.'<br>';
	
    $res =  ($item1*$item2)/(sqrt($item1*$item1)*sqrt($item2*$item2));
	
	$hasil = number_format((float)$res, 2, '.', '');
    return $hasil;
}

function weightSum($namaOrang, $judulBuku){
	
	// data siap ialah data namaorang,dan buku dgn ratenya.
	global $dataSiap;
	global $dataPerson;
	global $dataBuku;
	global $dataSimAll;
	global $dataSimGabungan;
	
	
	$jumlahSkrate = 0;
	$jumlahAbsolute = 0;
	
	$hasilAkhir = 0;
	
	for ($index = 0; $index < count($dataSiap); $index++) {
		
		foreach($dataBuku as $judul){
			if($judul != $judulBuku){
				$skorBuku = $dataSiap[$namaOrang][$judul];
				
				// $jumlahSkrate += $skorBuku * $dataSimAll[$judulBuku][$judul];
				// $jumlahAbsolute += abs($dataSimAll[$judulBuku][$judul]);
				
								
				$jumlahSkrate += $skorBuku * $dataSimGabungan[$judulBuku][$judul];
				$jumlahAbsolute += abs($dataSimGabungan[$judulBuku][$judul]);
					
				}
				
			}
		}
		
  
	if($jumlahSkrate!=0){
	$hasilAkhir = $jumlahSkrate/$jumlahAbsolute;
	}
	return $hasilAkhir;
	
}

function weightSumAll($namaOrang){
	
	global $dataBuku;
	
	$dataRekomenAkhir = array();
	
	$jumlahSkrate = 0;
	$jumlahAbsolute = 0;
	
	$hasilAkhir = 0;
	
	foreach($dataBuku as $judul){			
		$hasilAkhir = weightSum($namaOrang, $judul);
		$dataRekomenAkhir[$judul] = $hasilAkhir;
	}
	
	// diurutkan berdasarkan descending order
	arsort($dataRekomenAkhir);
	return $dataRekomenAkhir;
}


function getAllSimAttribute(){
	global $dataBuku;
	
	// menghitung similarity untuk masing-masing buku
	// terhadap ksluruhan secara attribute
	$dataBukuCompleted = array();
	$hasilSim = array();
	
	foreach($dataBuku as $judul){
		
		foreach($dataBuku as $judulKedua){
			if($judul != $judulKedua){
				$hasilSim[$judul][$judulKedua] = simAttributeCompare($judul, $judulKedua);
			}
		}
		
	}
	
	return $hasilSim;
	
}

function getAllSim(){
	global $dataBuku;
	
	// menghitung similarity untuk masing-masing buku
	// terhadap ksluruhan
	$dataBukuCompleted = array();
	$hasilSim = array();
	
	foreach($dataBuku as $judul){
		
		foreach($dataBuku as $judulKedua){
			if($judul != $judulKedua){
				$hasilSim[$judul][$judulKedua] = sim($judul, $judulKedua);
			}
		}
		
	}
	
	return $hasilSim;
	
}

function getPersonIdenticalBook($matrix, $bookList){
	
	$member = array();
	$data = array();
	
	foreach($bookList as $judulDoang){
		
		foreach($matrix as $nama=>$dataArray){
			
			foreach($dataArray as $judul=>$rate){
				if($judul == $judulDoang){
					$data[$judul] = $rate;
					$member[$nama] = $data;
				}
			}
			
		}
		
	}
	
	return $member;
	
}




?>