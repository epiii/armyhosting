var dir = 'server/p_mkwaran.php'; //diganti

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		$.ajax({
			url	: dir,
			type: 'GET',
			data: 'aksi=tampil',
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KWARAN'); //diganti
				$('#isi').hide().html(data).fadeIn(1000);
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
				if(data.status!='sukses'){
					optiony+='<option value="">'+data.status+'</option>'; //diganti
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
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

	function combomkec(id_mkota,id_mkec){ //diganti
		// alert(id_mkec);
		$.ajax({
			url:dir,
			type:'get',
			// data:'aksi=combo&menu=mkec&id_mkota='+id_mkota+'&id_mkec='+id_mkec, //diganti
			data:'aksi=combo&menu=mkec&id_mkota='+id_mkota+'&id_mkec='+id_mkec, //diganti
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkecTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkec==id_mkec){ //edit
							optiony+='<option selected="selected" value='+item.id_mkec+'>'+item.mkec+' </option>'; //diganti
						}else{ //add
							optiony+='<option value='+item.id_mkec+'>'+item.mkec+' </option>'; //diganti
						}
					});
					$('#id_mkecTB').html('<option value="">pilih Kecamatan ..</option>'+optiony); //diganti
				}
			}
		});
	}

	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mkwaran = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mkwaran='+id_mkwaran; //diganti
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
	function hapusmkwaran(id_mkwaran){ //diganti
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mkwaran='+id_mkwaran, //diganti
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
	function editmkwaran(id_mkwaran){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mkwaran='+id_mkwaran, //diganti
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id_mkwaran);
					$('#id_malamatH').val(data.id_malamat);
					$('#id_mloginH').val(data.id_mlogin);
					$('#malamatTB').val(data.malamat);
					$('#nomer_kwaranTB').val(data.nomer_kwaran);
					 
					// $('#mkwaran').val(mkwaran);
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
					// $('#paswotTB').val(data.paswot);
					
					combomkwarcab(data.id_mkwarcab);
					combomkec(data.id_mkec,data.id_mkota);
					// combommkwarcab(data.id_mkwarcab);
					$('#loadarea').html('<i class="icon-edit"></i> UBAH KWARAN').fadeIn(); //diganti
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
		$('#id_mkecTB').val('');
		$('#nomer_kwaranTB').val('');
		$('#ketua_ranTB').val('');
		// data alamat
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

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var aksi ='aksi=tampil';
		var cari = '&nomer_kwaranS='+$('#nomer_kwaranTS').val()
					+'&ketua_ranS='+$('#ketua_ranTS').val()
					+'&mkecS='+$('#mkecTS').val()
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
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KWARAN');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari = '&nomer_kwaranS='+$('#nomer_kwaranTS').val()
					+'&ketua_ranS='+$('#ketua_ranTS').val()
					+'&mkecS='+$('#mkecTS').val()
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
		// $('#id_mkotaTB').on('change',function(){
		// 	combomkec($(this).val());
		// });
		$('form').on('submit', submitForm);
	
		$('#nomer_kwaranTS').on('keyup',loadData);
		$('#ketua_ranTS').on('keyup',loadData);
		$('#mkecTS').on('keyup',loadData);
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
			combomkwarcab('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH KWARAN').fadeIn(); //diganti
		});
		$('#id_mkotaTB').on('change',function(){
			var id_mkota = $(this).val();
			combomkec(id_mkota,'');
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
	