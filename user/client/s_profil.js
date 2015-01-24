var dir='server/p_profil.php';

$(document).ready(function(){
	loadData('tampil');
    // $('form').on('submit',simpanData);
    $('form').on('submit',submitForm);

	$('#editBC').click(function(){
		loadData('ambiledit');
		$('input:submit').toggle();
		$('#cancelBC').toggle();
		$(this).toggle();
		$('#gantiDV').append('<td width="25%" colspan="3">'
								+'<label class="control-label">'
								+'<input type="checkbox" id="gantiTB" onclick="cekganti(gantiTB);"/>'
								+'Ganti Password</label></td>');
		$('#gfotoTR').html('<td width="25%" colspan="3">'
								+'<label class="span10">'
								+'<input type="checkbox" id="gfotoTB" onclick="gfotoFC(this);"/>'
								+'  Ganti Foto</label></td>');
	});
});	

function gfotoFC(x){
	$('#fotoTR').toggle(1000);
	if($(x).is(':checked')){
		$('#fotoTB').attr('required',true);
		$('#fotoTR').removeAttr('style');
	} else{
		$('#fotoTB').removeAttr('required');
		$('#fotoTB').val('');
		// $('#fotoTR').removeAttr('style');
	}
}

//fungsi untuk hapus akun user(dosen) secara kesluruhan (profil + kegiatan + bukeg )
function hapusAkun(){
	if(confirm('Anda yakin akan menghapus akun secara permanen?')){
		$.ajax({
			url:dir,
			dataType:'json',
			data:'aksi=hapusAkun',
			success:function(data){
				alert(data.status); // notif sebelum logout
				location.href='../logout.php'; //otomatis akan logout ketika berhasil hapus akun 
			}
		});
	}
}

//fungsi untuk memilih tanggal 
function tglinput(par){ 
	$(par).datepicker();
}

//fungsi untuk  mengecek ulang  password baru (sama/tidak) 
function cekpass(){
	var p2 = $('#passBTB2').val();
	var p1 = $('#passBTB1').val();
	if(p2==p1){ // notif ketika sama
		$('#passinfo').html('<span class="label label-success">password sesuai</span>'); 
	}else{ //notif ketika beda/salah
		$('#passinfo').html('<span class="label label-important">password harus sama</span>');
	}
}

//fungsi ketika checkbox dicentang (saat edit profil) => menampilkan textbox2 ganti  password  
function cekganti(x){
	$('#pass1').toggle(1000);
	$('#pass2').toggle(1000);
	$('#pass3').toggle(1000);
	$('#passLTB').val('');
	$('#passBTB1').val('');
	$('#passBTB2').val('');

	//fungsi ketika event keyUp  pada textbox password1
	$('#passBTB1').keyup(function(){
		cekpass();
	});
	//fungsi ketika event keyUp  pada textbox password2
	$('#passBTB2').keyup(function(){
		cekpass();
	});
}

function combomkwarcab(id_mkwarcab){ //diganti
	$.ajax({
		url:dir,
		type:'get',
		data:'aksi=combo&menu=mkwarcab', //diganti
		dataType:'json',
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>'; //diganti
			}else{
				$.each(data.datax, function (id,item){
					// alert(item);return false();
					if(item.id_mkwarcab==id_mkwarcab){ //diganti
						optiony+='<option selected="selected" value='+item.id_mkwarcab+'>  '+item.nomer_kwarcab+'. '+item.mkota+'  </option>'; //diganti
					}else{
						optiony+='<option value='+item.id_mkwarcab+'> '+item.nomer_kwarcab+'. '+item.mkota+'  </option>'; //diganti
					}
				});
			}
			$('#mkwarcabTD').html('<select  onchange="combomkwaran(\'\',\'\');" id="mkwarcabTB" name="mkwarcabTB" required>'
					+'<option value="">kwarcab </option>'+optiony
				+'</select>');
		}
	});
}

