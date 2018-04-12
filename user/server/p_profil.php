<?php
	session_start();
	require_once '../../lib/koneksi.php';
	require_once '../../lib/tglindo.php'; 
	$upDir 	= '../../upload/foto/';

	$aksi	= isset($_GET['aksi'])?$_GET['aksi']:'';
	$menu	= isset($_GET['menu'])?$_GET['menu']:'';

	switch ($aksi){
#hapus akun user (dosen) secara keseluruhan secara paralel otomatis (user + dsn + histjab + dtk + bukeg) =====================
		case 'hapusAkun':
			$sql = 'DELETE from mlogin where id_mlogin ='.$_SESSION['id_mloginp'];
			$exe = mysqli_query($con,$sql);
			$out = $exe?'{"status":"sukses"}':'{"status":"gagal hapus akun"}';
			echo $out;
		break;
#hapus akun user (dosen)=======================================================================================================

#combo ========================================================================================================================
		case 'combo':
			switch($menu){
				#Kecamatan---------------------------------------------
				case 'mkec':
					$whr 	= !empty($_GET['id_mkota'])?'where id_mkota = "'.$_GET['id_mkota'].'"':'';
					$sql 	= 'SELECT * from mkec  '.$whr.' order by mkec  asc';
					$exe	= mysqli_query($con,$sql);
					$ambil  = array();
					while($ambilR	= mysqli_fetch_assoc($exe)){
						$ambil[]=$ambilR;
					}
					// print_r($sql);exit();
					
					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}echo $out;
				break;	
		#end of Kec---------------------------------------
		
		#kota---------------------------------------------
				case 'mkota':
					// $whr 	= !empty($_GET['id_mpropinsi'])?'where id_mpropinsi = "'.$_GET['id_mpropinsi'].'"':'';
					$sql 	= 'SELECT * from mkota order by mkota  asc';
					$exe	= mysqli_query($con,$sql);
					$ambil  = array();
					while($ambilR	= mysqli_fetch_array($exe)){
						$ambil[]=$ambilR;
					}
					// var_dump($sql);exit();

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}echo $out;
				break;	
		#end of kota----------------------------------------

		#kwarcab---------------------------------------------
				case 'mkwarcab':
					$sql	= 'SELECT
									kb.id_mkwarcab,
									kb.nomer_kwarcab,
									ko.id_mkota,
									ko.mkota
								from  mkwarcab kb
									join malamat al on al.id_malamat = kb.id_malamat
									join mkec kc on kc.id_mkec       = al.id_mkec
									join mkota ko on ko.id_mkota     = kc.id_mkota   
								GROUP BY 
									ko.id_mkota
								order by 
									ko.mkota asc';

					$exe	= mysqli_query($con,$sql);
					$ambil  = array();
					while($ambilR	= mysqli_fetch_array($exe)){
						$ambil[]=$ambilR;
					}
					// var_dump($sql);exit();

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;	
		#end of kota----------------------------------------
		#kwarcab---------------------------------------------
				case 'mkwaran':
					$whr 	= !empty($_GET['id_mkwarcab'])?'where kb.id_mkwarcab = "'.$_GET['id_mkwarcab'].'"':'';
					$sql	= 'SELECT
									kr.id_mkwaran,
									kr.nomer_kwaran,
									kc.mkec
								FROM
									mkwaran kr
									JOIN mkwarcab kb ON kb.id_mkwarcab = kr.id_mkwarcab
									JOIN malamat al ON al.id_malamat   = kr.id_malamat
									JOIN mkec kc ON kc.id_mkec         = al.id_mkec
								'.$whr.'
								order by 
									kc.mkec asc';
					// print_r($sql);exit();
					$exe	= mysqli_query($con,$sql);
					$ambil  = array();
					while($ambilR	= mysqli_fetch_array($exe)){
						$ambil[]=$ambilR;
					}
					// var_dump($sql);exit();

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;	
		#end of kota----------------------------------------
		#kwarcab---------------------------------------------
				case 'mgudep':
					$whr 	= !empty($_GET['id_mkwaran'])?'where mg.id_mkwaran = "'.$_GET['id_mkwaran'].'"':'';
					$sql	= 'SELECT
									mg.id_mgudep,
									mg.nomer_gudep,
									mg.nama_pangkalan
								FROM
									mgudep mg 
									JOIN mkwaran kr on kr.id_mkwaran = mg.id_mkwaran
								'.$whr.'
								ORDER BY	
									mg.nama_pangkalan ASC'
								;
					// print_r($sql);exit();
					$exe	= mysqli_query($con,$sql);
					$ambil  = array();
					while($ambilR	= mysqli_fetch_array($exe)){
						$ambil[]=$ambilR;
					}
					// var_dump($sql);exit();

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;	
		#end of kota----------------------------------------
		
			}
		break;

		case 'uploadsave':
			#eksekusi tambah file (loop)------------------------------------------
			$jum = count($_POST['fileadd']);
			// for($i=0; $i<$jum; $i++){
				// $sql	= "INSERT into bukeg set iddtk = '$iddtk', file='".$_POST['fileadd'][$i]."'";
				$sql 	= 'UPDATE tdonasi set 	bukti 	="'.$_POST['fileadd'][$i].'",
												isLunas ="o"
						 				WHERE id_tdonasi='.$_GET['id_tdonasi'];
				$exe	= mysqli_query($con,$sql);
				if($exe){
					$data	= array(
						'success'=>'berhasil_simpan_bukeg_new',
						'formData'=>$_POST	
					);
				}else{
					$data	= array(
						'error'=>'gagal_simpan_bukeg_new',
						'formData'=>$_POST	
					);
				}
			// }
			echo json_encode($data);
			#end of eksekusi tambah file (loop)----------------------------------
		break;


		case 'uploadimg':
			$error=false;
			$files=array();
			foreach($_FILES as $file){
				$tipex		= substr($file['type'],6);
				$namaAwal 	= $file['name'];
				$namaSkrg	= $_SESSION['id_mloginp'].'_'.substr((md5($namaAwal.rand())),2,10).'.'.$tipex;
				$src		= $file['tmp_name'];
				// $destix		= $upDir .basename($namaSkrg);
				$destix		= '../../upload/foto/'.basename($namaSkrg);

				#proses upload -------------------------
				//berhasil
				if(move_uploaded_file($src, $destix)){
					$files[] = $namaSkrg;
				}
				//gagal 
				else{ 
					$error = true;
				}
				#end of proses upload -------------------
			}#end of upload file (loop) -------------------------------------------------
		
			#pesan upload ---------------------------------------------------------------
			//gagal
			if($error){ 
				$data=array(
					'error' => 'gagal upload file'
					); 
			}
			//berhasil 
			else{
				$data=array(
					'files' => $files
					);	
			}
			echo json_encode($data);
			#pesan upload -------------------------------------------------------------
		break;

