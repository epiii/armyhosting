<?php
	#start of : cek email/password 
	require_once'lib/koneksi.php';
	// var_dump($_POST);exit();
	if(!isset($_POST)){
		echo '<script>window.location=\'./\'</script>';
	}else{
		function anti_injection($data){
			// $filter = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
			// return $filter;
			return $data;
		}

		$email = anti_injection($_POST['emailTB']);
		$paswot = anti_injection(md5($_POST['paswotTB']));

		$sql 	= '	SELECT * 
					FROM 
						mlogin 
					WHERE  
						paswot="'.$paswot.'" and email="'.$email.'"';
		$login	= mysqli_query($con,$sql);
		$ketemu	= mysqli_num_rows($login);
		$r		= mysqli_fetch_assoc($login);
		// print_r($sql);exit();

		// Apabila email dan password ditemukan
		if ($ketemu > 0){ //ada 
			if($r['isActive']=='n' and $r['acak']=='confirmed'){ //blokir
				echo '<script>alert(\'akun anda sedang diblokir, silahkan hubungi admin\');window.location=\'masuk\'</script>';
			}elseif($r['isActive']=='n' and $r['acak']!='confirmed'){ // brlum aktivasi email
				echo '<script>alert(\'anda belum aktivasi silahkan buka email anda\');window.location=\'masuk\'</script>';
			}else{ // normal
				session_start();

				$sql2 ='SELECT * from m'.$r['level'].' WHERE id_mlogin ='.$r['id_mlogin'];
				$exe2 = mysqli_query($con,$sql2);
				$res2 =  mysqli_fetch_assoc($exe2);
				// var_dump($res2);exit();
				
				$_SESSION['namap'] 		= $r['nama'];
				$_SESSION['id_mloginp'] = $r['id_mlogin'];
				$_SESSION['emailp']  	= $r['email'];
				$_SESSION['levelp']		= $r['level'];
				
				$_SESSION['login'] 		= 1;
				
				$sid_lama = session_id();
				session_regenerate_id();
				$sid_baru = session_id();
				$_SESSION['idsesip']		= $sid_baru;
				
				 //var_dump($_SESSION);exit();
		
				if($r['level']!='anggota'){ // admin
					if(empty($r['acak'])){
						// $sqlc = 'UPDATE mlogin set acak="'.base64_encode($r['email']).'" where id_mlogin='.$r['id_mlogin'];
						$sqlc = 'UPDATE mlogin set acak="confirmed" where id_mlogin='.$r['id_mlogin'];
						$exec = mysqli_query($con,$sqlc);
					}
					header("Location:admin");
				}else{ //user
					$_SESSION['namalengkap']= $res2['full_anggota'];
					header("Location:user");
				}
			}
		}else{
			echo "<script>alert('email / password salah ');window.location='masuk';</script>";
			//echo "<script>window.location='masuk';</script>";
		}
	}#end  of : cek email/password 

?>
