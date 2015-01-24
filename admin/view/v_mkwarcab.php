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
<script src="client/s_mkwarcab.js"></script>
<!-- <h4><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h4> -->
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR KWARTIR CABANG</div></h3>
<ol class="breadcrumb">
<?php //if($_SESSION['levelp']!='kwarcab'){?>
  <li class="active">Kwarcab /</li>
<?php //}?>
  <li><a href="kwaran"> Kwaran </a>/</li>
  <li><a href="gudep"> Gudep </a></li>
</ol>

<!-- <a href="?menu=vgol" id="golBC" class="btn btn-secondary"><i class='icon-arrow-left'></i> Golongan</a> -->
<div>
	<?php if($_SESSION['levelp']=='kwarda'){?>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<?php }?>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>
	

<!--panel 1-->
<div xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
			<input type="hidden" id="idformTB" name="idformTB"/>
			<input type="hidden" id="id_mloginTB" name="id_mloginTB"/>
			<input type="hidden" id="id_malamatTB" name="id_malamatTB"/>
			
			<legend>Data Login</legend>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls" >
					<input type="email" name="emailTB" id="emailTB" required placeholder="email">
				</div>
				<span id="golInfo"></span>
			</div>

			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls" >
					<input type="password" name="paswotTB" id="paswotTB" required placeholder="password">
				</div>
				<span id="golInfo"></span>
			</div>
			
			<legend>Data Umum</legend>
			<div class="control-group">
				<label class="control-label">Kota</label>
				<div class="controls" >
					<select name="id_mkotaTB" id="id_mkotaTB" required >
						<option value="">silahkan pilih kota</option>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Nomer Kwarcab</label>
				<div class="controls" >
	            	<input type="text" placeholder="no. kwarcab" class="span1" size="4" maxlength="3" name="nomer_kwarcabTB" id="nomer_kwarcabTB"required />
					<input type="hidden" id="nomer_kwarcabH" name="nomer_kwarcabH">
					<span id="nomer_kwarcabInfo"></span>
				</div>
			</div>

			<legend>Data Alamat</legend>

			<div class="control-group">
				<label class="control-label">Kantor</label>
				<div class="controls" >
					<input name="pre_malamatTB" id="pre_malamatTB" required placeholder="alamat kantor">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Alamat</label>
				<div class="controls" >
					<input name="malamatTB" id="malamatTB" required placeholder="alamat lengkap">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Kecamatan</label>
				<div class="controls" >
					<select name="id_mkecTB" id="id_mkecTB" required >
						<option value="">silahkan pilih Kota dahulu ..</option>
					</select>
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
					<input  placeholder="isikan alamat website" name="webTB" id="webTB" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_1</label>
				<div class="controls" >
					<input name="telp_1TB" id="telp_1TB" placeholder="isikan nomer telp 1">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_2</label>
				<div class="controls" >
					<input name="telp_2TB" id="telp_2TB" placeholder="isikan nomer telp 2" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_3</label>
				<div class="controls" >
					<input name="telp_3TB" id="telp_3TB" placeholder="isikan nomer telp 3" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">FAX</label>
				<div class="controls" >
					<input name="faxTB" id="faxTB"  placeholder="isikan nomer fax">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Ketua Kwarcab</label>
				<div class="controls" >
					<input name="ketua_cabTB" id="ketua_cabTB"  required placeholder="isikan Nama Ketua Kwarcab">
				</div>
			</div>



		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div xclass="span11" id="v_kegPN"></br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
	<tr>
			<td></td>
			<td><input class="span1" placeholder="nomer kwarcab .." name="nomer_kwarcabTS" id="nomer_kwarcabTS"></td>
			<td><input class="span1" placeholder="nama kwarcab .." name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="alamat .." name="malamatTS" id="malamatTS"></td>
			<td><input class="span1" placeholder="kode pos .." name="kode_posTS" id="kode_posTS"></td>
			<td><input class="span1" placeholder="web .." name="webTS" id="webTS"></td>
			<td><input class="span1" placeholder="telp .." name="telp_1TS" id="telp_1TS"></td>
			<td><input class="span1" placeholder="fax .." name="faxTS" id="faxTS"></td>
			<td><input class="span1" placeholder="ketua Kwarcab .." name="ketua_cabTS" id="ketua_cabTS"></td>
			<td></td>
		</tr>
	<tr class="info">
		<td><b>No.</b></td>
		<td><b>Nomer Kwarcab</b></td>
		<td><b>Nama Kwarcab</b></td>
		<td><b>Alamat</b></td>
		
		<td><b>Kode Pos</b></td>
		<td><b>Web</b></td>
		<td><b>Telp</b></td>
		<td><b>Fax</b></td>
		<td><b>Ketua Kwarcab</b></td>
		<td colspan="2"><b>Action</b>
		</td>
	</tr>

	<tbody id="isi">

	</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
