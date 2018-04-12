<?php
  session_start();
  require_once '../../lib/koneksi.php';
  require_once '../../lib/tglindo.php';
  require_once '../../lib/mpdf/mpdf.php';
  // require_once '../server/f_pak.php';
  
  //sudah login ---
  if(isset($_SESSION['login'])!=0){
    //tipe file pdf ---
    if(isset($_GET['tipe']) AND $_GET['tipe']=='pdf'){
      $ruwet  = base64_encode($_SESSION['idsesip'].$_SESSION['id_mloginp'].$_SESSION['idsesip']);
      //enkripsi ruwet ---
      if(isset($_GET['ruwet']) AND $_GET['ruwet']==$ruwet){ 
          // $id=isset($_GET['iddsn'])?'d.iddsn='.$_GET['iddsn']:'d.id_mloginp='.$_SESSION['id_mloginp'];
          ob_start(); // digunakan untuk convert php ke html
          $sql='SELECT *
                FROM  
                  mlogin l
                  left JOIN manggota a ON l.id_mlogin = a.id_mlogin
                  left JOIN malamat m ON m.id_malamat = a.id_malamat
                  left JOIN mkec k ON k.id_mkec = m.id_mkec
                  left JOIN mkota t ON t.id_mkota = k.id_mkota
                  left JOIN dsosmed s ON s.id_manggota = a.id_manggota
                  LEFT JOIN dpekerjaan p ON p.id_manggota = a.id_manggota
                  left JOIN dkeluarga g ON g.id_manggota = a.id_manggota
                  left JOIN dasuransi i ON i.id_manggota = a.id_manggota
                WHERE
                  l.id_mlogin ='.$_SESSION['id_mloginp'];
          $exe = mysqli_query($con,$sql);
          $res = mysqli_fetch_assoc($exe);
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Daftar Riwayat Kecakapan Umum Anggota (Kwarda Jatim)</title>
              </head>

              <body>
              <p align="center">
                  <b>
                    PORTOFOLIO ANGGOTA PRAMUKA <br>
                    Kwartir Daerah Jawa Timur <br> 
                  </b>
                </p>
              <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Umum</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Nama</td>
                    <td width="60%" colspan="6"><b>: '.$res['full_anggota'].'('.$res['nick_anggota'].')</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Tempat / Tanggl Lahir</td>
                    <td colspan="6">: '.$res['temp_lahir'].', '.tgl_indo($res['tgl_lahir']).'</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">3</td>
                    <td width="30%" colspan="3">Alamat</td>
                    <td width="60%" colspan="6"><b>: '.$res['malamat'].', '.$res['mkec'].', '.$res['mkota'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Jenis Kelamin</td>
                    <td colspan="6">: '.$res['jenis_kelamin'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">Kode Pos</td>
                    <td colspan="6">: '.$res['kode_pos'].'</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">6</td>
                    <td width="30%" colspan="3">Email</td>
                    <td width="60%" colspan="6"><b>: '.$res['email'].'</b></td>
                  </tr>
                  
                </table><br>
                <p align="center">
                  <b>
                    Riwayat Kecakapan Umum<br>
                  </b>
                </p>

                <legend></legend>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>No.</td>
                      <td>Sub Golongan</td>
                      <td>Tanggal Pencapaian</td>
                      <td>No Sertifikat</td>
                      <td>Keterangan</td>
                    </tr>';
                  $msubgolongan  = trim($_GET['msubgolongan'])?$_GET['msubgolongan']:'';
                  $no_sertifikat = trim($_GET['no_sertifikat'])?$_GET['no_sertifikat']:'';
                  $ketergn       = trim($_GET['ketergn'])?$_GET['ketergn']:'';
                  
                  $sql = 'SELECT *
                      FROM
                        drkecpumum ku
                        JOIN manggota a ON ku.id_manggota = ku.id_manggota
                        LEFT JOIN msubgolongan msg ON msg.id_msubgolongan = ku.id_msubgolongan
                      WHERE
                        a.id_mlogin = '.$_SESSION['id_mloginp'].' and
                        msg.msubgolongan like "%'.$msubgolongan.'%" and 
                        ku.no_sertifikat like "%'.$no_sertifikat.'%" and 
                        ku.ketergn like "%'.$ketergn.'%"';
                  // print_r($sql);exit();
                  $exe = mysqli_query($con,$sql);
                  $jum = mysqli_num_rows($exe);

                  $nox = 1;
                  if($jum==0){
                    $out.='<tr>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                    </tr>';
                  }else{
                    while ($res=mysqli_fetch_assoc($exe)) {
                      $out.='<tr>
                            <td>'.$nox.'</td>
                            <td>'.$res['msubgolongan'].'</td>
                            <td>'.tgl_indo($res['tgl_pencapaian']).'</td>
                            <td>'.$res['no_sertifikat'].'</td>
                            <td>'.$res['ketergn'].'</td>
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
