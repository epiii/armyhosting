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
						drprestasi pr
						JOIN manggota a on a.id_manggota= pr.id_manggota
					WHERE 
						pr.id_drprestasi = '.$_GET['id_drprestasi'];
			 //print_r($sql);exit();

			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"nm_prestasi":"'.$res['nm_prestasi'].'",
					"tingkat":"'.$res['tingkat'].'",
					"thn":"'.$res['thn'].'",
					"no_sertifikat":"'.$res['no_sertifikat'].'",
					"ket":"'.$res['ket'].'"
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE drprestasi set 
										nm_prestasi 	= '".mysqli_real_escape_string($_POST['nm_prestasiTB'])."',
										tingkat			= '".mysqli_real_escape_string($_POST['tingkatTB'])."',
										thn				= '".mysqli_real_escape_string($_POST['thnTB'])."',
										no_sertifikat	= '".mysqli_real_escape_string($_POST['no_sertifikatTB'])."',
										ket				= '".mysqli_real_escape_string($_POST['ketTB'])."'
							where 		id_drprestasi		= ".$_GET['id_drprestasi'];
		//var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into drprestasi set	
											nm_prestasi 	= "'.mysqli_real_escape_string($_POST['nm_prestasiTB']).'",		
											tingkat			= "'.mysqli_real_escape_string($_POST['tingkatTB']).'",
											thn 			= "'.mysqli_real_escape_string($_POST['thnTB']).'",
											no_sertifikat	= "'.mysqli_real_escape_string($_POST['no_sertifikatTB']).'",
											ket 			= "'.mysqli_real_escape_string($_POST['ketTB']).'",
											id_manggota 	= (
													SELECT id_manggota 
													from manggota  
													where 
														id_mlogin = '.$_SESSION['id_mloginp'].'
												)';


			// $id1 	= mysqli_insert_id();
			$exe		= mysqli_query($con,$sql);
			// $id_malamat	= mysqli_insert_id();
			//var_dump($sql);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drprestasi where id_drprestasi ='.$_GET['id_drprestasi'];
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
			$nm_prestasi	= trim($_GET['nm_prestasiS'])?$_GET['nm_prestasiS']:'';
			$tingkat 		= trim($_GET['tingkatS'])?$_GET['tingkatS']:'';
			$thn 			= trim($_GET['thnS'])?$_GET['thnS']:'';
			$no_sertifikat 	= trim($_GET['no_sertifikatS'])?$_GET['no_sertifikatS']:'';
			$ket			= trim($_GET['ketS'])?$_GET['ketS']:'';
			
			$sql = 'SELECT * 
					FROM
						drprestasi pr
						JOIN manggota a on a.id_manggota= pr.id_manggota
					WHERE 
						a.id_mlogin = '.$_SESSION['id_mloginp'].' and 
						pr.nm_prestasi 		like "%'.$nm_prestasi.'%" and 
						pr.tingkat 			like "%'.$tingkat.'%" and 
						pr.thn 				like "%'.$thn.'%" and 
						pr.no_sertifikat	like "%'.$no_sertifikat.'%" and 
						pr.ket 				like "%'.$ket.'%" '; 
						
			//print_r($sql);exit();
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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_drprestasi]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_drprestasi]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nm_prestasi'].'</label></td>
							<td><label class="control-label">'.$res['tingkat'].'</label></td>
							<td><label class="control-label">'.$res['thn'].'</label></td>
							<td><label class="control-label">'.$res['no_sertifikat'].'</label></td>
							<td><label class="control-label">'.$res['ket'].'</label></td>
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
