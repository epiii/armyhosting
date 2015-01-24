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
				/*case 'manggota':
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
				break;*/

				case 'msubgolongan':
					$sql	= 'SELECT * FROM  msubgolongan ORDER BY msubgolongan asc';
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
						drkecpumum dkcp
						left JOIN manggota ma on dkcp.id_drkecpumum= dkcp.id_drkecpumum
						left JOIN msubgolongan msg on msg.id_msubgolongan = dkcp.id_msubgolongan
					WHERE 
						dkcp.id_drkecpumum = '.$_GET['id_drkecpumum'];

			// print_r($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_manggota":"'.$res['id_manggota'].'",
					"id_msubgolongan":"'.$res['id_msubgolongan'].'",
					"tgl_pencapaian":"'.$res['tgl_pencapaian'].'",
					"no_sertifikat":"'.$res['no_sertifikat'].'",
					"ketergn":"'.$res['ketergn'].'"					
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE drkecpumum set	id_msubgolongan 	= '.$_POST['id_msubgolonganTB'].',		
											tgl_pencapaian		= "'.mysql_real_escape_string(tgl_indo3($_POST['tgl_pencapaianTB'])).'",
											no_sertifikat		= "'.mysql_real_escape_string($_POST['no_sertifikatTB']).'",
											ketergn				= "'.mysql_real_escape_string($_POST['ketergnTB']).'"											
								WHERE id_drkecpumum 			= '.$_GET['id_drkecpumum'];
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
			$sql1 = 'INSERT into drkecpumum set id_msubgolongan	= "'.mysql_real_escape_string($_POST['id_msubgolonganTB']).'",
												no_sertifikat	= "'.mysql_real_escape_string($_POST['no_sertifikatTB']).'",														
												tgl_pencapaian	= "'.mysql_real_escape_string(tgl_indo3($_POST['tgl_pencapaianTB'])).'",														
												ketergn			= "'.mysql_real_escape_string($_POST['ketergnTB']).'",
												id_manggota 	= (
													SELECT id_manggota
													from manggota 
													where id_mlogin='.$_SESSION['id_mloginp'].'
												)';
			// print_r($sql1);exit();
			$exe1 = mysql_query($sql1);
			$out=($exe1)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drkecpumum where id_drkecpumum ='.$_GET['id_drkecpumum'];
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
			// $tgl_pencapaian	= trim($_GET['tgl_pencapaianS'])?$_GET['tgl_pencapaianS']:'';
			/*$full_anggota	= trim($_GET['full_anggotaS'])?$_GET['full_anggotaS']:'';*/
			$msubgolongan	= trim($_GET['msubgolonganS'])?$_GET['msubgolonganS']:'';
			$no_sertifikat 	= trim($_GET['no_sertifikatS'])?$_GET['no_sertifikatS']:'';
			$ketergn		= trim($_GET['ketergnS'])?$_GET['ketergnS']:'';
			
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
						// ku.tgl_pencapaian like "%'.$tgl_pencapaian.'%" and 
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
				while($res = mysql_fetch_assoc($result)){	
					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:edittombol('$res[id_drkecpumum]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapustombol('$res[id_drkecpumum]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							
							<td><label class="control-label">'.$res['msubgolongan'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl_pencapaian']).'</label></td>
							<td><label class="control-label">'.$res['no_sertifikat'].'</label></td>
							<td><label class="control-label">'.$res['ketergn'].'</label></td>
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
