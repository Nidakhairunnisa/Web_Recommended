 <?php
include "controller/database.php";

if(isset($_POST["nama_lengkap"])){
	$sqlupdate  = "UPDATE data_user SET nama_lengkap = '".$_POST["nama_lengkap"]."' where nim='".$_GET["nim"]."' ";
	$result = $conn->query($sqlupdate);
	
}

// if(isset($_SESSION['n'])) {
	// $nim = $_SESSION["nim"];

	$sql = "SELECT * FROM `data_user` WHERE nim = '".$_GET['nim']."' ";
	$result = $conn->query($sql);
	$nama_lengkap = "";
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$nama_lengkap 	= $row["nama_lengkap"];
				$nim 			= $row["nim"];
				
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
              <h3 class="box-title">Edit Profil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" METHOD="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" value="<?=$nama_lengkap?>">
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