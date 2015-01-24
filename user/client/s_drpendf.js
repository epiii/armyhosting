var dir='server/p_drpendf.php';

	function combodsubpendf(id_dsubpendf){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=dsubpendf',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_dsubpendfTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_dsubpendf==id_dsubpendf){
							optiony+='<option selected="selected" value='+item.id_dsubpendf+'>'+item.fakultas+' / '+item.jurusan+' </option>';
						}else{
							optiony+='<option value='+item.id_dsubpendf+'>'+item.fakultas+' / '+item.jurusan+' </option>';
						}
					});
					$('#id_dsubpendfTB').html('<option value="">pilih fakultas / jurusan ..</option>'+optiony);
				}
			}
		});
	}

	function combomkota(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota',
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
					$('#id_mkecTB').html('<option value="">pilih Kota ..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&pendidikanS='+$('#pendidikanTS').val()
				 +'&nm_instansiS='+$('#nm_instansiTS').val()
				 +'&thn_masukS='+$('#thn_masukTS').val()
				 +'&thn_lulusS='+$('#thn_lulusTS').val()
				 +'&no_ijazahS='+$('#no_ijazahTS').val()
				 +'&fakultasS='+$('#fakultasTS').val()
				 +'&jurusanS='+$('#jurusanTS').val()
				 +'&kelasS='+$('#kelasTS').val()
				 +'&no_indukS='+$('#no_indukTS').val()
				 +'&malamatS='+$('#malamatTS').val();		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR RIWAYAT PENDIDIKAN FORMAL');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&pendidikanS='+$('#pendidikanTS').val()
				 +'&nm_instansiS='+$('#nm_instansiTS').val()
				 +'&thn_masukS='+$('#thn_masukTS').val()
				 +'&thn_lulusS='+$('#thn_lulusTS').val()
				 +'&no_ijazahS='+$('#no_ijazahTS').val()
				 +'&fakultasS='+$('#fakultasTS').val()
				 +'&jurusanS='+$('#jurusanTS').val()
				 +'&kelasS='+$('#kelasTS').val()
				 +'&no_indukS='+$('#no_indukTS').val()
				 +'&malamatS='+$('#malamatTS').val();		

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
	
	//validasi poin (harus angka)
	function cekPoin(poin){
		if( $('#pointTB').val() != $('#pointTB').val().replace(/[^0-9]/g, '')){ // cek hanya angka 
			$('#pointTB').val($('#pointTB').val().replace(/[^0-9]/g, ''));
		}
	}
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_dsubpendf= +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_dsubpendf='+id_dsubpendf;
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
	function hapusGol(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_drpendf='+id,
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
	function editGol(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_drpendf='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#id_malamatH').val(data.id_malamat); 
					$('#pendidikanTB').val(data.pendidikan);
					$('#nm_instansiTB').val(data.nm_instansi);
					$('#no_ijazahTB').val(data.no_ijazah);
					$('#thn_masukTB').val(data.thn_masuk);
					$('#thn_lulusTB').val(data.thn_lulus);
					$('#kelasTB').val(data.kelas);
					$('#pre_malamatTB').val(data.pre_malamat);
					$('#malamatTB').val(data.malamat);
					$('#no_indukTB').val(data.no_induk);
					
					combodsubpendf(data.id_dsubpendf);
					combomkota(data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT PENDIDIKAN FORMAL').fadeIn();
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
		$('#id_malamatH').val('');
		$('#id_mkotaTB').val('');
		$('#id_mkecTB').val('');
		$('#pendidikanTB').val('');
		$('#nm_instansiTB').val('');
		$('#thn_masukTB').val('');
		$('#thn_lulusTB').val('');
		$('#alamatTB').val('');
		$('#kelasTB').val('');
		$('#no_indukTB').val('');
		$('#no_ijazahTB').val('');
	}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		// untuk cetak pdf
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_drpendf.php'
					+'?tipe=pdf'
					+'&pendidikan='+$('#pendidikanTS').val()
					+'&nm_instansi='+$('#nm_instansiTS').val()
					+'&thn_masuk='+$('#thn_masukTS').val()
					+'&thn_lulus='+$('#thn_lulusTS').val()
					+'&no_ijazah='+$('#no_ijazahTS').val()
					+'&fakultas='+$('#fakultasTS').val()
					+'&jurusan='+$('#jurusanTS').val()
					+'&kelas='+$('#kelasTS').val()
					+'&no_induk='+$('#no_indukTS').val()
					+'&malamat='+$('#malamatTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
		// untuk cetak pdf


		$('#id_mkotaTB').on('change', function(){
			combomkec($(this).val(),'');
		});
		
		$('#pendidikanTS').on('keyup',loadData);
		$('#nm_instansiTS').on('keyup',loadData);
		$('#thn_masukTS').on('keyup',loadData);
		$('#thn_lulusTS').on('keyup',loadData);
		$('#no_ijazahTS').on('keyup',loadData);
		$('#fakultasTS').on('keyup',loadData);
		$('#jurusanTS').on('keyup',loadData);
		$('#kelasTS').on('keyup',loadData);
		$('#no_indukTS').on('keyup',loadData);
		$('#malamatTS').on('keyup',loadData);
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkota('');
			combodsubpendf('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT PENDIDIKAN FORMAL').fadeIn();
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
	