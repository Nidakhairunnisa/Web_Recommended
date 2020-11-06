<?php
if(isset($_GET['id'])) {
	$nomor_id = $_GET["id"];
	
	include 'controller/edit_buku.php';
	
} else {
	$nomor_id = "";
	$judul_buku = "";
	$isbn = "";
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

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data Buku</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
			<form action="controller/save_upload.php" method="POST" enctype="multipart/form-data">
			<input name = "nomor_id" type="hidden" value="<?= $nomor_id ?>" />
             <input name = "jenis-data" type="hidden" value="buku" />
			 <div class="form-horizontal">
				<div class="box-body">
                <div class="form-group">
					<label class="col-sm-2 control-label">Judul buku</label>
					<div class="col-sm-10">
						<input type="text" name="judul_buku" value="<?= $judul_buku; ?>" />
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ISBN</label>
					<div class="col-sm-10">
						<input type="text" name="isbn" value="<?= $isbn; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Pengarang</label>
					<div class="col-sm-10">
						<input type="text" name="pengarang_buku" value="<?= $pengarang_buku; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Penyunting</label>
					<div class="col-sm-10">
						<input type="text" name="penyunting_buku" value="<?= $penyunting_buku; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Penerjemah</label>
					<div class="col-sm-10">
						<input type="text" name="penerjemah_buku" value="<?= $penerjemah_buku; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Penerbit</label>
					<div class="col-sm-10">
						<input type="text" name="penerbit_buku" value="<?= $penerbit_buku; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Kota terbit</label>
					<div class="col-sm-10">
						<input type="text" name="kota_penerbit" value="<?= $kota_penerbit; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Tahun terbit</label>
					<div class="col-sm-10">
						<input type="text" name="tahun_terbit" value="<?= $tahun_terbit; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Abstraksi</label>
					<div class="col-sm-10">
						<input type="text" name="abstraksi" value="<?= $abstraksi; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Jumlah buku</label>
					<div class="col-sm-10">
						<input type="text" name="jumlah_buku" value="<?= $jumlah_buku; ?>"/>
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Gambar</label>
					<div class="col-sm-10">
						<input type="file" name="file_buku" />
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
              </div>
			</div>  
        </div>
      </div>
      <!-- /.box -->

	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->