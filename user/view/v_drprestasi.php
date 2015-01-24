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

<script src="client/s_drprestasi.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR PRESTASI</div></h3>
<!-- <ol class="breadcrumb">
  <li><a href="pendidikan-formal">Pendidikan Formal /</a></li>
  <li class="active">Pendidikan Informal </li>
</ol>
 --><!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
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
		
		<legend>Data Prestasi</legend>
		
		<div class="control-group">
			<label class="control-label">nm_prestasi</label>
			<div class="controls" >
				<input name="nm_prestasiTB" id="nm_prestasiTB" placeholder="nama prestasi">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tingkat</label>
			<div class="controls" >
				<input name="tingkatTB" id="tingkatTB" required placeholder="Tingkata">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tahun</label>
			<div class="controls" >
				<input name="thnTB" id="thnTB" maxlength="4" required placeholder="Tahun">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">No Sertifikat</label>
			<div class="controls" >
				<input name="no_sertifikatTB" id="no_sertifikatTB" required placeholder="No. Sertifikat">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Keterangan</label>
			<div class="controls" >
				<input name="ketTB" id="ketTB" placeholder="Keterangan">
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
			<td><input class="span1" placeholder="Nama Prestasi" name="nm_prestasiTS" id="nm_prestasiTS"></td>
			<td><input class="span1" placeholder="Tingkat" name="tingkatTS" id="tingkatTS"></td>
			<td><input class="span1" placeholder="Tahun" name="thnTS" id="thnTS"></td>
			<td><input class="span1" placeholder="No. Sertifikat" name="no_sertifikatTS" id="no_sertifikatTS"></td>
			<td><input class="span1" placeholder="Keterangan" name="ketTS" id="ketTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Nama prestasi</b></td>
			<td><b>Tingkat</b></td>
			<td><b>Tahun</b></td>
			<td><b>No. Sertifikat</b></td>
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
