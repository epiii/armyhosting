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
<script src="client/s_mgudep.js"></script>
<!-- <h4><div id="loadarea"><i class="icon-th-list"></i>DAFTAR JABATAN</div></h4> -->
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR GUDEP</div></h3>
<ol class="breadcrumb">
<?php //if($_SESSION['levelp']!='kwarcab'){?>
  <li><a href="kwarcab">Kwarcab </a> /</li>
<?php //}?>
  <li><a href="kwaran"> Kwaran </a> /</li>
  <li class="active"> Gudep </li>
</ol>

<!-- <a href="?menu=vgol" id="golBC" class="btn btn-secondary"><i class='icon-arrow-left'></i> Golongan</a> -->
<div>
	<?php if($_SESSION['levelp']=='kwarda' or $_SESSION['levelp']=='kwarcab'  ){?>
	<button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button>
	<?php }?>
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
</div>
	

<!--panel 1-->
<div  id="i_kegPN" style="display:none;"><br>
	<div>
		<form autocomplete="off" method="post" name="form-daftar" class="form-horizontal" >
		<input type="hidden" id="idformTB" name="idformTB"/>
		<input type="hidden" id="id_malamatH" name="id_malamatH"/>
		<input type="hidden" id="id_mloginH" name="id_mloginH"/>

			<legend>Data Login</legend>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls" >
					<input type="email" name="emailTB" id="emailTB" required placeholder="email">
				</div>
				<span id="golInfo"></span>
			</div>

			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls" >
					<input type="password" name="paswotTB" id="paswotTB" required placeholder="password">
				</div>
				<span id="golInfo"></span>
			</div>

			<legend>Data Umum</legend>
			<div class="control-group">
				<label class="control-label">Nomer Gudep</label>
				<div class="controls" >
            		<input  class="span1" type="text" placeholder="isikan nomer gudep" name="nomer_gudepTB" id="nomer_gudepTB"required />
				</div>
				<span id="golInfo"></span>
			</div>

			<!-- </div> -->
			<div class="control-group">
				<label class="control-label">Nama Pangkalan</label>
				<div class="controls" >
	            	<input type="text" placeholder="isikan nama pangkalan" name="nama_pangkalanTB" id="nama_pangkalanTB"required />
				</div>
				<span id="golInfo"></span>
			</div>
			
			<div class="control-group">
				<label class="control-label">Tanggal Berdiri</label>
				<div class="controls" >
					<input name="tgl_berdiriTB" id="tgl_berdiriTB" required placeholder="tanggal berdiri">
				</div>
			</div>


			<div class="control-group">
				<label class="control-label">Kwarcab</label>
				<div class="controls" >
				<select name="id_mkotaTB" id="id_mkotaTB" required>
					<option value=''>pilih Kwarcab ...</option>
				</select>
				</div>
				
			</div>

			<div class="control-group">
				<label class="control-label">Kwaran</label>
				<div class="controls" >
					<select name="id_mkecTB" id="id_mkecTB" required >
						<option value="">silahkan pilih kwarcab dahulu..</option>
					</select>
				</div>
			</div>

			<legend>Data Alamat</legend>
			<div class="control-group">
				<label class="control-label">Kantor</label>
				<div class="controls" >
					<input name="pre_malamatTB" id="pre_malamatTB" placeholder="gedung/kantor">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Alamat</label>
				<div class="controls" >
					<input name="malamatTB" id="malamatTB" required placeholder="alamat lengkap">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Kode Pos</label>
				<div class="controls" >
					<input name="kode_posTB" id="kode_posTB" required placeholder="kode pos">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">WEB</label>
				<div class="controls" >
					<input name="webTB" id="webTB" placeholder="alamat web" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_1</label>
				<div class="controls" >
					<input name="telp_1TB" id="telp_1TB" placeholder="telp ">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_2</label>
				<div class="controls" >
					<input name="telp_2TB" id="telp_2TB"  placeholder="telp ">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">telp_3</label>
				<div class="controls" >
					<input name="telp_3TB" id="telp_3TB"  placeholder="telp ">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">FAX</label>
				<div class="controls" >
					<input name="faxTB" id="faxTB"  placeholder="fax">
				</div>
			</div>

			<button  id="simpanBC"class="btn btn-primary" >Simpan</button>
			<div >.</div>
			<div >.</div>
		</form>
	</div>
</div>
<divX id="loadtabel"></divX>

<div id="v_kegPN"></br>
	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
	<tr>
		<td></td>
		<td><input class="span1" placeholder="no. gudep .." name="nomer_gudepTS" id="nomer_gudepTS"></td>
		<td><input class="span2" placeholder="nama pangkalan .." name="nama_pangkalanTS" id="nama_pangkalanTS"></td>
		<td>
			<!-- <input class="span1" placeholder="tgl berdiri .." name="tgl_berdiriTS" id="tgl_berdiriTS"> -->
		</td>
		<td><input class="span1" placeholder="kwarcab.." name="mkwarcabTS" id="mkwarcabTS"></td>
		<td><input class="span1" placeholder="kwaran.." name="mkwaranTS" id="mkwaranTS"></td>
		<td><input class="span1" placeholder="alamat.." name="malamatTS" id="malamatTS"></td>
		<td><input class="span1" placeholder="kode_pos.." name="kode_posTS" id="kode_posTS"></td>
		<td><input class="span1" placeholder="web.." name="webTS" id="webTS"></td>
		<td><input class="span1" placeholder="telp_1.." name="telp_1TS" id="telp_1TS"></td>
		<td><input class="span1" placeholder="telp_2.." name="telp_2TS" id="telp_2TS"></td>
		<td><input class="span1" placeholder="telp_3.." name="telp_3TS" id="telp_3TS"></td>
		<td><input class="span1" placeholder="fax.." name="faxTS" id="faxTS"></td>
		<td></td>
	</tr>

	<tr class="info">
		<td><b>No.</b></td>
		<td><b>No. Gudep</b></td>
		<td><b>Pangkalan</b></td>
		<td><b>Tanggal Berdiri</b></td>
		<td><b>Kwarcab</b></td>
		<td><b>Kwaran</b></td>
		<td><b>Alamat</b></td>
		<td><b>Kode Pos</b></td>
		<td><b>Web</b></td>
		<td><b>Telp</b></td>
		<td><b>Telp2</b></td>
		<td><b>Telp3</b></td>
		<td><b>Fax</b></td>
		<td colspan="2"><b>Action</b></td>

	</tr>

	<tbody id="isi">

	</tbody>
	</table>
	<div>.</div>
	<div>.</div>
	<div>.</div>
	<div class="row" id="isi"></div>
</div>
