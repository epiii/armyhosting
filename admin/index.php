<?php
	session_start();

	if(!isset($_SESSION['levelp']) or empty($_SESSION['levelp']) ){ //sesi kosong
		header('location:../');
	}else{ // sesi ada
		if($_SESSION['levelp']=='anggota'){ //sesi : user
			header('location:../user');
		}else{ //sesi : bukan anggota
			include "../lib/koneksi.php";
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Kwarda Jatim</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../assets/js/jquery.js"></script>
    <link href="../lib/paging.css"rel="stylesheet">
    <link href="../assets/css/bootstrap.css"rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" >
    <link rel="apple-touch-icon-precomposed" >
    <link rel="shortcut icon">
	<style>
		#footerx{
			color:yellow;
			text-align:center;
			/*background:#000099;*/
			background:orange;
			padding: 10px 0;
			/*background: -webkit-linear-gradient(left, #ccc, #000099); /*#999*/
			/*background: -moz-linear-gradient(left, red,orange);*/
			background: -moz-linear-gradient(left, #a15142,#a15142);
			background: -ms-linear-gradient(left, #a15142,#a15142);
			background: -webkit-linear-gradient(left, #a15142,#a15142);
			background: -o-linear-gradient(left, #a15142,#a15142);
			bottom: 0;
			position: fixed;
			width: 100%;
			font-size: 18px;
	}
	#header{
		background: -moz-linear-gradient(top, #f8c310,#a15142);
		background: -ms-linear-gradient(top, #f8c310,#a15142);
		background: -webkit-linear-gradient(top, #f8c310,#a15142);
		background: -o-linear-gradient(top, #f8c310,#a15142);
	}
	#header2{
		background: -moz-linear-gradient(right, #a15142,#a15142);
		background: -ms-linear-gradient(right, #a15142,#a15142);
		background: -webkit-linear-gradient(right, #a15142,#a15142);
		background: -o-linear-gradient(right, #a15142,#a15142);
	}

    </style>
</head>

<body>
<!-- <body onload="alert('aku akan berjuang buat bang Dedy  ^_^ 9 ');"> -->

<div id="header" class="container-fluid" >
<!-- <div class="container-fluid" style="background-color:#F90"> -->
    <div class="span2" align="left" style="padding-top:5px;">
      <img src="../img/kwarda_jatim2.png" width="200" /> </div>   
      <!-- <img srcx="../img/LOOGG.png" /> </div>    -->
     <div class="span8" style="color:yellow;"> <h3 align="center" >Sistem Informasi Kwartir Daerah Jawa Timur</h3>
    </div>
    <div class="span2">.</div>
  </div>

    <div id="header2"  class="container-fluid" >
    <!-- <div class="container-fluid" style="background-color:#F90"> -->
    
    <div class="container-fluid">
	
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="?menu=vmain" style="color:#000" class="brand">
						 	<i class="icon-user"></i>
						 <?php 
						 		echo $_SESSION['emailp'].'(Admin '.$_SESSION['levelp'].')';
							// if($_SESSION['levelp']=='adminf'){
							// 	$levelx	= 'Admin Fakultas ('.$_SESSION['fak'].')';
							// }else{
							// 	$levelx	= 'Admin Universitas';
							// }
							// $_SESSION['nama_'.$res['level'].'p']
							// var_dump($_SESSION);
							// var_dump($_SESSION['nama_'.$_SESSION['levelp'].'p']);
							//echo '<i class="icon-user lg"></i> Admin '.$_SESSION['levelp'].'('.$_SESSION['nama_'.$_SESSION['levelp']].')';
						?></a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<!-- <ul class="nav pull-right"> -->
					        <ul class="nav navbar-nav pull-right">
								<!-- <li><a href="beranda" style="color:#000"><b>Beranda</b></a></li> -->
                                <li><a href="anggota" style="color:#000"><b>Anggota</b></a></li>
		                        
		                        <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Kwartir <i class="caret"></i></b></a>
									<ul class="dropdown-menu">
										<li><a href="kwarcab"><b>Kwarcab</b></a></li>
										<li><a href="kwaran"><b>Kwaran</b></a></li>
										<li><a href="gudep"><b>Gudep</b></a></li>
									</ul>
								</li>

		                        <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Setting <i class="caret"></i></b></a>
			                        <!-- level pertama -->
									<ul class="dropdown-menu">
		                            	<?php if($_SESSION['levelp']=='kwarda'){; ?>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Lokasi</b></a>
											<ul class="dropdown-menu">
												<li><a href="kota"><b>Kota</b></a></li>
												<li><a href="kecamatan"><b>Kecamatan</b></a></li>
											</ul>
										</li>
										
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Tingkatan</b></a>
											<ul class="dropdown-menu">
												<li><a href="golongan"><b>Golongan</b></a></li>
												<li><a href="sub-golongan"><b>Sub Golongan</b></a></li>
											</ul>
										</li>
										
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Kecakapan</b></a>
											<ul class="dropdown-menu">
												<li><a href="kategori-kecakapan-khusus"><b>Kategori Kec. Khusus</b></a></li>
												<li><a href="kecakapan-khusus"><b>Kec. Khusus </b></a></li>
											</ul>
										</li>
										<!-- <li><a href="profil"><b>Profil</b></a></li> -->
										<!-- <li><a href="anggota"><b>Anggota</b></a></li> -->
										<li class="divider"></li>
										<?php }?>
		                                <li>
											<a href="../logout.php"><b>Keluar</b></a>
										</li>

									</ul>
								</li>

							</ul>
							
						</div>
						
					</div>
				</div>
				
			</div>
            
		
	</div>
</div>

<!-- content -->
<div class="container">
    
        <!--<h3>HALAMAN <?php //echo $username; ?> </h3>-->
    	<?php
			if (isset($_GET['menu'])) {
				switch ($_GET['menu']){
					# UMUM -------------
						case 'anggota':
							require 'view/v_manggota.php';
						break;
						case 'profil':
							require 'view/v_mprofil.php';
						break;

					# DETAIL --------
					//kecakapan
						case 'vdkecpumum':
							require 'view/v_dkecp_umum.php';
						break;

					# MASTER ---------
					// kecakapan
						case 'vmkatkecpkhusus':
							require 'view/v_mkatkecpkhusus.php';
						break;
						case 'vmkecpkhusus':
							require 'view/v_mkecpkhusus.php';
						break;

					// tingkatan
						case 'vmgolongan':
							require 'view/v_mgolongan.php';
						break;
						case 'vmsubgolongan':
							require 'view/v_msubgolongan.php';
						break;

					//lokasi 
						case 'vmkec':
							require 'view/v_mkec.php';
						break;
						case 'vmkota':
							require 'view/v_mkota.php';
						break;
					
					// kwartir
						case 'vmkwarda':
							require 'view/v_mkwarda.php';
						break;
						case 'vmkwarcab':
							require 'view/v_mkwarcab.php';
						break;
						case 'vmkwaran':
							require 'view/v_mkwaran.php';
						break;
						case 'vmgudep':
							require 'view/v_mgudep.php';
						break;
				}
			}else{
				require 'view/v_manggota.php';
				// require 'view/v_main.php';
			}
		?>
   
</div>

<div id="footerx">copyright Kwarda Jatim @ 2014</div>


<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
    <script src="../js/plugins/bootstrap-datepicker.js"></script>
	<script src="../js/base64.js"></script>

</body>
</html>

<?php
		}
	}
?>