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
				case 'mkecpkhusus':
					$sql	= 'SELECT * FROM  mkecpkhusus ORDER BY mkecpkhusus asc';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
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

				case 'manggota':
					$sql	= 'SELECT * FROM  manggota ORDER BY full_anggota asc';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
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
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT 
						*
					FROM
						drkecpkhusus dkcp
						left JOIN mkecpkhusus mkcp on mkcp.id_mkecpkhusus= dkcp.id_mkecpkhusus
						-- left JOIN manggota ma on ma.id_manggota = dkcp.id_manggota
					WHERE 
						dkcp.id_drkecpkhusus = '.$_GET['id_drkecpkhusus'];

			//print_r($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkecpkhusus":"'.$res['id_mkecpkhusus'].'",
					"no_sertifikat":"'.$res['no_sertifikat'].'",
					"level":"'.$res['level'].'",
					"tgl":"'.tgl_indo4($res['tgl']).'",
					"id_manggota":"'.$res['id_manggota'].'",
					"ketergn":"'.$res['ketergn'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE drkecpkhusus set	id_mkecpkhusus  	= '.$_POST['mkecpkhususTB'].',
												no_sertifikat		= "'.mysql_real_escape_string($_POST['no_sertifikatTB']).'",		
												level				= "'.mysql_real_escape_string($_POST['levelTB']).'",
												tgl					= "'.mysql_real_escape_string(tgl_indo3($_POST['tglTB'])).'",
												ketergn				= "'.mysql_real_escape_string($_POST['ketergnTB']).'"
												WHERE id_drkecpkhusus 	= '.$_GET['id_drkecpkhusus'];
												// id_manggota 		= '.$_POST['full_anggotaTB'].',
			// $id1 	= mysql_insert_id();

			$exe1		= mysql_query($sql1);
			// var_dump($sql2);exit();
			if($exe1){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into drkecpkhusus set	id_mkecpkhusus= '.$_POST['mkecpkhususTB'].',
													no_sertifikat = "'.mysql_real_escape_string($_POST['no_sertifikatTB']).'",		
													level         = "'.mysql_real_escape_string($_POST['levelTB']).'",
													tgl           = "'.mysql_real_escape_string(tgl_indo3($_POST['tglTB'])).'",
													id_manggota   = (SELECT id_manggota FROM manggota WHERE id_mlogin= '.$_SESSION['id_mloginp'].'),
													ketergn       = "'.mysql_real_escape_string($_POST['ketergnTB']).'"';
			// print_r($sql1);exit();
			$exe1		= mysql_query($sql1);
			if($exe1){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drkecpkhusus where id_drkecpkhusus ='.$_GET['id_drkecpkhusus'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			// $full_anggota	= trim($_GET['full_anggotaS'])?$_GET['full_anggotaS']:'';
			$mkecpkhusus	= trim($_GET['mkecpkhususS'])?$_GET['mkecpkhususS']:'';
			$no_sertifikat 	= trim($_GET['no_sertifikatS'])?$_GET['no_sertifikatS']:'';
			$level 			= trim($_GET['levelS'])?$_GET['levelS']:'';
			$tgl			= trim($_GET['tglS'])?$_GET['tglS']:'';
			$ketergn 		= trim($_GET['ketergnS'])?$_GET['ketergnS']:'';

			$sql = 'SELECT 
						*
					FROM
						drkecpkhusus dkcp
						left JOIN mkecpkhusus mkcp on mkcp.id_mkecpkhusus= dkcp.id_mkecpkhusus
						left JOIN manggota ma on ma.id_manggota = dkcp.id_manggota
					WHERE
						mkcp.mkecpkhusus like "%'.$mkecpkhusus.'%" and 
						dkcp.no_sertifikat like "%'.$no_sertifikat.'%" and
						dkcp.level like "%'.$level.'%" and
						dkcp.tgl like "%'.$tgl.'%" and
						dkcp.ketergn like "%'.$ketergn.'%"';

						// ma.full_anggota like "%'.$full_anggota.'%" and
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$jum	= mysql_num_rows($result);
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:edittombol('$res[id_drkecpkhusus]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapustombol('$res[id_drkecpkhusus]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['mkecpkhusus'].'</label></td>
							<td><label class="control-label">'.$res['no_sertifikat'].'</label></td>
							<td><label class="control-label">'.$res['level'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl']).'</label></td>
							<td><label class="control-label">'.$res['ketergn'].'</label></td>
							'.$btn.'
						</tr>';
							// <td><label class="control-label">'.$res['full_anggota'].'</label></td>
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
