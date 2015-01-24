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
		// cek terpakai atau belum 
		case 'cek':
			switch ($menu) {
				case 'nomer_kwarcab':
					$sql = 'SELECT * from mkwarcab where nomer_kwarcab='.$_GET['nomer_kwarcab'];
					$exe = mysql_query($sql);
					$jum = mysql_num_rows($exe);
					// print_r($jum);exit();
					
					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($jum!=0){
							$out='{"status":"terpakai"}';
						}else{
							$out= '{"status":"tersedia"}';
						}
					}
					echo $out;
				break;
			}
		break;
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mkota':
					$where = (!empty($_GET['id_mkota'])) ? ' WHERE ko.id_mkota !='.$_GET['id_mkota']:'';
					$sql	= '	SELECT * 
								from mkota
								WHERE 
									id_mkota not in (
										SELECT ko.id_mkota
										from mkwarcab kb  
											JOIN malamat al on al.id_malamat = kb.id_malamat
											JOIN mkec kc on kc.id_mkec = al.id_mkec 
											JOIN mkota ko on ko.id_mkota= kc.id_mkota
										'.$where.'		
										ORDER by ko.mkota asc
									)';

					// print_r($sql);exit();
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

				case 'mkec':
					$sql	= 'SELECT * FROM  mkec where id_mkota='.$_GET['id_mkota'].' ORDER BY mkec asc';
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

				case 'mkwarcab':
					$sql	= 'SELECT * from  mkwarcab'; //diganti
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// echo $exe;exit();
					//var_dump($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
						//print_r($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * 
					FROM mkwarcab kb
						join  malamat al on al.id_malamat =kb.id_malamat
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkota ko on ko.id_mkota = kc.id_mkota
						join  mlogin lo on lo.id_mlogin = kb.id_mlogin 
					where 
						kb.id_mkwarcab='.$_GET['id_mkwarcab'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"nomer_kwarcab":"'.$res['nomer_kwarcab'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"mkec":"'.$res['mkec'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"mkota":"'.$res['mkota'].'",
					"kode_pos":"'.$res['kode_pos'].'",
					"web":"'.$res['web'].'",
					"hp":"'.$res['hp'].'",
					"telp_1":"'.$res['telp_1'].'",
					"telp_2":"'.$res['telp_2'].'",
					"telp_3":"'.$res['telp_3'].'",
					"id_mlogin":"'.$res['id_mlogin'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"fax":"'.$res['fax'].'",
					"ketua_cab":"'.$res['ketua_cab'].'",
					"email":"'.$res['email'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE 	mkwarcab set nomer_kwarcab 	= '.mysql_real_escape_string($_POST['nomer_kwarcabTB']).',
										 ketua_cab 	= "'.trim(mysql_real_escape_string($_POST['ketua_cabTB'])).'"				
					WHERE 	id_mkwarcab ='.$_GET['id_mkwarcab']; //diganti
			
			$sql2 = 'UPDATE malamat set  
										malamat 		= "'.trim(mysql_real_escape_string($_POST['malamatTB'])).'",
										pre_malamat		= "'.trim(mysql_real_escape_string($_POST['pre_malamatTB'])).'",
										kode_pos		= "'.trim(mysql_real_escape_string($_POST['kode_posTB'])).'",
										id_mkec 		= '.$_POST['id_mkecTB'].',
										web 			= "'.trim(mysql_real_escape_string($_POST['webTB'])).'",
										telp_1			= "'.trim(mysql_real_escape_string($_POST['telp_1TB'])).'",
										telp_2			= "'.trim(mysql_real_escape_string($_POST['telp_2TB'])).'",
										telp_3			= "'.trim(mysql_real_escape_string($_POST['telp_3TB'])).'",
										fax 			= "'.trim(mysql_real_escape_string($_POST['faxTB'])).'"
								where 	id_malamat 		='.$_POST['id_malamatTB']; //diganti
			
			$sql3 = 'UPDATE mlogin set 	email 	= "'.mysql_real_escape_string($_POST['emailTB']).'",
										paswot 	= "'.mysql_real_escape_string(md5($_POST['paswotTB'])).'"
					where id_mlogin ='.$_POST['id_mloginTB']; //diganti
			
			// var_dump($sql2);exit();
			$exe	= mysql_query($sql);
			$exe2	= mysql_query($sql2);
			$exe3	= mysql_query($sql3);
			if($exe AND $exe2 AND $exe3){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		
		#tambah  ============================================================================================
		case 'tambah':
			$sql = 'INSERT into mlogin set		email		= "'.trim(mysql_real_escape_string($_POST['emailTB'])).'",
												paswot		= "'.mysql_real_escape_string(md5($_POST['paswotTB'])).'",
												level		= "kwarcab"'; 
												//diganti
			$exe	= mysql_query($sql);	
			$id1	= mysql_insert_id();								
		  	// var_dump($ex)
			// exit();
			$sql2 = 'INSERT into malamat set	malamat 		= "'.trim(mysql_real_escape_string($_POST['malamatTB'])).'",
												pre_malamat		= "'.trim(mysql_real_escape_string($_POST['pre_malamatTB'])).'",
												kode_pos		= "'.trim(mysql_real_escape_string($_POST['kode_posTB'])).'",
												id_mkec 		= "'.mysql_real_escape_string($_POST['id_mkecTB']).'",
												web 			= "'.trim(mysql_real_escape_string($_POST['webTB'])).'",
												telp_1			= "'.trim(mysql_real_escape_string($_POST['telp_1TB'])).'",
												telp_2			= "'.trim(mysql_real_escape_string($_POST['telp_2TB'])).'",
												telp_3			= "'.trim(mysql_real_escape_string($_POST['telp_3TB'])).'",
												fax 			= "'.trim(mysql_real_escape_string($_POST['faxTB'])).'"';
			$exe2	= mysql_query($sql2);
			$id2	= mysql_insert_id();
			
			$sql3 	= 'INSERT into mkwarcab set	id_mlogin		= '.$id1.',
												id_malamat		= '.$id2.',
												id_mkwarda		= 1,
												ketua_cab			= "'.trim(mysql_real_escape_string($_POST['ketua_cabTB'])).'",
												nomer_kwarcab	= '.trim(mysql_real_escape_string($_POST['nomer_kwarcabTB']));												
			
			$exe3	= mysql_query($sql3);
			if($exe and $exe2 and $exe3){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==========================================================================================
		case 'hapus':			
			$sql	= "DELETE from mkwarcab where id_mkwarcab ='$_GET[id_mkwarcab]'";
			$exe	= mysql_query($sql);			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  ==========================================================================================
		case 'tampil' :	
			$nomer_kwarcab = trim($_GET['nomer_kwarcabS'])?$_GET['nomer_kwarcabS']:'';
			$ketua_cab = trim($_GET['ketua_cabS'])?$_GET['ketua_cabS']:'';
			$mkota         = trim($_GET['mkotaS'])?$_GET['mkotaS']:'';	
			$malamat       = trim($_GET['malamatS'])?$_GET['malamatS']:'';	
			$kode_pos      = trim($_GET['kode_posS'])?$_GET['kode_posS']:'';	
			$web           = trim($_GET['webS'])?$_GET['webS']:'';	
			$telp_1        = trim($_GET['telp_1S'])?$_GET['telp_1S']:'';	
			$fax           = trim($_GET['faxS'])?$_GET['faxS']:'';	
			
			$sql = 'SELECT * 
					FROM mkwarcab kb
						join  malamat al on al.id_malamat =kb.id_malamat
						join  mkec kc on kc.id_mkec = al.id_mkec
						join  mkota ko on ko.id_mkota = kc.id_mkota 
					WHERE
						kb.nomer_kwarcab like "%'.$nomer_kwarcab.'%" and 
						kb.ketua_cab like "%'.$ketua_cab.'%" and 
						ko.mkota like "%'.$mkota.'%" and 
						al.malamat like "%'.$malamat.'%" and
						al.kode_pos like "%'.$kode_pos.'%" and
						al.web like "%'.$web.'%" and
						al.telp_1 like "%'.$telp_1.'%" and
						al.fax like "%'.$fax.'%"
					ORDER BY 
						kb.nomer_kwarcab asc ';
			// print_r($sql);exit();					
			if(isset($_GET['startin'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}
			
			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;
			#end of paging	 
			
			$out='';
			if(mysql_num_rows($result)!=0){#ada data
				$nox 	= $starting+1;

				if ($_SESSION['levelp']!='kwarda') {
					$disabled = 'disabled';
				}else{
					$disabled = '';
				}
				// <a	 class="btn" href="javascript:hapusmkwarcab('.$res['id_mkwarcab'].');" role="button"><i class="icon-remove"></i></a>
				while($res = mysql_fetch_array($result)){	
						$btn= '<td  disabled="'.$disabled.'">
									 <button '.$disabled.' class="btn" onclick="editmkwarcab('.$res['id_mkwarcab'].');" ><i class="icon-pencil"></i></button>
									 <button '.$disabled.' class="btn" onclick="hapusmkwarcab('.$res['id_mkwarcab'].');" ><i class="icon-remove"></i></button>
								 </td>'; //diganti
					$out.= '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nomer_kwarcab'].'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							<td><label class="control-label">'.$res['pre_malamat'].' '.$res['malamat'].'</label></td>
							
							<td><label class="control-label">'.$res['kode_pos'].'</label></td>
							<td><label class="control-label">'.$res['web'].'</label></td>
							<td><label class="control-label">'.$res['telp_1'].'</label></td>
							<td><label class="control-label">'.$res['fax'].'</label></td>
							<td><label class="control-label">'.$res['ketua_cab'].'</label></td>
								'.$btn.'
						</tr>'; //diganti
                	$nox++;
				}
			}else{ #kosong
				$out.= '<tr align="center">
						<td  colspan=10><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';			
			}
		#link paging
			$out.= '<tr class="info"><td colspan="10">'.$obj->anchors.'</td></tr>';
			$out.= '<tr class="info"><td colspan="10">'.$obj->total.'</td></tr>';
			echo $out;
	break;
	
} ?>			
