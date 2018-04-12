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
				case 'mkec':
					// $sql	= 'SELECT *  from  mkec where id_mkota='.$_GET['id_mkota']; //diganti
					$whr2= (!empty($_GET['id_mkec'])) ? 'WHERE kc.id_mkec !='.$_GET['id_mkec']:'';
					$s='SELECT * from mkwaran';
					$e=mysqli_query($con,$s);
					$j=mysqli_num_rows($e);

					if($j>0){
						$whr1=' and id_mkec not in (
										SELECT kc.id_mkec
										from mkwaran kr
											JOIN malamat al on al.id_malamat = kr.id_malamat
											JOIN mkec kc on kc.id_mkec = al.id_mkec 
											JOIN mkota ko on ko.id_mkota= kc.id_mkota
										'.$whr2.'
									)';
					}else{
						$whr1='';
					}

					$sql	= '	SELECT * 
								from mkec
								WHERE 
									id_mkota ='.$_GET['id_mkota'].$whr1;
					// var_dump($sql);exit();
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
				
				case 'mkwarcab':
					$sql	= '	SELECT 
									kb.id_mkwarcab,
									kb.nomer_kwarcab,
									ko.id_mkota,
									ko.mkota
								from  
									mkwarcab kb
									join malamat al on al.id_malamat = kb.id_malamat
									join mkec kc on kc.id_mkec= al.id_mkec
									join mkota ko on ko.id_mkota = kc.id_mkota   
								GROUP BY 
									ko.id_mkota
								order by 
									ko.mkota asc';
					
					// var_dump($sql);exit();
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($datax!=NULL){
							$out='{"status":"sukses","datax":'.json_encode($datax).'}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

				case 'mkec':
					$sql	= '	SELECT 
								from  mkec
								where id_mkota = '.$_GET['id_mkota'].'
								GROUP BY 
									ko.id_mkota
								order by 
									ko.mkota asc';
					// var_dump($sql);exit();
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
			$sql = 'SELECT * 
					FROM mkwaran kn
						join  malamat al on al.id_malamat =kn.id_malamat
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkwarcab ko on ko.id_mkwarcab = kn.id_mkwarcab
						join  mlogin lo on lo.id_mlogin = kn.id_mlogin 
					where 
						kn.id_mkwaran='.$_GET['id_mkwaran'];
			$exe = mysqli_query($con,$sql);
			$res = mysqli_fetch_assoc($exe);
			// print_r($res);exit();
			if($exe){
				echo '{
					"nomer_kwaran":"'.$res['nomer_kwaran'].'",
					"malamat":"'.$res['malamat'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkwarcab":"'.$res['id_mkwarcab'].'",					
					"kode_pos":"'.$res['kode_pos'].'",
					"web":"'.$res['web'].'",
					"telp_1":"'.$res['telp_1'].'",
					"telp_2":"'.$res['telp_2'].'",
					"telp_3":"'.$res['telp_3'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"fax":"'.$res['fax'].'",
					"email":"'.$res['email'].'",
					"ketua_ran":"'.$res['ketua_ran'].'",
					"id_mlogin":"'.$res['id_mlogin'].'"
				}';
				// "mkec":"'.$res['mkec'].'",
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql  = 'UPDATE mkwaran set nomer_kwaran 	= "'.mysqli_real_escape_string($_POST['nomer_kwaranTB']).'",
										ketua_ran 		= "'.trim(mysqli_real_escape_string($_POST['ketua_ranTB'])).'"
									where id_mkwaran 	= '.$_GET['id_mkwaran']; //diganti
			$exe	= mysqli_query($con,$sql);
			// kwaran
			if(!$exe){
				$out='{"status":"gagal ubah data kwaran"}';
			}else{
				$sql2 = 'UPDATE malamat set malamat 		= "'.trim(mysqli_real_escape_string($_POST['malamatTB'])).'",
											pre_malamat		= "'.trim(mysqli_real_escape_string($_POST['pre_malamatTB'])).'",
											kode_pos		= "'.trim(mysqli_real_escape_string($_POST['kode_posTB'])).'",
											id_mkec 		= '.$_POST['id_mkecTB'].',
											web 			= "'.trim(mysqli_real_escape_string($_POST['webTB'])).'",
											telp_1			= "'.trim(mysqli_real_escape_string($_POST['telp_1TB'])).'",
											telp_2			= "'.trim(mysqli_real_escape_string($_POST['telp_2TB'])).'",
											telp_3			= "'.trim(mysqli_real_escape_string($_POST['telp_3TB'])).'",
											fax 			= "'.trim(mysqli_real_escape_string($_POST['faxTB'])).'"
									where	id_malamat 		= '.$_POST['id_malamatH']; //diganti
				$exe2	= mysqli_query($con,$sql2);
				// alamat
				if (!$exe2) {
					$out='{"status":"gagal ubah data alamat"}';
				} else {
					// login
					if(!$exe2){
						$out='{"status":"gagal ubah data login"}';
					}else{
						$sql3 = 'UPDATE mlogin set 	email 			= "'.mysqli_real_escape_string($_POST['emailTB']).'"
											where id_mlogin 		= '.$_POST['id_mloginH']; //diganti
						
						$exe3	= mysqli_query($con,$sql3);
						$out='{"status":"sukses"}';
					}//eo login
				} // eo alamat
			}//eo kwaran
			echo $out;			
		break;
			
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = "INSERT into mlogin set		email		= '".trim(mysqli_real_escape_string($_POST['emailTB']))."',
												paswot		= '".mysqli_real_escape_string(md5($_POST['paswotTB']))."',
												level		= 'kwaran'"; //diganti
			$exe	= mysqli_query($con,$sql);	
			$id1	= mysqli_insert_id();								
			 
			$sql2 = "INSERT into malamat set	malamat 		= '".trim(mysqli_real_escape_string($_POST['malamatTB']))."',
												pre_malamat		= '".trim(mysqli_real_escape_string($_POST['pre_malamatTB']))."',
												kode_pos		= '".trim(mysqli_real_escape_string($_POST['kode_posTB']))."',
												id_mkec 		= '".$_POST['id_mkecTB']."',
												web 			= '".trim(mysqli_real_escape_string($_POST['webTB']))."',
												telp_1			= '".trim(mysqli_real_escape_string($_POST['telp_1TB']))."',
												telp_2			= '".trim(mysqli_real_escape_string($_POST['telp_2TB']))."',
												telp_3			= '".trim(mysqli_real_escape_string($_POST['telp_3TB']))."',
												fax 			= '".trim(mysqli_real_escape_string($_POST['faxTB']))."'";
			$exe2	= mysqli_query($con,$sql2);
			$id2	= mysqli_insert_id(); //diganti
			$sql3 = 'INSERT into mkwaran set	id_malamat		='.$id2.',
												id_mlogin		='.$id1.',
												id_mkwarcab		= (
														SELECT	id_mkwarcab
														FROM 	mkwarcab
																JOIN malamat ON malamat.id_malamat = mkwarcab.id_malamat
																JOIN mkec ON mkec.id_mkec= malamat.id_mkec
																JOIN mkota ON mkota.id_mkota = mkec.id_mkota
														WHERE mkota.id_mkota = '.$_POST['id_mkotaTB'].'
												),
												ketua_ran 		= "'.trim(mysqli_real_escape_string($_POST['ketua_ranTB'])).'",
												nomer_kwaran	="'.trim(mysqli_real_escape_string($_POST['nomer_kwaranTB'])).'"';

			// $sql3 = 'INSERT into mkwaran set	id_malamat		='.$id2.',
			// 									id_mlogin		='.$id1.',
			// 									id_mkwarcab		='.$_POST['id_mkwarcabTB'].',
			// 									nomer_kwaran	="'.trim(mysqli_real_escape_string($_POST['nomer_kwaranTB'])).'"';

			$exe3	= mysqli_query($con,$sql3);
			// var_dump($sql3);exit();
			if($exe and $exe2 and $exe3){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;


		
		#hapus ==============================================================================================
		case 'hapus':
			// $sql	= "delete from mkwaran where id_mkwaran ='$_GET[id_mkwaran]'";
			$sql	= '	DELETE 
						FROM
							mlogin
						WHERE
							id_mlogin= (
								SELECT
									kr.id_mlogin
								FROM
									mkwaran kr
								WHERE
									kr.id_mkwaran = '.$_GET['id_mkwaran'].'
							)';
			$exe	= mysqli_query($con,$sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nomer_kwaran = trim($_GET['nomer_kwaranS'])?$_GET['nomer_kwaranS']:'';
			$ketua_ran = trim($_GET['ketua_ranS'])?$_GET['ketua_ranS']:'';
			$mkec         = trim($_GET['mkecS'])?$_GET['mkecS']:'';	
			$mkota        = trim($_GET['mkotaS'])?$_GET['mkotaS']:'';	
			$malamat      = trim($_GET['malamatS'])?$_GET['malamatS']:'';	
			$kode_pos     = trim($_GET['kode_posS'])?$_GET['kode_posS']:'';	
			$web          = trim($_GET['webS'])?$_GET['webS']:'';	
			$telp_1       = trim($_GET['telp_1S'])?$_GET['telp_1S']:'';	
			$fax          = trim($_GET['faxS'])?$_GET['faxS']:'';

			$lev = $_SESSION['levelp']=='kwarcab'?'AND
							kr.id_mkwarcab= (
								SELECT id_mkwarcab
								from mkwarcab
								where id_mlogin='.$_SESSION['id_mloginp'].'
							)':'';
			$sql = 'SELECT * 
					FROM 
						mkwaran kr
						join  mkwarcab kb on kb.id_mkwarcab =kr.id_mkwarcab
						join  malamat al on al.id_malamat =kr.id_malamat
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkota ko on ko.id_mkota = kc.id_mkota
					WHERE
						kr.nomer_kwaran like "%'.$nomer_kwaran.'%" and 
						kr.ketua_ran like "%'.$ketua_ran.'%" and 
						kc.mkec like "%'.$mkec.'%" and 
						ko.mkota like "%'.$mkota.'%" and 
						al.malamat like "%'.$malamat.'%" and
						al.kode_pos like "%'.$kode_pos.'%" and
						al.web like "%'.$web.'%" and
						al.telp_1 like "%'.$telp_1.'%" and
						al.fax like "%'.$fax.'%" '.$lev.'
					ORDER BY 
						kr.nomer_kwaran asc '; //diganti
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
			if ($_SESSION['levelp']=='kwarda' or $_SESSION['levelp']=='kwarcab') {
				$disabled = '';
			}else{
				$disabled = 'disabled';
			}
			// <a	 class="btn" href="javascript:hapusmkwarcab('.$res['id_mkwarcab'].');" role="button"><i class="icon-remove"></i></a>
			if(mysqli_num_rows($result)!=0){
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					$btn= '<td  disabled="'.$disabled.'">
								 <button '.$disabled.' class="btn" onclick="editmkwaran('.$res['id_mkwaran'].');" ><i class="icon-pencil"></i></button>
								 <button '.$disabled.' class="btn" onclick="hapusmkwaran('.$res['id_mkwaran'].');" ><i class="icon-remove"></i></button>
							 </td>'; //diganti
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nomer_kwaran'].'</label></td>
							<td><label class="control-label">'.$res['mkec'].'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							
							<td><label class="control-label">'.$res['pre_malamat'].' ; '.$res['malamat'].'</label></td>
							
							<td><label class="control-label">'.$res['kode_pos'].'</label></td>
							<td><label class="control-label">'.$res['web'].'</label></td>
							<td><label class="control-label">'.$res['telp_1'].'</label></td>
							<td><label class="control-label">'.$res['fax'].'</label></td>
							<td><label class="control-label">'.$res['ketua_ran'].'</label></td>
								'.$btn.'
						</tr>'; //diganti
                	$nox++;
				}
			}
			#kosong
			else
			{
				echo '<tr align="center">
						<td  colspan="12" ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			echo '<tr class="info"><td colspan="12">'.$obj->anchors.'</td></tr>';
			echo '<tr class="info"><td colspan="12">'.$obj->total.'</td></tr>';
	break;
	
} ?>			
