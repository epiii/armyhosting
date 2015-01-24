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

<script src="client/s_dbina.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR RIWAYAT MEMBINA</div></h3>
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
		
		<legend>Data Membina</legend>
		
		<div class="control-group">
			<label class="control-label">Keahlian</label>
			<div class="controls" >
				<input name="keahlianTB" id="keahlianTB" placeholder="Keahlian">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tahun Membina</label>
			<div class="controls" >
				<input name="thn_binaTB" id="thn_binaTB" maxlength="4" required placeholder="Tahun Membina">
			</div>
			
		</div>
		<div class="control-group">
			<label class="control-label">Tahun Selesai</label>
			<div class="controls" >
				<input name="thn_selesaiTB" id="thn_selesaiTB" maxlength="4" required placeholder="Tahun Selesai">
			</div>
			
		</div>
		
		<div class="control-group">
			<label class="control-label">Kwarcab</label>
			<div class="controls" >
				<select name="id_mkwarcabTB" id="id_mkwarcabTB" required>
					<option value=''>pilih Kwarcab ...</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Kwaran</label>
			<div class="controls" >
				<!-- <select onchange="combomgudep(this.value,'');" name="id_mkwaranTB" id="id_mkwaranTB" required> -->
				<select name="id_mkwaranTB" id="id_mkwaranTB" required>
					<option value=''>pilih Kwaran dahulu ...</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Gudep</label>
			<div class="controls" >
				<select name="id_mgudepTB" id="id_mgudepTB" required>
					<option value=''>pilih Gudep dahulu ...</option>
				</select>
			</div>
		</div>
		
<!-- 		<div class="control-group">
			<label class="control-label">No. Gudep</label>
			<div class="controls" >
				<input name="id_mgudepTB" id="id_mgudepTB" required placeholder="No. Gudep">
			</div>
			<span id="mkotaInfo"></span>
			
		</div>
 -->		<div class="control-group">
			<label class="control-label">Keterangan</label>
			<div class="controls" >
				<input name="ket_binaTB" id="ket_binaTB" placeholder="Keterangan">
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
			<td><input class="span1" placeholder="Keahlian" name="keahlianTS" id="keahlianTS"></td>
			<td><input class="span1" placeholder="Tahun Membina" name="thn_binaTS" id="thn_binaTS"></td>
			<td><input class="span1" placeholder="Tahun Selesai" name="thn_selesaiTS" id="thn_selesaiTS"></td>
			<td><input class="span1" placeholder="No. Gudep" name="no_gudepTS" id="no_gudepTS"></td>
			<td><input class="span1" placeholder="Keterangan" name="ket_binaTS" id="ket_binaTS"></td>
			<td></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Keahlian</b></td>
			<td><b>Tahun Membina</b></td>
			<td><b>Tahun Selesai</b></td>
			<td><b>No. Gudep</b></td>
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
