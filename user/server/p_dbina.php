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
			switch ($menu) {
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

				case 'mgudep':
					$sql	= 'SELECT
									g.nomer_gudep,
									g.id_mgudep,
									g.nama_pangkalan
								from  
									mgudep g
									join mkwaran kr on kr.id_mkwaran  = g.id_mkwaran
								WHERE 
									g.id_mkwaran = '.$_GET['id_mkwaran'].'
								order by 
									g.nama_pangkalan asc';
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

				case 'mkwaran':
					$sql	= 'SELECT
									kr.nomer_kwaran,
									kc.id_mkec,
									kc.mkec
								from  mkwaran kr
									join malamat al on al.id_malamat = kr.id_malamat
									join mkec kc on kc.id_mkec       = al.id_mkec
								WHERE 
									kr.id_mkwarcab = '.$_GET['id_mkwarcab'].'
								order by 
									kc.mkec asc';
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
			}
		break;
				
		case 'ambiledit':
			$sql = 'SELECT * 
					FROM
						dbina bn
						JOIN manggota a on a.id_manggota= bn.id_manggota
					WHERE 
						bn.id_dbina = '.$_GET['id_dbina'];
			// print_r($sql);exit();

			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"keahlian":"'.$res['keahlian'].'",
					"thn_bina":"'.$res['thn_bina'].'",
					"thn_selesai":"'.$res['thn_selesai'].'",
					"no_gudep":"'.$res['no_gudep'].'",
					"ket_bina":"'.$res['ket_bina'].'"
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE dbina set 
										keahlian 		= '".mysql_real_escape_string($_POST['keahlianTB'])."',
										thn_bina	= '".mysql_real_escape_string($_POST['thn_binaTB'])."',
										thn_selesai		= '".mysql_real_escape_string($_POST['thn_selesaiTB'])."',
										no_gudep	= '".mysql_real_escape_string($_POST['no_gudepTB'])."',
										ket_bina		= '".mysql_real_escape_string($_POST['ket_binaTB'])."'
							where 		id_dbina		= ".$_GET['id_dbina'];
		//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into dbina set	keahlian 			= "'.mysql_real_escape_string($_POST['keahlianTB']).'",		
											thn_bina			= "'.mysql_real_escape_string($_POST['thn_binaTB']).'",
											thn_selesai 		= "'.mysql_real_escape_string($_POST['thn_selesaiTB']).'",
											no_gudep			= "'.mysql_real_escape_string($_POST['no_gudepTB']).'",
											ket_bina 			= "'.mysql_real_escape_string($_POST['ket_binaTB']).'",
											id_manggota 	= (
													SELECT id_manggota 
													from manggota  
													where 
														id_mlogin = '.$_SESSION['id_mloginp'].'
												)';


			// $id1 	= mysql_insert_id();
			$exe		= mysql_query($sql);
			// $id_malamat	= mysql_insert_id();
			//var_dump($sql);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from dbina where id_dbina ='.$_GET['id_dbina'];
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
			$keahlian		= trim($_GET['keahlianS'])?$_GET['keahlianS']:'';
			$thn_bina 		= trim($_GET['thn_binaS'])?$_GET['thn_binaS']:'';
			$thn_selesai 	= trim($_GET['thn_selesaiS'])?$_GET['thn_selesaiS']:'';
			$no_gudep 		= trim($_GET['no_gudepS'])?$_GET['no_gudepS']:'';
			$ket_bina		= trim($_GET['ket_binaS'])?$_GET['ket_binaS']:'';
			

			$sql = 'SELECT * 
					FROM
						dbina bn
						JOIN manggota a on a.id_manggota= bn.id_manggota
						JOIN mgudep g on g.id_mgudep= a.id_mgudep
					WHERE 
						bn.keahlian 		like "%'.$keahlian.'%" and 
						bn.thn_bina 		like "%'.$thn_bina.'%" and 
						bn.thn_selesai 		like "%'.$thn_selesai.'%" and 
						bn.id_mgudep 		like "%'.$no_gudep.'%" and 
						bn.ket_bina 		like "%'.$ket_bina.'%"  
						
					ORDER BY 
						bn.thn_bina desc';

			//print_r($sql);exit();
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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_dbina]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_dbina]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['keahlian'].'</label></td>
							<td><label class="control-label">'.$res['thn_bina'].'</label></td>
							<td><label class="control-label">'.$res['thn_selesai'].'</label></td>
							<td><label class="control-label">'.$res['nomer_gudep'].'</label></td>
							<td><label class="control-label">'.$res['ket_bina'].'</label></td>
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