function combomkwaran(id_mkwarcab,id_mkwaran){ //diganti
	var id_kb, id_kr;
	if (id_mkwarcab=='') { // add mode
		id_kb=$('#mkwarcabTB').val();
		id_kr=$('#mkwaranTB').val();
	}else{ //edit mode
		id_kb=id_mkwarcab;
		id_kr=id_mkwaran;
	}	

	$.ajax({
		url:dir,
		type:'get',
		data:'aksi=combo&menu=mkwaran&id_mkwarcab='+id_kb, //diganti
		dataType:'json',
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>'; //diganti
			}else{
				$.each(data.datax, function (id,item){
					if(id_kr==item.id_mkwaran){ //diganti
						optiony+='<option selected="selected" value='+item.id_mkwaran+'> '+item.nomer_kwaran+'. '+item.mkec+'  </option>'; //diganti
					}else{
						optiony+='<option value='+item.id_mkwaran+'> '+item.nomer_kwaran+'. '+item.mkec+' </option>'; //diganti
					}
				});
				// alert(optiony);return false;
			}
			$('#mkwaranTD').html('<select  onchange="combomgudep(\'\',\'\');" id="mkwaranTB" name="mkwaranTB" required>'
					+'<option value="">kwaran </option>'+optiony
				+'</select>');
		}
	});
}

function combomgudep(id_mkwaran,id_mgudep){ //diganti
	var id_kr,id_gd;
	if (id_mkwaran=='') { // add mode
		id_kr=$('#mkwaranTB').val();
		id_gd=$('#mgudepTB').val();
	}else{ //edit mode
		id_kr=id_mkwaran;
		id_gd=id_mgudep;
	}	

	$.ajax({
		url:dir,
		type:'get',
		data:'aksi=combo&menu=mgudep&id_mkwaran='+id_kr, //diganti
		dataType:'json',
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>'; //diganti
			}else{
				$.each(data.datax, function (id,item){
					if(id_gd==item.id_mgudep){ //diganti
						optiony+='<option selected="selected" value='+item.id_mgudep+'> '+item.nomer_gudep+'. '+item.nama_pangkalan +'  </option>'; //diganti
					}else{
						optiony+='<option value='+item.id_mgudep+'> '+item.nomer_gudep+'. '+item.nama_pangkalan+' </option>'; //diganti
					}
				});
			}
			$('#mgudepTD').html('<select  onchange="combomgudep(\'\',\'\');" id="mgudepTB" name="mgudepTB" required>'
					+'<option value="">gudep </option>'+optiony
				+'</select>');
		}
	});
}

function combomkota(id_mkota){
	var id_k;
	if (id_k=='') { // add mode
		id_k=$('#id_mkotaTB').val();
	}else{ //edit mode
		id_k=id_mkota;
	}

	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=mkota',
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>';
			}else{
				$.each(data.datax, function (id,item){
					if(id_k==item.id_mkota){
						optiony+='<option value="'+item.id_mkota+'" selected="selected">'+item.mkota+' </option>';
					}else{
						optiony+='<option value="'+item.id_mkota+'">'+item.mkota+' </option>';
					}
				});
			}
			$('#mkotaTD').html('<select  onchange="combomkec(\'\',\'\');" id="id_mkotaTB" name="id_mkotaTB" required>'
										+'<option value="">Kota </option>'+optiony
									+'</select>');
		}
	}); 
}	

function combomkec(id_mkota,id_mkec){
	// alert(id_mkota+' '+id_mkec);
	var id_k, id_c;
	if (id_mkota=='') { // add mode
		id_k=$('#id_mkotaTB').val();
		id_c=$('#id_mkecTB').val();
	}else{ //edit mode
		id_k=id_mkota;
		id_c=id_mkec;
	}

	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=mkec&id_mkota='+id_k,
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>';
			}else{
				$.each(data.datax, function (id,item){
					if(id_c==item.id_mkec){
						optiony+='<option value="'+item.id_mkec+'" selected="selected">'+item.mkec+' </option>';
					}else{
						optiony+='<option value="'+item.id_mkec+'">'+item.mkec+' </option>';
					}
				});
			}
			$('#mkecTD').html('<select id="id_mkecTB" name="id_mkecTB" required>'
								+'<option value="">kecamatan..</option>'+optiony
							+'</select>');
		}
	}); 
}	

