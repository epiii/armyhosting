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
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'dsubpendf':
					$sql	= 'SELECT * FROM  dsubpendf ORDER BY fakultas asc';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

				case 'mkota':
					$sql	= 'SELECT * FROM  mkota ORDER BY mkota asc';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

				case 'mkec':
					$sql	= 'SELECT * FROM  mkec where  id_mkota='.$_GET['id_mkota'].' ORDER BY mkec ASC';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}

					// var_dump($sql);exit();
					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT 
						pf.*,
						al.malamat,
						al.id_malamat,
						al.pre_malamat,
						kc.id_mkec,
						ko.id_mkota,
						a.*
					FROM
						drpendf pf
						left JOIN dsubpendf dpf on dpf.id_dsubpendf= pf.id_dsubpendf
						left JOIN malamat al on al.id_malamat = pf.id_malamat
						left JOIN mkec kc on kc.id_mkec = al.id_mkec
						left JOIN mkota ko on ko.id_mkota = kc.id_mkota
						left JOIN manggota a on a.id_manggota= pf.id_manggota
					WHERE 
						pf.id_drpendf = '.$_GET['id_drpendf'];

			// print_r($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"pendidikan":"'.$res['pendidikan'].'",
					"nm_instansi":"'.$res['nm_instansi'].'",
					"no_ijazah":"'.$res['no_ijazah'].'",
					"thn_masuk":"'.$res['thn_masuk'].'",
					"thn_lulus":"'.$res['thn_lulus'].'",
					"kelas":"'.$res['kelas'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"malamat":"'.$res['malamat'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"id_dsubpendf":"'.$res['id_dsubpendf'].'",
					"no_induk":"'.$res['no_induk'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE malamat set	id_mkec  		= '.$_POST['id_mkecTB'].',
										pre_malamat 	= "'.mysqli_real_escape_string($_POST['pre_malamatTB']).'",		
										malamat			= "'.mysqli_real_escape_string($_POST['malamatTB']).'"
								WHERE id_malamat 		= '.$_POST['id_malamatH'];
			// $id1 	= mysqli_insert_id();

			$exe1		= mysqli_query($con,$sql1);
			$id_malamat	= mysqli_insert_id();

			$id_dsubpendf= ($_POST['id_dsubpendfTB']!='')?' id_dsubpendf ='.$_POST['id_dsubpendfTB'].', ':'';
			$sql2 = 'UPDATE  drpendf set	pendidikan 		= "'.mysqli_real_escape_string($_POST['pendidikanTB']).'",		
											nm_instansi		= "'.mysqli_real_escape_string($_POST['nm_instansiTB']).'",
											no_ijazah 		= "'.mysqli_real_escape_string($_POST['no_ijazahTB']).'",
											thn_masuk 		= "'.mysqli_real_escape_string($_POST['thn_masukTB']).'",
											thn_lulus 		= "'.mysqli_real_escape_string($_POST['thn_lulusTB']).'",
											kelas			= "'.mysqli_real_escape_string($_POST['kelasTB']).'",
											'.$id_dsubpendf.',
											no_induk		= "'.mysqli_real_escape_string($_POST['no_indukTB']).'"
										WHERE  id_dsubpendf ='.$_GET['id_dsubpendf'];

			$exe1	= mysqli_query($con,$sql1);
			$exe2	= mysqli_query($con,$sql2);
			// var_dump($sql2);exit();
			if($exe1 and $exe2){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into malamat set	id_mkec  		= '.$_POST['id_mkecTB'].',
												pre_malamat 	= "'.mysqli_real_escape_string($_POST['pre_malamatTB']).'",		
												malamat			= "'.mysqli_real_escape_string($_POST['malamatTB']).'"';
			// $id1 	= mysqli_insert_id();
			$exe1		= mysqli_query($con,$sql1);
			$id_malamat	= mysqli_insert_id();

			$id_dsubpendf= ($_POST['id_dsubpendfTB']!='')?' id_dsubpendf ='.$_POST['id_dsubpendfTB'].', ':'';
			$sql2 = 'INSERT into drpendf set	pendidikan 	= "'.mysqli_real_escape_string($_POST['pendidikanTB']).'",		
												nm_instansi		= "'.mysqli_real_escape_string($_POST['nm_instansiTB']).'",
												no_ijazah 		= "'.mysqli_real_escape_string($_POST['no_ijazahTB']).'",
												thn_masuk 		= "'.mysqli_real_escape_string($_POST['thn_masukTB']).'",
												thn_lulus 		= "'.mysqli_real_escape_string($_POST['thn_lulusTB']).'",
												kelas			= "'.mysqli_real_escape_string($_POST['kelasTB']).'",
												id_malamat		= '.$id_malamat.',
												id_manggota 	= (
													SELECT id_manggota 
													from manggota  
													where 
														id_mlogin = '.$_SESSION['id_mloginp'].'
												), '.$id_dsubpendf.'
												no_induk		= "'.mysqli_real_escape_string($_POST['no_indukTB']).'"';

			$exe1	= mysqli_query($con,$sql1);
			// var_dump($exe1);exit();
			$exe2	= mysqli_query($con,$sql2);
			if($exe1 and $exe2){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drpendf where id_drpendf ='.$_GET['id_drpendf'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$no_anggota		= trim($_GET['no_anggotaS'])?$_GET['no_anggotaS']:'';
			$full_anggota 	= trim($_GET['full_anggotaS'])?$_GET['full_anggotaS']:'';
			$jenis_kelamin 	= trim($_GET['jenis_kelaminS'])?$_GET['jenis_kelaminS']:'';
			$nama_pangkalan	= trim($_GET['nama_pangkalanS'])?$_GET['nama_pangkalanS']:'';
			$mkec			= trim($_GET['mkecS'])?$_GET['mkecS']:'';

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
								join malamat on malamat.id_malamat= manggota.id_malamat
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
						kc.mkec like "%'.$mkec.'%"  and 
						a.id_mlogin!='.$_SESSION['id_mloginp'].'
					ORDER BY 
						a.full_anggota ASC';

			// print(arg)t_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$jum	= mysqli_num_rows($result);
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					$jk = $res['jenis_kelamin']=='L'?'Laki-laki':'Perempuan';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['no_anggota'].'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$jk.'</label></td>
							<td><label class="control-label">'.$res['nama_pangkalan'].'</label></td>
							<td><label class="control-label">'.$res['mkec'].'</label></td>
						</tr>';
                	$nox++;
				}
			}
			#kosong
			else
			{
				echo "<tr align='center'>
						<td  colspan=12><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			echo "<tr class='info'><td colspan=12>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=12>".$obj->total."</td></tr>";
	break;
	
} ?>			
