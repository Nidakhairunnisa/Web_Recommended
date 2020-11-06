 <?php
include "controller/database.php";
// if(isset($_SESSION['n'])) {
	$nim = $_SESSION["nim"];

	$sql = "SELECT * FROM `data_buku` WHERE id_buku = '".$_GET['id_buku']."' ";
	$result = $conn->query($sql);
	$nama_lengkap = "";
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
				$gambar_buku = $row["file_buku"];
			}
		} else {
			echo "0 results";
		}
		   
		$conn->close();	
	
	// } else {
		// $nim = "";
		// $nama_lengkap = "";
	// }

?>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Buku</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Judul buku</label>
                  <input type="judul_buku" class="form-control" value="<?=$judul_buku?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">ISBN</label>
                  <input type="isbn" class="form-control" value="<?=$isbn?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pengarang buku</label>
                  <input type="pengarang_buku" class="form-control" value="<?=$pengarang_buku?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Penyunting_buku</label>
                  <input type="penyunting_buku" class="form-control" value="<?=$penyunting_buku?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Penerjemah</label>
                  <input type="penerjemah_buku" class="form-control" value="<?=$penerjemah_buku?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Penerbit</label>
                  <input type="penerbit" class="form-control" value="<?=$penerbit_buku?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Kota terbit</label>
                  <input type="kota_penerbit" class="form-control" value="<?=$kota_penerbit?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tahun terbit</label>
                  <input type="tahun_terbit" class="form-control" value="<?=$tahun_terbit?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Abstraksi </label>
                  <input type="abstraksi" class="form-control" value="<?=$abstraksi?>">
                </div>
              </div>
			  <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah buku</label>
                  <input type="jumlah_buku" class="form-control" value="<?=$jumlah_buku?>">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		</div>
	</div>
</section>