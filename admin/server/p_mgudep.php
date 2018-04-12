<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include"../../lib/tglindo.php"; 
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	
	switch ($aksi){
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mkota':
					$sql	= 'SELECT *  from  mkota'; //diganti
					$exe	= mysqli_query($con,$sql);
					$datax	= array();

					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// var_dump($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"kosong"}';
					}
				break;
				
				case 'mkwarcab':
					$sql	= 'SELECT
									kb.id_mkwarcab,
									kb.nomer_kwarcab,
									ko.id_mkota,
									ko.mkota
								from  mkwarcab kb
									join malamat al on al.id_malamat = kb.id_malamat
									join mkec kc on kc.id_mkec= al.id_mkec
									join mkota ko on ko.id_mkota = kc.id_mkota   
								GROUP BY 
									ko.id_mkota
								order by 
									ko.mkota asc';

					 //diganti
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// var_dump($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mkec':
					$sql	= '	SELECT *
								from  mkec
								where id_mkota = '.$_GET['id_mkota']
								;
					 //var_dump($sql);exit();
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
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * FROM mgudep gp
						join  malamat al on al.id_malamat = gp.id_malamat
						join  mkwaran kr on kr.id_mkwaran = gp.id_mkwaran
						join  mkwarcab kb on kb.id_mkwarcab = kr.id_mkwarcab
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkota ko on ko.id_mkota = kc.id_mkota
						join  mlogin lg on lg.id_mlogin = gp.id_mlogin
					where 
						gp.id_mgudep='.$_GET['id_mgudep'];
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$res = mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"nomer_gudep":"'.$res['nomer_gudep'].'",
					"nama_pangkalan":"'.$res['nama_pangkalan'].'",
					"tgl_berdiri":"'.tgl_indo4($res['tgl_berdiri']).'",
					"id_mlogin":"'.$res['id_mlogin'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"malamat":"'.$res['malamat'].'",		
					"pre_malamat":"'.$res['pre_malamat'].'",
					"id_mkwarcab":"'.$res['id_mkwarcab'].'",					
					"kode_pos":"'.$res['kode_pos'].'",
					"web":"'.$res['web'].'",
					"telp_1":"'.$res['telp_1'].'",
					"telp_2":"'.$res['telp_2'].'",
					"telp_3":"'.$res['telp_3'].'",
					"fax":"'.$res['fax'].'",
					"email":"'.$res['email'].'"
				}';


			/*$sql = 'SELECT * from mgudep where id_mgudep = '.$_GET['id_mgudep'];
			$exe = mysqli_query($con,$sql);
			$res = mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"mgudep":"'.$res['mgudep'].'"
				}';*/
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			# udpate : mlogin  -------------------
			$pass='';
			if(isset($_POST['passBTB2']) && !empty($_POST['passBTB2'])){
				$pass.=' paswot="'.trim(mysqli_real_escape_string(md5($_POST['passBTB2']))).'", ';
				// $exe1 = mysqli_query($con,$pass);
				// var_dump($exe1);exit();
			}
			#end of update : mlogin 

			$sql = "UPDATE mgudep set 	nomer_gudep 	= '".mysqli_real_escape_string($_POST['nomer_gudepTB'])."',
										nama_pangkalan 	= '".mysqli_real_escape_string($_POST['nama_pangkalanTB'])."',
										tgl_berdiri 	= '".mysqli_real_escape_string(tgl_indo3($_POST['tgl_berdiriTB']))."'
					where id_mgudep=".$_GET['id_mgudep']; //diganti
			// print_r($sql);exit();
			
			$sql2 = 'UPDATE malamat set malamat 		= "'.trim(mysqli_real_escape_string($_POST['malamatTB'])).'",
										pre_malamat		= "'.trim(mysqli_real_escape_string($_POST['pre_malamatTB'])).'",
										kode_pos		= "'.trim(mysqli_real_escape_string($_POST['kode_posTB'])).'",
										id_mkec 		= '.$_POST['id_mkecTB'].',
										web 			= "'.trim(mysqli_real_escape_string($_POST['webTB'])).'",
										telp_1			= "'.trim(mysqli_real_escape_string($_POST['telp_1TB'])).'",
										telp_2			= "'.trim(mysqli_real_escape_string($_POST['telp_2TB'])).'",
										telp_3			= "'.trim(mysqli_real_escape_string($_POST['telp_3TB'])).'",
										fax 			= "'.trim(mysqli_real_escape_string($_POST['faxTB'])).'"
										where id_malamat='.$_POST['id_malamatH']; //diganti
			$sql3 = 'UPDATE mlogin set 	'.$pass.' email 	= "'.trim(mysqli_real_escape_string($_POST['emailTB'])).'"
					 						WHERE id_mlogin = '.$_SESSION['id_mloginp']; 
			$exe  = mysqli_query($con,$sql);
			if(!$exe){
				$out='{"status":"gagal ubah gudep"}';
			}else{
				$exe2	= mysqli_query($con,$sql2);
				if(!$exe2){
					$out='{"status":"gagal ubah malamat"}';
				}else{
					$exe3	= mysqli_query($con,$sql3);
					if(!$exe3){
						$out='{"status":"gagal ubah mlogin "}';
					}else{
						$out='{"status":"sukses"}';
					}
				}
			}
			echo $out;
		break;
			/*$sql = "update  mgudep set mgudep = '".mysqli_real_escape_string($_POST['mgudepTB'])."' 
					where id_mgudep=".$_GET['id_mgudep']; //diganti
			$exe	= mysqli_query($con,$sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;*/
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mlogin set		email			= "'.trim(mysqli_real_escape_string($_POST['emailTB'])).'",
												paswot			= "'.trim(mysqli_real_escape_string($_POST['paswotTB'])).'",
												level			= "gudep"'; //diganti

			$exe	= mysqli_query($con,$sql);	
			$id1	= mysqli_insert_id();								
			
			$sql2 = 'INSERT into malamat set	malamat 		= "'.trim(mysqli_real_escape_string($_POST['malamatTB'])).'",
												pre_malamat		= "'.trim(mysqli_real_escape_string($_POST['pre_malamatTB'])).'",
												kode_pos		= "'.trim(mysqli_real_escape_string($_POST['kode_posTB'])).'",
												id_mkec 		= '.trim(mysqli_real_escape_string($_POST['id_mkecTB'])).',
												web 			= "'.trim(mysqli_real_escape_string($_POST['webTB'])).'",
												telp_1			= "'.trim(mysqli_real_escape_string($_POST['telp_1TB'])).'",
												telp_2			= "'.trim(mysqli_real_escape_string($_POST['telp_2TB'])).'",
												telp_3			= "'.trim(mysqli_real_escape_string($_POST['telp_3TB'])).'",
												fax 			= "'.trim(mysqli_real_escape_string($_POST['faxTB'])).'"';
			$exe2	= mysqli_query($con,$sql2);
			$id2	= mysqli_insert_id();

			#sing anyar
			$sql3 ='INSERT into mgudep set	id_mlogin		= '.$id1.',
											id_malamat		= '.$id2.',
											id_mkwaran		= (
													SELECT	kr.id_mkwaran
													FROM mkwaran kr
														join malamat al on al.id_malamat = kr.id_malamat
													WHERE id_mkec = '.$_POST['id_mkotaTB'].'
											),
											tgl_berdiri		= "'.trim(mysqli_real_escape_string(tgl_indo3($_POST['tgl_berdiriTB']))).'",
											nama_pangkalan	= "'.trim(mysqli_real_escape_string($_POST['nama_pangkalanTB'])).'",
											nomer_gudep		= "'.trim(mysqli_real_escape_string($_POST['nomer_gudepTB'])).'"';												
		  	// var_dump($sql3);exit();
			$exe3	= mysqli_query($con,$sql3);
			// var_dump($exe2);exit();

			// var_dump($sql3);exit();
			if($exe and $exe2 and $exe3){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		/*case 'hapus':
		$f=$_SESSION['id_mloginp'];*/
			
		
			// $sql	= "DELETE from mlogin where id_mlogin ="$_SESSION['id_mloginp'];
			// $exe	= mysqli_query($con,$sql);
			
			// if($exe){
			// 	echo '{"status":"sukses"}';
			// }else{
			// 	echo '{"status":"gagal"}';	
			// }
		/*break;*/

		case 'hapus':
			$sql	= 'DELETE from mgudep where id_mgudep ='.$_GET['id_mgudep'];
			$exe	= mysqli_query($con,$sql);
			// var_dump($f);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;


			
		#tampil  =============================================================================================
		case 'tampil' :
			$nomer_gudep 	= trim($_GET['nomer_gudepS'])?$_GET['nomer_gudepS']:'';
			$nama_pangkalan = trim($_GET['nama_pangkalanS'])?$_GET['nama_pangkalanS']:'';
			$mkwarcab		= trim($_GET['mkwarcabS'])?$_GET['mkwarcabS']:'';
			$mkwaran 		= trim($_GET['mkwaranS'])?$_GET['mkwaranS']:'';
			$malamat 		= trim($_GET['malamatS'])?$_GET['malamatS']:'';
			$web 			= trim($_GET['webS'])?$_GET['webS']:'';
			$kode_pos 		= trim($_GET['kode_posS'])?$_GET['kode_posS']:'';
			$telp_1			= trim($_GET['telp_1S'])?$_GET['telp_1S']:'';
			$telp_2			= trim($_GET['telp_2S'])?$_GET['telp_2S']:'';
			$telp_3			= trim($_GET['telp_3S'])?$_GET['telp_3S']:'';
			$fax			= trim($_GET['faxS'])?$_GET['faxS']:'';
			
			$sql = 'SELECT * FROM mgudep gp
						join  malamat al on al.id_malamat = gp.id_malamat
						join  mkwaran kr on kr.id_mkwaran = gp.id_mkwaran
						join  mkwarcab kb on kb.id_mkwarcab = kr.id_mkwarcab
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkota ko on ko.id_mkota = kc.id_mkota
					WHERE
						gp.nomer_gudep like "%'.$nomer_gudep.'%" AND
						gp.nama_pangkalan like "%'.$nama_pangkalan.'%" AND
						ko.mkota like "%'.$mkwarcab.'%" AND
						kc.mkec like "%'.$mkwaran.'%" AND
						al.malamat like "%'.$malamat.'%" AND
						al.kode_pos like "%'.$kode_pos.'%" AND
						al.web like "%'.$web.'%" AND
						al.telp_1 like "%'.$telp_1.'%" AND
						al.telp_2 like "%'.$telp_2.'%" AND
						al.telp_3 like "%'.$telp_3.'%" AND
						al.fax like "%'.$fax.'%" 
					ORDER BY 
						kc.mkec asc	'; //diganti
			// gp.tgl_berdiri like "%'.$.'%" AND
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}
			
			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;
			#end of paging	 
			
			#ada data
			$out='';
			if(mysqli_num_rows($result)!=0)
			{
				if ($_SESSION['levelp']=='kwarda' or $_SESSION['levelp']=='kwarcab') {
					$disabled = '';
				}else{
					$disabled = 'disabled';
				}
				// <a	 class="btn" href="javascript:hapusmkwarcab('.$res['id_mkwarcab'].');" role="button"><i class="icon-remove"></i></a>
				$nox 	= $starting+1;
				while($res = mysqli_fetch_assoc($result)){	
						$btn= '<td  disabled="'.$disabled.'">
									 <button '.$disabled.' class="btn" onclick="editmgudep('.$res['id_mgudep'].');" ><i class="icon-pencil"></i></button>
									 <button '.$disabled.' class="btn" onclick="hapusmgudep('.$res['id_mgudep'].');" ><i class="icon-remove"></i></button>
								 </td>'; //diganti

					$out.= '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nomer_gudep'].'</label></td>
							<td><label class="control-label">'.$res['nama_pangkalan'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl_berdiri']).'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							<td><label class="control-label">'.$res['mkec'].'</label></td>
							
							<td><label class="control-label">'.$res['pre_malamat'].' ; '.$res['malamat'].'</label></td>
							
							<td><label class="control-label">'.$res['kode_pos'].'</label></td>
							<td><label class="control-label">'.$res['web'].'</label></td>
							<td><label class="control-label">'.$res['telp_1'].'</label></td>
							<td><label class="control-label">'.$res['telp_2'].'</label></td>
							<td><label class="control-label">'.$res['telp_3'].'</label></td>
							<td><label class="control-label">'.$res['fax'].'</label></td>
								'.$btn.'
						</tr>'; //diganti
                	$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan=14 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="14">'.$obj->anchors.'</td></tr>';
			$out.= '<tr class="info"><td colspan="14">'.$obj->total.'</td></tr>';
			echo $out;
	break;
	
} ?>			
