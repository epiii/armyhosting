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
                <title>Daftar Riwayat Membina (Kwarda Jatim)</title>
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
                    Riwayat Membina <br>
                  </b>
                </p>

                <legend></legend>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>No.</td>
                      <td>Keahlian</td>
                      <td>Thn Membina</td>
                      <td>Thn Selesai</td>
                      <td>No. Gudep</td>
                      <td>Keterangan</td>
                      
                    </tr>';
                    $keahlian    = trim($_GET['keahlian'])?$_GET['keahlian']:'';
                    $thn_bina    = trim($_GET['thn_bina'])?$_GET['thn_bina']:'';
                    $thn_selesai = trim($_GET['thn_selesai'])?$_GET['thn_selesai']:'';
                    $no_gudep    = trim($_GET['no_gudep'])?$_GET['no_gudep']:'';
                    $ket_bina    = trim($_GET['ket_bina'])?$_GET['ket_bina']:'';
                    

                    $sql = 'SELECT *  
                            FROM
                              dbina bn
                              left JOIN manggota a on a.id_manggota= bn.id_manggota
                              left JOIN mgudep g on g.id_mgudep= a.id_mgudep
                            WHERE 
                              bn.keahlian     like "%'.$keahlian.'%" and 
                              bn.thn_bina     like "%'.$thn_bina.'%" and 
                              bn.thn_selesai  like "%'.$thn_selesai.'%" and 
                              bn.id_mgudep    like "%'.$no_gudep.'%" and 
                              bn.ket_bina     like "%'.$ket_bina.'%"  
            
                            ORDER BY 
                              bn.thn_bina desc';
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
                    </tr>';
                  }else{
                    while ($res=mysqli_fetch_assoc($exe)) {
                      $out.='<tr>
                              <td>'.$nox.'</td>
                              <td>'.$res['keahlian'].'</td>
                              <td>'.$res['thn_bina'].'</td>
                              <td>'.$res['thn_selesai'].'</td>
                              <td>'.$res['no_gudep'].'</td>
                              <td>'.$res['ket_bina'].'</td>
                              
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
