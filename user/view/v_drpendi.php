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

<script src="client/s_drpendi.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR RIWAYAT PENDIDIKAN INFORMAL</div></h3>
<ol class="breadcrumb">
  <li><a href="pendidikan-formal">Pendidikan Formal /</a></li>
  <li class="active">Pendidikan Informal </li>
</ol>
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	
	<!-- cetak report (pdf) -->
	<input type="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesip']; ?>" id="idsesiH">
	<input type="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginp']; ?>" id="id_mloginH">
	<button id="cetakBC" class="btn btn-default"><i class="icon-print"></i> cetak</button>
	<!-- cetak report (pdf) -->
</div>

<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div align="left" class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		
		<legend>Data Pendidikan Informal</legend>
		
		<div class="control-group">
			<label class="control-label">Nama Kursus</label>
			<div class="controls" >
				<input name="nm_kursusTB" id="nm_kursusTB" required placeholder=" Nama kursus">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">no sertifikat</label>
			<div class="controls" >
				<input name="no_sertifikatTB" id="no_sertifikatTB" required placeholder="nomer sertifikat">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Lembaga</label>
			<div class="controls" >
				<input name="nm_lembagaTB" id="nm_lembagaTB" required placeholder=" Nama Lembaga">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Alamat Lembaga</label>
			<div class="controls" >
				<input name="alamat_pendiTB" id="alamat_pendiTB" required placeholder="Alamat Lembaga">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">Tahun Kursus</label>
			<div class="controls" >
				<input name="thn_kursusTB" id="thn_kursusTB" maxlength="4" required placeholder="Tahun Kursus">
			</div>
			<span id="mkotaInfo"></span>
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
			<td><input class="span1" placeholder="Nama Kursus" name="nm_kursusTS" id="nm_kursusTS"></td>
			<td><input class="span1" placeholder="No Sertifikat" name="no_sertifikatTS" id="no_sertifikatTS"></td>
			<td><input class="span1" placeholder="Nama Lembaga " name="nm_lembagaTS" id="nm_lembagaTS"></td>
			<td><input class="span1" placeholder="Alamat Lembaga" name="alamat_pendiTS" id="alamat_pendiTS"></td>
			<td><input class="span1" placeholder="Tahun Kursus" name="thn_kursusTS" id="thn_kursusTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama Kursus</b></td>
			<td><b>No Sertifikat</b></td>
			<td><b>Nama Lembaga</b></td>
			<td><b>Alamat Lembaga</b></td>
			<td><b>Tahun Kursus</b></td>
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
