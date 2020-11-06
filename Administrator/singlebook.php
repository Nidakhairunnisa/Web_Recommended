<?php
include "controller/database.php";
 
if(isset($_GET['id'])) {
	$nomor_id = $_GET["id"];
	
	$sql = "SELECT * FROM `data_buku` WHERE id_buku = '$nomor_id' ";
	$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$judul_buku = $row["judul_buku"];
				$isbn = $row["isbn"];
				$pengarang_buku = $row["pengarang_buku"];
				$penyunting_buku = $row["penyunting_buku"];
				$penerjemah_buku = $row["penerjemah_buku"];
				$penerbit_buku = $row["penerbit"];
				$kota_penerbit = $row["kota_terbit"];
				$tahun_terbit = $row["tahun_terbit"];
				$abstraksi = $row["abstraksi"];
				$jumlah_buku = $row["jumlah_buku"];
				if ($row["file_buku"] != "0"){
					$gambar_buku = $row["file_buku"];
				} else { $gambar_buku = "noimg.png"; }
			}
		} else {
			echo "0 results";
		}
		   
		$conn->close();	
	
	} else {
		$nomor_id = "";
		$judul_buku = "";
		$isbn = "";
		$jenis_buku = "";
		$pengarang_buku = "";
		$penyunting_buku = "";
		$penerjemah_buku = "";
		$penerbit_buku = "" ;
		$kota_penerbit = "";
		$tahun_terbit = "";
		$abstraksi = "";
		$jumlah_buku = "";
		$gambar_buku = "";
	}

?>
<!-- Main content -->
    <section class="content">	
		<!-- div class="col-md-7" -->

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				<img class="profile-user-img img-responsive " src="administrator/data/buku/<?=$gambar_buku?>" alt="User profile picture">

				<h3 class="profile-username text-center"><?=$judul_buku?></h3>
				<br/><br/>
				<p class="text-muted"><b>Judul</b> <a class="pull-right"><?=$judul_buku?></a></p>
				<hr>
				<p class="text-muted"><b>ISBN</b> <a class="pull-right"><?=$isbn?></a></p>
				<hr>
				<p class="text-muted"><b>Pengarang</b> <a class="pull-right"><?=$pengarang_buku?></a></p>
				<hr>
				<p class="text-muted"><b>Penyunting</b> <a class="pull-right"><?=$penyunting_buku?></a></p>
				<hr>
				<p class="text-muted"><b>Penerjemah</b> <a class="pull-right"><?=$penerjemah_buku?></a></p>
				<hr>
				<p class="text-muted"><b>Penerbit</b> <a class="pull-right"><?=$penerbit_buku?></a></p>
				<hr>
				<p class="text-muted"><b>Kota terbit</b> <a class="pull-right"><?=$kota_penerbit?></a></p>
				<hr>
				<p class="text-muted"><b>Tahun terbit</b> <a class="pull-right"><?=$tahun_terbit?></a></p>
				<hr>
				<p class="text-muted"><b>Jumlah buku</b> <a class="pull-right"><?=$jumlah_buku?></a></p>
				<hr>
				<p class="text-muted"><b>Abstraksi</b> <a class="pull-right"><?=$abstraksi?></a></p>
				<hr>
				
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		<!-- /div -->

	</section>