function loadData(aksix){
	$('#loadarea').html('<img src="../img/loader.gif">loading..').fadeIn();
	$.ajax({
		url	: dir,
		type: "GET",
		data: "aksi=tampil",
		dataType:"json",
		success:function(data){
			if(data.status=='kosong'){
				alert('kosong');
			}else{
				//view
				if(aksix=='tampil'){
					$('a#editBC').fadeIn();
					$('input:submit').fadeOut();
					$('#loadarea').html('<h3>VIEW PROFIL</h3>');

					// data umum
					if(data.jenis_kelamin==''){
						jenis_kelamin='[kosong]';
					}else{
						if (data.jenis_kelamin=='L') {
							jenis_kelamin='Laki-laki';
						} else{
							jenis_kelamin='Perempuan';
						}
					}
					if(data.full_anggota==''){full_anggota='[kosong]';}else{full_anggota=data.full_anggota;}
					if(data.nick_anggota==''){nick_anggota='[kosong]';}else{nick_anggota=data.nick_anggota;}
					if(data.temp_lahir==''){temp_lahir='[kosong]';}else{temp_lahir=data.temp_lahir;}
					if(data.gol_darah==''){gol_darah='[kosong]';}else{gol_darah=data.gol_darah;}
					if(data.jenis_kelamin==''){jenis_kelamin='[kosong]';}else{jenis_kelamin=jenis_kelamin;}
					if(data.agama==''){agama='[kosong]';}else{agama=data.agama;}
					if(data.status_nikah==''){status_nikah='[kosong]';}else{status_nikah=data.status_nikah;}
					if(data.jenis_kecacatan==''){jenis_kecacatan='[kosong]';}else{jenis_kecacatan=data.jenis_kecacatan;}
					if(data.bakat==''){bakat='[kosong]';}else{bakat=data.bakat;}
					hobi=data.hobi;
					if(data.bahasa==''){bahasa='[kosong]';}else{bahasa=data.bahasa;}
					tgl_lahir=data.tgl_lahir;

					// data kontak
					if(data.malamat==''){malamat='[kosong]';}else{malamat=data.malamat;}
					if(data.mkec==''){mkec='[kosong]';}else{mkec=data.mkec;}
					if(data.mkota==''){mkota='[kosong]';}else{mkota=data.mkota;}
					if(data.kode_pos==''){kode_pos='[kosong]';}else{kode_pos=data.kode_pos;}
					if(data.hp==''){hp='[kosong]';}else{hp=data.hp;}

					// dat keluarga
					if(data.nm_ayah==''){nm_ayah='[kosong]';}else{nm_ayah=data.nm_ayah;}
					if(data.nm_ibu==''){nm_ibu='[kosong]';}else{nm_ibu=data.job_ibu;}
					if(data.job_ayah==''){job_ayah='[kosong]';}else{job_ayah=data.job_ayah;}
					if(data.job_ibu==''){job_ibu='[kosong]';}else{job_ibu=data.job_ibu;}
					if(data.alamat_kel==''){alamat_kel='[kosong]';}else{alamat_kel=data.alamat_kel;}
					if(data.telp_kel==''){telp_kel='[kosong]';}else{telp_kel=data.telp_kel;}

					// data pramuka
					if(data.nm_mgudep==''){nm_mgudep='[kosong]';}else{nm_mgudep=data.nm_mgudep;}
					if(data.nm_mkwaran==''){nm_mkwaran='[kosong]';}else{nm_mkwaran=data.nm_mkwaran;}
					if(data.nm_mkwarcab==''){nm_mkwarcab='[kosong]';}else{nm_mkwarcab=data.nm_mkwarcab;}

					// data pekerjaan
					if(data.nm_perusahaan==''){nm_perusahaan='[kosong]';}else{nm_perusahaan=data.nm_perusahaan;}
					if(data.bid_usaha==''){bid_usaha='[kosong]';}else{bid_usaha=data.bid_usaha;}
					if(data.jabatan==''){jabatan='[kosong]';}else{jabatan=data.jabatan;}
					if(data.alamat_usaha==''){alamat_usaha='[kosong]';}else{alamat_usaha=data.alamat_usaha;}
					if(data.pendapatan==''){pendapatan='[kosong]';}else{pendapatan=data.pendapatan;}

					// dat sosmed
					if(data.email==''){email='[kosong]';}else{email=data.email;}
					if(data.web==''){web='[kosong]';}else{web='<a href="http://'+data.web+'" target="_blank">'+data.web+'</a>';}
					if(data.gt==''){gt='[kosong]';}else{gt=data.gt;}
					if(data.ym==''){ym='[kosong]';}else{ym=data.ym;}
					if(data.msn==''){msn='[kosong]';}else{msn=data.msn;}
					if(data.skype==''){skype='[kosong]';}else{skype=data.skype;}
					if(data.mirc==''){mirc='[kosong]';}else{mirc=data.mirc;}
					if(data.twitter==''){twitter='[kosong]';}else{twitter=data.twitter;}
					if(data.fb==''){fb='[kosong]';}else{fb=data.fb;}
					if(data.callsing_orari==''){callsing_orari='[kosong]';}else{callsing_orari=data.callsing_orari;}

					// data asuransi
					if(data.dasuransi==''){dasuransi='[kosong]';}else{dasuransi=data.dasuransi;}
					if(data.jenis_asuransi==''){jenis_asuransi='[kosong]';}else{jenis_asuransi=data.jenis_asuransi;}
					if(data.masa_asuransi==''){masa_asuransi='[kosong]';}else{masa_asuransi=data.masa_asuransi;}
					if(data.kond_kesehatan==''){kond_kesehatan='[kosong]';}else{kond_kesehatan=data.kond_kesehatan;}

					//foto
					if(data.foto==''){foto='../img/no_image2.jpg';}else{foto='../upload/foto/'+data.foto;}

				// data umum
					$('#full_anggotaTD').html(full_anggota);
					$('#nick_anggotaTD').html(nick_anggota);
					$('#temp_lahirTD').html(temp_lahir);
					$('#tgl_lahirTD').html(tgl_lahir);
					$('#gol_darahTD').html(gol_darah); 
					$('#jenis_kelaminTD').html(jenis_kelamin);
					$('#agamaTD').html(agama);
					$('#status_nikahTD').html(status_nikah);
					$('#jenis_kecacatanTD').html(jenis_kecacatan);
					$('#bakatTD').html(bakat);
					$('#hobiTD').html(hobi);
					$('#bahasaTD').html(bahasa);
				// kontak
					$('#alamatTD').html(malamat);					
					$('#mkecTD').html(mkec);
					$('#mkotaTD').html(mkota);
					$('#kode_posTD').html(kode_pos);
					$('#hpTD').html(hp);
				// data pramuka
					$('#mkwarcabTD').html(nm_mkwarcab);
					$('#mkwaranTD').html(nm_mkwaran);
					$('#mgudepTD').html(nm_mgudep);
				// pekerjaan
					$('#nm_perusahaanTD').html(nm_perusahaan);
					$('#bid_usahaTD').html(bid_usaha);
					$('#jabatanTD').html(jabatan);
					$('#alamat_usahaTD').html(alamat_usaha);
					$('#pendapatanTD').html(pendapatan);
				// keluarga
					$('#nm_ayahTD').html(nm_ayah);
					$('#job_ayahTD').html(job_ayah);
					$('#nm_ibuTD').html(nm_ibu);
					$('#job_ibuTD').html(job_ibu);
					$('#alamat_kelTD').html(alamat_kel);
					$('#telp_kelTD').html(telp_kel);
				// sosmed	
					$('#webTD').html(web);
					$('#emailTD').html(email);
					$('#gtTD').html(gt);
					$('#ymTD').html(ym);
					$('#msnTD').html(msn);
					$('#skypeTD').html(skype);
					$('#mircTD').html(mirc);
					$('#twitterTD').html(twitter);
					$('#fbTD').html(fb);
					$('#callsing_orariTD').html(callsing_orari);
				// asuransi				
					$('#dasuransiTD').html(dasuransi);
					$('#jenis_asuransiTD').html(jenis_asuransi);
					$('#masa_asuransiTD').html(masa_asuransi);
					$('#kond_kesehatanTD').html(kond_kesehatan);
					$('#gantiDV').html('');
				//foto
					$('#fotoTD').html('<img width="200" src="'+foto+'">');
				}
				else{//edit
					$('#loadarea').html('<h3>EDIT PROFIL</h3>');
					
					//user
					combomkwarcab(data.id_mkwarcab);
					combomkwaran(data.id_mkwarcab,data.id_mkwaran);
					combomgudep(data.id_mkwaran,data.id_mgudep);

					combomkota(data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);
					//umum
					$('#id_malamatH').val(data.id_malamat)
					$('#full_anggotaTD').html('<input placeholder="nama lengkap"  required name="full_anggotaTB" type="text" value="'+(data.full_anggota)+'">');
					$('#nick_anggotaTD').html('<input placeholder="nama panggilan" maxlength="18" required name="nick_anggotaTB" type="text" value="'+(data.nick_anggota)+'">');
					$('#temp_lahirTD').html('<input placeholder="kota kelahiran" name="temp_lahirTB" required type="text" value="'+data.temp_lahir+'">');
					$('#tgl_lahirTD').html('<input placeholder="tanggal lahir" onfocus="tglinput(this);" onmousedown="tglinput(this);" required name="tgl_lahirTB" required type="text" value="'+data.tgl_lahir+'">');
					
					$('#jenis_kelaminTD').html('<select required name="jenis_kelaminTB" id="jenis_kelaminTB" >'
										+'<option value="">jenis kelamin </option>'
										+'<option value="L">Laki-laki</option>'
										+'<option value="P">Perempuan</option>'
										+'</select>');
					$('#jenis_kelaminTB').val(data.jenis_kelamin).attr('selected',true);

					$('#gol_darahTD').html('<select required name="gol_darahTB" id="gol_darahTB" >'
										+'<option value="">golongan darah</option>'
										+'<option value="A">A</option>'
										+'<option value="O">O</option>'
										+'<option value="B">B</option>'
										+'<option value="AB">AB</option>'
										+'</select>');
					$('#gol_darahTB').val(data.gol_darah).attr('selected',true);
					
					$('#agamaTD').html('<select required name="agamaTB" id="agamaTB" >'
										+'<option value=islam>Islam</option>'
										+'<option value=kristen>Kristen</option>'
										+'<option value=katholik>Katholik</option>'
										+'<option value=hindu>Hindu</option>'
										+'<option value=budha>Budha</option>'
										+'</select>');
					$('#agamaTB').val(data.agama).attr('selected',true);
					
					$('#status_nikahTD').html('<select required name="status_nikahTB" id="status_nikahTB" >'
										+'<option value=kawin>Kawin</option>'
										+'<option value=tidak kawin>Tidak Kawin</option>'
										+'</select>');
					$('#status_nikahTB').val(data.status_nikah).attr('selected',true);
					
					$('#jenis_kecacatanTD').html('<input placeholder="cacat" xrequired name="jenis_kecacatanTB" type="text" value="'+(data.jenis_kecacatan)+'">');
					$('#bakatTD').html('<input placeholder="bakat" xrequired name="bakatTB" type="text" value="'+(data.bakat)+'">');
					$('#hobiTD').html('<input placeholder="hobi" xrequired name="hobiTB" type="text" value="'+(data.hobi)+'">');
					$('#bahasaTD').html('<input placeholder="bahasa" required name="bahasaTB" type="text" value="'+(data.bahasa)+'">');
					
					//kontak
					$('#alamatTD').html('<input placeholder="alamat tinggal" required name="malamatTB" type="text" value="'+data.malamat+'">');
					$('#kode_posTD').html('<input placeholder="kode pos" xrequired name="kode_posTB" type="text" value="'+data.kode_pos+'">');
					$('#hpTD').html('<input placeholder="no hp" xrequired name="hpTB" type="text" value="'+data.hp+'">');

					//pekerjaan
					$('#nm_perusahaanTD').html('<input placeholder="nama perusahaan " xrequired name="nm_perusahaanTB" type="text" value="'+data.nm_perusahaan+'">');
					$('#bid_usahaTD').html('<input placeholder="bidang usaha" xrequired name="bid_usahaTB" type="text" value="'+data.bid_usaha+'">');
					$('#jabatanTD').html('<input placeholder="jabatan" xrequired name="jabatanTB" type="text" value="'+data.jabatan+'">');
					$('#alamat_usahaTD').html('<input placeholder="alamat perusahaan" xrequired name="alamat_usahaTB" type="text" value="'+data.alamat_usaha+'">');
					$('#pendapatanTD').html('<input placeholder="pendapatan" xrequired name="pendapatanTB" type="text" value="'+data.pendapatan+'">');

					//keluarga
					$('#nm_ayahTD').html('<input placeholder="nama ayah " required name="nm_ayahTB" type="text" value="'+data.nm_ayah+'">');
					$('#job_ayahTD').html('<input placeholder="pekerjaan ayah " required name="job_ayahTB" type="text" value="'+data.job_ayah+'">');
					$('#nm_ibuTD').html('<input placeholder="nama ibu " required name="nm_ibuTB" type="text" value="'+data.nm_ibu+'">');
					$('#job_ibuTD').html('<input placeholder="pekerjaan ibu " required name="job_ibuTB" type="text" value="'+data.job_ibu+'">');
					$('#alamat_kelTD').html('<input placeholder="alamat orang tua" required name="alamat_kelTB" type="text" value="'+data.alamat_kel+'">');
					$('#telp_kelTD').html('<input placeholder="telpon orang tua" required name="telp_kelTB" type="text" value="'+data.telp_kel+'">');
					
					//medsos
					$('#webTD').html('<input placeholder="web" xrequired name="webTB" type="text" value="'+data.web+'">');
					$('#gtTD').html('<input placeholder="google talk" xrequired name="gtTB" type="text" value="'+data.gt+'">');
					$('#ymTD').html('<input placeholder="yahoo messanger" xrequired name="ymTB" type="text" value="'+data.ym+'">');
					$('#msnTD').html('<input placeholder="msn" xrequired name="msnTB" type="text" value="'+data.msn+'">');
					$('#skypeTD').html('<input placeholder="skype" xrequired name="skypeTB" type="text" value="'+data.skype+'">');
					$('#mircTD').html('<input placeholder="mirc" xrequired name="mircTB" type="text" value="'+data.mirc+'">');
					$('#twitterTD').html('<input placeholder="twitter" xrequired name="twitterTB" type="text" value="'+data.twitter+'">');
					$('#fbTD').html('<input placeholder="facebook" xrequired name="fbTB" type="text" value="'+data.fb+'">');
					$('#callsing_orariTD').html('<input placeholder="callsing orari" xrequired name="callsing_orariTB" type="text" value="'+data.callsing_orari+'">');

					//asuransi
					$('#dasuransiTD').html('<input placeholder="asuransi" xrequired name="dasuransiTB" type="text" value="'+data.dasuransi+'">');
					$('#jenis_asuransiTD').html('<input placeholder="jenis asuransi" xrequired name="jenis_asuransiTB" type="text" value="'+data.jenis_asuransi+'">');
					$('#masa_asuransiTD').html('<input placeholder="masa asuransi" xrequired name="masa_asuransiTB" type="text" value="'+data.masa_asuransi+'">');
					$('#kond_kesehatanTD').html('<input placeholder="kondisi kesehaatan sekarang" xrequired name="kond_kesehatanTB" type="text" value="'+data.kond_kesehatan+'">');
					
					//foto
					// $('#fotoTD').html('<input type="file" name="fotoTB" id="fotoTB" required>');
				}
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log('ERRORS: ' + textStatus);
		}
	});
}

function combogol(idgol,idjab,idpt){
	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=gol',
		success:function(data){
			var optiony ='';
			$.each(data, function (id,item){
				if(idgol==item.id_gol){
					optiony+='<option value="'+item.id_gol+'" selected="selected">'+item.gol+' </option>';
				}else{
					optiony+='<option value="'+item.id_gol+'">'+item.gol+' </option>';
				}
			});
			$('#golsTD').html('<select id="golsTB" name="golsTB" required>'
								+'<option value="">silahkan pilih golongan</optionn>'+optiony
							+'</select>');
			combojab(idjab,idpt);
		}
	}); 
}	

