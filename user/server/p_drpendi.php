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
	#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * 
					FROM
						drpendi pi
						JOIN manggota a on a.id_manggota= pi.id_manggota
					WHERE 
						pi.id_drpendi = '.$_GET['id_drpendi'];
			// print_r($sql);exit();

			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"nm_kursus":"'.$res['nm_kursus'].'",
					"no_sertifikat":"'.$res['no_sertifikat'].'",
					"nm_lembaga":"'.$res['nm_lembaga'].'",
					"alamat_pendi":"'.$res['alamat_pendi'].'",
					"thn_kursus":"'.$res['thn_kursus'].'"
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE drpendi set 
										nm_kursus 		= '".mysql_real_escape_string($_POST['nm_kursusTB'])."',
										no_sertifikat	= '".mysql_real_escape_string($_POST['no_sertifikatTB'])."',
										nm_lembaga		= '".mysql_real_escape_string($_POST['nm_lembagaTB'])."',
										alamat_pendi	= '".mysql_real_escape_string($_POST['alamat_pendiTB'])."',
										thn_kursus		= '".mysql_real_escape_string($_POST['thn_kursusTB'])."'
							where 		id_drpendi		= ".$_GET['id_drpendi'];
		//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"kurang berhasil"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into drpendi set	nm_kursus 			= "'.mysql_real_escape_string($_POST['nm_kursusTB']).'",		
											no_sertifikat		= "'.mysql_real_escape_string($_POST['no_sertifikatTB']).'",
											nm_lembaga 			= "'.mysql_real_escape_string($_POST['nm_lembagaTB']).'",
											alamat_pendi		= "'.mysql_real_escape_string($_POST['alamat_pendiTB']).'",
											thn_kursus 			= "'.mysql_real_escape_string($_POST['thn_kursusTB']).'",
											id_manggota 	= (
													SELECT id_manggota 
													from manggota  
													where 
														id_mlogin = '.$_SESSION['id_mloginp'].'
												)';


			// $id1 	= mysql_insert_id();
			$exe		= mysql_query($sql);
			// $id_malamat	= mysql_insert_id();
			// var_dump($sql);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drpendi where id_drpendi ='.$_GET['id_drpendi'];
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
			$nm_kursus		= trim($_GET['nm_kursusS'])?$_GET['nm_kursusS']:'';
			$no_sertifikat 	= trim($_GET['no_sertifikatS'])?$_GET['no_sertifikatS']:'';
			$nm_lembaga 	= trim($_GET['nm_lembagaS'])?$_GET['nm_lembagaS']:'';
			$alamat_pendi 	= trim($_GET['alamat_pendiS'])?$_GET['alamat_pendiS']:'';
			$thn_kursus		= trim($_GET['thn_kursusS'])?$_GET['thn_kursusS']:'';
			

			$sql = 'SELECT * 
					FROM
						drpendi pi
						left JOIN manggota a on a.id_manggota= pi.id_manggota
					WHERE 
						pi.nm_kursus 		like "%'.$nm_kursus.'%" and 
						pi.no_sertifikat 	like "%'.$no_sertifikat.'%" and 
						pi.nm_lembaga 		like "%'.$nm_lembaga.'%" and 
						pi.alamat_pendi 	like "%'.$alamat_pendi.'%" and 
						pi.thn_kursus 		like "%'.$thn_kursus.'%"  
						
					ORDER BY 
						pi.thn_kursus desc';

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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_drpendi]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_drpendi]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nm_kursus'].'</label></td>
							<td><label class="control-label">'.$res['no_sertifikat'].'</label></td>
							<td><label class="control-label">'.$res['nm_lembaga'].'</label></td>
							<td><label class="control-label">'.$res['alamat_pendi'].'</label></td>
							<td><label class="control-label">'.$res['thn_kursus'].'</label></td>
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
