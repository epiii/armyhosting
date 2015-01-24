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

<script src="client/s_dgiat.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR RIWAYAT KEGIATAN</div></h3>

<ol class="breadcrumb">
  <li class="active">Kegiatan Kepramukaan /</li>
  <li><a href="non-pramuka">Kegiatan Non Kepramukaan </a></li>
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
		<input type="hidden" id="id_manggotaH" name="id_manggotaH"/>
		
		<legend>Data Detail Riwayat Kegiatan Pramuka</legend>
		
		<div class="control-group">
			<label class="control-label">Detail Kegiatan</label>
			<div class="controls" >
				<input name="drkegpramTB" id="drkegpramTB" placeholder="Kegiatan">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Kegiatan</label>
			<div class="controls" >
				<input name="tglTB" id="tglTB" required placeholder="Tanggal Kegiatan">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Lokasi</label>
			<div class="controls" >
				<input name="lokasiTB" id="lokasiTB" required placeholder="Lokasi">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tingkat</label>
			<div class="controls" >
				<select name="tingkatTB" id="tingkatTB" required>
					<option value=''>Pilih Tingkat ..</option>
					<option value='Nasional'>Nasional</option>
					<option value='Daerah'>Daerah</option>
					<option value='Cabang'>Cabang</option>
					<option value='Ranting'>Ranting</option>
					<option value='Gudep'>Gudep</option>
				</select>
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Golongan</label>
			<div class="controls" >
				<select name="mgolonganTB" id="mgolonganTB" required>
					<option value=''>Pilih Golongan ..</option></select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Kategori</label>
			<div class="controls" >
				<select name="kategoriTB" id="kategoriTB" required>
					<option value=''>Pilih Kategori ..</option>
					<option value='Lomba'>Lomba</option>
					<option value='Pesta'>Pesta</option>
					<option value='Seminar'>Seminar</option>
					<option value='Petualangan'>Petualangan</option>
					<option value='Latihan'>Latihan</option>
					<option value='Bakti'>Bakti</option>
				</select>
			</div></div>

		<div class="control-group">
			<label class="control-label">Status</label>
			<div class="controls" >
				<select name="statusTB" id="statusTB" required>
					<option value=''>Pilih Status ..</option>
					<option value='Peserta'>Peserta</option>
					<option value='Pemateri'>Pemateri</option>
					<option value='Peninjau'>Peninjau</option>
					<option value='Panitia'>Panitia</option>					
				</select>
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
			<td><input class="span1" placeholder="Detail Kegiatan" name="drkegpramTS" id="drkegpramTS"></td>
			<td></td>
			<td><input class="span1" placeholder="Lokasi" name="lokasiTS" id="lokasiTS"></td>
			<td>
				<select name="tingkatTS" id="tingkatTS" class="span1">
					<option value="">semua</option>
					<option value="Nasional">Nasional</option>
					<option value="Daerah">Daerah</option>
					<option value="Cabang">Cabang</option>
					<option value="Ranting">Ranting</option>
					<option value="Gudep">Gudep</option>
				</select>
			</td>
			<td>
				<select name="mgolonganTS" id="mgolonganTS" class="span1">
					<option value="">semua</option>
					<option value="Siaga">Siaga</option>
					<option value="Penggalang">Penggalang</option>
					<option value="Penegak">Penegak</option>
					<option value="Pandega">Pandega</option>
					<option value="Anggota Dewasa">Anggota Dewasa</option>
				</select>
				<!-- <input class="span1" placeholder="Golongan" name="mgolonganTS" id="mgolonganTS"> -->
			</td>
			<td>
				<select name="kategoriTS" id="kategoriTS" class="span1">
					<option value="">semua</option>
					<option value="Lomba">Lomba</option>
					<option value="Pesta">Pesta</option>
					<option value="Seminar">Seminar</option>
					<option value="Petualangan">Petualangan</option>
					<option value="Latihan">Latihan</option>
					<option value="Bakti">Bakti</option>
				</select>
			</td>
			<td>
				<select name="statusTS" id="statusTS" class="span1">
					<option value="">semua</option>
					<option value="Peserta">Peserta</option>
					<option value="Pemateri">Pemateri</option>
					<option value="Peninjau">Peninjau</option>
					<option value="Panitia">Panitia</option>
				</select>
			</td>
			<td>
				<input class="span1" placeholder="Keterangan" name="ketTS" id="ketTS">
			</td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Detail Kegiatan</b></td>
			<td><b>Tanggal Kegiatan</b></td>
			<td><b>Lokasi</b></td>
			<td><b>Tingkat</b></td>
			<td><b>Golongan</b></td>
			<td><b>Kategori</b></td>
			<td><b>Status</b></td>
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
