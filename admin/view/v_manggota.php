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
<script src="client/s_manggota.js"></script>
<h3><div id="loadarea"><i class="icon-th-list"></i>DAFTAR ANGGOTA</div></h3>
<!-- <ol class="breadcrumb">
  <li class="active">Alamat /</li>
  <li ><a href="subunsur"> Sub Unsur </a>/</li>
  <li> <a href="unsur">Unsur</a></li>
</ol>
 -->
<!-- <a href="?menu=vrule"id="ruleBC" class="btn btn-secondary"><i class='icon-arrow-left'> </i> Rule</a> -->
<div>
	<!-- <button id="addBC" class="btn btn-primary"><i class='icon-plus-sign'></i> Tambah</button> -->
	<button style="display:none;" id="viewBC" class="btn btn-primary"><i class='icon-th-list'></i> Lihat Semua</button>
	<!-- cetak report (pdf) -->
	<input type="hidden" name="idsesiH" value="<?php echo $_SESSION['idsesip']; ?>" id="idsesiH">
	<input type="hidden" name="id_manggotaH" id="id_manggotaH">
	<input type="hidden" name="id_mloginH" value="<?php echo $_SESSION['id_mloginp']; ?>" id="id_mloginH">
	<!-- cetak report (pdf) -->		

	<!-- <a href="unsur"id="jabBC" class="btn btn-secondary">unsur <i class='icon-arrow-right'> </i></a> -->
</div>



<!--panel 1-->
<div xclass="span8"id="i_kegPN" style="display:none;"><br>
	<div xclass="span8">
		<div class="navigasi" style="margin-bottom:20px;">
	<p class="pull-right">
		<!-- <span data-toggle="tooltip" data-placement="top" title="setujui dosen untuk naik pangkat" id="rekomBC"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		<button class="btn cetakBC" data-toggle="tooltip" data-placement="top" title="setujui dosen untuk naik pangkat" id="rekomBC"><i class="icon-print"></i>KTA</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</p>
	<br>
		<table  class="tabel-responsive" xcellpadding="3" width="100%">
			<input type="hidden" id="iduser" name="iduser">
			<tbody>
				<tr>
					<td nowrap="nowrap"  class="capitalizer"><strong>Nama Lengkap</strong></td>
					<td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
					<td nowrap="nowrap" class="capitalizer" id="full_anggotaTD"></td>
					
					<td nowrap="nowrap"  class="capitalizer"><strong>Gugusdepan</strong></td>
					<td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
					<td nowrap="nowrap"  class="capitalizer" id="nm_mgudepTD"></td>
				</tr>
				<tr>
					<td nowrap="nowrap"  class="capitalizer"><strong>Agama</strong></td>
					<td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
					<td nowrap="nowrap"  class="capitalizer" id="agamaTD"></td>
					
					<td nowrap="nowrap"  class="capitalizer"><strong>Alamat </strong></td>
					<td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
					<td nowrap="nowrap"  class="capitalizer" id="malamatTD"></td>
				</tr>
				<tr>
	                <td nowrap="nowrap"  class="capitalizer"><strong>Jenis Kelamin</strong></td>
	                <td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
	                <td nowrap="nowrap"  class="capitalizer" id="jenis_kelaminTD"></td>
				
	                <td nowrap="nowrap"  class="capitalizer"><strong>Masa berlaku KTA </strong></td>
	                <td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
	                <td nowrap="nowrap"  class="capitalizer"id="periodeTD"></td>
	            </tr>
	            <tr>
	                <td nowrap="nowrap"  class="capitalizer"><strong>Tempat, Tgl Lahir</strong></td>
	                <td nowrap="nowrap"  class="capitalizer"><strong>:</strong></td>
	                <td nowrap="nowrap"  class="capitalizer" id="ttlTD"></td>
				</tr>            
				
			</tbody>
		</table>
	</div>
		<legend>Daftar Riwayat</legend>
		<div class="accordion" id="accordion2" >
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c1">
						Pendidikan Formal
					</a>
				</div>
				<div id="c1" class="accordion-body collapse in">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>pendidikan</td>
										<td>Instansi</td>
										<td>td masuk</td>
										<td>td lulus</td>
										<td>fakultas</td>
										<td>jurusan</td>
										<td>kelas</td>
										<td>no induk</td>
										<td>alamat sekolah</td>
									</tr>
								<!-- </thead> -->
								<tbody id="drpendfDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c2">
						Pendidikan informal
					</a>
				</div>
				<div id="c2" class="accordion-body collapse ">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Nama Kursus</td>
										<td>No sertifikat</td>
										<td>Instansi</td>
										<td>Alamat Kursus</td>
										<td>Tahun Kursus</td>
									</tr>
								<!-- </thead> -->
								<tbody id="drpendiDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c3">
						Kecakapan Umum
					</a>
				</div>
				<div id="c3" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Sub Golongan </td>
					                    <td>Tgl. Pencapaian</td>
					                    <td>No. Sertifikat</td>
					                    <td>Keterangan </td>
									</tr>
								<!-- </thead> -->
								<tbody id="rkuDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c4">
						Kecakapan Khusus
					</a>
				</div>
				<div id="c4" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Sub Golongan </td>
					                    <td>Tgl. Pencapaian</td>
					                    <td>No. Sertifikat</td>
					                    <td>Keterangan </td>
									</tr>
								<!-- </thead> -->
								<tbody id="rkkDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c5">
						Prestasi
					</a>
				</div>
				<div id="c5" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Nama Prestasi</td>
					                    <td>tingkat</td>
					                    <td>Tahun Perolehan</td>
					                    <td>No. Sertifikat</td>
					                    <td>Keterangan</td>
									</tr>
								<!-- </thead> -->
								<tbody id="rpresDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c6">
						Jabatan Diluar Pramuka
					</a>
				</div>
				<div id="c6" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Nama Organisasi</td>
					                    <td>Jabatan</td>
					                    <td>Tgl. Lantik</td>
					                    <td>Tgl. Purna</td>
					                    <td>Keterangan</td>
									</tr>
								<!-- </thead> -->
								<tbody id="rjdpDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c7">
						Membina
					</a>
				</div>
				<div id="c7" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Keahlian</td>
					                    <td>Tahun Membina</td>
					                    <td>Tahun Selesai</td>
					                    <td>Nomer Gudep</td>
					                    <td>Keterangan</td>
									</tr>
								<!-- </thead> -->
								<tbody id="rbinaDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c8">
						Kegiatan Kepramukaan
					</a>
				</div>
				<div id="c8" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Detail Kegiatan</td>
					                      <td>Tanggal Kegiatan</td>
					                      <td>Lokasi</td>
					                      <td>Tingkat</td>
					                      <td>Golongan</td>
					                      <td>Kategori</td>
					                      <td>Status</td>
					                      <td>Keterangan</td>
									</tr>
								<!-- </thead> -->
								<tbody id="rkpramDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div align="left" class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#c9">
						Kegiatan Nonkepramukaan
					</a>
				</div>
				<div id="c9" class="accordion-body collapse">
					<div class="accordion-inner" >
							<table class="table table-hover table-bordered table-striped" width="100%" border="0">
								<!-- <thead> -->
									<tr class="info">
										<td>no</td>
										<td>Nama Kegiatan</td>
					                      <td>Tanggal</td>
					                      <td>Lokasi</td>
					                      <td>Tingkat</td>
					                      <td>Status</td>
					                      <td>Penyelenggara</td>
					                      <td>Keterangan</td>
									</tr>
								<!-- </thead> -->
								<tbody id="rknonpramDV">

								</tbody>
						</table>					
					</div>
				</div>
			</div>
		</div>
		<div >.</div>
		<div >.</div>
		
	</div>
