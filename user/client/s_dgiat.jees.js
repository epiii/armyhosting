var dir='server/p_dgiat.php';

	function combogolongan(id_mgolongan){
		$.ajax({
			url:dir,
			type:'get',
			dataType:'json',
			cache:false,
			data:'aksi=combo&menu=mgolongan',
			success:function(data){
				var optiony ='';
				if(data.status!='sukses'){
					optiony+='<option value="">'+data.status+'</option>';
				}else{
					$.each(data.datax, function (id,item){
						if(id_mgolongan==item.id_mgolongan){
							optiony+='<option value="'+item.id_mgolongan+'" selected="selected">'+item.mgolongan+' </option>';
						}else{
							optiony+='<option value="'+item.id_mgolongan+'">'+item.mgolongan+' </option>';
						}
					});
				}
				$('#mgolonganTB').html('<option value="">Pilih Golongan..</option>'+optiony);
			}
		}); 
	}
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&drkegpramS='+$('#drkegpramTS').val()
				 +'&mgolonganS='+$('#mgolonganTS').val()
				 +'&manggotaS='+$('#manggotaTS').val()
				 +'&tglS='+$('#tglTS').val()
				 +'&lokasiS='+$('#lokasiTS').val()
				 +'&tingkatS='+$('#tingkatTS').val()
				 +'&kategoriS='+$('#kategoriTS').val()
				 +'&statusS='+$('#statusTS').val()
				 +'&ketS='+$('#ketTS').val();
				 		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KEPARAMUKAAN');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&drkegpramS='+$('#drkegpramTS').val()
				 +'&mgolonganS='+$('#mgolonganTS').val()
				 +'&manggotaS='+$('#manggotaTS').val()
				 +'&tglS='+$('#tglTS').val()
				 +'&lokasiS='+$('#lokasiTS').val()
				 +'&tingkatS='+$('#tingkatTS').val()
				 +'&kategoriS='+$('#kategoriTS').val()
				 +'&statusS='+$('#statusTS').val()
				 +'&ketS='+$('#ketTS').val();

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
		
		var id_drkegpram = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_drkegpram='+id_drkegpram;
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
			data:'aksi=hapus&id_drkegpram='+id,
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
			data:'aksi=ambiledit&id_drkegpram='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id);
					$('#mgolonganTB').val(data.mgolongan);
					$('#id_manggotaH').val(data.id_manggota);
					$('#manggotaTB').val(data.manggota); 
					$('#drkegpramTB').val(data.drkegpram);
					$('#tglTB').val(data.tgl);
					$('#lokasiTB').val(data.lokasi);
					$('#tingkatTB').val(data.tingkat);
					$('#kategoriTB').val(data.kategori);
					$('#statusTB').val(data.status);
					$('#ketTB').val(data.ket);
					
					
					combogolongan(data.id_mgolongan);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT KEGIATAN').fadeIn();
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
		$('#manggotaTB').val('');
		$('#mgolonganTB').val('');
		$('#drkegpramTB').val('');
		$('#tglTB').val('');
		$('#lokasiTB').val('');
		$('#tingkatTB').val('');
		$('#kategoriTB').val('');
		$('#statusTB').val('');
		$('#ketTB').val('');
		}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
			
		$('#mgolonganTS').on('keyup',loadData);
		$('#manggotaTS').on('keyup',loadData);
		$('#drkegpramTS').on('keyup',loadData);
		$('#tglTS').on('keyup',loadData);
		$('#lokasiTS').on('keyup',loadData);
		$('#tingkatTS').on('keyup',loadData);
		$('#kategoriTS').on('keyup',loadData);
		$('#statusTS').on('keyup',loadData);
		$('#ketTS').on('keyup',loadData);
		
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();

			combogolongan ('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT KEGIATAN').fadeIn();
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
	