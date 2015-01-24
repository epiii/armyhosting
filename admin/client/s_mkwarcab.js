var dir = 'server/p_mkwarcab.php'; //diganti

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		$.ajax({
			url	: dir,
			type: 'GET',
			data: 'aksi=tampil',
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KWARCAB'); //diganti
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
 
	function combomkota(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota&id_mkota='+id_mkota,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkotaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkota==id_mkota){
							optiony+='<option selected="selected" value='+item.id_mkota+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
						}
					});
					$('#id_mkotaTB').html('<option value="">pilih Kota ..</option>'+optiony);
				}
			}
		});
	}

	function combomkec(id_mkota,id_mkec){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkec&id_mkota='+id_mkota,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkecTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkec==id_mkec){
							optiony+='<option selected="selected" value='+item.id_mkec+'>'+item.mkec+' </option>';
						}else{
							optiony+='<option value='+item.id_mkec+'>'+item.mkec+' </option>';
						}
					});
					$('#id_mkecTB').html('<option value="">pilih Kecamatan ..</option>'+optiony);
				}
			}
		});
	}

	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mkwarcab = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mkwarcab='+id_mkwarcab; //diganti
		}

		var datax = $('form').serialize();
		$.ajax({
			url:urlx,
			type:'post',
			dataType:'json',
			data:datax,
			success:function(data){
				if(data.status=='sukses'){
					kosongkan();
					$('#i_kegPN').toggle();
					$('#v_kegPN').toggle();
					$('#addBC').toggle();
					$('#viewBC').toggle();
					loadData();
				}else{
					alert(data.status);
				}
			}
		});
	}
	
	//hapus record kegiatan
	function hapusmkwarcab(id_mkwarcab){ //diganti
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mkwarcab='+id_mkwarcab, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('gagal menghapus data');
				}else{
					loadData();
				}
			}
		});
	}
	//end of hapus record kegiatan
	
	//edit record kegiatan
	function editmkwarcab(id_mkwarcab){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mkwarcab='+id_mkwarcab, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id_mkwarcab); 
					$('#id_mloginTB').val(data.id_mlogin); 
					$('#id_malamatTB').val(data.id_malamat); 
					$('#nomer_kwarcabTB').val(data.nomer_kwarcab);
					$('#nama_kwarcabTB').val(data.nama_kwarcab);
					$('#ketua_cabTB').val(data.ketua_cab);
					
					$('#kode_posTB').val(data.kode_pos);
					$('#malamatTB').val(data.malamat);
					$('#pre_malamatTB').val(data.pre_malamat);
					$('#kode_posTB').val(data.kode_pos);
					$('#webTB').val(data.web);
					/*$('#hpTB').val(data.hp);*/
					$('#telp_1TB').val(data.telp_1);
					$('#telp_2TB').val(data.telp_2);
					$('#telp_3TB').val(data.telp_3);
					$('#faxTB').val(data.fax);
					$('#emailTB').val(data.email);
					$('#paswotTB').val(data.paswot);
					
					combomkota(data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);

					$('#loadarea').html('<i class="icon-edit"></i> UBAH KWARCAB').fadeIn(); //diganti
					$('#i_kegPN').toggle(1000);
					$('#v_kegPN').toggle();
					$('#viewBC').toggle();
					$('#addBC').toggle();
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS: ' + errorThrown);
			}
		});
	}
	
	//kosongkan form
	function kosongkan(){
		$('#idformTB').val('');
		// data login
		$('#yuserTB').val('');
		$('#paswotTB').val('');
		// data umum 
		$('#id_mkotaTB').val('');
		$('#nomer_kwarcabH').val('');
		$('#nomer_kwarcabInfo').html('');
		$('#nomer_kwarcabTB').val('');
		$('#nama_kwarcabTB').val('');
		$('#ketua_cabTB').val('');
		// data alamat
		$('#id_mkecTB').val('');
		$('#malamatTB').val('');
		$('#pre_malamatTB').val('');
		$('#kode_posTB').val('');
		$('#webTB').val('');
		$('#telp_1TB').val('');
		$('#telp_2TB').val('');
		$('#telp_3TB').val('');
		$('#hpTB').val('');
		$('#faxTB').val('');
	}
	//end of kosongkan form

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var aksi ='aksi=tampil';
		var cari = '&nomer_kwarcabS='+$('#nomer_kwarcabTS').val()
					+'&ketua_cabS='+$('#ketua_cabTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&faxS='+$('#faxTS').val()
					;

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KWARCAB');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari = '&nomer_kwarcabS='+$('#nomer_kwarcabTS').val()
					+'&ketua_cabS='+$('#ketua_cabTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&faxS='+$('#faxTS').val();

		$.ajax({
			url:dir,
			type:"GET",
			data: datax+cari,
			success:function(data){
				$("#loadtabel").fadeOut();
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}	
	
	





	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);

		$('#nomer_kwarcabTS').on('keyup',loadData);
		$('#ketua_cabTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#malamatTS').on('keyup',loadData);
		$('#kode_posTS').on('keyup',loadData);
		$('#webTS').on('keyup',loadData);
		$('#telp_1TS').on('keyup',loadData);
		$('#faxTS').on('keyup',loadData);
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			// combomkec('');
			combomkota('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH KWARCAB').fadeIn(); //diganti
		});
		$('#nomer_kwarcabTB').on('change', cekNomer);
		$('#id_mkotaTB').on('change',function (){
			combomkec($(this).val(),'');
		});
		//masuk halaman "VIEW DATA"
		$('#viewBC').click(function(){
			kosongkan();
			$(this).toggle();
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#addBC').toggle();
			loadData();	
		});
	});	
	
// function cekNomer(nomer_kwarcab){
function cekNomer(){
	var valx 	= $('#nomer_kwarcabTB').val();
	var digit 	= valx.length;
	if( valx != valx.replace(/[^0-9]/g, '')){ // cek hanya angka 
		$('#nomer_kwarcabTB').val(valx.replace(/[^0-9]/g, ''));
		$('#nomer_kwarcabInfo').html('<span class="label label-important">hanya angka</span>');
	}else if(digit>3){ // cek 3 digit
		$('#nomer_kwarcabInfo').html('<span class="label label-important">maksimal 3 digit</span>');
	}else{ //sudah 3 digit -> cek k db
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=cek&menu=nomer_kwarcab&nomer_kwarcab='+valx,
			dataType:'json',
			success:function(data){
				if(valx==''){ //kosong 
					$('#nomer_kwarcabInfo').html('<span class="label label-important">harus diisi (hanya angka)</span>');
				}else{ // terisi 
					if(data.status=='terpakai'){ // terpaksi
						if($('#nomer_kwarcabH').val()==''){
							$('#nomer_kwarcabInfo').html('<span class="label label-important">\''+valx+'\' telah terpakai</span>');
							$('#nomer_kwarcabTB').val('');
							return false;
						}
					}else{ // tersedia 
						$('#nomer_kwarcabInfo').html('<span class="label label-success"><i class="icon-ok"></i> tersedia</span>');
					}
				}
			}
		});
	}
}
