<?php
<?php 
	if(isset($_GET['judul_buku'])){
		
	} else {
		$judul_buku = "";
	}
?>
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
			<div class="row">
				<div class="col-md-4">
				  <!-- Widget: user widget style 1 -->
				  <div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-yellow">
					  <div class="widget-user-image">
						<img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
					  </div>
					  <!-- /.widget-user-image -->
					  <h3 class="widget-user-username">\<? $judul_buku = $row[judul_buku]?></h3>
					  <h5 class="widget-user-desc">Buku Rekreasi</h5>
					</div>
					<div class="box-footer no-padding">
					  <ul class="nav nav-stacked">
						<li>rating <span class="pull-right badge bg-blue">star</span></a></li>
					  </ul>
					</div>
				  </div>
				  <!-- /.widget-user -->
				</div>
		   <!-- /.box-body -->
          </div>
		 </div>
		  
	</section>