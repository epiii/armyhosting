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

<script src="client/s_drpendf.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR RIWAYAT PENDIDIKAN FORMAL</div></h3>
<ol class="breadcrumb">
  <li class="active">Pendidikan Formal /</li>
  <li><a href="pendidikan-informal">Pendidikan informal </a></li>
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
		
		<legend>Data Sekolah</legend>
		<div class="control-group">
			<label class="control-label">Kota</label>
			<div class="controls" >
				<select name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih Kota ...</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select name="id_mkecTB" id="id_mkecTB" required>
					<option value=''>pilih kecamatan ...</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">pendidikan</label>
			<div class="controls" >
				<select name="pendidikanTB" id="pendidikanTB" required>
					<option value=''>pilih pendidikan  ...</option>
					<option value='SD'>SD</option>
					<option value='SMP'>SMP</option>
					<option value='SMA'>SMA</option>
					<option value='D1'>D1</option>
					<option value='D2'>D2</option>
					<option value='D3'>D3</option>
					<option value='S1'>S1</option>
					<option value='S2'>S2</option>
					<option value='S3'>S3</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">nama_instansi</label>
			<div class="controls" >
				<input name="nm_instansiTB" id="nm_instansiTB" required placeholder=" sekolah">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">tahun masuk</label>
			<div class="controls" >
				<input name="thn_masukTB" id="thn_masukTB" maxlength="4" required placeholder="tahun masuk">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">tahun lulus</label>
			<div class="controls" >
				<input name="thn_lulusTB" id="thn_lulusTB"  maxlength="4" required placeholder="tahun lulus">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">no ijazah</label>
			<div class="controls" >
				<input name="no_ijazahTB" id="no_ijazahTB" required placeholder="nomer ijazah">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">fakultas / Jurusan </label>
			<div class="controls" >
				<select name="id_dsubpendfTB" id="id_dsubpendfTB">
					<option value=''>pilih fak/ jur ..</option>
				</select>
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">kelas</label>
			<div class="controls" >
				<input class="span1" placeholder="kelas" name="kelasTB" id="kelasTB" >
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">no induk</label>
			<div class="controls" >
				<input name="no_indukTB" id="no_indukTB" required placeholder="nomer induk">
			</div>
			<span id="mkotaInfo"></span>
		</div>
		<div class="control-group">
			<label class="control-label">alamat</label>
			<div class="controls" >
				<input class="span1" name="pre_malamatTB" id="pre_malamatTB"  placeholder="kantor">
				<input class="span2" name="malamatTB" id="malamatTB" required placeholder="alamat">
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
			<td><input class="span1" placeholder="pendidikan" name="pendidikanTS" id="pendidikanTS"></td>
			<td><input class="span1" placeholder="sekolah " name="nm_instansiTS" id="nm_instansiTS"></td>
			<td><input class="span1" placeholder="thn masuk" name="thn_masukTS" id="thn_masukTS"></td>
			<td><input class="span1" placeholder="thn lulus" name="thn_lulusTS" id="thn_lulusTS"></td>
			<td><input class="span1" placeholder="no ijazah" name="no_ijazahTS" id="no_ijazahTS"></td>
			<td><input class="span1" placeholder="fakultas" name="fakultasTS" id="fakultasTS"></td>
			<td><input class="span1" placeholder="jurusan" name="jurusanTS" id="jurusanTS"></td>
			<td><input class="span1" placeholder="kelas" name="kelasTS" id="kelasTS"></td>
			<td><input class="span1" placeholder="no induk" name="no_indukTS" id="no_indukTS"></td>
			<td><input class="span1" placeholder="alamat" name="malamatTS" id="malamatTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>pendidikan</b></td>
			<td><b>sekolah</b></td>
			<td><b>thn_masuk</b></td>
			<td><b>thn_lulus</b></td>
			<td><b>no_ijazah</b></td>
			<td><b>Fakultas</b></td>
			<td><b>Jurusan</b></td>
			<td><b>Kelas</b></td>
			<td><b>No. induk</b></td>
			<td><b>Alamat Sekolah</b></td>
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
