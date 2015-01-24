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
          $id=isset($_GET['iddsn'])?'d.iddsn='.$_GET['iddsn']:'d.id_mloginp='.$_SESSION['id_mloginp'];
          ob_start(); // digunakan untuk convert php ke html
          $sql='SELECT *
                FROM  
                  mlogin l
                  left JOIN manggota a ON l.id_mlogin = a.id_mlogin
                  LEFT JOIN mgudep g ON g.id_mgudep= a.id_mgudep
                  JOIN(
                    SELECT ma.id_manggota,CONCAT(md.nomer_kwarda,"",mb.nomer_kwarcab,"",mw.nomer_kwaran,"",mg.nomer_gudep,"",ma.id_manggota) as no_anggota
                    from 
                      manggota ma
                      JOIN mgudep mg on  mg.id_mgudep     = ma.id_mgudep
                      JOIN mkwaran mw on  mw.id_mkwaran   = mg.id_mkwaran
                      JOIN mkwarcab mb on  mb.id_mkwarcab = mw.id_mkwarcab
                      JOIN mkwarda md on  md.id_mkwarda   = mb.id_mkwarda
                  )tbno on tbno.id_manggota = a.id_manggota
                  JOIN (
                    SELECT
                      kwr.id_mkwaran, 
                      kwr.nomer_kwaran,
                      kwr.id_mkwarcab,
                      kcm.mkec AS nm_mkwaran
                    FROM
                      mkwaran kwr
                      JOIN malamat alm ON alm.id_malamat = kwr.id_malamat
                      JOIN mkec kcm ON kcm.id_mkec = alm.id_mkec
                  ) tbkwr ON tbkwr.id_mkwaran = g.id_mkwaran
                  JOIN (
                    SELECT
                      kwb.id_mkwarda,
                      kwb.id_mkwarcab,
                      kwb.nomer_kwarcab,
                      kot.mkota AS nm_mkwarcab
                    FROM
                      mkwarcab kwb
                    JOIN malamat alm ON alm.id_malamat = kwb.id_malamat
                    JOIN mkec kcm ON kcm.id_mkec = alm.id_mkec
                    JOIN mkota kot ON kot.id_mkota = kcm.id_mkota
                  ) tbkwb ON tbkwb.id_mkwarcab = tbkwr.id_mkwarcab
                        
                  left JOIN malamat m ON m.id_malamat = a.id_malamat
                  left JOIN mkec k ON k.id_mkec = m.id_mkec
                  left JOIN mkota t ON t.id_mkota = k.id_mkota
                  left JOIN dsosmed s ON s.id_manggota = a.id_manggota
                  LEFT JOIN dpekerjaan p ON p.id_manggota = a.id_manggota
                  left JOIN dkeluarga kg  ON kg.id_manggota = a.id_manggota
                  left JOIN dasuransi i ON i.id_manggota = a.id_manggota
                WHERE
                  l.id_mlogin ='.$_SESSION['id_mloginp'];
          // print_r($sql);exit();
          $exe = mysql_query($sql);
          $res = mysql_fetch_assoc($exe);
          // echo '<pre>';
          //   print_r($res);exit();
          // echo '</pre>';
          // $sql='SELECT * from manggota where id_mlogin='.$_SESSION['id_mloginp'];

          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Portofolio Anggota Pramuka (Kwarda Jatim)</title>
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
                    <td width="30%" colspan="3">No Anggota</td>
                    <td width="60%" colspan="6">: '.$res['no_anggota'].'</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">2</td>
                    <td width="30%" colspan="3">Nama</td>
                    <td width="60%" colspan="6"><b>: '.$res['full_anggota'].'('.$res['nick_anggota'].')</b></td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Tempat / Tanggl Lahir</td>
                    <td colspan="6">: '.$res['temp_lahir'].', '.tgl_indo($res['tgl_lahir']).'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Golongan Darah</td>
                    <td colspan="6">: '.$res['gol_darah'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">Jenis Kelamin</td>
                    <td colspan="6">: '.$res['jenis_kelamin'].'</td>
                  </tr>
                  <tr>
                    <td align="center">6</td>
                    <td colspan="3">Agama</td>
                    <td colspan="6">: '.$res['agama'].'</td>
                  </tr>
                  <tr>
                    <td align="center">7</td>
                    <td colspan="3">Status Nikah</td>
                    <td colspan="6">: '.$res['status_nikah'].'</td>
                  </tr>
                  <tr>
                    <td align="center">8</td>
                    <td colspan="3">Jenis Kecacatan</td>
                    <td colspan="6">: '.$res['jenis_kecacatan'].'</td>
                  </tr>
                  <tr>
                    <td align="center">9</td>
                    <td colspan="3">Bakat</td>
                    <td colspan="6">: '.$res['bakat'].'</td>
                  </tr>
                  <tr>
                    <td align="center">10</td>
                    <td colspan="3">Hobi</td>
                    <td colspan="6">: '.$res['hobi'].'</td>
                  </tr>
                  <tr>
                    <td align="center">11</td>
                    <td colspan="3">Bahasa</td>
                    <td colspan="6">: '.$res['bahasa'].'</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Kepramukaan</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Gudep</td>
                    <td width="60%" colspan="6">: '.$res['nama_pangkalan'].'('.$res['nomer_gudep'].')</td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Kwaran</td>
                    <td colspan="6">: '.$res['nm_mkwaran'].'('.$res['nomer_kwaran'].')</td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Kwarcab</td>
                    <td colspan="6">: '.$res['nm_mkwarcab'].'('.$res['nomer_kwarcab'].')</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Kontak</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Alamat</td>
                    <td width="60%" colspan="6"><b>: '.$res['malamat'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Kecamatan</td>
                    <td colspan="6">: '.$res['mkec'].'</td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Kota</td>
                    <td colspan="6">: '.$res['mkota'].'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Kode Pos</td>
                    <td colspan="6">: '.$res['kode_pos'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">Fax</td>
                    <td colspan="6">: '.$res['fax'].'</td>
                  </tr>
                  <tr>
                    <td align="center">6</td>
                    <td colspan="3">hp</td>
                    <td colspan="6">: '.$res['hp'].'</td>
                  </tr>
                  <tr>
                    <td align="center">7</td>
                    <td colspan="3">No Telepon 1</td>
                    <td colspan="6">: '.$res['telp_1'].'</td>
                  </tr>
                  <tr>
                    <td align="center">8</td>
                    <td colspan="3">No Telepon 2</td>
                    <td colspan="6">: '.$res['telp_2'].'</td>
                  </tr>
                  <tr>
                    <td align="center">9</td>
                    <td colspan="3">No Telepon 3</td>
                    <td colspan="6">: '.$res['telp_3'].'</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Pekerjaan</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Nama Perusahaan</td>
                    <td width="60%" colspan="6"><b>: '.$res['nm_perusahaan'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Bidang Usaha</td>
                    <td colspan="6">: '.$res['bid_usaha'].'</td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Jabatan</td>
                    <td colspan="6">: '.$res['jabatan'].'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Alamat Perusahaan</td>
                    <td colspan="6">: '.$res['alamat_usaha'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">Pendapatan</td>
                    <td colspan="6">: '.$res['pendapatan'].'</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Keluarga</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Nama Ayah</td>
                    <td width="60%" colspan="6"><b>: '.$res['nm_ayah'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Pekerjan Ayah</td>
                    <td colspan="6">: '.$res['job_ayah'].'</td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Nama Ibu</td>
                    <td colspan="6">: '.$res['nm_ibu'].'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Pekerjaan Ibu</td>
                    <td colspan="6">: '.$res['job_ibu'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">Alamat Orangtua</td>
                    <td colspan="6">: '.$res['alamat_kel'].'</td>
                  </tr>
                  <tr>
                    <td align="center">6</td>
                    <td colspan="3">No Telp Orangtua</td>
                    <td colspan="6">: '.$res['telp_kel'].'</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Media Sosial</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Email</td>
                    <td width="60%" colspan="6"><b>: '.$res['email'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Web</td>
                    <td colspan="6">: '.$res['web'].'</td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Google Talk</td>
                    <td colspan="6">: '.$res['gt'].'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Yahoo Masengger</td>
                    <td colspan="6">: '.$res['ym'].'</td>
                  </tr>
                  <tr>
                    <td align="center">5</td>
                    <td colspan="3">MSN</td>
                    <td colspan="6">: '.$res['msn'].'</td>
                  </tr>
                  <tr>
                    <td align="center">6</td>
                    <td colspan="3">Skype</td>
                    <td colspan="6">: '.$res['kyipe'].'</td>
                  </tr>
                  <tr>
                    <td align="center">7</td>
                    <td colspan="3">MIRC</td>
                    <td colspan="6">: '.$res['mirc'].'</td>
                  </tr>
                  <tr>
                    <td align="center">8</td>
                    <td colspan="3">Twitter</td>
                    <td colspan="6">: '.$res['twitter'].'</td>
                  </tr>
                  <tr>
                    <td align="center">9</td>
                    <td colspan="3">Facebook</td>
                    <td colspan="6">: '.$res['fb'].'</td>
                  </tr>
                  <tr>
                    <td align="center">10</td>
                    <td colspan="3">Callsing Orari</td>
                    <td colspan="6">: '.$res['callsing_orari'].'</td>
                  </tr>
                </table><br>

                <table class="isix" width="100%" border="0">
                  <tr>
                    <td colspan="10">Data Asuransi</td>
                  </tr>
                  <tr>
                    <td width="10%" align="center">1</td>
                    <td width="30%" colspan="3">Nama Asuransi</td>
                    <td width="60%" colspan="6"><b>: '.$res['dasuransi'].'</b></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="3">Jenis Asuransi</td>
                    <td colspan="6">: '.$res['jenis_asuransi'].'</td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td colspan="3">Masa Asuransi</td>
                    <td colspan="6">: '.$res['masa_asuransi'].'</td>
                  </tr>
                  <tr>
                    <td align="center">4</td>
                    <td colspan="3">Kondisi Kesehatan</td>
                    <td colspan="6">: '.$res['kond_kesehatan'].'</td>
                  </tr>
                </table><br>

                <legend>Riwayat Pendidikan Formal</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Jenjang</td>
                    <td>Nama Sekolah</td>
                    <td>th. Masuk</td>
                    <td>th. Lulus</td>
                    <td>no. Ijazah</td>
                    <td>Fakultas</td>
                    <td>Jurusan</td>
                    <td>Kelas</td>
                    <td>no. Induk</td>
                    <td>Alamat </td>
                  </tr>';
                  $sqlpf='SELECT *
                          FROM
                            drpendf f
                            LEFT JOIN manggota a ON a.id_manggota= f.id_manggota
                            LEFT JOIN malamat al ON al.id_malamat = f.id_malamat
                            LEFT JOIN dsubpendf sf ON sf.id_dsubpendf = f.id_dsubpendf
                          WHERE
                            a.id_mlogin ='.$_SESSION['id_mloginp'].'
                          ORDER BY
                            f.thn_masuk ASC';
                  $exepf = mysql_query($sqlpf);
                  while ($respf=mysql_fetch_assoc($exepf)) {
                  // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$respf['pendidikan'].'</td>
                            <td>'.$respf['nm_instansi'].'</td>
                            <td>'.$respf['thn_masuk'].'</td>
                            <td>'.$respf['thn_lulus'].'</td>
                            <td>'.$respf['no_ijazah'].'</td>
                            <td>'.$respf['fakultas'].'</td>
                            <td>'.$respf['jurusan'].'</td>
                            <td>'.$respf['kelas'].'</td>
                            <td>'.$respf['no_induk'].'</td>
                            <td>'.$respf['malamat'].', '.$respf['mkec'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Pendidikan Informal</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Nama Kursus</td>
                    <td>No. Sertifikat</td>
                    <td>Nama Lembaga </td>
                    <td>th. Kursus</td>
                    <td>Alamat </td>
                  </tr>';
                  $sqlpi='SELECT * 
                          FROM 
                            drpendi pi 
                            LEFT JOIN manggota a ON a.id_manggota = pi.id_manggota
                          WHERE 
                            id_mlogin = '.$_SESSION['id_mloginp'].' 
                          ORDER BY 
                            pi.thn_kursus DESC';
                  $exepi = mysql_query($sqlpi);
                  while ($respi=mysql_fetch_assoc($exepi)) {
                  // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$respi['nm_kursus'].'</td>
                            <td>'.$respi['no_sertifikat'].'</td>
                            <td>'.$respi['nm_lembaga'].'</td>
                            <td>'.$respi['thn_kursus'].'</td>
                            <td>'.$respi['alamat_pendi'].'</td>

                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Kecakapan Umum</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Sub Golongan </td>
                    <td>Tgl. Pencapaian</td>
                    <td>No. Sertifikat</td>
                    <td>Keterangan </td>
                  </tr>';
                  $sqlku='SELECT *
                          FROM
                            drkecpumum dkcp
                            left JOIN manggota ma on dkcp.id_manggota= dkcp.id_manggota
                            left JOIN msubgolongan msg on msg.id_msubgolongan = dkcp.id_msubgolongan
                          WHERE id_mlogin = '.$_SESSION['id_mloginp'];
                  $exeku = mysql_query($sqlku);
                  while ($resku=mysql_fetch_assoc($exeku)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$resku['msubgolongan'].'</td>
                            <td>'.$resku['tgl_pencapaian'].'</td>
                            <td>'.$resku['no_sertifikat'].'</td>
                            <td>'.$resku['ketergn'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Kecakapan Khusus</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Kecakapan Khusus</td>
                    <td>Tanggal Pencapaian</td>
                    <td>No. Sertifikat</td>
                    <td>Level</td>
                    <td>Keterangan </td>
                  </tr>';
                    
                  $sqlkk='SELECT  *
                  FROM
                    drkecpkhusus dkcp
                    left JOIN mkecpkhusus mkcp on mkcp.id_mkecpkhusus= dkcp.id_mkecpkhusus
                    left JOIN manggota ma on ma.id_manggota = dkcp.id_manggota
                  WHERE id_mlogin = '.$_SESSION['id_mloginp'];
                  $exekk = mysql_query($sqlkk);
                  while ($reskk=mysql_fetch_assoc($exekk)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$reskk['mkecpkhusus'].'</td>
                            <td>'.$reskk['tgl'].'</td>
                            <td>'.$reskk['no_sertifikat'].'</td>
                            <td>'.$reskk['level'].'</td>
                            <td>'.$reskk['ketergn'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Prestasi</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Nama Prestasi</td>
                    <td>tingkat</td>
                    <td>Tahun Perolehan</td>
                    <td>No. Sertifikat</td>
                    <td>Keterangan</td>
                  </tr>';
                    
                  $sqlp='SELECT  *
                          FROM
                            drprestasi pr
                            JOIN manggota a on a.id_manggota= pr.id_manggota
                          WHERE 
                            id_mlogin = '.$_SESSION['id_mloginp'].'
                          ORDER BY 
                            pr.thn desc';
                  $exep = mysql_query($sqlp);
                  while ($resp=mysql_fetch_assoc($exep)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$resp['nm_prestasi'].'</td>
                            <td>'.$resp['tingkat'].'</td>
                            <td>'.$resp['thn'].'</td>
                            <td>'.$resp['no_sertifikat'].'</td>
                            <td>'.$resp['ket'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Jabatan Diluar Pramuka</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Nama Organisasi</td>
                    <td>Jabatan</td>
                    <td>Tgl. Lantik</td>
                    <td>Tgl. Purna</td>
                    <td>Keterangan</td>
                  </tr>';
                    
                  $sqljlp='SELECT  *
                          FROM
                            djabatan jb
                            left JOIN manggota a on a.id_manggota= jb.id_manggota
                          WHERE 
                            id_mlogin = '.$_SESSION['id_mloginp'].'
                          ORDER BY 
                            jb.tgl_lantik desc';
                  $exejlp = mysql_query($sqljlp);
                  while ($resjlp=mysql_fetch_assoc($exejlp)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$resjlp['nm_org'].'</td>
                            <td>'.$resjlp['nm_jab'].'</td>
                            <td>'.$resjlp['tgl_lantik'].'</td>
                            <td>'.$resjlp['tgl_purna'].'</td>
                            <td>'.$resjlp['ket_jab'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Membina</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                    <td>Keahlian</td>
                    <td>Tahun Membina</td>
                    <td>Tahun Selesai</td>
                    <td>Nomer Gudep</td>
                    <td>Keterangan</td>
                  </tr>';
                    
                  $sqlb='SELECT  *
                          FROM
                            dbina bn
                            JOIN manggota a on a.id_manggota= bn.id_manggota
                            JOIN mgudep g on g.id_mgudep= a.id_mgudep
                          WHERE
                             a.id_mlogin = '.$_SESSION['id_mloginp'].'
                          ORDER BY 
                            bn.thn_bina desc';
                          // print_r($sqlb);exit();
                  $exeb = mysql_query($sqlb);
                  while ($resb=mysql_fetch_assoc($exeb)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$resb['keahlian'].'</td>
                            <td>'.$resb['thn_bina'].'</td>
                            <td>'.$resb['thn_selesai'].'</td>
                            <td>'.$resb['nomer_gudep'].'</td>
                            <td>'.$resb['ket_bina'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Kegiatan Kepramukaan</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>Detail Kegiatan</td>
                      <td>Tanggal Kegiatan</td>
                      <td>Lokasi</td>
                      <td>Tingkat</td>
                      <td>Golongan</td>
                      <td>Kategori</td>
                      <td>Status</td>
                      <td>Keterangan</td>
                  </tr>';
                  $sqlkp = 'SELECT * 
                          FROM
                            drkegpram dr
                            LEFT JOIN manggota ma on ma.id_manggota= dr.id_manggota
                            LEFT JOIN mgolongan mg on mg.id_mgolongan= dr.id_mgolongan
                          WHERE 
                            ma.id_mlogin  = '.$_SESSION['id_mloginp'].'
                          ORDER BY 
                            dr.tgl desc';

                  $exekp = mysql_query($sqlkp);
                  while ($reskp=mysql_fetch_assoc($exekp)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$reskp['drkegpram'].'</td>
                            <td>'.tgl_indo($reskp['tgl']).'</td>
                            <td>'.$reskp['lokasi'].'</td>
                            <td>'.$reskp['tingkat'].'</td>
                            <td>'.$reskp['mgolongan'].'</td>
                            <td>'.$reskp['kategori'].'</td>
                            <td>'.$reskp['status'].'</td>
                            <td>'.$reskp['ket'].'</td>
                          </tr>';
                        }
                $out.='</table><br>';

                $out.='
                <legend>Riwayat Kegiatan Nonkepramukaan</legend>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td>Nama Kegiatan</td>
                      <td>Tanggal</td>
                      <td>Lokasi</td>
                      <td>Tingkat</td>
                      <td>Status</td>
                      <td>Penyelenggara</td>
                      <td>Keterangan</td>
                  </tr>';
                    
                  $sqlnp='SELECT * 
                            FROM
                              drkegnonpram kg
                              left JOIN manggota a on a.id_manggota= kg.id_manggota
                            WHERE
                             a.id_mlogin = '.$_SESSION['id_mloginp'].'
                          ORDER BY 
                            kg.tgl desc';
                  // print_r($sqlnp);exit();
                  $exenp = mysql_query($sqlnp);
                  while ($resnp=mysql_fetch_assoc($exenp)) {
                // print_r($respf);exit();
                        $out.='<tr>
                            <td>'.$resnp['drkegnonpram'].'</td>
                            <td>'.tgl_indo($resnp['tgl']).'</td>
                            <td>'.$resnp['lokasi'].'</td>
                            <td>'.$resnp['tingkat'].'</td>
                            <td>'.$resnp['stus'].'</td>
                            <td>'.$resnp['plenggara'].'</td>
                            <td>'.$resnp['ket'].'</td>
                          </tr>';
                            
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
    echo '<script>alert("anda belum login");window.location="../";</script>';
  } //end of belum login ---
// echo $out;
