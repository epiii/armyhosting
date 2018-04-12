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
			$sql = 'SELECT * FROM mkatkecpkhusus WHERE id_mkatkecpkhusus ='.$_GET['id_mkatkecpkhusus'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"mkatkecpkhusus":"'.$res['mkatkecpkhusus'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mkatkecpkhusus set 	mkatkecpkhusus	= "'.mysqli_real_escape_string($_POST['mkatkecpkhususTB']).'"
										WHERE id_mkatkecpkhusus 	= '.$_GET['id_mkatkecpkhusus'];
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mkatkecpkhusus set 	
													mkatkecpkhusus= "'.mysqli_real_escape_string(trim($_POST['mkatkecpkhususTB'])).'"';
			//print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mkatkecpkhusus  where id_mkatkecpkhusus  ='.$_GET['id_mkatkecpkhusus'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mkatkecpkhusus = trim($_GET['mkatkecpkhususS'])?$_GET['mkatkecpkhususS']:'';
			$sql = 'SELECT *
					FROM mkatkecpkhusus
					WHERE mkatkecpkhusus like "%'.$mkatkecpkhusus.'%" 
					ORDER BY mkatkecpkhusus asc';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysqli_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysqli_fetch_array($result)){	
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmkatkecpkhusus(\''.$res['id_mkatkecpkhusus'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmkatkecpkhusus(\''.$res['id_mkatkecpkhusus'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					// <td>
					// 	<label onmouseover="poShow('.$nox.',1);" onmouseout="poHide('.$nox.',1);" id="po1_'.$nox.'" data-placement="right" title="detail" data-content="'.$res['ket'].'">
					// 		'.substr($res['ket'],0,40).'...
					// 	</label>
					// </td>
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td><label class="control-label">'.$res['mkatkecpkhusus'].'</label></td>
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
