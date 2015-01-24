var dir='server/p_drpendi.php';
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&nm_kursusS='+$('#nm_kursusTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
				 +'&nm_lembagaS='+$('#nm_lembagaTS').val()
				 +'&alamat_pendiS='+$('#alamat_pendiTS').val()
				 +'&thn_kursusS='+$('#thn_kursusTS').val();
				 		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR RIWAYAT PENDIDIKAN INFORMAL');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&nm_kursusS='+$('#nm_kursusTS').val()
				 +'&no_sertifikatS='+$('#no_sertifikatTS').val()
				 +'&nm_lembagaS='+$('#nm_lembagaTS').val()
				 +'&alamat_pendiS='+$('#alamat_pendiTS').val()
				 +'&thn_kursusS='+$('#thn_kursusTS').val();

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
		
		var id_drpendi = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_drpendi='+id_drpendi;
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
			data:'aksi=hapus&id_drpendi='+id,
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
			data:'aksi=ambiledit&id_drpendi='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#nm_kursusTB').val(data.nm_kursus);
					$('#no_sertifikatTB').val(data.no_sertifikat);
					$('#nm_lembagaTB').val(data.nm_lembaga);
					$('#alamat_pendiTB').val(data.alamat_pendi);
					$('#thn_kursusTB').val(data.thn_kursus);
					
					
					/*combomkota(data.id_mpropinsi,data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);*/
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT PENDIDIKAN INFORMAL').fadeIn();
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
		$('#nm_kursusTB').val('');
		$('#no_sertifikatTB').val('');
		$('#nm_lembagaTB').val('');
		$('#alamat_pendiTB').val('');
		$('#thn_kursusTB').val('');
		}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_drpendi.php'
					+'?tipe=pdf'
					+'&nm_kursus='+$('#nm_kursusTS').val()
					+'&no_sertifikat='+$('#no_sertifikatTS').val()
					+'&nm_lembaga='+$('#nm_lembagaTS').val()
					+'&alamat_pendi='+$('#alamat_pendiTS').val()
					+'&thn_kursus='+$('#thn_kursusTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
			
		$('#nm_kursusTS').on('keyup',loadData);
		$('#no_sertifikatTS').on('keyup',loadData);
		$('#nm_lembagaTS').on('keyup',loadData);
		$('#alamat_pendiTS').on('keyup',loadData);
		$('#thn_kursusTS').on('keyup',loadData);
		
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT PENDIDIKAN INFORMAL').fadeIn();
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
	