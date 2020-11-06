<?php

	$kondisi = '';
	$infoMsg = '';
	if(isset($_POST['q']) && $_POST['q'] != "" ){
		$q 		= $_POST['q'];
		
		$kondisi  = "WHERE judul_buku LIKE '%$q%' ";
		$kondisi .= "OR pengarang_buku LIKE '%$q%' ";
		$kondisi .= "OR penerbit LIKE '%$q%' ";
		$kondisi .= "OR genre like '%$q%' " ;
		$infoMsg	.= ''.$q. '<br/>';
	}
	
	
	if (isset($_POST['judul_buku']) || isset($_POST['pengarang']) || isset($_POST['penerbit']) || isset($_POST['genre']) )
		if ($_POST['judul_buku'] != "" || $_POST['pengarang'] != "" || $_POST['penerbit'] != "" || $_POST['genre'] != "" ) 
			$kondisi = 'WHERE ';
		
	if(isset($_POST['judul_buku']) && $_POST['judul_buku'] != ""){
		$bukuDicari = $_POST['judul_buku'];
		$infoMsg	.= 'Judul Buku : '.$bukuDicari. '<br/>';
		$kondisi 	.= "judul_buku LIKE '%$bukuDicari%'";
	} 
	if(isset($_POST['pengarang']) && $_POST['pengarang'] != ""){
		$pengarangDicari = $_POST['pengarang'];
		$infoMsg	.= 'Pengarang : '.$pengarangDicari. '<br/>';
		if ($_POST['judul_buku'] != "") $kondisi .= " AND ";
		$kondisi 	.= "pengarang_buku LIKE '%$pengarangDicari%'";
	} 
	if(isset($_POST['penerbit']) && $_POST['penerbit'] != ""){
		$penerbitDicari = $_POST['penerbit'];
		$infoMsg	.= 'Penerbit : '.$penerbitDicari. '<br/>';
		if ($_POST['judul_buku'] != "" || $_POST['pengarang'] != "") $kondisi .= " AND ";
		$kondisi 	.= " penerbit LIKE '%$penerbitDicari%'";
	} 
	if(isset($_POST['genre']) && $_POST['genre'] != ""){
		$genreDicari = $_POST['genre'];
		$infoMsg	.= 'Genre : '.$genreDicari. '<br/>';
		if ($_POST['judul_buku'] != "" || $_POST['pengarang'] != "" || $_POST['penerbit'] != "") $kondisi .= " AND ";
		$kondisi .= " genre LIKE '%$genreDicari%'";
	} 
	else  {
		
		$kondisi .= "ORDER BY average_rate DESC";
		
	}  
	
?>

	<!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
		
          <h3 class="box-title">Dashboard</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
			<h2 id='rekomendasi-judul'>Rekomendasi Buku</h2>
            <?php
				
				include_once ("controller/database.php");
				//include_once ('controller/calculator.php');
				include_once ('controller/matrix_recommendation.php');
				

				$dataWeightAll = weightSumAll($_SESSION['nama_lengkap']);
				
				echo '<div class="item">
            <ul id="content-slider" class="content-slider">';
				$batas = 10;
				foreach($dataWeightAll as $jdl=>$rate){
					$batas--;
					if($batas==0){
						break;
					}
					$sql 	= "SELECT * FROM `data_buku` where judul_buku='".$jdl."' ";
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							if ($row["file_buku"] != "0" && file_exists('administrator/data/buku/'.$row["file_buku"])){
								$namaFile = $row["file_buku"];
							} else { $namaFile = "default.png"; }
						}
					}
					
					echo '	<li>
								<h3><img class="gambar-buku" width="30%" src="administrator/data/buku/'.$namaFile.'" />
								<br/><center>'.$jdl.'<center>
								</h3>
								
							</li>';
				}
			
				echo '</ul>
        </div>';
						
				$template=file_get_contents("templateviewbuku.html"); 
						// echo $template;
if (isset($_POST['search-advance']) || isset($_POST['search'])) {
	echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Hasil Pencarian : </h4>
                '.$infoMsg.'
              </div>';
}

						$sql = "SELECT * FROM `data_buku` $kondisi";
						$result = $conn->query($sql);


						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								
								$judul = $row["judul_buku"];
								if (strlen($judul)>14) {
									$judul = substr($judul, 0,15) . "..." ;
								} 
								
								if ($row["file_buku"] != "0" && file_exists('administrator/data/buku/'.$row["file_buku"])){
									$namaFile = $row["file_buku"];
								} else { $namaFile = "default.png"; }
								
								$templatefinal = str_replace("ID_BUKU",$row["id_buku"],$template);
								$templatefinal = str_replace("NAMA_BUKU",$judul,$templatefinal);
								$templatefinal = str_replace("PENGARANG_BUKU",$row["pengarang_buku"],$templatefinal);
								$templatefinal = str_replace("ISBN",$row["isbn"],$templatefinal);
								$templatefinal = str_replace("PENERJEMAH_BUKU",$row["penerjemah_buku"],$templatefinal);
								$templatefinal = str_replace("PENYUNTING_BUKU",$row["penyunting_buku"],$templatefinal);
								$templatefinal = str_replace("PENERBIT",$row["penerbit"],$templatefinal);
								$templatefinal = str_replace("KOTA_TERBIT",$row["kota_terbit"],$templatefinal);
								$templatefinal = str_replace("TAHUN_TERBIT",$row["tahun_terbit"],$templatefinal);
								$templatefinal = str_replace("ABSTRAKSI",$row["abstraksi"],$templatefinal);
								$templatefinal = str_replace("JUMLAH_BUKU",$row["jumlah_buku"],$templatefinal);
								$templatefinal = str_replace("NILAI_RATE",$row["average_rate"],$templatefinal);
								$templatefinal = str_replace("NAMA_FILE",$namaFile,$templatefinal);
								
								
								
								echo $templatefinal;
								
								

							}
						} else {
							echo "0 results";
						}
						   
						$conn->close();
						?>
          
              </div>
			</div>  
        </div>
      </div>
      <!-- /.box -->

	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

	<link rel="stylesheet"  href="css/lightslider.css"/>
	<style>
    	.content-slider ul{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}}
	</style>
	
	<script src="js/lightslider.js"></script> 
	<script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            
		});
    </script>