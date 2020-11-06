  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="data/user/default.jpg" class="user-image" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['nama_admin'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form"> -->
        <div class="input-group">
          <input id="searchbox" type="text" name="q" class="form-control searchbox" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="searchbutton" class="btn btn-flat"><i class="fa fa-search"></i>                </button>
              </span>
        </div>
     <!-- </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="home.php?a=addpinjam">
		  <i class="fa fa-dashboard"></i> 
		  <span>Dashboard</span> </a>
            <span class="pull-right-container">
              <i class="label label-primary pull-right"></i>
            </span>
         
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Bibliografi</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="home.php?a=addbuku"><i class="fa fa-circle-o"></i> Add Buku</a></li>
			<li><a href="home.php?a=listbuku"><i class="fa fa-circle-o"></i> List Buku</a></li>
			
          </ul>
        </li>
		  </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Keanggotaan</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="home.php?a=adduser"><i class="fa fa-circle-o"></i> Add User</a></li>
			<li><a href="home.php?a=listuser"><i class="fa fa-circle-o"></i> List User</a></li>
			
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> 
			<span>Peminjaman</span>
            <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
          </a>
		  <ul class="treeview-menu">
			<li><a href="home.php?a=addpeminjaman"><i class="fa fa-circle-o"></i> Add Peminjaman</a></li>
			<li><a href="home.php?a=addpinjam"><i class="fa fa-circle-o"></i> Peminjaman Buku</a></li>
          </ul>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>