<style>
	#loadarea{
		height:45px;
	}#pagination{
		color:white;list-style:none;
	}.vwimg{
		height:80px;
		opacity:0.8;
	}.vwimg:hover{
		opacity:1;
	}.error-info{
		/*padding: .2em .6em .3em;*/
		padding: .4em;
		font-size: 75%;
		font-weight: bold;
		line-height: 1;
		color: #ffffff;
		border-radius: .25em;
		background-color:red;
	}.trtable:hover{
		background-color:#3FC;
	}.upperizer{
		text-transform:uppercase;
	}.capitizer{
		text-transform:capitalize;
	}

</style>
<script src="client/s_mkwaran.js"></script>
<!-- <h4><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h4> -->
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR KWARTIR</div></h3>
<ol class="breadcrumb">
<?php //if($_SESSION['levelp']!='kwarcab'){?>
  <li><a href="kwarcab">Kwarcab </a>/</li>
<?php //}?>
  <li class="active">Kwaran  /</li>
  <li><a href="gudep"> Gudep </a></li>
</ol>

<!-- <a href="?menu=vgol" id="golBC" class="btn btn-secondary"><i class='icon-arrow-left'></i> Golongan</a> -->
<div>
	<?php if($_SESSION['levelp']=='kwarda' or $_SESSION['levelp']=='kwarcab' ){?>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<?php }?>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>
	

<!--panel 1-->
<div xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
			<input type="hidden" id="idformTB" name="idformTB"/>
			<input type="hidden" id="id_malamatH" name="id_malamatH"/>
			<input type="hidden" id="id_mloginH" name="id_mloginH"/>

			<legend>Data Login</legend>
			<div class="control-group">
				<label class="control-label">Username</label>
				<div class="controls" >
					<input type="email" name="emailTB" id="emailTB" required placeholder="username">
				</div>
				<span id="golInfo"></span>
			</div>

			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls" >
					<input name="paswotTB" id="paswotTB" type="password" required placeholder="password">
				</div>
				<span id="golInfo"></span>
			</div>

			<legend>Data Umum</legend>
			<div class="control-group">
				<label class="control-label">Kwarcab</label>
				<div class="controls" >
				<select name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih Kwarcab ...</option>
				</select>
				</div>
				<span id="golInfo"></span>
			</div>

			<div class="control-group">
				<label class="control-label">Kecamatan</label>
				<div class="controls" >
					<select name="id_mkecTB" id="id_mkecTB" required >
						<option value="">silahkan pilih KWARCAB dahulu</option>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Nomer Kwaran</label>
				<div class="controls" >
	            	<input type="text" placeholder="isikan nomer kwaran" name="nomer_kwaranTB" id="nomer_kwaranTB" required />
				</div>
				<span id="golInfo"></span>
			</div>
			

			<legend>Data Alamat</legend>
			<div class="control-group">
				<label class="control-label">Kantor</label>
				<div class="controls" >
					<input name="pre_malamatTB" id="pre_malamatTB" required placeholder="alamat lengkap">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Alamat</label>
				<div class="controls" >
					<input name="malamatTB" id="malamatTB" required placeholder="alamat lengkap">
				</div>
			</div>

			
			<div class="control-group">
				<label class="control-label">Kode Pos</label>
				<div class="controls" >
					<input name="kode_posTB" id="kode_posTB" required placeholder="kode pos">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">WEB</label>
				<div class="controls" >
					<input name="webTB" id="webTB" placeholder="web" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_1</label>
				<div class="controls" >
					<input name="telp_1TB" id="telp_1TB" placeholder="telp 1" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_2</label>
				<div class="controls" >
					<input name="telp_2TB" id="telp_2TB" placeholder="telp 2" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_3</label>
				<div class="controls" >
					<input name="telp_3TB" id="telp_3TB" placeholder="telp 3" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">FAX</label>
				<div class="controls" >
					<input name="faxTB" id="faxTB" placeholder="fax" >
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Ketua Ranting</label>
				<div class="controls" >
					<input name="ketua_ranTB" id="ketua_ranTB" required placeholder="Ketua Kwaran" >
				</div>
			</div>



		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div xclass="span8"id="v_kegPN"></br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
	<tr>
			<td></td>
			<td><input class="span1" placeholder="nomer kwaran .." name="nomer_kwaranTS" id="nomer_kwaranTS"></td>
			<td><input class="span1" placeholder="nama kwaran .." name="mkecTS" id="mkecTS"></td>
			<td><input class="span1" placeholder="nama kwarcab .." name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="alamat .." name="malamatTS" id="malamatTS"></td>
			<td><input class="span1" placeholder="kode pos .." name="kode_posTS" id="kode_posTS"></td>
			<td><input class="span1" placeholder="web .." name="webTS" id="webTS"></td>
			<td><input class="span1" placeholder="telp .." name="telp_1TS" id="telp_1TS"></td>
			<td><input class="span1" placeholder="fax .." name="faxTS" id="faxTS"></td>
			<td><input class="span1" placeholder="ketua_ran .." name="ketua_ranTS" id="ketua_ranTS"></td>
			<td></td>
		</tr>

	<tr class="info">
		<td><b>No.</b></td>
		<td><b>Nomer kwaran</b></td>
		<td><b>Nama Kwaran</b></td>
		<td><b>Nama Kwarcab</b></td>
		
		<td><b>Alamat</b></td>
		
		<td><b>Kode Pos</b></td>
		<td><b>Web</b></td>
		<td><b>telp_1</b></td>
		<td><b>Fax</b></td>
		<td><b>Ketua Ranting</b></td>
		
		<td colspan="2"><b>Action</b></td>
	</tr>

	<tbody id="isi">

	</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
