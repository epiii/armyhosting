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
			$sql = 'SELECT * FROM drkecpumum WHERE id_drkecpumum ='.$_GET['id_drkecpumum'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkecpumum":"'.$res['id_mkecpumum'].'",
					"drkecpumum":"'.$res['drkecpumum'].'",
					"no_sertifikat":"'.$res['no_sertifikat'].'",
					"level":"'.$res['level'].'",
					"tgl":"'.$res['tgl'].'",
					"ketergn":"'.$res['ketergn'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  drkecpumum set 	drkecpumum	= "'.mysql_real_escape_string($_POST['drkecpumumTB']).'"
										WHERE id_drkecpumum 	= '.$_GET['id_drkecpumum'];
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$s= 'SELECT id_manggota from manggota where id_mlogin='.$_SESSION['id_mloginp'];
			$q=mysql_query($s);
			$r=mysql_fetch_assoc($q);

			$sql = 'INSERT into drkecpumum set 		id_msubgolongan	= "'.$_POST['id_msubgolonganB'].'",
													tgl_pencapaian	= "'.mysql_real_escape_string(trim($_POST['tgl_pencapaianTB'])).'",
													no_sertifikat 	= "'.mysql_real_escape_string(trim($_POST['no_sertifikatTB'])).'",
													ketergn			= "'.mysql_real_escape_string(trim($_POST['ketergnTB'])).'",
													id_manggota		= '.$id_manggota;
			var_dump($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from drkecpumum  where id_drkecpumum  ='.$_GET['id_drkecpumum'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$drkecpumum = trim($_GET['drkecpumumS'])?$_GET['drkecpumumS']:'';
			$sql = 'SELECT *
					FROM drkecpumum
					WHERE drkecpumum like "%'.$drkecpumum.'%" 
					ORDER BY drkecpumum asc';
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
								 <a class="btn btn-secondary" href="javascript:editdrkecpumum(\''.$res['id_drkecpumum'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusdrkecpumum(\''.$res['id_drkecpumum'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					// <td>
					// 	<label onmouseover="poShow('.$nox.',1);" onmouseout="poHide('.$nox.',1);" id="po1_'.$nox.'" data-placement="right" title="detail" data-content="'.$res['ket'].'">
					// 		'.substr($res['ket'],0,40).'...
					// 	</label>
					// </td>
					$out.= '<tr>
								<td>'.$nox.'</td>
								<td><label class="control-label">'.$res['drkecpumum'].'</label></td>
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
