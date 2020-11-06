<?php


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
		if($jumlahBuku > 0){
		$nilaiRataFinal = number_format((float)($nilai/$jumlahBuku), 2, '.', '');;
		}
		
		
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

function getAllPerson($matrix){
	
	$allPersonName = array();
	
	foreach ($matrix as $nama=>$dataArray){
			
			// jika bukan average, 
			// maka ini ialah buku dan rate
			if(!in_array($nama, $allPersonName)){
				$allPersonName[] = $nama;
			}
	}
	
	return $allPersonName;
}

function getRate($namaOrang, $judulBuku, $matrix){
	
	$nilai=0;
	
	foreach($matrix as $nama=>$anotherData){
		foreach($anotherData as $judul=>$score)
		if($namaOrang == $nama && $judulBuku == $judul){
			$nilai = $score;
		}
	}
	return $nilai;
}

function combinePersonAndBook($dataPerson, $dataBook, $matrix){
	$dataResult1 = array();
	foreach($dataPerson as $namaOrang){
		
		foreach($dataBook as $judulBuku){
			//kita siapkan data buku dan orang 
			// dengan score rate 0 dulu
			$nilaiRate = getRate($namaOrang, $judulBuku, $matrix);
			$dataResult[$namaOrang][$judulBuku] = $nilaiRate;
			
		}
	}
	return $dataResult;
}

function sim($i,$j) {
    global $dataSiap;
	global $dataPerson;
	global $dataBooks;
	//print_r($dataBooks);
	$item1 = 0;
    $item2 = 0;
	$ujung = count($dataBooks)-1;
	

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

    $res =  ($item1+$item2)/(sqrt($item1*$item1)*sqrt($item2*$item2));
    return $res;
}

function weightSum($namaOrang, $judulBuku){
	// datasiap data orang dan buku beserta rate
	global $dataSiap;
	global $dataPerson;
	global $dataBooks;
	global $dataSimAll;
	
	
	$jumlahSkRate = 0;
	$jumlahAbsolut = 0;
	
	$hasilAkhir;
	
	for ($index = 0; $index < count($dataSiap); $index++) {
		
		foreach($dataBooks as $judul){
			if($judul != $judulBuku){
				$skorRate = $dataSiap[$namaOrang][$judul];

					$jumlahSkRate += $skorRate * $dataSimAll[$judulBuku][$judul];
					$jumlahAbsolut += abs ($dataSimAll[$judulBuku][$judul]);
				}	
				
		}
		$skorRate = $dataSiap[$namaOrang][$judulBuku];
		
		
				
    }
	$hasilAkhir = $jumlahSkRate/$jumlahAbsolut;
	return $hasilAkhir;
}

function weightSumAll($namaOrang){
	
	global $dataBooks;

	
	$dataRekomendasiAkhir = array();

	
	$jumlahSkRate 	= 0;
	$jumlahAbsolut 	= 0;
	
	$hasilAkhir;
	if (!empty($dataBooks)){
		$j=0;
		foreach($dataBooks as $judul){
				
			$hasilAkhir = weightSum($namaOrang, $judul);
			if ($hasilAkhir >= 0 && $j < 10){
				$dataRekomendasiAkhir[$judul] = $hasilAkhir;
			}
			
			$j++;
			
		}
	}
		arsort($dataRekomendasiAkhir);
		return $dataRekomendasiAkhir;
	
}

function getAllSim(){
	//menghitung similarity masing-masing buku terhadap keseluruhan 
	global $dataBooks;
	
	$dataBukuComplete = array();
	$hasilSim = array();
	foreach($dataBooks as $judul){
	
		foreach($dataBooks as $judulKedua){
			if($judul != $judulKedua){
				$hasilSim[$judul][$judulKedua] = sim($judul, $judulKedua);
			}
		}
	}
	return $hasilSim;
}


function getPersonIdenticalBook($matrix, $bookList){
	
	$member = array();
	
	foreach($bookList as $judulDoang){
		
		foreach($matrix as $nama=>$dataArray){
			
			foreach($dataArray as $judul=>$rate){
				if($judul == $judulDoang){
					//$Orangscore[$nama] = $rate;
					$data[$judul] = $rate;
					$member[$judul][$nama] = $data;
				}
			}
			
		}
		
	}
	
	return $member;
	
}

function getAdjustConSimilar($book1, $book2, $matrix){

	//iterate from matrix for 2 books// from each member 
	
	$rateAverageSinglePerson = 0;
	$totalSmaSinglePerson = 0;
	$multipySinglePerson = 0;
	$rootSingleBook1 = 0;
	$rootSingleBook2 = 0;
	$multipyRoot = 0;
	$endingDivision = 0;


	foreach($matrix as $nama=>$dataArray){

			foreach($dataArray as $judul=>$rate){
			
			
				if ($judul == 'average'){
					// mengambil
					$rateAverageSinglePerson = $rate;
				}
			}
	}	
 	
	
}



?>