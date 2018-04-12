<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include "../../lib/tglindo.php"; 
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	
	switch ($aksi){
		#cek==============================================================================================
		case 'status':
			$isActive = $_GET['isActive']=='y'?'n':'y';
			$sql = 'UPDATE mlogin set isActive	="'.$isActive.'" 
								where id_mlogin	=(
										SELECT id_mlogin from manggota where id_manggota='.$_GET['id_manggota'].'
									 )';
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			if(!$exe){
				$out='{"status":"gagal"}';
			}else{
				$out='{"status":"sukses"}';
			}
			echo $out;
		break;

		#vdrpendf  =============================================================================================
		case 'vdrpendi' :
			$sql = 'SELECT * 
                  FROM drpendi pi 
                  LEFT JOIN manggota a ON a.id_manggota = pi.id_manggota
                  WHERE id_mlogin = '.$_SESSION['id_mloginp'].' 
                  ORDER BY pi.thn_kursus DESC';
						
						// left join malamat al  on al.id_malamat = pf.id_malamat
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['nm_kursus'].'</td>
								<td>'.$res['no_sertifikat'].'</td>
								<td>'.$res['nm_lembaga'].'</td>
								<td>'.$res['alamat_pendi'].'</td>
								<td>'.$res['thn_kursus'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
	
		case 'vdrpendf' :
			$sql = 'SELECT *
					from 
						drpendf pf 
						left join dsubpendf dpf on dpf.id_dsubpendf = pf.id_dsubpendf
						left join malamat al  on al.id_malamat = pf.id_malamat
					WHERE
						pf.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						pf.thn_lulus ASC';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['pendidikan'].'</td>
								<td>'.$res['nm_instansi'].'</td>
								<td>'.$res['no_ijazah'].'</td>
								<td>'.$res['thn_masuk'].'</td>
								<td>'.$res['thn_lulus'].'</td>
								<td>'.$res['fakultas'].'/'.$res['jurusan'].'</td>
								<td>'.$res['kelas'].'</td>
								<td>'.$res['no_induk'].'</td>
								<td>'.$res['malamat'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;

		case 'vrku' :
			$sql = 'SELECT *
	                  FROM
	                    drkecpumum dkcp
	                    left JOIN manggota ma on dkcp.id_manggota= dkcp.id_manggota
	                    left JOIN msubgolongan msg on msg.id_msubgolongan = dkcp.id_msubgolongan
	                  WHERE
						dkcp.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						dkcp.tgl_pencapaian ASC';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($resku = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$resku['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$resku['msubgolongan'].'</td>
	                            <td>'.$resku['tgl_pencapaian'].'</td>
	                            <td>'.$resku['no_sertifikat'].'</td>
	                            <td>'.$resku['ketergn'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;

		case 'vrkk' :
			$sql = 'SELECT  *
                  FROM
                    drkecpkhusus dkck
                    left JOIN mkecpkhusus mkcp on mkcp.id_mkecpkhusus= dkck.id_mkecpkhusus
                    left JOIN manggota ma on ma.id_manggota = dkck.id_manggota
	                  WHERE
						dkck.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						dkck.tgl ASC';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['mkecpkhusus'].'</td>
	                            <td>'.$res['tgl'].'</td>
	                            <td>'.$res['no_sertifikat'].'</td>
	                            <td>'.$res['level'].'</td>
	                            <td>'.$res['ketergn'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
		case 'vrpres' :
			$sql = 'SELECT  *
                          FROM
                          drprestasi pr
                          JOIN manggota a on a.id_manggota= pr.id_manggota
	                  WHERE
						pr.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						pr.thn desc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['nm_prestasi'].'</td>
	                            <td>'.$res['tingkat'].'</td>
	                            <td>'.$res['thn'].'</td>
	                            <td>'.$res['no_sertifikat'].'</td>
	                            <td>'.$res['ket'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
		case 'vrjdp' :
			$sql = 'SELECT  *
                          FROM
                          djabatan jb
                          left JOIN manggota a on a.id_manggota= jb.id_manggota
	                  WHERE
						jb.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						jb.tgl_lantik desc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['nm_org'].'</td>
	                            <td>'.$res['nm_jab'].'</td>
	                            <td>'.$res['tgl_lantik'].'</td>
	                            <td>'.$res['tgl_purna'].'</td>
	                            <td>'.$res['ket_jab'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
		case 'vrbina' :
			$sql = 'SELECT  *
                          FROM
                            dbina bn
                            JOIN manggota a on a.id_manggota= bn.id_manggota
                            JOIN mgudep g on g.id_mgudep= a.id_mgudep
	                  WHERE
						bn.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						bn.thn_bina desc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$resku['keahlian'].'</td>
	                            <td>'.$resku['thn_bina'].'</td>
	                            <td>'.$resku['thn_selesai'].'</td>
	                            <td>'.$resku['nomer_gudep'].'</td>
	                            <td>'.$resku['ket_bina'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
		case 'vrkpram' :
			$sql = 'SELECT * 
                            FROM
                              drkegpram dr
                              LEFT JOIN manggota ma on ma.id_manggota= dr.id_manggota
                              LEFT JOIN mgolongan mg on mg.id_mgolongan= dr.id_mgolongan
	                  WHERE
						dr.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						dr.tgl desc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
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
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
		case 'vrknonpram' :
			$sql = 'SELECT * 
                            FROM
                              drkegnonpram kg
                              left JOIN manggota a on a.id_manggota= kg.id_manggota
	                  WHERE
						kg.id_manggota = '.$_GET['id_manggota'].'
					ORDER BY
						kg.tgl desc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
							 <a  class="btn" href="javascript:viewAnggotaDtl(\''.$res['id_manggota'].'\');"> <i class="icon-user"></i></a>
						 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td>'.$res['drkegnonpram'].'</td>
	                            <td>'.$res['tgl'].'</td>
	                            <td>'.$res['lokasi'].'</td>
	                            <td>'.$res['tingkat'].'</td>
	                            <td>'.$res['stus'].'</td>
	                            <td>'.$res['plenggara'].'</td>
	                            <td>'.$res['ket'].'</td>
							</tr>';
								// '.$btn.'		
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
	
	
		case 'view':
			# tampil manggota
			$sql = 'SELECT 
						al.*,gd.*,mc.*,mk.*,
						gd.nomer_gudep,
						gd.nama_pangkalan,
						a.id_manggota,
						a.full_anggota,
						a.nick_anggota,
						a.temp_lahir,
						a.tgl_lahir,
						(year(now())-year(a.tgl_lahir))as usia,
						a.gol_darah,
						a.jenis_kelamin,
						a.agama,
						a.status_nikah,
						a.jenis_kecacatan,
						a.bakat,
						a.hobi,
						a.bahasa,
						mk.mkota,
						tbkwr.*,
						tbkwb.*
					FROM manggota a
						left join malamat al on al.id_malamat = al.id_malamat
						left join mgudep gd on gd.id_mgudep   = gd.id_mgudep
						left join mkec mc on mc.id_mkec       = al.id_mkec
						left join mkota mk on mk.id_mkota     = mc.id_mkota
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
						) tbkwr ON tbkwr.id_mkwaran = gd.id_mkwaran
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
					WHERE 
						id_manggota= '.$_GET['id_manggota'];
					// print_r($sql);exit();
			
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
					if ($exe) {
						echo '{
							"id_manggota":"'.$res['id_manggota'].'",
							"full_anggota":"'.$res['full_anggota'].'",
							"agama":"'.$res['agama'].'",
							"jenis_kelamin":"'.$res['jenis_kelamin'].'",
							"nomer_gudep":"'.$res['nomer_gudep'].'",
							"malamat":"'.$res['malamat'].'",
							"temp_lahir":"'.$res['temp_lahir'].'",
							"tgl_lahir":"'.tgl_indo($res['tgl_lahir']).'",
							"malamat":"'.$res['malamat'].'",
							"mkec":"'.$res['mkec'].'",
							"mkota":"'.$res['mkota'].'",
							"kode_pos":"'.$res['kode_pos'].'",
							"nm_mgudep":"'.$res['nama_pangkalan'].'",
							"nm_mkwaran":"'.$res['nm_mkwaran'].'",
							"nm_mkwarcab":"'.$res['nm_mkwarcab'].'"
						}';
					} else {
						echo '{"status":"gagal"}';
					}
		break;
		#tampil  =============================================================================================
		case 'tampil' :
			$no_anggota    = trim($_GET['no_anggotaS'])?$_GET['no_anggotaS']:'';
			$full_anggota  = trim($_GET['full_anggotaS'])?$_GET['full_anggotaS']:'';
			$jenis_kelamin = trim($_GET['jenis_kelaminS'])?$_GET['jenis_kelaminS']:'';
			$malamat       = trim($_GET['malamatS'])?$_GET['malamatS']:'';
			$mgudep        = trim($_GET['mgudepS'])?$_GET['mgudepS']:'';
			$mkwaran       = trim($_GET['mkwaranS'])?$_GET['mkwaranS']:'';
			$mkwarcab      = trim($_GET['mkwarcabS'])?$_GET['mkwarcabS']:'';
			$usia          = trim($_GET['usiaS'])?$_GET['usiaS']:'';
			$mkec          = trim($_GET['mkecS'])?$_GET['mkecS']:'';
			$mkota         = trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$kode_pos      = trim($_GET['kode_posS'])?$_GET['kode_posS']:'';
			$email         = trim($_GET['emailS'])?$_GET['emailS']:'';
			$isActive      = $_GET['isActiveS']?$_GET['isActiveS']:'';
			
			$sql = 'SELECT
						a.id_manggota,
						tbno.no_anggota,
						concat(a.full_anggota," (",a.nick_anggota,")") AS nama,
						a.jenis_kelamin,
						(YEAR(CURDATE())-YEAR(a.tgl_lahir))as usia,
						concat(g.nama_pangkalan," (",g.nomer_gudep,")") as gudep,
						concat(tbkwr.nm_mkwaran," (",tbkwr.nomer_kwaran,")") as kwaran,
						concat(tbkwb.nm_mkwarcab," (",tbkwb.nomer_kwarcab,")") as kwarcab,
						al.pre_malamat,
						al.malamat,
						al.kode_pos,
						kc.mkec,
						ko.mkota,
						l.email,
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
					ORDER BY
						a.full_anggota ASC';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					// var_dump($res['isActive']);exit();
					if ($res['isActive']=='y') { // aktif 
						$trclr  ='';
						$act    ='onclick="statAnggota('.$res['id_manggota'].',\'y\');"';
						$bclr   ='success';
						$trinfo ='Aktif';
						$info   ='non aktifkan';
						$status ='<label class="label label-success">Aktif</label>';
					} else { // gak aktif
						$trclr ='warning';
						$act    ='onclick="statAnggota('.$res['id_manggota'].',\'n\');"';
						$bclr   ='default';
						$trinfo ='Tidak Aktif';
						$info   ='aktifkan';
						$status ='<label class="label label-warning">Tidak Aktif</label>';
					}
					$jk=$res['jenis_kelamin']=='L'?'Laki-laki':'Perempuan';
					$btn ='<td>
						 	<div class="btn-group">
							  	<button type="button" class="btn btn-info" onclick="viewAnggotaDtl('.$res['id_manggota'].');"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="detail" data-placement="top" >
							  		<i class="icon-search"></i>
						  		</button>
							  	<button type="button" class="btn btn-'.$bclr.'" '.$act.'
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="'.$info.'" data-placement="top" >
							  		<i class="icon-ok"></i>
						  		</button>
					  		</div>
						</td>';

					$out.= '<tr class="'.$trclr.'" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="'.$trinfo.'" data-placement="left">
								<td>'.$res['no_anggota'].'</td>
								<td>'.$res['nama'].'</td>
								<td>'.$jk.'</td>
								<td >
									<label onmouseover="poShow('.$nox.',1);" onmouseout="poHide('.$nox.',1);" id="po1_'.$nox.'" 
										data-placement="right" title="detail" data-content="'.$res['pre_malamat'].', '.$res['malamat'].'">
										... '.$res['malamat'].'
									</label>
								</td>
								<td>'.$res['gudep'].'</td>
								<td>'.$res['kwaran'].'</td>
								<td>'.$res['kwarcab'].'</td>
								
								<td>'.$res['usia'].'</td>
								<td>'.$res['kode_pos'].'</td>
								<td>'.$res['mkec'].'</td>
								<td>'.$res['mkota'].'</td>
								<td>
									<a target="_blank" href="http://'.$res['email'].'">'.$res['email'].'</a>
								</td>
								<td>'.$status.'</td>
								'.$btn.'
							</tr>';
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=9 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="20">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="20">'.$obj->total.'</td></tr>';
			echo $out;
		break;
	
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mkota':
					$sql	= '	SELECT * from mkota ORDER by mkota asc '; 
					// print_r($sql);exit();	
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mkec':
					$where 	=empty($_GET['id_mkota'])?' id_mkec ='.$_GET['id_mkec']:' id_mkota ='.$_GET['id_mkota'];
					// print_r($where);exit();
					$sql	= '	SELECT * from mkec where '.$where.' order by mkec ASC ';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mbukeg':
					$sql	= '	SELECT * from mbukeg order by mbukeg ';
					// print_r($sql);exit();	
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT *					
					FROM 
						malamat a join(
							select kc.id_mkec,kc.mkec,kt.id_mkota,kt.mkota
							from mkota kt 
								left join mkec kc on kc.id_mkota = kt.id_mkota
						)tbk on tbk.id_mkec = a.id_mkec
					WHERE id_malamat='.$_GET['id_malamat'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"kode_pos":"'.$res['kode_pos'].'",
					"web":"'.$res['web'].'",
					"hp":"'.$res['hp'].'",
					"telp_1":"'.$res['telp_1'].'",
					"telp_2":"'.$res['telp_2'].'",
					"telp_3":"'.$res['telp_3'].'",
					"fax":"'.$res['fax'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  malamat set id_mkec			= '.mysqli_real_escape_string($_POST['id_mkecTB']).',
										malamat 		= "'.mysqli_real_escape_string($_POST['malamatTB']).'",
										kode_pos 		= '.mysqli_real_escape_string($_POST['kode_posTB']).',
										web 			= "'.mysqli_real_escape_string($_POST['webTB']).'",
										hp 	 			= '.mysqli_real_escape_string($_POST['hpTB']).',
										telp_1 			= '.mysqli_real_escape_string($_POST['telp_1TB']).',
										telp_2 			= '.mysqli_real_escape_string($_POST['telp_2TB']).',
										telp_3 			= '.mysqli_real_escape_string($_POST['telp_3TB']).',
										fax 			= '.mysqli_real_escape_string($_POST['faxTB']).'
									WHERE id_malamat 	='.$_GET['id_malamat'];
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into malamat set 	id_mkec			= '.mysqli_real_escape_string($_POST['id_mkecTB']).',
												malamat 		= "'.mysqli_real_escape_string($_POST['malamatTB']).'",
												kode_pos 		= '.mysqli_real_escape_string($_POST['kode_posTB']).',
												web 			= "'.mysqli_real_escape_string($_POST['webTB']).'",
												hp 	 			= '.mysqli_real_escape_string($_POST['hpTB']).',
												telp_1 			= '.mysqli_real_escape_string($_POST['telp_1TB']).',
												telp_2 			= '.mysqli_real_escape_string($_POST['telp_2TB']).',
												telp_3 			= '.mysqli_real_escape_string($_POST['telp_3TB']).',
												fax 			= '.mysqli_real_escape_string($_POST['faxTB']);
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from malamat  where id_malamat  ='.$_GET['id_malamat'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
} ?>			
