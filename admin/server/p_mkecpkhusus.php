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
			switch($menu){
				case 'mkatkecpkhusus':
					$sql	= 'SELECT *  from mkatkecpkhusus order by mkatkecpkhusus asc'; //diganti
					$exe	= mysqli_query($con,$sql);
					$datax	= array();

					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out = '{"status":"error db"}';
					}else{
						if($datax!=NULL){
							echo json_encode($datax);
						}else{
							echo '{"status":"kosong"}';
						}
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT mk.* 
					FROM 	mkecpkhusus mk
							join mkatkecpkhusus kat on kat.id_mkatkecpkhusus = mk.id_mkatkecpkhusus
					WHERE 	mk.id_mkecpkhusus ='.$_GET['id_mkecpkhusus'];

			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkatkecpkhusus":"'.$res['id_mkatkecpkhusus'].'",
					"mkecpkhusus":"'.$res['mkecpkhusus'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				 
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mkecpkhusus set id_mkatkecpkhusus	= "'.mysqli_real_escape_string($_POST['id_mkatkecpkhususTB']).'",
											mkecpkhusus			= "'.mysqli_real_escape_string($_POST['mkecpkhususTB']).'"
										WHERE id_mkecpkhusus 	= '.$_GET['id_mkecpkhusus'];
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mkecpkhusus set	id_mkatkecpkhusus= '.$_POST['id_mkatkecpkhususTB'].',
												mkecpkhusus 	 = "'.mysqli_real_escape_string(trim($_POST['mkecpkhususTB'])).'"';
			//print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mkecpkhusus  where id_mkecpkhusus  ='.$_GET['id_mkecpkhusus'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mkecpkhusus = trim($_GET['mkecpkhususS'])?$_GET['mkecpkhususS']:'';
			$mkatkecpkhusus = trim($_GET['mkatkecpkhususS'])?$_GET['mkatkecpkhususS']:'';
			$sql = 'SELECT * 
					FROM 
						mkecpkhusus mk
						join mkatkecpkhusus kat on kat.id_mkatkecpkhusus = mk.id_mkatkecpkhusus
					WHERE 
						mk.mkecpkhusus like "%'.$mkecpkhusus.'%" and
						kat.mkatkecpkhusus like "%'.$mkatkecpkhusus.'%" 
					ORDER BY 
						mk.mkecpkhusus asc';
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
								 <a class="btn btn-secondary" href="javascript:editmkecpkhusus(\''.$res['id_mkecpkhusus'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmkecpkhusus(\''.$res['id_mkecpkhusus'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td><label class="control-label">'.$res['mkecpkhusus'].'</label></td>
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
