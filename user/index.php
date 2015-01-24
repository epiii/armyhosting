<?php 
	session_start();
  if(!isset($_SESSION['levelp']) or empty($_SESSION['levelp']) ){ //sesi kosong
    header('location:../');
  }else{ // sesi ada
    if($_SESSION['levelp']!='anggota'){ //sesi : user
      header('location:../admin');
    }else{ //sesi : bukan anggota
      require_once '../lib/koneksi.php';
  		require_once '../lib/koneksi.php';
      require_once '../lib/tglindo.php';
      require_once '../lib/filter.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Kwarda Jawa Timur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../lib/paging.css"rel="stylesheet">
    <link href="../assets/css/bootstrap.css"rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet" media="screen">

	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/bootstrap-tooltip.js"></script>
	<script src="../js/base64.js"></script>
		    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" >
    <link rel="apple-touch-icon-precomposed" >
    <link rel="shortcut icon">
	<style>
		#footerx{
			color:black;
			text-align:center;
			background:#f8c310;
			padding: 10px 0;
/*			background: -moz-linear-gradient(bottom, brown,yellow);
			background: -webkit-linear-gradient(bottom, brown,yellow);
			background: -o-linear-gradient(bottom, brown,yellow);
			background: -ms-linear-gradient(bottom, brown,yellow);
			background: -moz-linear-gradient(bottom, brown,yellow);
*/			bottom: 0;
			position: fixed;
			width: 100%;
			font-size: 18px;
	}.blinker{
		text-decoration:blink;
	}
  #header{
    background: -moz-linear-gradient(bottom, #f8c310,#f8c310);
    background: -ms-linear-gradient(bottom, #f8c310,#f8c310);
    background: -webkit-linear-gradient(bottom, #f8c310,#f8c310);
    background: -o-linear-gradient(bottom, #f8c310,#f8c310);
  }
  #header2{
    background: -moz-linear-gradient(bottom, #f8c310,#f8c310);
    background: -ms-linear-gradient(right, #f8c310,#f8c310);
    background: -webkit-linear-gradient(right, #f8c310,#f8c310);
    background: -o-linear-gradient(right, #f8c310,#f8c310);
  }
    </style>
</head>

<!-- <body onload="alert('melek sek gan ^_^ V');"> -->
<body>
  <div id="header" class="container-fluid info">
    <div class="span2" align="left" style="padding-top:5px;">
      <img src="../img/logo_pramuka.png"  width="50" />   </div>   
     <div class="span8"> <h3 align="center" style="color:black">Sistem Informasi Kwartir Daerah Jawa Timur</h3>
    </div>
    <div class="span2">.</div>
  </div>
  
  <div class="container-fluid" id="header2">
      <div class="container-fluid" >
         
        
              <div class="navbar">
                  <div class="navbar-inner">
                      <div class="container-fluid">
                           <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                          </a> 
                          <a href="./" style="color:#000" class="brand">
                              <?php 
                                  // echo '<pre>';
                                  //     print_r($_SESSION);
                                  // echo'</pre>';
                                  // echo '<i class="icon-user lg"></i> '.$_SESSION['namad'];
                                  echo '<i class="icon-user lg"></i>'.$_SESSION['namalengkap'].' ('.$_SESSION['levelp'].')';
                              ?>
                          </a>
                          <div class="nav-collapse collapse navbar-responsive-collapse">
                              <ul class="nav pull-right">
                                  <li>
                                      <a href="profil" style="color:#000"><b>Profil</b></a>
                                  </li>
                                  <?php
                                    $scek  = 'SELECT * from manggota where id_mlogin ='.$_SESSION['id_mloginp'];
                                    $excek = mysql_query($scek);
                                    $jumcek= mysql_num_rows($excek);
                                    if ($jumcek>0) {
                                  ?>
                                  <li>
                                      <a href="anggota" style="color:#000"><b>Anggota</b></a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Data Riwayat <i class="caret"></i></b></a>
                                    <ul class="dropdown-menu">

                                      <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Pendidikan</b></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="pendidikan-formal"><b>Pend. Formal</b></a></li>
                                          <li><a href="pendidikan-informal"><b>Pend. Informal</b></a></li>
                                        </ul>
                                      </li>

                                      <li class="dropdown-submenu">
                                        <a href="kenaikkan-tingkat"><b>Kegiatan</b></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="kepramukaan"><b>Kepramukaan</b></a></li>
                                          <li><a href="non-pramuka"><b>Non Pramuka</b></a></li>
                                        </ul>
                                      </li>

                                      <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Kecakapan</b></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="kecakapan-umum"><b>Keck. Umum</b></a></li>
                                          <li><a href="kecakapan-khusus"><b>Keck. Khusus</b></a></li>
                                        </ul>
                                      </li>

                                      <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><b>Prestasi</b></a>
                                        <ul class="dropdown-menu">
                                          <li><a href="prestasi-diperoleh"><b>Prestasi Diperoleh</b></a></li>
                                          <li><a href="jabatan-expramuka"><b>Jabatan Diluar Pramuka</b></a></li>
                                          <li><a href="membina"><b>Membina</b></a></li>
                                        </ul>
                                      </li>
                                    </ul>
                                    <?php
                                    }else{ ?>
                                    <li>
                                      <a  href="#" onclick="alert('silahkan lengkapi biodata profil anda dahulu');" style="color:#000"><b>Anggota</b></a>
                                    </li>
                                    <li>
                                      <a href="#" onclick="alert('silahkan lengkapi biodata profil anda dahulu');" style="color:#000"><b>Riwayat</b></a>
                                    </li>
                                    <?php }?>

                                  </li>
                                  <li>
                                      <a href="../logout.php"style="color:#000"><b>Keluar</b></a>
                                  </li>
                              </ul>
                              
                          </div>
                          
                      </div>
                  </div>
                  
              </div>
          
      </div>
  </div>
  <!-- content -->
  <div align="center" class="container">
     
          <!--<h3>HALAMAN <?php //echo $username; ?> </h3>-->
          <?php
              if (isset($_GET['menu'])) {
                switch ($_GET['menu']){
                    #common -
                    // case 'vmain':
                    //     require 'view/v_main.php';
                    // break;
                    case 'vprof':
                        require 'view/v_profil.php';
                    break;
                    case 'vmanggota':
                        require 'view/v_manggota.php';
                    break;
                    #riwayat --
                      case 'vdrpendf':
                          require 'view/v_drpendf.php';
                      break;
                      case 'vdrpendi':
                          require 'view/v_drpendi.php';
                      break;
                      
                      case 'vdgiat':
                          require 'view/v_dgiat.php';
                      break;
                      case 'vdrkegnonpram':
                          require 'view/v_drkegnonpram.php';
                      break;
                      case 'vdkecpumum':
                          require 'view/v_dkecpumum.php';
                      break;

                      case 'vdkecpkhusus':
                          require 'view/v_dkecpkhusus.php';
                      break;
                     
                      case 'vdrprestasi':
                          require 'view/v_drprestasi.php';
                      break;
                      case 'vdjabatan':
                          require 'view/v_djabatan.php';
                      break;
                      case 'vdbina':
                          require 'view/v_dbina.php';
                      break;
                }
              }else{
                // require 'view/v_main.php';
                require 'view/v_profil.php';
              }
          ?>
          
          <!--<divx class="span2"></div>-->
      </div>
  <div id="footerx">copyright Kwarda Jawa Timur @ 2014</div>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
    <script src="../js/plugins/bootstrap-datepicker.js"></script>
</body>
</html>
<?php 
    }
	}
?>