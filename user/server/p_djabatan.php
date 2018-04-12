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
						djabatan jb
						JOIN manggota a on a.id_manggota= jb.id_manggota
					WHERE 
						jb.id_djabatan = '.$_GET['id_djabatan'];
			// print_r($sql);exit();

			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"nm_org":"'.$res['nm_org'].'",
					"nm_jab":"'.$res['nm_jab'].'",
					"tgl_lantik":"'.$res['tgl_lantik'].'",
					"tgl_purna":"'.$res['tgl_purna'].'",
					"ket_jab":"'.$res['ket_jab'].'"
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE djabatan set 
										nm_org 		= '".mysqli_real_escape_string($_POST['nm_orgTB'])."',
										nm_jab		= '".mysqli_real_escape_string($_POST['nm_jabTB'])."',
										tgl_lantik	= '".mysqli_real_escape_string(tgl_indo3($_POST['tgl_lantikTB']))."',
										tgl_purna	= '".mysqli_real_escape_string(tgl_indo3($_POST['tgl_purnaTB']))."',
										ket_jab		= '".mysqli_real_escape_string($_POST['ket_jabTB'])."'
							where 		id_djabatan	= ".$_GET['id_djabatan'];
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
			$sql = 'INSERT into djabatan set
											nm_org 				= "'.mysqli_real_escape_string($_POST['nm_orgTB']).'",		
											nm_jab				= "'.mysqli_real_escape_string($_POST['nm_jabTB']).'",
											tgl_lantik 			= "'.mysqli_real_escape_string(tgl_indo3($_POST['tgl_lantikTB'])).'",
											tgl_purna			= "'.mysqli_real_escape_string(tgl_indo3($_POST['tgl_purnaTB'])).'",
											ket_jab 			= "'.mysqli_real_escape_string($_POST['ket_jabTB']).'",
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
			$sql	= 'DELETE from djabatan where id_djabatan ='.$_GET['id_djabatan'];
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
			// $tgl_lantik	= trim($_GET['tgl_lantikS'])?$_GET['tgl_lantikS']:'';
			// $tgl_purna 	= trim($_GET['tgl_purnaS'])?$_GET['tgl_purnaS']:'';
			$nm_org		= trim($_GET['nm_orgS'])?$_GET['nm_orgS']:'';
			$nm_jab 	= trim($_GET['nm_jabS'])?$_GET['nm_jabS']:'';
			$ket_jab	= trim($_GET['ket_jabS'])?$_GET['ket_jabS']:'';
			

			$sql = 'SELECT * 
					FROM
						djabatan jb
						left JOIN manggota a on a.id_manggota= jb.id_manggota
					WHERE 
						jb.nm_org 		like "%'.$nm_org.'%" and 
						jb.nm_jab 		like "%'.$nm_jab.'%" and 
						jb.ket_jab 		like "%'.$ket_jab.'%"  
						
					ORDER BY 
						jb.tgl_lantik desc';
			// jb.tgl_lantik 	like "%'.$tgl_lantik.'%" and 
			// jb.tgl_purna 	like "%'.$tgl_purna.'%" and 

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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_djabatan]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_djabatan]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nm_org'].'</label></td>
							<td><label class="control-label">'.$res['nm_jab'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl_lantik']).'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl_purna']).'</label></td>
							<td><label class="control-label">'.$res['ket_jab'].'</label></td>
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
