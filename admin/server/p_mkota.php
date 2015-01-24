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
				case 'mkota':
					$sql	= '	SELECT 
									kk.cum,m3.msubunsur3, m4.msubunsur4,m5.msubunsur5, m6.mkota, m6.id_mkota
								from 
								    msubunsur3 m3 , msubunsur4 m4, msubunsur5 m5,katkeg kk, mkota m6
								where 
									m3.id_msubunsur3 = m4.id_msubunsur3 and
									m4.id_msubunsur4 = m5.id_msubunsur4 and
									m5.id_msubunsur5 = m6.id_msubunsur5 and 
									m3.id_katkeg= kk.idkatkeg 
								ORDER by 
								 	kk.cum,m3.msubunsur3 asc '; 

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

				case 'subkatkeg':
					$sql	= '	SELECT * from subkatkeg order by subkatkeg ';
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
			$sql = 'SELECT * FROM mkota WHERE id_mkota ='.$_GET['id_mkota'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"mkota":"'.$res['mkota'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mkota set 	mkota	= "'.mysql_real_escape_string($_POST['mkotaTB']).'"
										WHERE id_mkota 	= '.$_GET['id_mkota'];
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mkota set mkota= "'.mysql_real_escape_string(trim($_POST['mkotaTB'])).'"';
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mkota  where id_mkota  ='.$_GET['id_mkota'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mkota = trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$sql = 'SELECT *
					FROM mkota
					WHERE mkota like "%'.$mkota.'%" 
					ORDER BY mkota asc';
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
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmkota(\''.$res['id_mkota'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmkota(\''.$res['id_mkota'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					// <td>
					// 	<label onmouseover="poShow('.$nox.',1);" onmouseout="poHide('.$nox.',1);" id="po1_'.$nox.'" data-placement="right" title="detail" data-content="'.$res['ket'].'">
					// 		'.substr($res['ket'],0,40).'...
					// 	</label>
					// </td>
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td><label class="control-label">'.$res['mkota'].'</label></td>
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
