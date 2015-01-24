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
						drkegnonpram kg
						JOIN manggota a on a.id_manggota= kg.id_manggota
					WHERE 
						kg.id_drkegnonpram = '.$_GET['id_drkegnonpram'];
			// print_r($sql);exit();

			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"drkegnonpram":"'.$res['drkegnonpram'].'",
					"tgl":"'.tgl_indo4($res['tgl']).'",
					"lokasi":"'.$res['lokasi'].'",
					"stus":"'.$res['stus'].'",
					"tingkat":"'.$res['tingkat'].'",
					"plenggara":"'.$res['plenggara'].'",
					"ket":"'.$res['ket'].'"
					
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE drkegnonpram set 
										drkegnonpram= '".mysql_real_escape_string($_POST['drkegnonpramTB'])."',
										tgl			= '".mysql_real_escape_string(tgl_indo3($_POST['tglTB']))."',
										lokasi		= '".mysql_real_escape_string($_POST['lokasiTB'])."',
										tingkat		= '".mysql_real_escape_string($_POST['tingkatTB'])."',
										stus		= '".$_POST['stusTB']."',
										plenggara	= '".mysql_real_escape_string($_POST['plenggaraTB'])."',
										ket			= '".mysql_real_escape_string($_POST['ketTB'])."'
							where id_drkegnonpram	= ".$_GET['id_drkegnonpram'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into drkegnonpram set drkegnonpram 	= "'.mysql_real_escape_string($_POST['drkegnonpramTB']).'",		
												tgl				= "'.tgl_indo3(mysql_real_escape_string($_POST['tglTB'])).'",
												lokasi 			= "'.mysql_real_escape_string($_POST['lokasiTB']).'",
												tingkat			= "'.mysql_real_escape_string($_POST['tingkatTB']).'",
												stus 			= "'.$_POST['stusTB'].'",
												plenggara		= "'.mysql_real_escape_string($_POST['plenggaraTB']).'",
												ket				= "'.mysql_real_escape_string($_POST['ketTB']).'",
												id_manggota 	= (
														SELECT id_manggota 
														from manggota  
														where 
															id_mlogin = '.$_SESSION['id_mloginp'].'
												)';
			// $id_malamat	= mysql_insert_id();


			// $id1 	= mysql_insert_id();
			// print_r($sql);exit();
			$exe		= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drkegnonpram where id_drkegnonpram ='.$_GET['id_drkegnonpram'];
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
			// $tgl 		= trim($_GET['tglS'])?$_GET['glaS']:'';
			$drkegnonpram = trim($_GET['drkegnonpramS'])?$_GET['drkegnonpramS']:'';
			$lokasi       = trim($_GET['lokasiS'])?$_GET['lokasiS']:'';
			$tingkat      = trim($_GET['tingkatS'])?$_GET['tingkatS']:'';
			$stus         = trim($_GET['stusS'])?$_GET['stusS']:'';
			$plenggara    = trim($_GET['plenggaraS'])?$_GET['plenggaraS']:'';
			$ket          = trim($_GET['ketS'])?$_GET['ketS']:'';

			$sql = 'SELECT * 
					FROM
						drkegnonpram kg
						left JOIN manggota a on a.id_manggota= kg.id_manggota
					WHERE 
						a.id_mlogin 	= '.$_SESSION['id_mloginp'].'  and
						kg.drkegnonpram 	like "%'.$drkegnonpram.'%" and 
						kg.lokasi 			like "%'.$lokasi.'%" and 
						kg.tingkat 			like "%'.$tingkat.'%" and 
						kg.stus 			like "%'.$stus.'%" and  
						kg.plenggara 		like "%'.$plenggara.'%"and  
						kg.ket 				like "%'.$ket.'%"  
					ORDER BY 
						kg.tgl desc';
						// kg.tgl 				like "%'.$tgl.'%" and 

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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_drkegnonpram]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_drkegnonpram]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['drkegnonpram'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl']).'</label></td>
							<td><label class="control-label">'.$res['lokasi'].'</label></td>
							<td><label class="control-label">'.$res['tingkat'].'</label></td>
							<td><label class="control-label">'.$res['stus'].'</label></td>
							<td><label class="control-label">'.$res['plenggara'].'</label></td>
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
