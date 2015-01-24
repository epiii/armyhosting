<?php
  session_start();
  if(!isset($_SESSION['levelp']) or empty($_SESSION['levelp']) ){ //sesi kosong
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Kwarda Jatim</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="assets/css/carousel.css" rel="stylesheet">
    <style>
    #footerx{
          color:#FFFFFF;
          text-align:center;
          padding: 10px 0;
          background-color:rgba(240, 183, 84, 1);

/*          background: -moz-linear-gradient(left, black,#000055);
          background: -ms-linear-gradient(left, black,#000055);
          background: -o-linear-gradient(left, black,#000055);
          background: -webkit-linear-gradient(left, black,#000055);
          background: -linear-gradient(left, black,#000055);
*/          bottom: 0;
          position: fixed;
          width: 100%;
          font-size: 18px;
      }
      #footerx a{
        text-decoration: none;
        font-weight: bold;
        color: #000;
      }
    </style>
  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" style="background-color:rgba(240, 183, 84, 1);" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="img/kwarda_jatim2.png" alt="" width="120"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="beranda">Beranda</a></li>
            <li><a href="tentang">Tentang</a></li>
            <li><a href="kontak">Kontak</a></li>
            
            <!-- <li><a href="galeri">Galeri</a></li>
            <li><a href="kegiatan">Kegiatan</a></li> -->
<!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Donasi <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="cara-donasi">Cara Berdonasi</a></li>
                <li><a href="donasi">Donasi</a></li>
              </ul>
            </li>
 -->          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- <li class="dropdown"> -->
              <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Donatur <b class="caret"></b></a> -->
              <!-- <ul class="dropdown-menu"> -->
                <!-- <li><a href="masuk">Masuk</a></li> -->
                <!-- <li><a href="daftar">Daftar</a></li> -->
                <!-- <li class="divider"></li> -->
                <!-- <li class="dropdown-header">Nav header</li> -->
                <!-- <li><a href="#">Separated link</a></li> -->
                <!-- <li><a href="#">One more separated link</a></li> -->
              <!-- </ul> -->
            <!-- </li> -->
            <li><a href="masuk">Login</a></li>
            <!-- <li><a href="../navbar-static-top/">Static top</a></li> -->
            <!-- <li class="active"><a href="./">Fixed top</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <?php
        if (isset($_GET['menu'])) {
          switch ($_GET['menu']){
            #common --
              case 'vberanda':
                require 'vberanda.php';
              break;
              case 'vtentang':
                require 'vtentang.php';
              break;
              case 'vkontak':
                require 'vkontak.php';
              break;
              case 'vdaftar':
                require 'vdaftar.php';
              break;
              case 'vkonfirmasi':
                require 'vkonfirmasi.php';
              break;
              /*case 'vgaleri':
                require 'vgaleri.php';
              break;
              case 'vcdonasi':
                require 'vcdonasi.php';
              break;
              case 'vdonasi':
                require 'vdonasi.php';*/
              break;
              case 'vlogout':
                require 'logout.php';
              break;
              case 'vmasuk':
                require 'vmasuk.php';
              break;
          }
        }else{
          require 'vberanda.php';
        }
    ?>
    
    </div> 
    <div id="footerx">copyright Kwartir Daerah Jawa Timur@ 2014</div>

    <!-- /container -->
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
  }else{ // sesi ada
    if($_SESSION['levelp']=='anggota'){ //sesi : user
      header('location:user');
    }else{ //sesi : bukan anggota
      // include "../lib/koneksi.php";
      header('location:admin');
    }
  }
?>