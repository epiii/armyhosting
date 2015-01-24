var dir='server/p_msubgolongan.php';
// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});

		$('#id_mgolonganTB').on('change',function(){
			combomsubgolongan('',$(this).val());
		});

		$('#malamatTS').on('keyup',loadData);
		$('#mgolonganTS').on('keyup',loadData);
		$('#msubgolonganTS').on('keyup',loadData);
		$('#kode_posTS').on('keyup',loadData);
		$('#webTS').on('keyup',loadData);
		$('#hpTS').on('keyup',loadData);
		$('#telp_1TS').on('keyup',loadData);
		$('#telp_2TS').on('keyup',loadData);
		$('#telp_3TS').on('keyup',loadData);
		$('#faxTS').on('keyup',loadData);

		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomgolongan('');
			// combomsubgolongan('');
			// combombukeg('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH SUB GOLONGAN').fadeIn();
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
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var aksi ='aksi=tampil';
		var cari ='&mgolonganS='+$('#mgolonganTS').val()+'&msubgolonganS='+$('#msubgolonganTS').val();

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR SUB GOLONGAN');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&mgolonganS='+$('#mgolonganTS').val()+'&msubgolonganS='+$('#msubgolonganTS').val();

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

	function combomgolongan(id_mgolongan){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mgolongan',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mgolongan==id_mgolongan){
							optiony+='<option selected="selected" value='+item.id_mgolongan+'>'+item.mgolongan+' </option>';
						}else{
							optiony+='<option value='+item.id_mgolongan+'>'+item.mgolongan+' </option>';
 						}
					});
					$('#id_mgolonganTB').html('<option value="">pilih kota..</option>'+optiony);
				}
			}
		});
	}

	function combomsubgolongan(id_msubgolongan,id_mgolongan){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=msubgolongan&id_mgolongan='+id_mgolongan+'&id_msubgolongan='+id_msubgolongan,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					$('#id_msubgolonganTB').html('<option value="">kosong</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_msubgolongan==id_msubgolongan){
							optiony+='<option selected="selected" value='+item.id_msubgolongan+'>'+item.msubgolongan+' </option>';
						}else{
							optiony+='<option value='+item.id_msubgolongan+'>'+item.msubgolongan+' </option>';
 						}
					});
					$('#id_msubgolonganTB').html('<option value="">pilih SUB GOLONGAN ..</option>'+optiony);
				}
			}
		});
	}

	function combombukeg(id_mbukeg){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mbukeg',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mbukeg==id_mbukeg){
							optiony+='<option selected="selected" value='+item.id_mbukeg+'>'+item.mbukeg+' </option>';
						}else{
							optiony+='<option value='+item.id_mbukeg+'>'+item.mbukeg+'</option>';
 						}
					});
					$('#id_mbukegTB').html('<option value="">pilih Bukti Kegiatan ..</option>'+optiony);
				}
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
		
		var id_msubgolongan = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_msubgolongan='+id_msubgolongan;
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
	function hapusmsubgolongan(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_msubgolongan='+id,
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
	function editmsubgolongan(id){
		kosongkan();
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_msubgolongan='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					$('#idformTB').val(id); 
					$('#msubgolonganTB').val(data.msubgolongan);
					
					combomgolongan(data.id_mgolongan);

					$('#loadarea').html('<i class="icon-edit"></i> UBAH SUB GOLONGAN').fadeIn();
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
		$('#malamatTB').val('');
		$('#subkatkegTB').val('');
		$('#mbukegTB').val('');
		$('#batutTB').val('');
		$('#jumbatutTB').val('');
		$('#poinTB').val('');
	}
	//end of kosongkan form

	function poShow(x,y){
		$('#po'+y+'_'+x).popover('show');
	}

	function poHide(x,y){
		$('#po'+y+'_'+x).popover('hide');
	}
		
	// function cari(){
	// 	loadData('');
	// }
	
	