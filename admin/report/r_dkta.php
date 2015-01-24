<?php
  session_start();
  require_once '../../lib/koneksi.php';
  require_once '../../lib/tglindo.php';
  require_once '../../lib/mpdf/mpdf.php';
  
  //sudah login ---
  if(isset($_SESSION['login'])==0){
    echo '<script>alert(\'silahkan login \');window.location=\'masuk\';</script>'; 
  }else{
    //tipe file pdf ---
    if(!isset($_GET['tipe']) or $_GET['tipe']!='pdf'){
      echo 'bukan tipe pdf';
    }else{
      $ruwet  = base64_encode($_SESSION['idsesip'].$_SESSION['id_mloginp'].$_SESSION['idsesip']);
      //enkripsi ruwet ---
      if(!isset($_GET['ruwet']) or $_GET['ruwet']!=$ruwet){
        echo 'kode enkripsi tidak sama (dilarang merubah URL)';
      }else{
          // $id=isset($_GET['iddsn'])?'d.iddsn='.$_GET['iddsn']:'d.id_mloginp='.$_SESSION['id_mloginp'];
          ob_start(); // digunakan untuk convert php ke html
          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                  <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                          <title>Untitled Document</title>
                      </head>

                      <body>
                        <table width="100%">';
                        
                        //cetak berdasarkan pencarian 
                        $no_anggota    = trim($_GET['no_anggota'])?$_GET['no_anggota']:'';
                        $full_anggota  = trim($_GET['full_anggota'])?$_GET['full_anggota']:'';
                        $jenis_kelamin = trim($_GET['jenis_kelamin'])?$_GET['jenis_kelamin']:'';
                        $malamat       = trim($_GET['malamat'])?$_GET['malamat']:'';
                        $mgudep        = trim($_GET['mgudep'])?$_GET['mgudep']:'';
                        $mkwaran       = trim($_GET['mkwaran'])?$_GET['mkwaran']:'';
                        $mkwarcab      = trim($_GET['mkwarcab'])?$_GET['mkwarcab']:'';
                        $usia          = trim($_GET['usia'])?$_GET['usia']:'';
                        $mkec          = trim($_GET['mkec'])?$_GET['mkec']:'';
                        $mkota         = trim($_GET['mkota'])?$_GET['mkota']:'';
                        $kode_pos      = trim($_GET['kode_pos'])?$_GET['kode_pos']:'';
                        $email         = trim($_GET['email'])?$_GET['email']:'';
                        $isActive      = $_GET['isActive']?$_GET['isActive']:'';
                        
                        //cetak per anggota 
                        $id_manggota   = trim($_GET['id_manggota'])!=''?' and a.id_manggota='.$_GET['id_manggota']:'';
                        // var_dump($id_manggota);exit();
                        $sql = 'SELECT
                              a.id_manggota,
                              a.agama,
                              a.tgl_lahir,
                              a.gol_darah,
                              a.foto,
                              tbno.no_anggota,
                              concat(a.full_anggota," (",a.nick_anggota,")") AS nama,
                              a.jenis_kelamin,
                              a.temp_lahir,
                              tbkwb.ketua_cab,
                              tbkwb.nm_mkwarcab,
                              concat(g.nama_pangkalan," (",g.nomer_gudep,")") as gudep,
                              concat(tbkwr.nm_mkwaran," (",tbkwr.nomer_kwaran,")") as kwaran,
                              concat(tbkwb.nm_mkwarcab," (",tbkwb.nomer_kwarcab,")") as kwarcab,
                              al.malamat,
                              al.kode_pos,
                              al.hp,
                              kc.mkec,
                              ko.mkota,
                              l.isActive
                            FROM
                              mlogin l
                            JOIN manggota a ON a.id_mlogin = l.id_mlogin
                            JOIN(
                              SELECT ma.id_manggota,CONCAT(md.nomer_kwarda,"",mb.nomer_kwarcab,"",mw.nomer_kwaran,"",mg.nomer_gudep,"",ma.id_manggota) as no_anggota
                              from 
                                manggota ma
                                JOIN mgudep mg on  mg.id_mgudep = ma.id_mgudep
                                JOIN mkwaran mw on  mw.id_mkwaran= mg.id_mkwaran
                                JOIN mkwarcab mb on  mb.id_mkwarcab= mw.id_mkwarcab
                                JOIN mkwarda md on  md.id_mkwarda= mb.id_mkwarda
                            )tbno on tbno.id_manggota = a.id_manggota
                            JOIN mgudep g ON g.id_mgudep = a.id_mgudep
                            JOIN malamat al ON al.id_malamat = a.id_malamat
                            JOIN mkec kc ON kc.id_mkec = al.id_mkec
                            JOIN mkota ko ON ko.id_mkota = kc.id_mkota
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
                                kwb.ketua_cab,
                                kot.mkota AS nm_mkwarcab
                              FROM
                                mkwarcab kwb
                              JOIN malamat alm ON alm.id_malamat = kwb.id_malamat
                              JOIN mkec kcm ON kcm.id_mkec = alm.id_mkec
                              JOIN mkota kot ON kot.id_mkota = kcm.id_mkota
                            ) tbkwb ON tbkwb.id_mkwarcab = tbkwr.id_mkwarcab
                            JOIN mkwarda kd ON kd.id_mkwarda = tbkwb.id_mkwarda
                            WHERE
                              (a.full_anggota LIKE "%'.$full_anggota.'%"
                              OR a.nick_anggota LIKE "%'.$full_anggota.'%")
                            AND 
                              tbno.no_anggota LIKE "%'.$no_anggota.'%"
                            AND a.jenis_kelamin LIKE "%'.$jenis_kelamin.'%"
                            AND al.malamat LIKE "%'.$malamat.'%"
                            AND (
                              g.nama_pangkalan LIKE "%'.$mgudep.'%" or 
                              g.nomer_gudep LIKE "%'.$mgudep.'%" 
                            )
                            AND tbkwr.nm_mkwaran LIKE "%'.$mkwaran.'%"
                            AND tbkwb.nm_mkwarcab LIKE "%'.$mkwarcab.'%"
                            and (YEAR(CURDATE())-YEAR(a.tgl_lahir)) like "%'.$usia.'%"
                            AND al.kode_pos LIKE "%'.$kode_pos.'%"
                            AND kc.mkec LIKE "%'.$mkec.'%"
                            AND ko.mkota LIKE "%'.$mkota.'%"
                            AND l.email LIKE "%'.$email.'%"
                            AND l.isActive like  "%'.$isActive.'%"
                            '.$id_manggota.'
                            ORDER BY
                              a.full_anggota ASC';
                            // ma.id_manggota LIKE "%'.$id_manggota.'%"
                        // print_r($sql);exit();
                        $exe = mysql_query($sql);
                        $jum = mysql_num_rows($exe);
                        if ($jum<=0) {
                          $out.='<tr>
                                  <td style="text-align:center;color:red;">KOSONG</td>
                                </tr>';
                        } else {
                          $arr = array();
                          while ($res=mysql_fetch_assoc($exe)) {
                            $arr[]=$res;
                          }
                          // echo '<pre>';
                          // print_r($arr);
                          // exit();
                          // echo '</pre>';
                          foreach ($arr as $i=>$v) {
                            $foto = ($v['foto']=='')?'img/no_image2.jpg':'upload/foto/'.$v['foto'];
                            $tb='<table width="100%" border="0">
                                  <tr>
                                    <td align="center" valign="top" rowspan="12">
                                        <img src="../../img/tunas.jpg" width="50" alt="pram" /><br />
                                        <img src="../../'.$foto.'" alt="foto" width="100" height="120" /></td>
                                    <td class="kop" colspan="2">KARTU TANDA ANGGOTA<br />GERAKAN PRAMUKA</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Nama</td>
                                    <td colspan="2">: '.$v['nama'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">No. Anggota</td>
                                    <td colspan="2">: '.$v['no_anggota'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Tgl. Lahir</td>
                                    <td colspan="2">: '.$v['temp_lahir'].', '.tgl_indo($v['tgl_lahir']).'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Alamat</td>
                                    <td colspan="2">: '.$v['malamat'].', '.$v['mkec'].', '.$v['mkota'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Telepon/HP</td>
                                    <td colspan="2">: '.$v['hp'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Agama</td>
                                    <td colspan="2">: '.$v['agama'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Jabatan/Gol</td>
                                    <td colspan="2">: '.$v['msubgolongan'].'</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Kwarda</td>
                                    <td colspan="2">:Jawa Timur</td>
                                  </tr>
                                  <tr>
                                    <td class="field">Berlaku s/d</td>
                                    <td>: '.$v['gol_darah'].'</td>
                                    <td><b>Gol Darah</b> : '.$v['gol_darah'].'</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2" align="center"><p>Mengetahui,</p>
                                      <p>&nbsp;</p>
                                      <p>'.$v['ketua_cab'].'<br />
                                        Ketua Kwarcab '.$v['nm_mkwarcab'].'
                                      </p>
                                    </td>
                                  </tr>
                              </table>';
                            if ($i % 2 == 0) {
                              $out.='<tr><td>'.$tb.'</td>';
                            }else{
                              $out.='<td>'.$tb.'</td></tr>';
                            }
                          }
                        }

                      $out.='
                      </table>
                      </body>
                  </html>';
          echo $out;
          #generate html -> PDF ------------
          $out2 = ob_get_contents();
          ob_end_clean(); 
          
          // Define a Landscape page size/format by name
          // $mpdf=new mPDF('utf-8', 'A4-L');

          // Define a page size/format by array - page will be 190mm wide x 236mm height

          $mpdf=new mPDF('c','A4','');   
          // $mpdf=new mPDF('utf-8', array(190,236));
          $mpdf->SetDisplayMode('fullpage');   
          $stylesheet = file_get_contents('../../lib/mpdf/r_allkta.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();

      }#enkripsi
    }#pdf
  }#login

