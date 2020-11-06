<?php
if(isset($_GET['id'])) {
	$nomor_id = $_GET["id"];
	
	include 'edituser.php';
	
} else {
	$nim = "";
	$nama = "";
	$password = "" ;
	$file_user = "";
}
?>

<!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data User</h3>

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
			<input name = "jenis-data" type="hidden" value="user" />
              <div class="form-horizontal">
				<div class="box-body">
                <div class="form-group">
					<label class="col-sm-2 control-label">Nama Lengkap</label>
					<div class="col-sm-10">
						<input type="text" name="nama_lengkap" value="<?= $nama; ?>" />
					</div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="text" name="password" value="<?= $password; ?>"/>
					</div>
                </div>	
				<div class="form-group">
					<label class="col-sm-2 control-label">Foto</label>
					<div class="col-sm-10">
						<input type="file" name="file_user" />
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