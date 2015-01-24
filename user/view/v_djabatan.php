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

<script src="client/s_djabatan.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR RIWAYAT JABATAN DILUAR PRAMUKA</div></h3>
<!-- <ol class="breadcrumb">
  <li><a href="pendidikan-formal">Pendidikan Formal /</a></li>
  <li class="active">Pendidikan Informal </li>
</ol> -->
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	
	<!-- cetak report (pdf) -->
	<input type ="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesip']; ?>" id="idsesiH">
	<input type ="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginp']; ?>" id="id_mloginH">
	<button id  ="cetakBC" class="btn btn-default"><i class="icon-print"></i> cetak</button>
	<!-- cetak report (pdf) -->		
</div>


<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div align="left" class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		
		<legend>Data Jabatan Diluar Pramuka</legend>
		
		<div class="control-group">
			<label class="control-label">Nama Organisasi</label>
			<div class="controls" >
				<input name="nm_orgTB" id="nm_orgTB" required placeholder=" Nama Organisasi">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Nama Jabatan</label>
			<div class="controls" >
				<input name="nm_jabTB" id="nm_jabTB" required placeholder="Nama Jabatan">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Dilantik</label>
			<div class="controls" >
				<input name="tgl_lantikTB" id="tgl_lantikTB" required placeholder="Tanggal Dilantik">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Purna</label>
			<div class="controls" >
				<input name="tgl_purnaTB" id="tgl_purnaTB" required placeholder="Tanggal Purna">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Keterangan Jabatan</label>
			<div class="controls" >
				<input name="ket_jabTB" id="ket_jabTB">
			</div>
			
		</div>
		
		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>

<divX id="loadtabel"></divX>

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span1" placeholder="Nama Organisasi" name="nm_orgTS" id="nm_orgTS"></td>
			<td><input class="span1" placeholder="Nama Jabatan" name="nm_jabTS" id="nm_jabTS"></td>
			<td><input class="span1" placeholder="Tanggal Dilantik " name="tgl_lantikTS" id="tgl_lantikTS"></td>
			<td><input class="span1" placeholder="Tanggal Purna" name="tgl_purnaTS" id="tgl_purnaTS"></td>
			<td><input class="span1" placeholder="Keterangan" name="ket_jabTS" id="ket_jabTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama Organisasi</b></td>
			<td><b>Nama Jabatan</b></td>
			<td><b>Tanggal Dilantik</b></td>
			<td><b>Tanggal Purna</b></td>
			<td><b>Keterangan</b></td>
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