function combojab(idjab,idpt){
	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=jab',
		success:function(data){
			var optiony ='';
			$.each(data, function (id,item){
				if(idjab==item.id_jab){
					optiony+='<option value="'+item.id_jab+'" selected="selected">'+item.jab+' </option>';
				}else{
					optiony+='<option value="'+item.id_jab+'">'+item.jab+' </option>';
				}
			});
			$('#jabsTD').html('<select id="jabsTB" name="jabsTB" required>'
								+'<option value="">silahkan pilih jabatan</option>'+optiony
							+'</select>');
			combopt(idpt);	
		}
	});
}	

function combopt(idpt){
	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=pt',
		success:function(data){
			var optiony ='';
			$.each(data, function (id,item){
				if(idpt==item.id_pt){
					optiony+='<option value="'+item.id_pt+'" selected="selected">'+item.pt+' </option>';
				}else{
					optiony+='<option value="'+item.id_pt+'">'+item.pt+' </option>';
				}
			});
			$('#ptTD').html('<select id="ptTB" name="ptTB" required>'
								+'<option value="">silahkan pilih pend. terakhir</option>'+optiony
							+'</select>');
		}
	});
}	

function hapusAkun(){
	$.ajax({
		url:dir,
		dataType:'json',
		data:'aksi=hapusAkun',
		success:function(data){
			if(data.status=='sukses'){
				alert(data.status);
				location.href='../logout.php';
			}else{
				alert(data.status);
			}
		}
	});
}

