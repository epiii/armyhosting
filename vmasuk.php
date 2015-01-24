<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/signin.css" rel="stylesheet">

<form class="form-signin" role="form" action="p_login.php" method="post">
  <h2 class="form-signin-heading">Masuk </h2>

  <?php 
    if(isset($_SESSION['emailp'])){
  		$user='value="'.$_SESSION['emailp'].'" ';
  		$disabled='readonly';
			$btn='<button class="btn btn-lg btn-success btn-primary" type="submit">Masuk</button>
    			  <a class="btn btn-lg btn-info btn-primary" href="logout.php">Akun Lain</a>';
  	}else{
  		$user='';
  		$disabled='';
   		$btn='<button class="btn btn-lg btn-warning btn-primary btn-block" type="submit">Masuk</button>';
  	}
  ?> 
  <input <?php echo $user.$disabled; ?> class="form-control" type="email" placeholder="email" id="emailTB" name="emailTB" required autofocus>
  <input type="password" name="paswotTB" id="paswotTB" class="form-control" placeholder="Kata Sandi" required>
  <?php echo $btn;?>
<div>
    admin <br>
    - id : kwarda@jatim.com <br>    
    - pass : lali  <br>  
    user <br>
    - id : lfree_style@yahoo.co.id <br>    
    - pass : lali  <br>  
  </div>

</form>
<p align="center" class="muted"><b>Belum punya akun? <a href="daftar" style="color:#F60"> Daftar</a></b></p>
