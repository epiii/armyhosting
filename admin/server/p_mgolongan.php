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
			$sql = 'SELECT * FROM mgolongan WHERE id_mgolongan ='.$_GET['id_mgolongan'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"mgolongan":"'.$res['mgolongan'].'",
					"umur":"'.$res['umur'].'",
					"urutan":"'.$res['urutan'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mgolongan set 	
											mgolongan	= "'.mysqli_real_escape_string($_POST['mgolonganTB']).'",
											umur		= "'.mysqli_real_escape_string($_POST['umurTB']).'",
											urutan		= "'.mysqli_real_escape_string($_POST['urutanTB']).'"
										WHERE id_mgolongan 	= '.$_GET['id_mgolongan'];
			//print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mgolongan set 
								mgolongan= "'.mysqli_real_escape_string(trim($_POST['mgolonganTB'])).'",
								umur= "'.mysqli_real_escape_string(trim($_POST['umurTB'])).'",
								urutan= "'.mysqli_real_escape_string(trim($_POST['urutanTB'])).'"
								';
			 //print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mgolongan  where id_mgolongan  ='.$_GET['id_mgolongan'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mgolongan = trim($_GET['mgolonganS'])?$_GET['mgolonganS']:'';
			$umur = trim($_GET['umurS'])?$_GET['umurS']:'';
			
			$sql = 'SELECT *
					FROM mgolongan
					WHERE 
						mgolongan like "%'.$mgolongan.'%"  and
						umur like "%'.$umur.'%" 
					ORDER BY mgolongan asc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmgolongan(\''.$res['id_mgolongan'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmgolongan(\''.$res['id_mgolongan'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td><label class="control-label">'.$res['mgolongan'].'</label></td>
								<td><label class="control-label">'.$res['umur'].'</label></td>
								<td><label class="control-label">'.$res['urutan'].'</label></td>
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
			$out.= '<tr class="info"><td colspan=9>'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan=9>'.$obj->total.'</td></tr>';
			echo $out;
	break;
} ?>			
