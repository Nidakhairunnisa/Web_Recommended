<?php
include "controller/database.php";
//dicheck nyari by nim
	if(isset($_GET['judul_buku'])){
		$bukuDicari = $_GET['judul_buku'];
		
		$kondisi = "WHERE judul_buku LIKE '%$bukuDicari%'";
	} else {
		$kondisi = "";
	}
	
	$sql = "SELECT * FROM `data_buku` $kondisi";
	//echo $sql;
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
			}
		} else {
			echo "0 results";
		}
		   
		// $conn->close();	
	
?>



<!-- Main content -->
    <section class="content">
	
	 <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">List Buku</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <!--table class="table no-margin" -->
				<table id="example2" class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>id buku</th>
						<th>Judul buku</th>
						<th>Pengarang</th>
						<th>Penerbit</th>
						<th>Jumlah buku</th>
						<th>Jumlah buku</th>
					</tr>
					</thead>
					<tbody>
				  <?php
					$sqlAll = "SELECT * FROM `data_buku` " . $kondisi;

$result = $conn->query($sqlAll);
$banyakData = $result->num_rows;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		?>
		<tr>
                    <td><a href="#"><?php echo $row["id_buku"];?></a></td>
                    <td><?= $row["judul_buku"]?></td>
					<td><?= $row["pengarang_buku"]?></td>
					<td><?= $row["penerbit"]?></td>
					<td><?= $row["jumlah_buku"]?></td>
					<td>
						<a href="home.php?a=editbuku&id_buku=<?php echo $row["id_buku"];?>">
						<i class="fa fa-edit" ></i>  |
						</a>						
						<a href="home.php?a=deleteuser">
						<i class="fa fa-times-circle" ></i> 
						</a>
					</td>
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

			</div>  
        </div>
      </div>
      <!-- /.box -->

	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- DataTables -->
<link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!--Import jQuery before export.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
	$.noConflict();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>  