# edit/ubah =======================================================================================================
		case 'ubah':
			#cek id login di manggota (ada /tidak)
			$sqlc = 'SELECT * from manggota where id_mlogin = '.$_SESSION['id_mloginp'];
			$exec = mysqli_query($con,$sqlc);
			$jumc = mysqli_num_rows($exec);
			$out ='';

			# udpate : mlogin  -------------------
				if(isset($_POST['passBTB2']) && !empty($_POST['passBTB2'])){
					$sql1	='UPDATE mlogin set paswot="'.md5(trim(mysqli_real_escape_string($_POST['passBTB2']))).'" where id_mlogin='.$_SESSION['id_mloginp'];
					$exe1 = mysqli_query($con,$sql1);
					// var_dump($exe1);exit();
				}
			#end of update : mlogin 

			//upload image
				if(isset($_POST['fileadd'])){
					$foto = ' , foto="'.$_POST['fileadd'].'"';
					$r=mysqli_fetch_assoc(mysqli_query($con,'SELECT foto from manggota WHERE id_mlogin='.$_SESSION['id_mloginp']));

					unlink($upDir.$r['foto']);
				}else{
					$foto ='';
				}

			#add / update : malamat & mdonatur
				$sal=' 	malamat		= "'.trim(mysqli_real_escape_string($_POST['malamatTB'])).'",
						id_mkec		= "'.trim(mysqli_real_escape_string($_POST['id_mkecTB'])).'",
						kode_pos	= "'.trim(mysqli_real_escape_string($_POST['kode_posTB'])).'",
						web			= "'.trim(mysqli_real_escape_string($_POST['webTB'])).'",
						hp			= "'.trim(mysqli_real_escape_string($_POST['hpTB'])).'"';
						
				$sa= '  full_anggota	= "'.trim(mysqli_real_escape_string($_POST['full_anggotaTB'])).'",
						nick_anggota	= "'.trim(mysqli_real_escape_string($_POST['nick_anggotaTB'])).'",											
						temp_lahir		= "'.trim(mysqli_real_escape_string($_POST['temp_lahirTB'])).'",											
						tgl_lahir		= "'.trim(mysqli_real_escape_string(tgl_indo3($_POST['tgl_lahirTB']))).'",											
						gol_darah		= "'.trim(mysqli_real_escape_string($_POST['gol_darahTB'])).'",											
						jenis_kelamin	= "'.trim(mysqli_real_escape_string($_POST['jenis_kelaminTB'])).'",											
						agama			= "'.trim(mysqli_real_escape_string($_POST['agamaTB'])).'",											
						status_nikah	= "'.trim(mysqli_real_escape_string($_POST['status_nikahTB'])).'",											
						jenis_kecacatan	= "'.trim(mysqli_real_escape_string($_POST['jenis_kecacatanTB'])).'",											
						bakat			= "'.trim(mysqli_real_escape_string($_POST['bakatTB'])).'",											
						hobi			= "'.trim(mysqli_real_escape_string($_POST['hobiTB'])).'",											
						id_mgudep		= "'.trim(mysqli_real_escape_string($_POST['mgudepTB'])).'",											
						bahasa			= "'.trim(mysqli_real_escape_string($_POST['bahasaTB'])).'"'.$foto;											
				
				$skj= ' nm_perusahaan	= "'.trim(mysqli_real_escape_string($_POST['nm_perusahaanTB'])).'",
						bid_usaha		= "'.trim(mysqli_real_escape_string($_POST['bid_usahaTB'])).'",
						jabatan			= "'.trim(mysqli_real_escape_string($_POST['jabatanTB'])).'",
						alamat_usaha	= "'.trim(mysqli_real_escape_string($_POST['alamat_usahaTB'])).'",											
						pendapatan		= "'.trim(mysqli_real_escape_string($_POST['pendapatanTB'])).'"';

				$skel= ' nm_ibu	= "'.trim(mysqli_real_escape_string($_POST['nm_ibuTB'])).'",
						nm_ayah		= "'.trim(mysqli_real_escape_string($_POST['nm_ayahTB'])).'",
						alamat_kel	= "'.trim(mysqli_real_escape_string($_POST['alamat_kelTB'])).'",
						telp_kel	= "'.trim(mysqli_real_escape_string($_POST['telp_kelTB'])).'",											
						job_ayah	= "'.trim(mysqli_real_escape_string($_POST['job_ayahTB'])).'",
						job_ibu		= "'.trim(mysqli_real_escape_string($_POST['job_ibuTB'])).'"';

				$ssos= ' ym	= "'.trim(mysqli_real_escape_string($_POST['ymTB'])).'",
						gt		= "'.trim(mysqli_real_escape_string($_POST['gtTB'])).'",
						msn		= "'.trim(mysqli_real_escape_string($_POST['msnTB'])).'",
						skype	= "'.trim(mysqli_real_escape_string($_POST['skypeTB'])).'",											
						mirc	= "'.trim(mysqli_real_escape_string($_POST['mircTB'])).'",
						twitter	= "'.trim(mysqli_real_escape_string($_POST['twitterTB'])).'",
						fb		= "'.trim(mysqli_real_escape_string($_POST['fbTB'])).'",
						callsing_orari	= "'.trim(mysqli_real_escape_string($_POST['callsing_orariTB'])).'"';

				$sas= ' dasuransi		= "'.trim(mysqli_real_escape_string($_POST['dasuransiTB'])).'",
						jenis_asuransi	= "'.trim(mysqli_real_escape_string($_POST['jenis_asuransiTB'])).'",
						masa_asuransi	= "'.trim(mysqli_real_escape_string($_POST['masa_asuransiTB'])).'",
						kond_kesehatan	= "'.trim(mysqli_real_escape_string($_POST['kond_kesehatanTB'])).'"';											

				if ($jumc==0) { //add
					$tipex 	= 'add';	 
					$sqal	= 'INSERT INTO malamat set '.$sal;
					$sqa	= 'INSERT INTO manggota set '.$sa.', id_mlogin='.$_SESSION['id_mloginp'];
					$sqkj	= 'INSERT INTO dpekerjaan set '.$skj;
					$sqkel	= 'INSERT INTO dkeluarga set '.$skel;
					$sqsos 	= 'INSERT INTO dsosmed set '.$ssos;
					$sqas 	= 'INSERT INTO dasuransi set '.$sas;
				}else{
					$tipex 	= 'edit';	 
					$s=mysqli_fetch_assoc(mysqli_query($con,'SELECT id_manggota from manggota where id_mlogin='.$_SESSION['id_mloginp']));
					$id_manggota=$s['id_manggota'];
					$sqal  = 'UPDATE malamat set'.$sal.' WHERE  id_malamat ='.$_POST['id_malamatH'];
					$sqa   = 'UPDATE manggota set'.$sa.' WHERE  id_mlogin ='.$_SESSION['id_mloginp'];
					$sqkj  = 'UPDATE dpekerjaan set '.$skj.' WHERE  id_manggota='.$id_manggota;
					$sqkel = 'UPDATE dkeluarga set '.$skel.' WHERE    id_manggota='.$id_manggota;
					$sqsos = 'UPDATE dsosmed set '.$ssos.' WHERE    id_manggota='.$id_manggota;
					$sqas  = 'UPDATE dasuransi set '.$sas.' WHERE    id_manggota='.$id_manggota;
				}

				// print_r($sqa);exit();
				$exal = mysqli_query($con,$sqal);
				$idal =  mysqli_insert_id();
				if(!$exal){
					$out='{"status":"gagal alamat"}';
				}else{
					if($jumc==0) {//add
						$sqa.=', id_malamat 	= '.$idal;
					}
					// var_dump($sqa);exit();
					
					$exa	= mysqli_query($con,$sqa);
					$ida 	=  mysqli_insert_id();
					if (!$exa) {
						$out='{"status":"gagal anggota"}';
					} else {
						if($jumc==0) {//add
							$sqkj  .=', id_manggota 	= '.$ida;
							$sqkel .=', id_manggota 	= '.$ida;
							$sqsos .=', id_manggota 	= '.$ida;
							$sqas  .=', id_manggota 	= '.$ida;
						}

						$exkj= mysqli_query($con,$sqkj);
						if (!$exkj) {
							$out='{"status":"gagal pekerjaan"}';
						} else {
							$exkel= mysqli_query($con,$sqkel);
							if (!$exkel) {
								$out='{"status":"gagal keluarga"}';
							} else {
								$exsos= mysqli_query($con,$sqsos);
								if (!$exsos) {
									$out='{"status":"gagal sosmed"}';
								} else {
									$exas= mysqli_query($con,$sqas);
									if (!$exas) {
										// var_dump($sqas);exit();
										$out='{"status":"gagal asuransi"}';
									} else {
										// if(!empty($_POST['fileadd'])){
										// 	$jum = count($_POST['fileadd']);
										// 	for($i=0; $i<$jum; $i++){
										// 		// $sql	= "INSERT into bukeg set iddtk = '$iddtk', file='".$_POST['fileadd'][$i]."'";
										// 		$sql 	= 'UPDATE tdonasi set 	bukti 	="'.$_POST['fileadd'][$i].'",
										// 										isLunas ="o"
										// 				 				WHERE id_tdonasi='.$_GET['id_tdonasi'];
										// 		$exe	= mysqli_query($con,$sql);
										// 		if($exe){
										// 			$data	= array(
										// 				'success'=>'berhasil_simpan_bukeg_new',
										// 				'formData'=>$_POST	
										// 			);
										// 		}else{
										// 			$data	= array(
										// 				'error'=>'gagal_simpan_bukeg_new',
										// 				'formData'=>$_POST	
										// 			);
										// 		}
										// 	}
										// }else{
											$out='{
													"status":"sukses"
												}';
													// "tipe":"'.$tipex.'"
										// }
									} #eo asuransi					
								}#eo sosmed			
							}#eo kelyarga			
						}#eo pekerjaan			
					}#eo anggota
				}#eo alamat
			#add / update : malamat & mdonatur
			echo $out;
		break;
