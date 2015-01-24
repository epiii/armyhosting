  <?php
    require_once 'lib/koneksi.php';
    $url   = $_SERVER['QUERY_STRING'];
    $pecah = explode('=',$url);
    $id  = $pecah[2];
    // var_dump($id);exit();
    if(trim($id)!='' or !empty($id)){
      $sql = 'SELECT * from mlogin where acak = "'.$id.'"';
      // var_dump($sql);exit();
      $exe = mysql_query($sql);
      $res = mysql_fetch_assoc($exe);
      $jum = mysql_num_rows($exe);
      if($jum>0){
        $sql2 ='UPDATE mlogin set isActive="y", acak="confirmed" where id_mlogin='.$res['id_mlogin'];
        $exe2 = mysql_query($sql2);
        // $out='<p class="alert alert-success">selamat berhasil terdaftar sebagai donatur  </p> ';
        $out='Anda berhasil terdaftar sebagai anggota, silahkan login ^_^ ';
      }else{
        // $out='<p class="alert alert-warning">eror database</p> ';
        $out='eror database';
      }
    }else{
      // $out='<p class="alert alert-warning">id kosong </p> ';
      $out='id konfirmasi  kosong  ';
    }
    // var_dump($out);
    // echo $out;
    echo '<script>alert(\''.$out.'\');window.location=\'../masuk\';</script>';
    // header('Location:masuk');
  ?>
  
