<?php
	// var_dump($_SESSION);
?>
<script language="javascript" type="text/javascript" src="../js/plugins/bootstrap-datepicker.js"></script>
<script src="client/s_profil.js"></script>
<style>
#loadarea{
	height:15px;}
.capitizer{
	text-transform:capitalize;
}</style>

<!-- content -->
<h3></h3>
<div id="loadarea" ></div> 
<div class="container">
    	<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#panel1" data-toggle="tab" style="color:#080"><b>Data Login</b></a>
				</li>
				<li>                    
					<a href="#panel2" data-toggle="tab" style="color:#080"><b>Data Umum <span  style="color:red;">*</span></b></a>
				</li>
				<li>
					<a href="#panel3" data-toggle="tab" style="color:#080"><b>Kontak <span style="color:red;">*</span></b></a>
				</li>
				<li>
					<a href="#panel8" data-toggle="tab" style="color:#080"><b>Pramuka</b></a>
				</li>
				<li>
					<a href="#panel4" data-toggle="tab" style="color:#080"><b>Pekerjaan</b></a>
				</li>
				<li>
					<a href="#panel5" data-toggle="tab" style="color:#080"><b>Keluarga</b></a>
				</li>
				<li>
					<a href="#panel6" data-toggle="tab" style="color:#080"><b>Media Sosial</b></a>
				</li>
				<li>
					<a href="#panel7" data-toggle="tab" style="color:#080"><b>Asuransi</b></a>
				</li>
				<li>
					<a href="#panel9" data-toggle="tab" style="color:#080"><b>Foto</b></a>
				</li>
				<li class="pull-right">
					<a href="javascript:hapusAkun();" class="btn btn-danger"><i class="icon-off"></i> Hapus Akun</a>
				</li>
				<li class="pull-right">
					<a href="report/r_portfolio.php?tipe=pdf&ruwet=<?php echo base64_encode($_SESSION['idsesip'].$_SESSION['id_mloginp'].$_SESSION['idsesip']);?>" target="_blank" class="btn btn-secondary"><i class="icon-print"></i> portofolio</a>
				</li>
			</ul>
			
			<form class="form-horizontal" >
				<div class="tab-content">
					<div align="left"style ="color:red;">* harus sesuai ID Card (KTP/SIM/Kartu Pelajar)</div>
					<!-- login data -->
					<div align="center" class="tab-pane active" id="panel1">
						<div class="control-group">
							<table class="table table-striped" width="100%" border="0">
								<tr>
									<td width="25%"><label class="control-label">Email</label></td>
									<td width="5%"><label class="control-label"> :</label></td>
									<td width="70%" id="emailTD"></td>
								</tr>
								<tr id="gantiDV">
									<!--password-->
								</tr>
								
								<tr id="pass1" style="display:none;">
									 <td width="25%"><label class="control-label">password lama</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passLTD"></td>
								 </tr>
								 <tr id="pass2"  style="display:none;">
									 <td width="25%"><label class="control-label">password baru</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passBTB1"></td>
								 </tr>
								 <tr id="pass3"  style="display:none;">
									 <td width="25%"><label class="control-label">password baru (ketik ulang)</label></td>
									 <td width="5%"><label class="control-label">:</label></td>
									 <td width="70%"><input type="password" id="passBTB2" name="passBTB2"><span id="passinfo"></span></td>
								 </tr>
							</table>
						</div>

						<div class="form-actions">
						</div>
					</div>
					<!-- end of login data -->

					<!-- data umum -->
					<div  align="center"class="tab-pane" id="panel2">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Nama Lengkap</label></td>
								<td width="5%"><label class="control-label"> :<!-- <input type="text" id="full_anggotTD" name="full_anggotTD"> --></label></td>
								<td width="70%" id="full_anggotaTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Nama Panggilan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="nick_anggotaTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Jenis Kelamin</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="jenis_kelaminTD"></td>
	 						</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Tempat Lahir</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="temp_lahirTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Tanggal Lahir</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="tgl_lahirTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Golongan Darah</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="gol_darahTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Agama</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="agamaTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Status Nikah</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="status_nikahTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Jenis Kecacatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="jenis_kecacatanTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Bakat</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="bakatTD"></td>
	 						</tr>

	 						<!-- jabatan data -->
	                        <tr>
								<td width="25%"><label class="control-label">Hobi</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="hobiTD"></td>
	 						</tr>
							<tr>
								<td width="25%"><label class="control-label">Bahasa</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%"  id="bahasaTD"></td>
							</tr>
							
						</table>
					</div>
					<!-- end of bio data -->

					<!-- data Kontak -->
					<div  align="center"class="tab-pane" id="panel3">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Alamat</label></td>
								<td width="5%"><label class="control-label"> :
									<input type="hidden" id="id_malamatH" name="id_malamatH">
								</label></td>
								<td width="70%" id="alamatTD"></td>
							</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Kota</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mkotaTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kecamatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mkecTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kode Pos</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="kode_posTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Hp</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="hpTD"></td>
	 						</tr>
	                        
						</table>
					</div>
					<!-- data pramuka -->
					<div  align="center"class="tab-pane" id="panel8">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Kwarcab</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mkwarcabTD"></td>
							</tr>
							<tr>
								<td width="25%"><label class="control-label">Kwaran</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mkwaranTD"></td>
							</tr>
							<tr>
								<td width="25%"><label class="control-label">Gudep</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mgudepTD"></td>
							</tr>
						</table>
					</div>
					<!-- end of data Kontak -->
					<!-- data pekerjaan -->
					<div  align="center"class="tab-pane" id="panel4">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Nama Perusahaan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="nm_perusahaanTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Bidang Usaha</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="bid_usahaTD"></td>
	 						</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Jabatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="jabatanTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Alamat Perusahaan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="alamat_usahaTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Pendapatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="pendapatanTD"></td>
	 						</tr>
	                        
						</table>
					</div>
					<!-- end of data pekerjaan -->
					<!-- data Keluarga -->
					<div  align="center"class="tab-pane" id="panel5">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Nama Ayah</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="nm_ayahTD"></td>
							</tr>
							<tr>
								<td width="25%"><label class="control-label">Pekerjaan Ayah</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="job_ayahTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Nama Ibu</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="nm_ibuTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Pekerjaan Ibu</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="job_ibuTD"></td>
	 						</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Alamat Orangtua</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="alamat_kelTD"></td>	
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">No Telepon Orangtua</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="telp_kelTD"></td>
	 						</tr>
						</table>
					</div>
					<!-- end of data Keluarga -->
	                        
					<!-- data medsos -->
					<div  align="center"class="tab-pane" id="panel6">
						<table class="table table-striped" width="100%" border="0">
							<tr>
								<td width="25%"><label class="control-label">Web</label></td>
								<td width="5%"><label class="control-label"> :
								</label></td>
								<td width="70%" id="webTD"></td>
							</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Google Talk</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="gtTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Yahoo Masengger</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="ymTD"></td>
	 						</tr>
	  						<tr>
								<td width="25%"><label class="control-label">MSN</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="msnTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Skype</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="skypeTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">MIRC</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="mircTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Twitter</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="twitterTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Facebook</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="fbTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Callsing Orari</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="callsing_orariTD"></td>
	 						</tr>
	                        
						</table>
					</div>
					<!-- end of data medsos -->
					<!-- data Asuransi -->
					<div  align="center"class="tab-pane" id="panel7">
						<table class="table table-striped" width="100%" border="0">
							
	                        <tr>
								<td width="25%"><label class="control-label">Nama Asuransi</label></td>
								<td width="5%"><label class="control-label"> :
								</label></td>
								<td width="70%" id="dasuransiTD"></td>
	 						</tr>
	 						<tr>
								<td width="25%"><label class="control-label">Jenis Asuransi</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="jenis_asuransiTD"></td>
	 						</tr>
	  						<tr>
								<td width="25%"><label class="control-label">Masa Asuransi</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="masa_asuransiTD"></td>
	 						</tr>
	                        <tr>
								<td width="25%"><label class="control-label">Kondisi Kesehatan</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="kond_kesehatanTD"></td>
	 						</tr>
						</table>
					</div>
					<!-- end of data Asuransi -->

					<!-- data foto -->
					<div  align="center"class="tab-pane" id="panel9">
						<table class="table table-striped" width="100%" border="0">
	                        <tr>
								<td width="25%"><label class="control-label">Foto</label></td>
								<td width="5%"><label class="control-label"> :</label></td>
								<td width="70%" id="fotoTD"></td>
	 						</tr>
							<tr id="gfotoTR">
								<!--password-->
							</tr>
							<tr id="fotoTR" style="display:none;">
								 <td width="25%"><label class="control-label">Ganti Foto</label></td>
								 <td width="5%"><label class="control-label">:</label></td>
								 <td width="70%"><input type="file" id="fotoTB" name="fotoTB"></td>
							 </tr>
						</table>
					</div>
					<!-- end of data Asuransi -->
				</div>
			
				<input type="submit" value="Simpan"class="btn btn-primary" style="display:none;">
				<a href="profil" style="display:none;" class="btn btn-primary" id='cancelBC'>Batal</a>
				<a class="btn btn-primary" id='editBC'>Ubah</a>
				<div>.</div>
				<div>.</div>
			</form>
	</div>
</div>