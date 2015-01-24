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
<script src="client/s_mgolongan.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR GOLONGAN</div></h3>
<ol class="breadcrumb">
  <li class="active">Golongan /</li>
  <li> <a href="sub-golongan">Sub Golongan</a></li>
</ol>


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
			<label class="control-label">Golongan</label>
			<div class="controls" >
				<input class="span5"  name="mgolonganTB" id="mgolonganTB" required placeholder="Golongan">
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Umur</label>
			<div class="controls" >
				<input class="span5"  name="umurTB" id="umurTB" required placeholder="Umur">
			</div>
			<span id="subunsurInfo2"></span>
		</div>

		<div class="control-group">
			<label class="control-label">Urutan</label>
			<div class="controls" >
				<input class="span5"  name="urutanTB" id="urutanTB" required placeholder="Urutan">
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
			<td><input class="span3" placeholder="pencarian golongan .." name="mgolonganTS" id="mgolonganTS"></td>
			<td><input class="span1" placeholder="umur .." name="umurTS" id="umurTS"></td>
			<td><input class="span1" placeholder="urutan .." name="urutanTS" id="urutanTS"></td>
			<td></td>
		</tr>
		<tr class="info">
			<td><b>No.</b></td>
			<td><b>Golongan</b></td>
			<td><b>Umur</b></td>
			<td><b>Urutan</b></td>
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
