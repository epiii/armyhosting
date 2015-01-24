<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include "../../lib/tglindo.php"; 
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	
	switch ($aksi){
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "update  kegiatan set 	katkeg	= '".mysql_real_escape_string($_POST['id_katkegTB'])."',
											nakeg	= '".mysql_real_escape_string($_POST['nakegTB'])."',
											poin	= '".mysql_real_escape_string($_POST['poinTB'])."',
											bukeg	= '".mysql_real_escape_string($_POST['bukegTB'])."',
											batut	= '".mysql_real_escape_string($_POST['batutTB'])."' 
							where idkeg=".$_POST['idkeg'];
			//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = "insert into kegiatan set 	katkeg	= '".mysql_real_escape_string($_POST['id_katkegTB'])."',
												nakeg	= '".mysql_real_escape_string($_POST['nakegTB'])."',
												poin	= '".mysql_real_escape_string($_POST['poinTB'])."',
												bukeg	= '".mysql_real_escape_string($_POST['bukegTB'])."',
												batut	= '".mysql_real_escape_string($_POST['batutTB'])."'";
			#var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#cek  ==============================================================================================
		case 'cek':
			switch($menu){
				case 'nakeg':
					if(isset($_GET['nakeg1'])and !empty($_GET['nakeg1']) ){ //edit
						$sqlx = " and not(nakeg ='$_GET[nakeg1]')";
					}else{
						$sqlx='';
					}				
					$sql	= "	SELECT * from kegiatan where katkeg='$_GET[idkatkeg]' and nakeg != '' and nakeg = '$_GET[nakeg]'".$sqlx;
					//var_dump($sql);exit();
					$exe	= mysql_query($sql);
					$jum 	= mysql_num_rows($exe);
					//var_dump($jum);exit();
					if($exe){
						if($jum>0){
							echo '{"status":"terpakai"}';
						}else{
							echo '{"status":"tersedia"}';
						}
					}else{
						echo '{"status":"error_kueri_kegiatan"}';	
					}
				break;
			}
		break;
		
		case 'ambiledit':
			$sql	= "	select *  from  kegiatan where 	idkeg = '$_GET[idkeg]'";
			//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			//var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			//var_dump($res);exit();
			if($exe){
				//var_dump($exe);exit();
				echo '{
						"kondisi":"sukses",
						"idkatkeg":"'.$res['katkeg'].'",
						"nakeg":"'.$res['nakeg'].'",
						"poin":"'.$res['poin'].'",
						"bukeg":"'.$res['bukeg'].'",
						"batut":"'.$res['batut'].'"
					}';
				// "sks":"'.$res['sks'].'"
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= "delete from kegiatan where idkeg ='$_GET[idkeg]'";
			$exe	= mysql_query($sql);
			
			//var_dump($jumz);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$sql = "SELECT *
					FROM kegiatan k
					WHERE 
						k.katkeg 	= '$menu' 
					ORDER BY idkeg DESC	";
			//var_dump($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}
			//var_dump($sql);exit();
			
			//record per halaman
			//var_dump($menu);exit();
			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;
			#end of paging	 
			
			#ada data
			if(mysql_num_rows($result)!=0)
			{
				$nox 	= $starting+1;
				//$tb	='<thead></thead><tbody>';
				while($res = mysql_fetch_array($result)){	
					$btn ="<td>
								<a class='btn' href=\"javascript:hapusKeg('$res[idkeg]','$res[katkeg]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>
							 <td>
								 <a class='btn' href=\"javascript:editKeg('$res[idkeg]');\" 
								 role='button'><i class='icon-pencil'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nakeg'].'</label></td>
							<td><label class="control-label">'.$res['poin'].'</label></td>
							'.$btn.'
						</tr>';
                	$nox++;
				}
				//echo $tb.'</tbody>';
			}
			#kosong
			else
			{
				echo "<tr align='center'>
						<td  colspan=7 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			echo "<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
	break;
	
} ?>			
