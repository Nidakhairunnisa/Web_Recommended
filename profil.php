<?php
if(isset($_SESSION['nim'])) {
	$nim = $_SESSION["nim"];
	
	include 'controller/edit_user.php';
	
} else {
		$nim = "";
		$nama_lengkap = "";
		$password = "";
		$file_user = "";
		$namaFile = "";
}
?>
<!-- Main content -->
    <section class="content">	
		<!-- div class="col-md-7" -->

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
				<img class="profile-user-img img-responsive " src="administrator/data/user/<?=$file_user?>" alt="User profile picture">

				<h3 class="profile-username text-center"><?=$nama_lengkap?></h3>
				<br/><br/>
				<p class="text-muted"><b>Nama lengkap</b> <a class="pull-right"><?=$nama_lengkap?></a></p>
				<hr>
				<p class="text-muted"><b>Password</b> <a class="pull-right"><?=$password?></a></p>
				<hr>
				<tr>
				<a href="home.php?a=editprofil">
                    <button type="button" class="btn btn-block btn-danger">Edit</button>
                </a>
				</tr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		<!-- /div -->

	</section>