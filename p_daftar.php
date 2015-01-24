<?php
	// error_reporting(0);
	require_once 'lib/koneksi.php';
	require_once 'lib/tglindo.php';
	
	 $aksi		= isset($_POST['aksi'])?$_POST['aksi']:'';
	// $kategori	= isset($_POST['kategori'])?$_POST['kategori']:'';
	 switch($aksi){
		
		
		case 'cek':
			switch($kategori){
				case 'username':
					$sql	= "select * from m_login where username = '$_POST[_un]'";
					//var_dump($sql);exit();
					$exe	= mysql_query($sql);
					$jum	= mysql_num_rows($exe);
					if($exe && $jum>0){
						echo '{"status":"ada"}';
					}else{
						echo '{"status":"kosong"}';
					}
				break;
			}
		break;
		
		//tambah ============
		case 'tambah':
			//simpan user
												// username	= '".trim(mysql_real_escape_string($_POST['_un']))."',
				$sql1	= "insert into m_login set email	= '".trim(mysql_real_escape_string($_POST['_email']))."',
												password	= '".md5($_POST['_ps'])."',
												level		= 'anggota'";

				// var_dump($sql1);exit();
				$exe1	= mysql_query($sql1);
	
			if($exe1){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
	}
?>

 