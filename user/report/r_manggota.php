<?php
  session_start();
  require_once '../../lib/koneksi.php';
  require_once '../../lib/tglindo.php';
  require_once '../../lib/mpdf/mpdf.php';
  // require_once '../server/f_pak.php';
  // var_dump($_SESSION);
  //sudah login ---
  if(isset($_SESSION['login'])!=0){
    //tipe file pdf ---
    if(isset($_GET['tipe']) AND $_GET['tipe']=='pdf'){
      $ruwet  = base64_encode($_SESSION['idsesip'].$_SESSION['id_mloginp'].$_SESSION['idsesip']);
      //enkripsi ruwet ---
      if(isset($_GET['ruwet']) AND $_GET['ruwet']==$ruwet){ 
          // $id=isset($_GET['iddsn'])?'d.iddsn='.$_GET['iddsn']:'d.id_mloginp='.$_SESSION['id_mloginp'];
          ob_start(); // digunakan untuk convert php ke html
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Daftar Riwayat Pendidikan Formal Anggota (Kwarda Jatim)</title>
              </head>

              <body>
                <p align="center">
                  <b>
                    Daftar Anggota (Tingkat Kwarcab)  <br>
                  </b>
                </p>';
                    $no_anggota   = trim($_GET['no_anggota'])?$_GET['no_anggota']:'';
                    $jenis_kelamin= trim($_GET['jenis_kelamin '])?$_GET['jenis_kelamin ']:'';
                    $full_anggota = trim($_GET['full_anggota'])?$_GET['full_anggota']:'';
                    $nama_pangkalan= trim($_GET['nama_pangkalan'])?$_GET['nama_pangkalan']:'';
                    $mkec         = trim($_GET['mkec'])?$_GET['mkec']:'';

                    $sql = 'SELECT 
                          concat(kd.nomer_kwarda,"-",kb.nomer_kwarcab,"-",kr.nomer_kwaran,"-",g.nomer_gudep,"-",a.id_manggota)as no_anggota,
                          concat(a.full_anggota," (",a.nick_anggota,")")as nama,
                          a.jenis_kelamin,
                          g.nama_pangkalan,
                          kc.mkec
                        from 
                          manggota a 
                          join mgudep g on g.id_mgudep = a.id_mgudep
                          join mkwaran kr on kr.id_mkwaran = g.id_mkwaran
                          join malamat al on al.id_malamat= kr.id_malamat
                          join mkec kc on kc.id_mkec= al.id_mkec
                          JOIN mkwarcab kb ON kb.id_mkwarcab= kr.id_mkwarcab
                          JOIN mkwarda kd ON kd.id_mkwarda= kb.id_mkwarda
                        WHERE 
                          kc.id_mkota= (
                            SELECT id_mkota 
                            from  
                              manggota 
                              join malamat on malamat.id_malamat= manggota.id_alamat
                              join mkec on mkec.id_mkec= malamat.id_mkec
                            where 
                              manggota.id_mlogin ='.$_SESSION['id_mloginp'].'
                          )AND(
                            a.full_anggota like "%'.$full_anggota.'%" OR 
                            a.nick_anggota like "%'.$full_anggota.'%" 
                          )and (
                            kd.nomer_kwarda LIKE "%'.$no_anggota.'%" or 
                            kb.nomer_kwarcab LIKE "%'.$no_anggota.'%" or 
                            kr.nomer_kwaran LIKE "%'.$no_anggota.'%" or 
                            g.nomer_gudep LIKE "%'.$no_anggota.'%" or 
                            a.id_manggota LIKE "%'.$no_anggota.'%"
                          ) and
                          a.jenis_kelamin like "%'.$jenis_kelamin.'%" and 
                          g.nama_pangkalan like "%'.$nama_pangkalan.'%" and 
                          kc.mkec like "%'.$mkec.'%" 
                        ORDER BY 
                          a.full_anggota ASC';

                  // print_r($sql);exit();
                  $exe = mysqli_query($con,$sql);
                  $jum = mysqli_num_rows($exe);
                $out.='<b>Total : '.$jum.' Orang</b>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>No.</td>
                      <td>No. Anggota</td>
                      <td>Nama</td>
                      <td>Jenis Kelamin</td>
                      <td>Pangkalan(Gudep)</td>
                      <td>Kwaran</td>
                    </tr>';

                  $nox = 1;
                  if($jum==0){
                    $out.='<tr>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>';
                  }else{
                    while ($res=mysqli_fetch_assoc($exe)) {
                      $jk = $res['jenis_kelamin']=='L'?'Laki-laki':'Perempuan';
                      $out.='<tr>
                              <td>'.$nox.'</td>
                              <td>'.$res['no_anggota'].'</td>
                              <td>'.$res['nama'].'</td>
                              <td>'.$jk.'</td>
                              <td>'.$res['nama_pangkalan'].'</td>
                              <td>'.$res['mkec'].'</td>
                            </tr>';
                      $nox++;
                    }
                  }
                  $out.='</table><br>';
          echo $out;
  
        #generate html -> PDF ------------
          $out2 = ob_get_contents();
          ob_end_clean(); 
          $mpdf=new mPDF('c','A4','');   
          $mpdf->SetDisplayMode('fullpage');   
          $stylesheet = file_get_contents('../../lib/mpdf/r_cetak.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();
        #end of generate html -> PDF ------------
      } //end of enkripsi ruwet -- 
      else{ // ruwet  =salah 
          echo 'kode enkripsi (url) tidak sesuai ';
      } // end of ruwet =salah     
    } //end of file pdf --
    else{ // tipe file bukan pdf ---
      echo 'bukan tipe pdf ';
    } // end of tipe file bukan pdf ---
  } // end of sudah login --
  else{ //belum login ---
    echo '<script>alert("anda belum login");window.location="../masuk";</script>';
  } //end of belum login ---
// echo $out;
