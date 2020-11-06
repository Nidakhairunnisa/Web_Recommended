 <?php
 include "controller/database.php";
 $nimDicari = $_SESSION['nim'];
 
 // yg belum terbaca saja yaitu terbaca=0
 $sqlNotif= "SELECT * FROM data_notif WHERE nim=$nimDicari AND terbaca=0";
 $result = $conn->query($sqlNotif);
 
 $jumlah_data_baru = 0;
 
 $judulBuku=array();
 $statusBuku=array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$jumlah_data_baru++;
		$judulBuku[]=$row['judul_buku'];
		$statusBuku[]=$row['status'];
		
	}
	
}
 ?> 
  <header class="main-header">
    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Open</b>Library</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
   
        
          <!-- Tasks: style can be found in dropdown.less -->
		<!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" id="update-notif" nim="<?= $nimDicari ?>"class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
			  <?php
				if($jumlah_data_baru > 0){
					$spanMasuk = '<span class="label label-warning">' . $jumlah_data_baru . '</span>';
				} else {
					$spanMasuk = '';
				}
			  ?>
              <?= $spanMasuk ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?= $jumlah_data_baru ?> notifications</li>
			  <?php
			  $pesanBaik = "harap berikan rating";
			  $pesanBuruk = "harap segera kembalikan! ";
			  $pesan;
			  $href = "home.php?a=riwayatpinjam";
			  
			  for ($a = 0; $a < sizeof($judulBuku); $a++){
				  
				 if($statusBuku[$a]=='dikembalikan'){
					 $pesan  = $pesanBaik;
					echo '<li class="header">Buku "' . $judulBuku[$a] . '" telah ' . $statusBuku[$a] . ' ' . $pesan .'</li>';
				 } else {
					$pesan = $pesanBuruk;
					echo '<li class="header"> Buku "' . $judulBuku[$a] . '" telah ' . $statusBuku[$a] . ' ' . $pesan .' </li>';
				 }
				
			  }
			  ?>
			  
           </li>
		   </ul>
          <!-- User Account: style can be found in dropdown.less -->
          <li id="user-toggle" class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="administrator/data/user/default.jpg" class="user-image" alt="User Image">
              <span><?= $_SESSION['nama_lengkap'] ?></span>
            </a>
            <ul class="dropdown-menu">
			
              <!-- User image -->
              <li class="user-header">
                <img src="administrator/data/user/default.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $_SESSION['nama_lengkap'] ?>
                  <small>Mahasiswa</small>
                </p>
              </li>
              <!-- Menu Body -->
                <!-- /.row -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="home.php?a=profil" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="controller/logout.php" id="logout" onclick="dialog-confirm();" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          
		  
		  </li>
		     
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>