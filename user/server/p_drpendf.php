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
			$exe1		= mysqli_query($con,$sql1);
			$id_malamat	= mysqli_insert_id();

			$r = mysqli_fetch_assoc(mysqli_query($con,'SELECT id_manggota from manggota where id_mlogin = '.$_SESSION['id_mloginp']));
			if(!$exe1){
				$out='{"status":"gagal simpan alamat"}';
			}else{
				$id_dsubpendf = ($_POST['id_dsubpendfTB']!='')?' id_dsubpendf ='.$_POST['id_dsubpendfTB'].', ':'';
				$sql2         = 'INSERT into drpendf set	pendidikan 	= "'.mysqli_real_escape_string($_POST['pendidikanTB']).'",		
													nm_instansi		= "'.mysqli_real_escape_string($_POST['nm_instansiTB']).'",
													no_ijazah 		= "'.mysqli_real_escape_string($_POST['no_ijazahTB']).'",
													thn_masuk 		= "'.mysqli_real_escape_string($_POST['thn_masukTB']).'",
													thn_lulus 		= "'.mysqli_real_escape_string($_POST['thn_lulusTB']).'",
													kelas			= "'.mysqli_real_escape_string($_POST['kelasTB']).'",
													id_malamat		= '.$id_malamat.',
													id_manggota 	= '.$r['id_manggota'].',
													'.$id_dsubpendf.'
													no_induk		= "'.mysqli_real_escape_string($_POST['no_indukTB']).'"';
				// var_dump($sql2);exit();
				$exe2         = mysqli_query($con,$sql2);
				if (!$exe2) {
					$out='{"status":"gagal simpan pend formal"}';
				} else {
					$out='{"status":"sukses"}';
				}
			}
			echo $out;
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
			$pendidikan	= trim($_GET['pendidikanS'])?$_GET['pendidikanS']:'';
			$nm_instansi= trim($_GET['nm_instansiS'])?$_GET['nm_instansiS']:'';
			$thn_masuk 	= trim($_GET['thn_masukS'])?$_GET['thn_masukS']:'';
			$thn_lulus 	= trim($_GET['thn_lulusS'])?$_GET['thn_lulusS']:'';
			$no_ijazah	= trim($_GET['no_ijazahS'])?$_GET['no_ijazahS']:'';
			$fakultas 	= trim($_GET['fakultasS'])!=''?' dpf.fakultas like "%'.$_GET['fakultasS'].'%" and ':'';
			$jurusan 	= trim($_GET['jurusanS'])!=''?' dpf.jurusan like "%'.$_GET['jurusanS'].'%" and ':'';
			$kelas 		= trim($_GET['kelasS'])?$_GET['kelasS']:'';
			$no_induk	= trim($_GET['no_indukS'])?$_GET['no_indukS']:'';
			$malamat	= trim($_GET['malamatS'])?$_GET['malamatS']:'';

			$sql = 'SELECT *  
					FROM
						drpendf pf
						left JOIN dsubpendf dpf on dpf.id_dsubpendf= pf.id_dsubpendf
						left JOIN malamat al on al.id_malamat = pf.id_malamat
						left JOIN manggota a on a.id_manggota= pf.id_manggota
					WHERE 
						pf.pendidikan like "%'.$pendidikan.'%" and 
						pf.nm_instansi like "%'.$nm_instansi.'%" and 
						pf.thn_masuk like "%'.$thn_masuk.'%" and 
						pf.thn_lulus like "%'.$thn_lulus.'%" and 
						pf.no_ijazah like "%'.$no_ijazah.'%" and 
						'.$fakultas.$jurusan.'
						pf.kelas like "%'.$kelas.'%" and  
						pf.no_induk like "%'.$no_induk.'%" and  
						al.malamat like "%'.$malamat.'%" 
					ORDER BY 
						pf.thn_masuk desc';

			// print_r($sql);exit();
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
					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_drpendf]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_drpendf]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['pendidikan'].'</label></td>
							<td><label class="control-label">'.$res['nm_instansi'].'</label></td>
							<td><label class="control-label">'.$res['thn_masuk'].'</label></td>
							<td><label class="control-label">'.$res['thn_lulus'].'</label></td>
							<td><label class="control-label">'.$res['no_ijazah'].'</label></td>
							<td><label class="control-label">'.$res['fakultas'].'</label></td>
							<td><label class="control-label">'.$res['jurusan'].'</label></td>
							<td><label class="control-label">'.$res['kelas'].'</label></td>
							<td><label class="control-label">'.$res['no_induk'].'</label></td>
							<td><label class="control-label">'.$res['malamat'].'</label></td>
							'.$btn.'
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