</div>
<divX id="loadtabel"></divX>

<div xclass="span8"id="v_kegPN"><br>
	<button id="cetakBC" class="btn btn-default cetakBC"><i class="icon-print"></i> KTA</button>

	<table class="table table-hover table-bordered table-striped" width="100%" border="0">
		<tr>
			<td><input class="span1" placeholder="no. anggota " name="no_anggotaTS" id="no_anggotaTS"></td>		
			<td><input class="span1" placeholder="nama lengkap " name="full_anggotaTS" id="full_anggotaTS"></td>		
			<td>
				<select class="span1" name="jenis_kelaminTS" id="jenis_kelaminTS">
					<option value="">Semua</option>
					<option value="L">Laki</option>
					<option value="P">Perempuan</option>
				</select>
			<td><input class="span1" placeholder="alamat" name="malamatTS" id="malamatTS"></td>
			<td><input class="span1" placeholder="gudep " name="mgudepTS" id="mgudepTS"></td>		
			<td><input class="span1" placeholder="kwaran" name="mkwaranTS" id="mkwaranTS"></td>
			<td><input class="span1" placeholder="kwarcab" name="mkwarcabTS" id="mkwarcabTS"></td>		
			<td><input class="span1" placeholder="usia" name="usiaTS" id="usiaTS"></td>
			<td><input class="span1" placeholder="kode pos" name="kode_posTS" id="kode_posTS"></td>
			<td><input class="span1" placeholder="kecamatan" name="mkecTS" id="mkecTS"></td>
			<td><input class="span1" placeholder="kota" name="mkotaTS" id="mkotaTS"></td>
			<td><input class="span1" placeholder="email" name="emailTS" id="emailTS"></td>
			<td>
				<select name="isActiveTS" id="isActiveTS" class="span1">
					<option value="">Semua</option>
					<option value="y">Aktif</option>
					<option value="n">Tidak Aktif</option>
				</select>
			<td></td>
		</tr>
		<tr class="info">
			<td><b>No. Anggota</b></td>
			<td><b>Nama</b></td>
			<td><b>Gender</b></td>
			<td><b>Alamat</b></td>
			<td><b>Gudep</b></td>
			<td><b>Kwaran</b></td>
			<td><b>Kwarcab</b></td>
			<td><b>Usia</b></td>
			<td><b>Kode Pos</b></td>
			<td><b>Kecamatan</b></td>
			<td><b>Kota</b></td>
			<td><b>Email</b></td>
			<td><b>Status</b></td>
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
