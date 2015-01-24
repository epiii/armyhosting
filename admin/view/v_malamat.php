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
		background-color:re5;
	}.trtable:hover{
		background-color:#3FC;
	}.upperizer{
		text-transform:uppercase;
	}.capitizer{
		text-transform:capitalize;
	}

</style>
<script src="client/s_malamat.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR ALAMAT</div></h3>
<!-- <ol class="breadcrumb">
  <li class="active">Alamat /</li>
  <li ><a href="subunsur"> Sub Unsur </a>/</li>
  <li> <a href="unsur">Unsur</a></li>
</ol>
 -->
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- <a href="unsur"id="jabBC" class="btn btn-secondary">unsur <i class='icon-arrow-right'> </i></a> -->
</div>

<!--panel 1-->
<div class="span8"id="i_kegPN" style="display:none;"><br>
	<div class="span8">
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		
		<div class="control-group">
			<label class="control-label">Kota (di Jawa Timur)</label>
			<div class="controls" >
				<select class="span3" name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih kota ...</option>
				</select>
			</div>
			<span id="subunsurInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Kecamatan</label>
			<div class="controls" >
				<select class="span3" name="id_mkecTB" id="id_mkecTB" required>
					<option value=''>pilih Kota dahulu ...</option>
				</select>
			</div>
			<span id="subunsurInfo"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Alamat</label>
			<div class="controls" >
				<input class="span2"  name="pre_malamatTB" id="pre_malamatTB" placeholder="gedung/instansi dll.">
				<input class="span3"  name="malamatTB" id="malamatTB" required placeholder="Alamat">
			</div>
			<span id="subunsurInfo2"></span>
		</div>
		
		<div class="control-group">
			<label class="control-label">Kode Pos </label>
			<div class="controls" >
				<input class="span1" name="kode_posTB" id="kode_posTB" placeholder="kode pos" required>
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Web </label>
			<div class="controls" >
				<input class="span5" name="webTB" id="webTB" placeholder="alamat web" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">HP </label>
			<div class="controls" >
				<input class="span3" name="hpTB" id="hpTB" placeholder="nomor HP" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">telp 1 </label>
			<div class="controls" >
				<input class="span3" name="telp_1TB" id="telp_1TB" placeholder="nomor telp 1" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">telp 2 </label>
			<div class="controls" >
				<input class="span3" name="telp_2TB" id="telp_2TB" placeholder="nomor telp 2" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">telp 3 </label>
			<div class="controls" >
				<input class="span3" name="telp_3TB" id="telp_3TB" placeholder="nomor telp 2" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Fax </label>
			<div class="controls" >
				<input class="span3" name="faxTB" id="faxTB" placeholder="nomor fax" >
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
		<div >.</div>
		<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div class="span8"id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>

			<td><input class="span2" placeholder="alamat" name="malamatTS" id="malamatTS"></td>
			<td><input class="span1" placeholder="kota" name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="kecamatan" name="mkecTS" id="mkecTS"></td>
			<td><input class="span1" placeholder="kode pos" name="kode_posTS" id="kode_posTS"></td>
			<td><input class="span1" placeholder="web" name="webTS" id="webTS"></td>
			<td><input class="span1" placeholder="no HP" name="hpTS" id="hpTS"></td>
			<td><input class="span1" placeholder="telp 1" name="telp_1TS" id="telp_1TS"></td>
			<td><input class="span1" placeholder="telp 2" name="telp_2TS" id="telp_2TS"></td>
			<td><input class="span1" placeholder="telp 3" name="telp_3TS" id="telp_3TS"></td>
			<td><input class="span1" placeholder="fax" name="faxTS" id="faxTS"></td>

			<td></td>
		</tr>
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Alamat</b></td>
			<td><b>Kota</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kode_Pos</b></td>
			<td><b>Web</b></td>
			<td><b>HP</b></td>
			<td><b>telp_1</b></td>
			<td><b>telp_2</b></td>
			<td><b>telp_3</b></td>
			<td><b>fax</b></td>
			<td colspan="2"><b>Aksi</b>
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
