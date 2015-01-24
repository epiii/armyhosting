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
			$mgolongan 		= trim($_GET['mgolonganS'])?$_GET['mgolonganS']:'';
			$msubgolongan 	= trim($_GET['msubgolonganS'])?$_GET['msubgolonganS']:'';

			$sql = 'SELECT *
					FROM msubgolongan s
					LEFT JOIN mgolongan g ON g.id_mgolongan = s.id_mgolongan
					WHERE 	g.mgolongan like "%'.$mgolongan.'%" and
							s.msubgolongan like "%'.$msubgolongan.'%"
					ORDER BY
						g.mgolongan asc,s.msubgolongan asc';
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
			$jum	= mysql_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					// echo '<pre>'.print_r($res),'</pre>';exit();
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmsubgolongan(\''.$res['id_msubgolongan'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmsubgolongan(\''.$res['id_msubgolongan'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					$out.= '<tr>
							<td>'.$nox.'</td>
							<td>'.$res['msubgolongan'].'</td>
							<td>'.$res['mgolongan'].'</td>
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
				case 'mgolongan':
					$sql	= '	SELECT * from mgolongan ORDER by mgolongan asc '; 
					// print_r($sql);exit();	
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'msubgolongan':
					$where 	=empty($_GET['id_mgolongan'])?' id_msubgolongan ='.$_GET['id_msubgolongan']:' id_mgolongan ='.$_GET['id_mkeota'];
					// print_r($where);exit();
					$sql	= '	SELECT * from msubgolongan where '.$where.' order by msubgolongan ASC ';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
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
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
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
			$sql = 'SELECT * from msubgolongan WHERE id_msubgolongan='.$_GET['id_msubgolongan'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mgolongan":"'.$res['id_mgolongan'].'",
					"msubgolongan":"'.$res['msubgolongan'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  msubgolongan set 	id_mgolongan= '.mysql_real_escape_string($_POST['id_mgolonganTB']).',
										msubgolongan 	= "'.mysql_real_escape_string($_POST['msubgolonganTB']).'"
								WHERE id_msubgolongan='.$_GET['id_msubgolongan'];
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into msubgolongan set 	id_mgolongan 	= '.mysql_real_escape_string($_POST['id_mgolonganTB']).',
											msubgolongan 		= "'.mysql_real_escape_string($_POST['msubgolonganTB']).'"';
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from msubgolongan  where id_msubgolongan  ='.$_GET['id_msubgolongan'];
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
} ?>			
