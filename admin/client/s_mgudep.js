var dir = 'server/p_mgudep.php'; //diganti

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax 	='aksi=tampil';
		var cari 	= '&nomer_gudepS='+$('#nomer_gudepTS').val()
					+'&nama_pangkalanS='+$('#nama_pangkalanTS').val()
					+'&mkwarcabS='+$('#mkwarcabTS').val()
					+'&mkwaranS='+$('#mkwaranTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&telp_2S='+$('#telp_2TS').val()
					+'&telp_3S='+$('#telp_3TS').val()
					+'&faxS='+$('#faxTS').val();

		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR GUDEP'); //diganti
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}


	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax 	= 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari 	= '&nomer_gudepS='+$('#nomer_gudepTS').val()
					+'&nama_pangkalanS='+$('#nama_pangkalanTS').val()
					+'&mkwarcabS='+$('#mkwarcabTS').val()
					+'&mkwaranS='+$('#mkwaranTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&telp_2S='+$('#telp_2TS').val()
					+'&telp_3S='+$('#telp_3TS').val()
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

	function combomkwaran(id_mkwaran){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=id_mkwaran&id_mkwaran='+id_mkwaran, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){

				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkwaran==id_mkwaran){ //diganti
							optiony+='<option selected="selected" value='+item.id_mkwaran+'>'+item.mkwaran+' '+item.nomer_kwaran+' </option>'; //diganti
						}else{
							optiony+='<option value='+item.id_mkwaran+'>'+item.mkwaran+' '+item.nomer_kwaran+' </option>'; //diganti
						}
					});
					$('#id_mkwaranTB').html('<option value="">pilih KWARAN ..</option>'+optiony); //diganti
				}
			}
		});
	}


	function combomkwarcab(id_mkwarcab){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkwarcab', //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					optiony+='<option value="">data kosong</option>'; //diganti
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkwarcab==id_mkwarcab){ //diganti
							optiony+='<option selected="selected" value='+item.id_mkota+'> '+item.mkota+' ('+item.nomer_kwarcab+')  </option>'; //diganti
						}else{
							optiony+='<option value='+item.id_mkota+'> '+item.mkota+' ('+item.nomer_kwarcab+') </option>'; //diganti
						}
					});
					$('#id_mkotaTB').html('<option value="">pilih KWARCAB ..</option>'+optiony); //diganti
				}
			}
		});
	}


	function combomkec(id_mkec,id_mkota){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkec&id_mkota='+id_mkota, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					optiony+='<option value="">data kosong</option>'; //diganti
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkec==id_mkec){ //edit
							optiony+='<option selected="selected" value='+item.id_mkec+'>'+item.mkec+' </option>'; //diganti
						}else{ //add
							optiony+='<option value='+item.id_mkec+'>'+item.mkec+' </option>'; //diganti
						}
					});
					$('#id_mkecTB').html('<option value="">pilih KWARAN ..</option>'+optiony); //diganti
				}
			}
		});
	}




	/*function combomkwarcab(id_mkwarcab){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=id_mkwarcab&id_mkwarcab='+id_mkwarcab, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){

				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkwarcab==id_mkwarcab){ //diganti
							optiony+='<option selected="selected" value='+item.id_mkwarcab+'>'+item.mkwarcab+' '+item.nomer_kwarcab+' </option>'; //diganti
						}else{
							optiony+='<option value='+item.id_mkwarcab+'>'+item.mkwarcab+' '+item.nomer_kwarcab+' </option>'; //diganti
						}
					});
					$('#id_mkwarcabTB').html('<option value="">pilih KWARCAB ..</option>'+optiony); //diganti
				}
			}
		});
	}*/

	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mgudep = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mgudep='+id_mgudep; //diganti
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
	function hapusmgudep(id_mgudep){ //diganti
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			// data:'aksi=hapus&id_mlogin='+id_mlogin, //diganti
			data:'aksi=hapus&id_mgudep='+id_mgudep, //diganti
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
	function editmgudep(id_mgudep){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mgudep='+id_mgudep, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id_mgudep); 
					$('#nomer_gudepTB').val(data.nomer_gudep);
					$('#nama_pangkalanTB').val(data.nama_pangkalan);
					$('#tgl_berdiriTB').val(data.tgl_berdiri);

					$('#id_mloginTB').val(data.id_mlogin); 
					$('#id_malamatH').val(data.id_malamat); 
					$('#id_mloginH').val(data.id_mlogin); 
					$('#malamatTB').val(data.malamat); 
										
					$('#kode_posTB').val(data.kode_pos);
					$('#pre_malamatTB').val(data.pre_malamat);
					$('#kode_posTB').val(data.kode_pos);
					$('#webTB').val(data.web);
					// $('#hpTB').val(data.hp);
					$('#telp_1TB').val(data.telp_1);
					$('#telp_2TB').val(data.telp_2);
					$('#telp_3TB').val(data.telp_3);
					$('#faxTB').val(data.fax);
					$('#emailTB').val(data.email);

					combomkwarcab(data.id_mkwarcab);
					combomkec(data.id_mkec,data.id_mkota);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH GUDEP').fadeIn(); //diganti
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
		$('#yuserTB').val('');
		$('#paswotTB').val('');
		$('#nomer_gudepTB').val('');
		$('#nama_pangkalanTB').val('');
		$('#tgl_berdiriTB').val('');
		$('#id_mkotaTB').val('');
		$('#id_mkecTB').val('');
		$('#pre_malamatTB').val('');
		$('#malamatTB').val('');
		$('#kode_posTB').val('');
		$('#webTB').val('');
		$('#telp_1TB').val('');
		$('#telp_2TB').val('');
		$('#telp_3TB').val('');
		$('#faxTB').val('');
		$('#emailTB').val('');
	}
	//end of kosongkan form

	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$("#tgl_berdiriTB").datepicker(function(){
			format:"yyyy-mm-dd"
		});

		$('form').on('submit', submitForm);
	
		$('#nomer_gudepTS').on('keyup',loadData);
		$('#nama_pangkalanTS').on('keyup',loadData);
		$('#mkwarcabTS').on('keyup',loadData);
		$('#mkwaranTS').on('keyup',loadData);
		$('#malamatTS').on('keyup',loadData);
		$('#kode_posTS').on('keyup',loadData);
		$('#webTS').on('keyup',loadData);
		$('#telp_1TS').on('keyup',loadData);
		$('#telp_2TS').on('keyup',loadData);
		$('#telp_3TS').on('keyup',loadData);
		$('#faxTS').on('keyup',loadData);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkwarcab('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH GUDEP').fadeIn(); //diganti
		});
		$('#id_mkotaTB').on('change',function(){
			var id_mkwarcab = $('#id_mkotaTB').val();
			combomkec('',id_mkwarcab);
		
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
	