var dir='server/p_dkecpumum.php';
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
					$('#full_anggotaTB').html('<option value="">pilih Nama Lengkap ..</option>'+optiony);
				}
			}
		});
	}

	function combomsubgolongan(id_msubgolongan){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=msubgolongan',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_msubgolonganTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_msubgolongan==id_msubgolongan){
							optiony+='<option selected="selected" value='+item.id_msubgolongan+'>'+item.msubgolongan+' </option>';
						}else{
							optiony+='<option value='+item.id_msubgolongan+'>'+item.msubgolongan+' </option>';
						}
					});
					$('#id_msubgolonganTB').html('<option value="">pilih sub anggota ..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&msubgolonganS='+$('#msubgolonganTS').val()
				 // +'&tgl_pencapaianS='+$('#tgl_pencapaianTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
				 +'&ketergnS='+$('#ketergnTS').val();		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DETAIL KECAKAPAN UMUM');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&msubgolonganS='+$('#msubgolonganTS').val()
				 // +'&tgl_pencapaianS='+$('#tgl_pencapaianTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
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
		
		var id_drkecpumum= +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_drkecpumum='+id_drkecpumum;
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
			data:'aksi=hapus&id_drkecpumum='+id,
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
			data:'aksi=ambiledit&id_drkecpumum='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#full_anggotaTB').val(data.full_anggota); 
					$('#id_msubgolonganTB').val(data.msubgolongan);
					$('#tgl_pencapaianTB').val(data.tgl_pencapaian);
					$('#no_sertifikatTB').val(data.no_sertifikat);
					$('#ketergnTB').val(data.ketergn);
					
					combomanggota(data.id_manggota);
					combomsubgolongan(data.id_msubgolongan);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH DETAIL KECAKAPAN UMUM').fadeIn();
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
		$('#full_anggotaTB').val('');
		$('#id_msubgolonganTB').val('');
		$('#tgl_pencapaianTB').val('');
		$('#no_sertifikatTB').val('');
		$('#ketergnTB').val('');
	}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_dkecpumum.php'
					+'?tipe=pdf'
					+'&full_anggota='+$('#full_anggotaTS').val()
					+'&msubgolongan='+$('#msubgolonganTS').val()
					+'&tgl_pencapaian='+$('#tgl_pencapaianTS').val()
					+'&no_sertifikat='+$('#no_sertifikatTS').val()
					+'&ketergn='+$('#ketergnTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
		
		$('#id_mkotaTB').on('change', function(){
			combomkec($(this).val(),'');
		});
		
		$('#full_anggotaTS').on('keyup',loadData);
		$('#msubgolonganTS').on('keyup',loadData);
		$('#tgl_pencapaianTS').on('keyup',loadData);
		$('#no_sertifikatTS').on('keyup',loadData);
		$('#ketergnTS').on('keyup',loadData);

		$('form').on('submit', submitForm);
	
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomanggota('');
			combomsubgolongan('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DETAIL KECAKAPAN UMUM').fadeIn();
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

		$("#tgl_pencapaianTB").datepicker(function(){
			format:"yyyy-mm-dd"
		});
	
	});	
	