<?php
include "controller/database.php";
	//dicheck nyari by nim
	if(isset($_GET['nim'])){
		$nimDicari = $_GET['nim'];
		
		$kondisi = "WHERE CAST(nim as CHAR) LIKE '%$nimDicari%'";
	} else {
		$kondisi = "";
	}
	
?>



<!-- Main content -->
    <section class="content">
	
	 <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Peminjaman Buku</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID Peminjaman</th>
                    <th>Nama user</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam </th>
                    <th>Tanggal Kembali </th>
					<th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
				  <?php
				  $halaman = 100;
				  $start_halaman = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
				  $mulai = ($start_halaman>1) ? ($start_halaman * $halaman) - $halaman : 0;
					//$sqlAll = "SELECT * FROM `pinjam_buku` order by tanggal_pinjam desc";
					$sqlAll = "SELECT * FROM `pinjam_buku` $kondisi";
					if($kondisi==""){
						$sqlPaging = "SELECT * FROM `pinjam_buku`LIMIT $mulai, $halaman";
					}else{
						$sqlPaging = "SELECT * FROM `pinjam_buku` $kondisi LIMIT $mulai, $halaman";
					}
					
					

$result = $conn->query($sqlAll);
$banyakData = $result->num_rows;
$pages = ceil($banyakData/$halaman);

$result = $conn->query($sqlPaging);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		
		if($row['status'] == 'dikembalikan'){
			$tanggal_kembali = $row['tanggal_kembali'];
			$tanggal_kembali = explode(' ',$tanggal_kembali);
			$tanggal_kembali = $tanggal_kembali[0];
			$status			= $row['status'];
		} else {
				$tanggal_kembali= date('Y-m-d', strtotime($row["tanggal_pinjam"]. ' + 7 days'));
				$status			= $row['status'];
		}
		
		if ($tanggal_kembali == date('Y-m-d')){
			$label = "warning " . $status;
		} else if ($tanggal_kembali >  date('Y-m-d') && $status != "kembali"){
			$label = "danger "  . $status;
		} 
		else {
			$label = "success "  . $status;
		}
		
		?>
		<tr>
                    <td><a href="#"><?php echo $row["id_pinjam"];?></a></td>
                    <td><?= $row["nim"]?></td>
					<td class="judul-buku"><?= $row["judul_buku"]?></td>
					<td><?= $row["tanggal_pinjam"]?></td>
					<td><span data-id="<?= $row['id_pinjam'] ?>" status="<?= $row['status'] ?>" class="label label-<?= $label ?> tanggal-kembali"><?=$tanggal_kembali?></span></td>
	<td ><span nim="<?= $row['nim']?>" status="<?= $row['status']?>" id="<?= $row['id_pinjam']?>" class="tombol-status <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
                  </tr>
				  <?php
    }
	
	
} else {
    echo "0 results";
}
?>
                  
				  
				  
                 
                  </tbody>
                </table>
              </div>
			  

	<div class="navigasi-halaman">
  <?php 
  echo "Page ";
  for ($i=1; $i<=$pages ; $i++){  ?>
  <a href="?a=addpinjam&halaman=<?= $i; ?>">
  <?= $i; ?>
  </a>
 
  <?php } ?>
 
	</div>
			  
      <!-- SELECT2 EXAMPLE -->
      <!--<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Peminjaman Buku</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
			<form action="controller/save_upload.php" method="POST" enctype="multipart/form-data">
			<input name = "nomor_id" type="hidden" value="<?= $nomor_id ?>" />
              <div class="form-horizontal">
				<div class="box-body">
                <div class="form-group">
					<label class="col-sm-2 control-label">Nama Lengkap</label>
					<div class="col-sm-10">
						<input type="text" name="nama" value="<?= $nama; ?>" />
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Judul Buku</label>
					<div class="col-sm-10">
						<input type="text" name="judul_buku" value="<?= $judul_buku; ?>"/>
					</div>
                </div>	
				<div class="form-group">
					<label class="col-sm-2 control-label">Tanggal Peminjaman</label>
					<div class="col-sm-10">
						<input type="text" name="tanggal_pinjam" value="<?= $tanggal_pinjam; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<div class="col-sm-10">
						<input type="submit" value="cancel" /> 
						<input type="submit" value="ok" />
					</div>
                </div>
				</div>		
					
					<p> silahkan isi dengan data sebenarnya </p>
					</form>
					</div>
              </div> -->
			</div>  
        </div>
      </div>
      <!-- /.box -->

	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->