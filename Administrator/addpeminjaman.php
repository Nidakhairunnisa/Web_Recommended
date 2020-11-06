<?php
if(isset($_GET['nim'])) {
	$nomor_id = $_GET["nim"];
	
	
} else {
	$id_pinjam = "";
	$nim = "";
	$judul_buku = "";
	$tanggal_pinjam = "";
}

?>


<!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Data Peminjaman</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-9">
			<form action="controller/input_pinjam.php" method="POST" enctype="multipart/form-data">
			<input name = "nomor_id" type="hidden" value="<?= $nomor_id ?>" />
              <div class="form-horizontal">
				<div class="box-body">
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Tanggal Peminjaman</label>
					<div class="col-sm-10">
						<input type="date" name="tgl_peminjaman"  value="<?php echo date('Y-m-j'); ?>"/>
					</div>
                </div>
				
                <div class="form-group">
					<label class="col-sm-2 control-label">NIM</label>
					<div class="col-sm-10">
						<input type="text" name="nim" required />
					</div> 
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Judul buku</label>
					<div class="col-sm-10">
						<input type="text" id="judul_buku" name="judul_buku" value="<?= $judul_buku; ?>"  required />
					</div>
                </div>
				
				<div class="form-group">
					<div class="col-sm-10">
						<input type="reset" name= "reset" value="cancel" /> 
						<input type="submit" class="tombol-submit" name= "Submit" value="Submit" />
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
  
<script type="text/javascript">
var data = [
    {
        id: 0,
        text: 'enhancement'
    },
    {
        id: 1,
        text: 'bug'
    },
    {
        id: 2,
        text: 'duplicate'
    },
    {
        id: 3,
        text: 'invalid'
    },
    {
        id: 4,
        text: 'wontfix'
    }
];

$(".js-example-data-array").select2({
	data: data
})
</script>