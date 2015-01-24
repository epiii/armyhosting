  <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="assets/css/signin.css" rel="stylesheet">
  <?php
    require_once 'lib/koneksi.php';
    $reg    ='';
    $email  ='';
    $action ='daftar';
    $btn    ='<button class="btn btn-lg btn-warning btn-primary btn-block" type="submit">ok</button>';
    $info   ='';

    // var_dump($_SESSION);exit();
    if (isset($_SESSION['emailp'])) {
      header('Location:masuk');
    }else{
      if(isset($_POST['emailTB'])){
        $sql = 'SELECT * FROM mlogin WHERE email="'.$_POST['emailTB'].'"';
        $exe = mysql_query($sql);
        $res = mysql_fetch_assoc($exe);
        $jum = mysql_num_rows($exe);

        if($res['isActive']=='n'){
          $info.='<p class="alert alert-warning">silahkan cek email untuk konfirmasi pendaftaran <a target="_blank" href="http://'.$_POST['emailTB'].'">'.$_POST['emailTB'].'</a></p>';
        }else{  
          if($jum>0){ // telah terdaftar
            session_start();
            $_SESSION['emaily']=$_POST['emailTB'];
            header('Location:masuk');
          }else{  //belum terdaftar
              $reg='<p class="alert alert-warning">
                      <i class="glyphicon glyphicon-warning-sign"></i> 
                      maaf email belum terdaftar,
                    </p>'; 
              // <a href="daftar">daftar</a>
              $email=$_POST['emailTB'];
              $action='p_mail.php';
              $btn='<button class="btn btn-lg btn-warning btn-primary btn-block" type="submit">daftarkan</button>';
          }
        }
      }
    }
  ?>
  
  <form class="form-signin" role="form" action="<?php echo $action;?>" method="post">
    <h2 class="form-signin-heading"> Masukkan email : </h2>
    <input type="email" value="<?php echo $email;?>" class="form-control" placeholder="email" id="emailTB" name="emailTB" required autofocus>
    <?php  echo $reg.$info.$btn;  ?>
  </form>