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
<script src="client/s_mkec.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR KECAMATAN</div></h3>
<ol class="breadcrumb">
  <li ><a href="kota">Kota </a>/</li>
  <li class="active">Kecamatan </li>
</ol>

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
				<input type="text" class="span3" name="mkecTB" id="mkecTB" placeholder="kecamatan" required>
			</div>
			<span id="subunsurInfo"></span>
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
			<td><input class="span3" placeholder="Pencarian Kecamatan" name="mkecTS" id="mkecTS"></td>
			<td><input class="span3" placeholder="Pencarian Kota" name="mkotaTS" id="mkotaTS"></td>
			<td></td>
		</tr>
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kota</b></td>
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
