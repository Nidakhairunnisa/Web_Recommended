<?php 

class Buku{
	public $id;
	public $judul_buku;
	public $manyRate;
	public $totalRate;
	public $averageRate;
	
	public function hitungAverage(){
	
		$this->averageRate = $this->totalRate/$this->manyRate;
		//bulatin 
		$skor_rating = $this->averageRate; 
		$this->averageRate = number_format($skor_rating, 2, '.', '') ;
		return $this->averageRate;
	}
	
	public function cetakData(){
	echo $this->judul_buku ."dengan average rate". $this->averageRate."<br>"; 
	
	}
	
	
}
?>
