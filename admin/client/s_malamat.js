var dir='server/p_malamat.php';
// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});

		$('#id_mkotaTB').on('change',function(){
			combomkec('',$(this).val());
		});

		$('#malamatTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#mkecTS').on('keyup',loadData);
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
			combomkota('');
			// combomkec('');
			// combombukeg('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH ALAMAT').fadeIn();
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
		var cari = '&malamatS='+$('#malamatTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&mkecS='+$('#mkecTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&hpS='+$('#hpTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&telp_2S='+$('#telp_2TS').val()
					+'&faxS='+$('#faxTS').val()
					+'&telp_3S='+$('#telp_3TS').val();
		// alert(cari);return false;

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR ALAMAT');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari = '&malamatS='+$('#malamatTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&mkecS='+$('#mkecTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&webS='+$('#webTS').val()
					+'&hpS='+$('#hpTS').val()
					+'&telp_1S='+$('#telp_1TS').val()
					+'&telp_2S='+$('#telp_2TS').val()
					+'&faxS='+$('#faxTS').val()
					+'&telp_3S='+$('#telp_3TS').val();

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

	function combomkota(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkota==id_mkota){
							optiony+='<option selected="selected" value='+item.id_mkota+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
 						}
					});
					$('#id_mkotaTB').html('<option value="">pilih kota..</option>'+optiony);
				}
			}
		});
	}

	function combomkec(id_mkec,id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkec&id_mkota='+id_mkota+'&id_mkec='+id_mkec,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					$('#id_mkecTB').html('<option value="">kosong</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkec==id_mkec){
							optiony+='<option selected="selected" value='+item.id_mkec+'>'+item.mkec+' </option>';
						}else{
							optiony+='<option value='+item.id_mkec+'>'+item.mkec+' </option>';
 						}
					});
					$('#id_mkecTB').html('<option value="">pilih kecamatan ..</option>'+optiony);
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
		
		var id_malamat = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_malamat='+id_malamat;
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
	function hapusmalamat(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_malamat='+id,
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
	function editmalamat(id){
		kosongkan();
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_malamat='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					$('#idformTB').val(id); 
					$('#malamatTB').val(data.malamat);
					$('#pre_malamatTB').val(data.pre_malamat);
					$('#kode_posTB').val(data.kode_pos);
					$('#webTB').val(data.web);
					$('#hpTB').val(data.hp);
					$('#telp_1TB').val(data.telp_1);
					$('#telp_2TB').val(data.telp_2);
					$('#telp_3TB').val(data.telp_3);
					$('#faxTB').val(data.fax);
					
					combomkota(data.id_mkota);
					combomkec(data.id_mkec,'');

					$('#loadarea').html('<i class="icon-edit"></i> UBAH ALAMAT').fadeIn();
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
	
	