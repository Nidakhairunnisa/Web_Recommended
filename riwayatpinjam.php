<?php
include "controller/database.php";
if(isset($_GET['id'])) {
	$nomor_id = $_GET["id"];

	
} else {
	$id_pinjam = "";
	$judul_buku= "" ;
	$tanggal_pinjam = "";
}
if(isset($_GET['judul_buku'])){
		$bukuDicari = $_GET['judul_buku'];
		
		$kondisi = "AND judul_buku LIKE '%$bukuDicari%'";
	} else {
		$kondisi = "";
		
	}
  $nimDicari = $_SESSION['nim'];
				 

?>


<!-- Main content -->
    <section class="content">
	<input id="nim-user" type="hidden" value="<?=$nimDicari?>" />
	 <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Peminjaman</h3>

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
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam </th>
                    <th>Tanggal Kembali </th>
					<th>Status</th>
					<th>Rating</th>
                  </tr>
                  </thead>
                  <tbody>
				  
				  <?php
				  
					echo $nimDicari;
					//$sql = "SELECT * FROM `pinjam_buku` WHERE nim=$nimDicari order by tanggal_pinjam desc";
					$sql= "SELECT pb.*, rating FROM pinjam_buku pb LEFT JOIN data_rating dr ON pb.id_pinjam=dr.id_pinjam WHERE pb.nim=$nimDicari $kondisi";
					
					
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$tanggal_kembali= date('Y-m-d', strtotime($row["tanggal_pinjam"]. ' + 7 days'));
		$status			= "kembali";
		if ($tanggal_kembali == date('Y-m-d')){
			$label = "warning";
		} else if ($tanggal_kembali >  date('Y-m-d') && $status != "kembali"){
			$label = "danger";
		} 
		else {
			$label = "success";
		}
		
		if ($row['status'] == "dikembalikan") {
	
			$nilaiRating = $row['rating'];
			
			if($nilaiRating !== NULL){
				$kelasLabel = "label-success";
			}else{
				$nilaiRating = 0;
				$kelasLabel = "label-success";
			}
	
			$ulas = '<span id-pinjam ="' . $row['id_pinjam'] . '" class="label '.
			$kelasLabel .'"><i class="fa fa-star" id-pinjam="' . $row['id_pinjam'] .'"></i> '. 
			$nilaiRating . ' Rate </span>';
		} else { $ulas = '';}

		?>
		<tr>
			<td><a href="#"><?php echo $row["id_pinjam"];?></a></td>
			<td><?php echo $row["judul_buku"];?></td>
			<td><?php echo $row["tanggal_pinjam"];?></td>
			<td><span class="label label-<?php echo $label; ?>"><?=$tanggal_kembali?></span></td>
			<td><?= $row['status'] ?></td>
			<td><?php echo $ulas; ?></td>
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
  
<!--Import jQuery before export.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>  
  