function tglinput(par){ 
	$(par).datepicker();
}

function kosongkan(){
	$('#id_malamatH').val('');
	$('#fotoTB').val('');
	$('#fotoTB').removeAttr('required');
	$('#fotoTR').attr('style','display:none;');
}

function simpanData(event){
    $('#loadarea').html('<img src="../img/loader.gif">loading..').fadeIn();
	event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    var datax = $(this).serialize();
    $.ajax({
        url:dir+'?aksi=ubah',
        type:'post',
        data:datax,
        dataType:'json',
        success:function(data){
	        if(data.status=='sukses'){
	            loadData('tampil');				
				$('#gantiTB').attr('checked',false); // menghilangkan centang setalah sukses simpan/update data
				$('#gantiTR').css('display','none'); // menyembunyikan textbox setelah sukses simpan/update data 
				$('#pass1').css('display','none'); 
				$('#pass2').css('display','none');
				$('#pass3').css('display','none');
				$('#passBTB1').val('');
				$('#passBTB2').val('');
				$('#cancelBC').toggle();
				kosongkan();
				if (data.tipe=='add') { //jika baru maka refresh halaman 
					location.href='profil';	
				}
			}else{
                alert(data.status);
            }
        }	
    });	
}

//-----------
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();

		//add image
		var files =new Array();
		$("input:file").each(function() {
			files.push($(this).get(0).files[0]); 
		});
		 
		// Create a formdata object and add the files
		var filesAdd = new FormData();
		$.each(files, function(key, value){
			filesAdd.append(key, value);
		});

		if($('#fotoTB').val()==''){ //upload
			saveData('');
		}else{ // ga upload
			uploadFiles(filesAdd);
		}
	}

	// function uploadFiles(tipe,dataAdd,id){
	function uploadFiles(dataAdd){
		// alert(dataAdd);
		$('#loadarea').html('<img src="../img/loader.gif"> ').fadeIn();
		$.ajax({
			url: dir+'?aksi=uploadimg',
			type: 'POST',
			data: dataAdd,
			cache: false,
			dataType: 'json',
			processData: false,// Don't process the files
			contentType: false,//Set content type to false as jq 'll tell the server its a query string request
			success: function(data, textStatus, jqXHR){
				if(typeof data.error === 'undefined'){ //gak error
					saveData(data);
					console.log('sukses upload');
				}else{ //error
					console.log('ERRORS upload : ' + data.error);
				}
			},error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS upload2: ' + textStatus);
				$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
			}
		});
    }
	
	// simpan data ke database
	function saveData(add){
		var formData = $('form').serialize();
		if(add!=''){ // ada upload file nya
			$.each(add.files, function(key, value){
				formData +='&fileadd=' + value ;
			});
		}else{ // tanpa upload file nya
			formData  += formData;
		}

		$.ajax({
			url: dir+'?aksi=ubah',
            type:'POST',
            data:formData,
            cache:false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
            	if(typeof data.error === 'undefined'){
					console.log('SUCCESS savedata1: ' + data);
            	}else{
            		console.log('ERRORS savedata1: ' + data.error);
            	}
            },error: function(jqXHR, textStatus, errorThrown){
            	console.log('ERRORS savedata2: ' + textStatus);
            },
            complete: function(){
	            loadData('tampil');				
				$('#gantiTB').attr('checked',false); // menghilangkan centang setalah sukses simpan/update data
				$('#gantiTR').css('display','none'); // menyembunyikan textbox setelah sukses simpan/update data 
				$('#pass1').css('display','none'); 
				$('#pass2').css('display','none');
				$('#pass3').css('display','none');
				$('#passBTB1').val('');
				$('#passBTB2').val('');
				$('#cancelBC').toggle();
				$('#gfotoTR').html('');
				// $('#fotoTB').attr('style','display:none');
				kosongkan();
				if (data.tipe=='add') { //jika baru maka refresh halaman 
					location.href='profil';	
				}
			}
		});
	}
