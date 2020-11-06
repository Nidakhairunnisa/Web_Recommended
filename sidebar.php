  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="administrator/data/user/default.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['nama_lengkap'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form"> -->
        <div class="input-group">
			<form method="post" action="home.php?a=viewbuku">
			  <input id="searchbox" type="text" name="q" class="form-control searchbox" placeholder="Search...">
			  <span class="input-group-btn">
					<button type="submit" name="search" id="searchbutton" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
              </span>
			</form>  
        </div>
     <!-- </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu" data-widget="tree">
		<form method="post" action="home.php?a=viewbuku">
        <li class="header non-active" id="advancesearch">Advance Search</li>
        <li class="active treeview">
			<input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku">
			<input id="search-pengarang" type="text" name="pengarang" class="form-control" placeholder="Pengarang">
			<input id="search-penerbit" type="text" name="penerbit" class="form-control" placeholder="Penerbit">
			<input type="text" name="genre" class="form-control" placeholder="Genre">
		<!-- span class="header">Rate </span><span class="rating-value">0</span>
		<input name="rating-range" id="rating-range" type="range" min="0" max="5" value="0">
		<output class="pop-up" for="rating-range" onforminput="value = rating-range.valueAsNumber;"></output -->
			<input type="submit" name="search-advance" id="search-advance" value="search" >
		</li>
		</form>
        
	</ul>
	<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="home.php?a=viewbuku">
            <i class="fa fa-files-o"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
        <li class="">
          <a href="home.php?a=riwayatpinjam">
            <i class="fa fa-th"></i> 
			<span>Riwayat Peminjaman</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
        </li>
		</ul>
    </section>
    <!-- /.sidebar -->
  </aside>