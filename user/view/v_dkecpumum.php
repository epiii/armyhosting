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

<script src="client/s_dkecpumum.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR DETAIL KECAKAPAN UMUM</div></h3>
<ol class="breadcrumb">
  <li class="active">Daftar Kecakapan Umum /</li>
  <li><a href="kecakapan-khusus">Detail Kecakapan Khusus </a></li>
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
		<input type="hidden" id="id_malamatH" name="id_malamatH"/>
		
		<legend>Detail Riwaya Kecakapan Umum</legend>
		
		<!-- <div class="control-group">
			<label class="control-label">Nama Lengkap</label>
			<div class="controls" >
				<select name="full_anggotaTB" id="full_anggotaTB" required>
					<option value=''>Pilih Nama ...</option>
				</select>
			</div>
		</div> -->

		<div class="control-group">
			<label class="control-label">Sub Golongan</label>
			<div class="controls" >
				<select name="id_msubgolonganTB" id="id_msubgolonganTB" required>
					<option value=''>Pilih golongan ...</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Tanggal Pencapaian</label>
			<div class="controls" >
				<input name="tgl_pencapaianTB" id="tgl_pencapaianTB" required placeholder="Tanggal Pencapaian">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">No Sertifikat</label>
			<div class="controls" >
				<input name="no_sertifikatTB" id="no_sertifikatTB" required placeholder="NO Sertifikat">
			</div>
			<span id="mkotaInfo"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Keterangan</label>
			<div class="controls" >
				<input name="ketergnTB" id="ketergnTB" required placeholder="Keterangan">
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
			<!-- <td><input class="span1" placeholder="Nama Lengkkp" name="full_anggotaTS" id="full_anggotaTS"></td> -->
			<td><input class="span1" placeholder="SUb Golongan " name="msubgolonganTS" id="msubgolonganTS"></td>
			<td>
				<!-- <input class="span1" placeholder="Tanggal Pencapaian" name="tgl_pencapaianTS" id="tgl_pencapaianTS"> -->
			</td>
			<td><input class="span1" placeholder="No sertifikat" name="no_sertifikatTS" id="no_sertifikatTS"></td>
			<td><input class="span1" placeholder="Keterangan" name="ketergnTS" id="ketergnTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<!-- <td><b>Nama Lengkap</b></td> -->
			<td><b>Sub GOlongan</b></td>
			<td><b>Tanggal Pencapaian</b></td>
			<td><b>No Sertifikat</b></td>
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
