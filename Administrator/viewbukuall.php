<?php 
	if(isset($_GET['judul_buku'])){
		$judulDicari = $_GET['judul_buku'];
		
		$kondisi = "WHERE judul_buku LIKE '%$judulDicari%'";
	} else {
		$kondisi = "";
	}
?>
<!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Book</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
			
            <?php
				include "controller/database.php";

				$template=file_get_contents("templateviewbuku.html"); 
						// echo $template;

						$sql = "SELECT * FROM `data_buku` $kondisi";
						$result = $conn->query($sql);


						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								
								$judul = $row["judul_buku"];
								if (strlen($judul)>14) {
									$judul = substr($judul, 0,15) . "..." ;
								} 
								
								if ($row["file_buku"] != "0"){
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