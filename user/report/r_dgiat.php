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
          $exe = mysql_query($sql);
          $res = mysql_fetch_assoc($exe);
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Daftar Riwayat Kegiatan Kepramukaan Anggota (Kwarda Jatim)</title>
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
                    Riwayat Kegiatan Kepramukaan <br>
                  </b>
                </p>

                <legend></legend>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>No.</td>
                      <td>Detail Kegiatan</td>
                      <td>Tanggal Kegiatan</td>
                      <td>Lokasi</td>
                      <td>Tingkat</td>
                      <td>Golongan</td>
                      <td>Kategori</td>
                      <td>Status</td>
                      <td>Keterangan</td>
                    </tr>';
                    // $tgl       = trim($_GET['tgl'])?$_GET['tgl']:'';
                    // $manggota  = trim($_GET['manggota'])?$_GET['manggota']:'';
                    $mgolongan = trim($_GET['mgolongan'])?$_GET['mgolongan']:'';
                    $drkegpram = trim($_GET['drkegpram'])?$_GET['drkegpram']:'';
                    $lokasi    = trim($_GET['lokasi'])?$_GET['lokasi']:'';
                    $tingkat   = trim($_GET['tingkat'])?$_GET['tingkat']:'';
                    $kategori  = trim($_GET['kategori'])?$_GET['kategori']:'';
                    $status    = trim($_GET['status'])?$_GET['status']:'';
                    $ket       = trim($_GET['ket'])?$_GET['ket']:'';

                    $sql = 'SELECT * 
                            FROM
                              drkegpram dr
                              LEFT JOIN manggota ma on ma.id_manggota= dr.id_manggota
                              LEFT JOIN mgolongan mg on mg.id_mgolongan= dr.id_mgolongan
                            WHERE 
                              ma.id_mlogin  = '.$_SESSION['id_mloginp'].' and
                              mg.mgolongan  like "%'.$mgolongan.'%" and
                              dr.drkegpram  like "%'.$drkegpram.'%" and
                              dr.lokasi     like "%'.$lokasi.'%" and 
                              dr.tingkat    like "%'.$tingkat.'%" and  
                              dr.kategori   like "%'.$kategori.'%"and  
                              dr.status     like "%'.$status.'%"  and
                              dr.ket        like "%'.$ket.'%"  
                            ORDER BY 
                              dr.tgl desc';
                  // print_r($sql);exit();
                  $exe = mysql_query($sql);
                  $jum = mysql_num_rows($exe);

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
                      <td>-</td>
                    </tr>';
                  }else{
                    while ($res=mysql_fetch_assoc($exe)) {
                      $out.='<tr>
                            <td>'.$nox.'</td>
                            <td>'.$res['drkegpram'].'</td>
                            <td>'.$res['tgl'].'</td>
                            <td>'.$res['lokasi'].'</td>
                            <td>'.$res['tingkat'].'</td>
                            <td>'.$res['mgolongan'].'</td>
                            <td>'.$res['kategori'].'</td>
                            <td>'.$res['status'].'</td>
                            <td>'.$res['ket'].'</td>
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
