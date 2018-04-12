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
		#tampil  =============================================================================================
		case 'tampil' :
			$malamat= trim($_GET['malamatS'])?$_GET['malamatS']:'';
			$mkota 	= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mkec 	= trim($_GET['mkecS'])?$_GET['mkecS']:'';
			$kode_pos= trim($_GET['kode_posS'])?$_GET['kode_posS']:'';
			$web 	= trim($_GET['webS'])?$_GET['webS']:'';
			$hp 	= trim($_GET['hpS'])?$_GET['hpS']:'';
			$telp_1 = trim($_GET['telp_1S'])?$_GET['telp_1S']:'';
			$telp_2 = trim($_GET['telp_2S'])?$_GET['telp_2S']:'';
			$telp_3 = trim($_GET['telp_3S'])?$_GET['telp_3S']:'';
			$fax 	= trim($_GET['faxS'])?$_GET['faxS']:'';

			$sql = 'SELECT *					
					FROM 
						malamat a join(
							select kc.id_mkec,kc.mkec,kt.id_mkota,kt.mkota
							from mkota kt 
								left join mkec kc on kc.id_mkota = kt.id_mkota
						)tbk on tbk.id_mkec = a.id_mkec
					WHERE
						a.malamat like "%'.$malamat.'%" AND
						tbk.mkota like "%'.$mkota.'%" AND
						tbk.mkec like "%'.$mkec.'%" AND
						a.kode_pos like "%'.$kode_pos.'%" AND
						a.web like "%'.$web.'%" AND
						a.hp like "%'.$hp.'%" AND
						a.telp_1 like "%'.$telp_1.'%" AND
						a.telp_2 like "%'.$telp_2.'%" AND
						a.telp_3 like "%'.$telp_3.'%" AND
						a.fax like "%'.$fax.'%" 
					ORDER BY 
						tbk.mkota ASC';
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
								 <a class="btn btn-secondary" href="javascript:editmalamat(\''.$res['id_malamat'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmalamat(\''.$res['id_malamat'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					$out.= '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td >
								<label onmouseover="poShow('.$nox.',1);" onmouseout="poHide('.$nox.',1);" id="po1_'.$nox.'" 
									data-placement="right" title="detail" data-content="'.$res['pre_malamat'].', '.$res['malamat'].'">
									... '.$res['malamat'].'
								</label>
							</td>
							<td>'.$res['mkota'].'</td>
							<td>'.$res['mkec'].'</td>
							<td>'.$res['kode_pos'].'</td>
							<td>'.$res['web'].'</td>
							<td>'.$res['hp'].'</td>
							<td>'.$res['telp_1'].'</td>
							<td>'.$res['telp_2'].'</td>
							<td>'.$res['telp_3'].'</td>
							<td>'.$res['fax'].'</td>
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
			$out.= '<tr class="info"><td colspan="12">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="12">'.$obj->total.'</td></tr>';
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
					$where 	=empty($_GET['id_mkota'])?' id_mkec ='.$_GET['id_mkec']:' id_mkota ='.$_GET['id_mkeota'];
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
