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
		#tampil  =============================================================================================
		case 'tampil' :
			// $malamat= t rim($_GET['malamatS'])?$_GET['malamatS']:'';
			$mkota 	= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mkec 	= trim($_GET['mkecS'])?$_GET['mkecS']:'';

			$sql = 'SELECT *
					FROM mkec kc
					LEFT JOIN mkota ko ON ko.id_mkota = kc.id_mkota
					WHERE 	ko.mkota like "%'.$mkota.'%" and
							kc.mkec like "%'.$mkec.'%"
					ORDER BY
						ko.id_mkota';
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
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmkec(\''.$res['id_mkec'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmkec(\''.$res['id_mkec'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					$out.= '<tr>
							<td>'.$nox.'</td>
							<td>'.$res['mkec'].'</td>
							<td>'.$res['mkota'].'</td>
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
			$out.= '<tr class="info"><td colspan="12">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="12">'.$obj->total.'</td></tr>';
			echo $out;
		break;
	
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mkota':
					$sql	= '	SELECT * from mkota ORDER by mkota asc '; 
					// print_r($sql);exit();	
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mkec':
					$where 	=empty($_GET['id_mkota'])?' id_mkec ='.$_GET['id_mkec']:' id_mkota ='.$_GET['id_mkeota'];
					// print_r($where);exit();
					$sql	= '	SELECT * from mkec where '.$where.' order by mkec ASC ';
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mbukeg':
					$sql	= '	SELECT * from mbukeg order by mbukeg ';
					// print_r($sql);exit();	
					$exe	= mysqli_query($con,$sql);
					$datax	= array();
					while($res=mysqli_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * from mkec WHERE id_mkec='.$_GET['id_mkec'];
			// var_dump($sql);exit();
			$exe	= mysqli_query($con,$sql);
			$res	= mysqli_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkota":"'.$res['id_mkota'].'",
					"mkec":"'.$res['mkec'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mkec set 	id_mkota= '.mysqli_real_escape_string($_POST['id_mkotaTB']).',
										mkec 	= "'.mysqli_real_escape_string($_POST['mkecTB']).'"
								WHERE id_mkec='.$_GET['id_mkec'];
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mkec set 	id_mkota 	= '.mysqli_real_escape_string($_POST['id_mkotaTB']).',
											mkec 		= "'.mysqli_real_escape_string($_POST['mkecTB']).'"';
			// print_r($sql);exit();
			$exe = mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mkec  where id_mkec  ='.$_GET['id_mkec'];
			$exe	= mysqli_query($con,$sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
} ?>			
