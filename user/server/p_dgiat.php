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

		case 'combo':
			switch($menu){
				case 'mgolongan':
					$sql	= 'SELECT * from  mgolongan';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// var_dump($datax);exit();
					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($datax!=NULL){
							$out='{ 
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"gagal"}';
						}
					}
					echo $out;
				break;

		}
		break;
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * 
					FROM
						drkegpram dr
						JOIN manggota ma on ma.id_manggota= dr.id_manggota
						JOIN mgolongan mg on mg.id_mgolongan= dr.id_mgolongan
					WHERE 
						dr.id_drkegpram = '.$_GET['id_drkegpram'];
			// print_r($sql);exit();

			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"drkegpram":"'.$res['drkegpram'].'",
					"id_mgolongan":"'.$res['id_mgolongan'].'",
					"mgolongan":"'.$res['mgolongan'].'",
					"id_manggota":"'.$res['id_manggota'].'",
					"tgl":"'.$res['tgl'].'",
					"lokasi":"'.$res['lokasi'].'",
					"tingkat":"'.$res['tingkat'].'",
					"kategori":"'.$res['kategori'].'",
					"status":"'.$res['status'].'",
					"ket":"'.$res['ket'].'"
					}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE drkegpram set 
										id_manggota = '".$_POST['id_manggotaH']."',
										id_mgolongan= '".mysqli_real_escape_string($_POST['mgolonganTB'])."',
										tgl			= '".tgl_indo3(mysqli_real_escape_string($_POST['tglTB']))."',
										drkegpram 	='".mysqli_escape_string($_POST['drkegpramTB'])."',
										lokasi		= '".mysqli_real_escape_string($_POST['lokasiTB'])."',
										tingkat		= '".mysqli_real_escape_string($_POST['tingkatTB'])."',
										kategori	= '".mysqli_real_escape_string($_POST['kategoriTB'])."',
										status		= '".mysqli_real_escape_string($_POST['statusTB'])."',
										ket			= '".mysqli_real_escape_string($_POST['ketTB'])."'
							where 		id_drkegpram	= ".$_GET['id_drkegpram'];
			//print_r($sql);exit();
			$exe	= mysqli_query($con,$sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sq ='	SELECT id_manggota 
					from manggota  
					where 
						id_mlogin = '.$_SESSION['id_mloginp'];
			$r = mysqli_fetch_assoc(mysqli_query($con,$sq));
			$sql = 'INSERT into drkegpram set
										id_mgolongan	= "'.mysqli_real_escape_string($_POST['mgolonganTB']).'",
										drkegpram 	= "'.mysqli_escape_string($_POST['drkegpramTB']).'",
										tgl			= "'.tgl_indo3(mysqli_real_escape_string($_POST['tglTB'])).'",
										lokasi		= "'.mysqli_real_escape_string($_POST['lokasiTB']).'",
										tingkat		= "'.mysqli_real_escape_string($_POST['tingkatTB']).'",
										kategori	= "'.mysqli_real_escape_string($_POST['kategoriTB']).'",
										status		= "'.mysqli_real_escape_string($_POST['statusTB']).'",
										ket			= "'.mysqli_real_escape_string($_POST['ketTB']).'",
										id_manggota='.$r['id_manggota'];
			// print_r($sql);exit();
			$exe		= mysqli_query($con,$sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drkegpram where id_drkegpram ='.$_GET['id_drkegpram'];
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
			$mgolongan	= trim($_GET['mgolonganS'])?$_GET['mgolonganS']:'';
			$drkegpram	= trim($_GET['drkegpramS'])?$_GET['drkegpramS']:'';
			$lokasi 	= trim($_GET['lokasiS'])?$_GET['lokasiS']:'';
			$tingkat	= trim($_GET['tingkatS'])?$_GET['tingkatS']:'';
			$kategori	= trim($_GET['kategoriS'])?$_GET['kategoriS']:'';
			$status		= trim($_GET['statusS'])?$_GET['statusS']:'';
			$ket		= trim($_GET['ketS'])?$_GET['ketS']:'';
			

			$sql = 'SELECT * 
					FROM
						drkegpram dr
						LEFT JOIN manggota ma on ma.id_manggota= dr.id_manggota
						LEFT JOIN mgolongan mg on mg.id_mgolongan= dr.id_mgolongan
						
					WHERE 
						ma.id_mlogin	= '.$_SESSION['id_mloginp'].' and
						mg.mgolongan	like "%'.$mgolongan.'%" and
						dr.drkegpram 	like "%'.$drkegpram.'%" and
						dr.lokasi 		like "%'.$lokasi.'%" and 
						dr.tingkat 		like "%'.$tingkat.'%" and  
						dr.kategori 	like "%'.$kategori.'%"and  
						dr.status 		like "%'.$status.'%"  and
						dr.ket 			like "%'.$ket.'%"  
						
					ORDER BY 
						dr.tgl desc';
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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_drkegpram]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_drkegpram]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['drkegpram'].'</label></td>
							<td><label class="control-label">'.tgl_indo($res['tgl']).'</label></td>
							<td><label class="control-label">'.$res['lokasi'].'</label></td>
							<td><label class="control-label">'.$res['tingkat'].'</label></td>
							<td><label class="control-label">'.$res['mgolongan'].'</label></td>
							<td><label class="control-label">'.$res['kategori'].'</label></td>
							<td><label class="control-label">'.$res['status'].'</label></td>
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