#end of ubah ================================================================================
		
#view (login + biodata)  ==========================================================
		case 'tampil' :
			$sql = 'SELECT * 
					from 
						mlogin l 
						LEFT JOIN (
							SELECT 
								a.id_mlogin,
								a.id_manggota,
								a.full_anggota,
								a.nick_anggota,
								a.temp_lahir,
								a.tgl_lahir,
								a.gol_darah,
								a.jenis_kelamin,
								a.agama,
								a.status_nikah,
								a.jenis_kecacatan,
								a.bakat,
								a.hobi,
								a.bahasa,
								a.foto,
								al.id_malamat,
								al.malamat,
								al.kode_pos,
								al.hp,
								al.web,
								kc.id_mkec,
								ko.id_mkota,
								kc.mkec,
								ko.mkota,
								g.id_mgudep,
								g.nomer_gudep,
								g.nama_pangkalan as nm_mgudep,
								tbkwr.id_mkwaran,
								tbkwr.nomer_kwaran,
								tbkwr.nm_mkwaran,
								tbkwb.id_mkwarcab,
								tbkwb.nomer_kwarcab,
								tbkwb.nm_mkwarcab,
								kj.nm_perusahaan,
								kj.bid_usaha,
								kj.jabatan,
								kj.alamat_usaha,
								kj.pendapatan,
								kg.nm_ayah,
								kg.nm_ibu,
								kg.alamat_kel,
								kg.telp_kel,
								kg.job_ayah,
								kg.job_ibu,
								sos.ym,
								sos.gt,
								sos.msn,
								sos.skype,
								sos.mirc,
								sos.twitter,
								sos.fb,
								sos.callsing_orari,
								asr.dasuransi,
								asr.masa_asuransi,
								asr.kond_kesehatan,
								asr.jenis_asuransi
							FROM	
								manggota a
								JOIN malamat al on al.id_malamat = a.id_malamat
								JOIN mkec kc on kc.id_mkec= al.id_mkec
								JOIN mkota ko on ko.id_mkota= kc.id_mkota
								JOIN mgudep g on g.id_mgudep = a.id_mgudep
								JOIN (
									SELECT 		
										kwr.id_mkwaran,
										kwr.nomer_kwaran,
										kwr.id_mkwarcab,
										kcm.mkec as nm_mkwaran
									from mkwaran kwr  
										join malamat alm on alm.id_malamat= kwr.id_malamat
										join mkec kcm on kcm.id_mkec= alm.id_mkec
								)tbkwr on tbkwr.id_mkwaran = g.id_mkwaran
								JOIN(
									SELECT 		
										kwb.id_mkwarcab,
										kwb.nomer_kwarcab,
										kot.mkota as nm_mkwarcab
									from mkwarcab kwb
										join malamat alm on alm.id_malamat= kwb.id_malamat
										join mkec kcm on kcm.id_mkec= alm.id_mkec
										join mkota kot on kot.id_mkota= kcm.id_mkota
								)tbkwb on tbkwb.id_mkwarcab = tbkwr.id_mkwarcab
								JOIN dpekerjaan kj on kj.id_manggota = a.id_manggota
								JOIN dkeluarga kg on kg.id_manggota= a.id_manggota
								JOIN dsosmed sos on sos.id_manggota= a.id_manggota
								JOIN dasuransi asr on asr.id_manggota= a.id_manggota

						)tbprof on tbprof.id_mlogin  = l.id_mlogin
					WHERE
						l.id_mlogin ='.$_SESSION['id_mloginp'];
			
			$exe 		= mysqli_query($con,$sql);
			$res 		= mysqli_fetch_assoc($exe);
			$tgl_lahir  = ($res['tgl_lahir']!=NULL)?tgl_indo4($res['tgl_lahir']):'[kosong]';	
			$hobi       = ($res['hobi']!=NULL)?$res['hobi']:'[kosong]';	
			// var_dump($hobi);exit();
			
			if($exe){
				echo'{
					"email":"'.$res['email'].'",

					"full_anggota":"'.$res['full_anggota'].'",
					"nick_anggota":"'.$res['nick_anggota'].'",
					"temp_lahir":"'.$res['temp_lahir'].'",
					"tgl_lahir":"'.$tgl_lahir.'",
					"gol_darah":"'.$res['gol_darah'].'",
					"jenis_kelamin":"'.$res['jenis_kelamin'].'",
					"agama":"'.$res['agama'].'",
					"status_nikah":"'.$res['status_nikah'].'",
					"jenis_kecacatan":"'.$res['jenis_kecacatan'].'",
					"bakat":"'.$res['bakat'].'",
					"foto":"'.$res['foto'].'",
					"bahasa":"'.$res['bahasa'].'",
					"hobi":"'.$hobi.'",
					
					"id_malamat":"'.$res['id_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"id_mkec":"'.$res['id_mkec'].'",
					"mkec":"'.$res['mkec'].'",
					"mkota":"'.$res['mkota'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"kode_pos":"'.$res['kode_pos'].'",
					"hp":"'.$res['hp'].'",
					
					"id_mgudep":"'.$res['id_mgudep'].'",
					"nm_mgudep":"'.$res['nm_mgudep'].'",
					"id_mkwaran":"'.$res['id_mkwaran'].'",
					"nm_mkwaran":"'.$res['nm_mkwaran'].'",
					"id_mkwarcab":"'.$res['id_mkwarcab'].'",
					"nm_mkwarcab":"'.$res['nm_mkwarcab'].'",

					"nm_perusahaan":"'.$res['nm_perusahaan'].'",
					"bid_usaha":"'.$res['bid_usaha'].'",
					"jabatan":"'.$res['jabatan'].'",
					"alamat_usaha":"'.$res['alamat_usaha'].'",
					"pendapatan":"'.$res['pendapatan'].'",

					"nm_ayah":"'.$res['nm_ayah'].'",
					"nm_ibu":"'.$res['nm_ibu'].'",
					"job_ayah":"'.$res['job_ayah'].'",
					"job_ibu":"'.$res['job_ibu'].'",
					"telp_kel":"'.$res['telp_kel'].'",
					"alamat_kel":"'.$res['alamat_kel'].'",

					"fb":"'.$res['fb'].'",
					"web":"'.$res['web'].'",
					"gt":"'.$res['gt'].'",
					"mirc":"'.$res['mirc'].'",
					"msn":"'.$res['msn'].'",
					"skype":"'.$res['skype'].'",
					"twitter":"'.$res['twitter'].'",
					"ym":"'.$res['ym'].'",
					"callsing_orari":"'.$res['callsing_orari'].'",
					
					"dasuransi":"'.$res['dasuransi'].'",
					"jenis_asuransi":"'.$res['jenis_asuransi'].'",
					"masa_asuransi":"'.$res['masa_asuransi'].'",
					"kond_kesehatan":"'.$res['kond_kesehatan'].'"
				}';
			}else{
				echo '{"status":"kosong"}';	
			}
		break;
#end of tampil  =====================================================================================
	}
?>