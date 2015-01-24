var dir='server/p_dkecpkhusus.php';
	function combomkecpkhusus(id_mkecpkhusus){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkecpkhusus',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#mkecpkhususTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkecpkhusus==id_mkecpkhusus){
							optiony+='<option selected="selected" value='+item.id_mkecpkhusus+'>'+item.mkecpkhusus+' </option>';
						}else{
							optiony+='<option value='+item.id_mkecpkhusus+'>'+item.mkecpkhusus+' </option>';
						}
					});
					$('#mkecpkhususTB').html('<option value="">pilih kecakapan khusus ..</option>'+optiony);
				}
			}
		});
	}

	function combomanggota(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=manggota',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#full_anggotaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_manggota==id_manggota){
							optiony+='<option selected="selected" value='+item.id_manggota+'>'+item.full_anggota+' </option>';
						}else{
							optiony+='<option value='+item.id_manggota+'>'+item.full_anggota+' </option>';
						}
					});
					$('#full_anggotaTB').html('<option value="">pilih anggota ..</option>'+optiony);
				}
			}
		});
	}

	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&mkecpkhususS='+$('#mkecpkhususTS').val()
				 // +'&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
				 +'&levelS='+$('#levelTS').val()
				 +'&tglS='+$('#tglTS').val()
				 +'&ketergnS='+$('#ketergnTS').val();		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DETAIL KECAKAPAN KHUSUS');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&mkecpkhususS='+$('#mkecpkhususTS').val()
				 // +'&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
				 +'&levelS='+$('#levelTS').val()
				 +'&tglS='+$('#tglTS').val()
				 +'&ketergnS='+$('#ketergnTS').val();		

		$.ajax({
			url:dir,
			type:"GET",
			data: datax,
			success:function(data){
				$("#loadtabel").fadeOut();
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_drkecpkhusus= +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_drkecpkhusus='+id_drkecpkhusus;
		}
		//console.log(urlx);
		//return false;
		$.ajax({
			url:urlx,
			type:'post',
			dataType:'json',
			data:$('form').serialize(),
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
	function hapustombol(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_drkecpkhusus='+id,
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
	function edittombol(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_drkecpkhusus='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#mkecpkhususTB').val(data.mkecpkhusus); 
					// $('#full_anggotaTB').val(data.full_anggota);
					$('#no_sertifikatTB').val(data.no_sertifikat);
					$('#levelTB').val(data.level);
					$('#tglTB').val(data.tgl);
					$('#ketergnTB').val(data.ketergn);
					
					combomkecpkhusus(data.id_mkecpkhusus);
					combomanggota(data.id_manggota);
				
					$('#loadarea').html('<i class="icon-edit"></i> UBAH DETAIL KECAKAPAN KHUSUS').fadeIn();
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
		$('#mkecpkhususTB').val('');
		// $('#full_anggotaTB').val('');
		$('#no_sertifikatTB').val('');
		$('#levelTB').val('');
		$('#tglTB').val('');
		$('#ketergnTB').val('');
	}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_dkecpkhusus.php'
					+'?tipe=pdf'
					+'&mkecpkhusus='+$('#mkecpkhususTS').val()
					+'&full_anggota='+$('#full_anggotaTS').val()
					+'&no_sertifikat='+$('#no_sertifikatTS').val()
					+'&level='+$('#levelTS').val()
					+'&tgl='+$('#tglTS').val()
					+'&ketergn='+$('#ketergnTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
		
		$('#id_mkotaTB').on('change', function(){
			combomkec($(this).val(),'');
		});
		
		$('#mkecpkhususTS').on('keyup',loadData);
		$('#full_anggotaTS').on('keyup',loadData);
		$('#no_sertifikatTS').on('keyup',loadData);
		$('#levelTS').on('keyup',loadData);
		$('#tglTS').on('keyup',loadData);
		$('#ketergnTS').on('keyup',loadData);
		
		$('form').on('submit', submitForm);
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkecpkhusus('');
			combomanggota('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DETAIL KECAKAPAN KHUSUS').fadeIn();
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

		$("#tglTB").datepicker(function(){
			format:"yyyy-mm-dd"
		});
	
	});	
	