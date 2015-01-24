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

<script src="client/s_manggota.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR ANGGOTA KOTA</div></h3>
<!-- <ol class="breadcrumb">
  <li class="active">Pendidikan Formal /</li>
  <li><a href="pendidikan-informal">Pendidikan informal </a></li>
</ol>
 --><!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<!-- <button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button> -->
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- cetak report (pdf) -->
	<input type="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesip']; ?>" id="idsesiH">
	<input type="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginp']; ?>" id="id_mloginH">
	<button id="cetakBC" class="btn btn-default"><i class="icon-print"></i> cetak</button>
	<!-- cetak report (pdf) -->
</div>

<div xclass="span8" id="v_kegPN"><br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td></td>
			<td><input class="span2" placeholder="no Urut Anggota" name="no_anggotaTS" id="no_anggotaTS"></td>
			<td><input class="span2" placeholder="Nama " name="full_anggotaTS" id="full_anggotaTS"></td>
			<td>
				<select class="span1" name="jenis_kelaminTS" id="jenis_kelaminTS">
					<option value="">Semua</option>		
					<option value="L">Laki-laki</option>		
					<option value="P">Perempuan</option>		
				</select>
			</td>
			<td><input class="span1" placeholder="Pangkalan" name="nama_pangkalanTS" id="nama_pangkalanTS"></td>
			<td><input class="span1" placeholder="Kwaran" name="mkecTS" id="mkecTS"></td>
		</tr>

		<tr class="info">
			<td><b>No.</b></td>
			<td><b>No. Urut Anggota</b></td>
			<td><b>Nama</b></td>
			<td><b>Jenis Kelamin</b></td>
			<td><b>Pangkalan(Gudep)</b></td>
			<td><b>Kwaran</b></td>
		</tr>

		<tbody id="isi">

		</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
