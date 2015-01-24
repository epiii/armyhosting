<?php
    require_once 'lib/koneksi.php';
    require_once "lib/smtpmail/PHPMailer.php";
    // var_dump($_POST);exit();
    function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";    
     
        $size = strlen( $chars );
        $str='';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }
    $pass = rand_string(5); //password
    $acak = rand_string(20); // token

    $body='Selamat Datang di <b>Kwarda Jawa Timur (versi::army)</b> ,<br/> 
        informasi pendaftaran anda 
        Silahkan klik link berikut ini : <a href="http://localhost/pramuka/konfirmasi/'.$acak.'">konfirmasi</a><br/>
        kemudian masuk dengan akun dibawah ini  :<br/>
        email : '.$_POST['emailTB'].'<br>
        password : '.$pass.'<br>';

    $to = $_POST['emailTB'];
    $subject =  'Konfirmasi Pendaftaran';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host       = "smtp.gmail.com"; // SMTP server example
    //$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for    testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
    $mail->SMTPSecure = 'tls';
    $mail->Username   = "4rmyhosting@gmail.com"; // SMTP account username example
    $mail->Password   = "1tambah1=2";
    $mail->Mailer = "smtp";
    $mail->SetFrom('4rmyhosting@gmail.com', 'Kwarda Jawa Timur');
    $mail->Subject = $subject;
    $mail->AddAddress($to, "");
    $mail->MsgHTML($body);
    
    if(!$mail->Send()) {
        echo '<script>alert(\'silahkan cek koneksi internet, gagal mengirim email\');window.location=\'daftar\';</script>';
        // header('location:donasi');
    }else{
        $sql = 'INSERT into mlogin set  email   = "'.$_POST['emailTB'].'",
                                        level   = "anggota",
                                        paswot  = "'.md5($pass).'",
                                        acak    = "'.$acak.'"';
        $exe = mysql_query($sql);
        if ($exe) {
            echo '<script>alert(\'silahkan cek email  anda '.$to.' (mungkin di folder spam)\');window.location=\'masuk\';</script>';
        }else{
            echo '<script>alert(\'gagal menyimpan data \');window.location=\'masuk\';</script>';
        } 
        // header('location:masuk');
    }

?>