var dir='server/p_mkecpkhusus.php';

function combomkatkecpkhusus(id_mkatkecpkhusus){ //diganti
	$.ajax({
		url:dir,
		type:'get',
		data:'aksi=combo&menu=mkatkecpkhusus', //diganti
		dataType:'json',
		success:function(data){
			if(data.status=='gagal'){
				optiony+='<option value="">data kosong</option>'; //diganti
			}else{
				var optiony ='';
				$.each(data, function (id,item){
					// alert(item.mkecpkhusus);return false;
					if(item.id_mkatkecpkhusus==id_mkatkecpkhusus){ //diganti
						optiony+='<option selected="selected" value='+item.id_mkatkecpkhusus+'> '+item.mkatkecpkhusus+'  </option>'; //diganti
					}else{
						optiony+='<option value='+item.id_mkatkecpkhusus+'> '+item.mkatkecpkhusus+'  </option>'; //diganti
					}
				});
				$('#id_mkatkecpkhususTB').html('<option value="">pilih Kecakapan Khusus ..</option>'+optiony); //diganti
			}
		}
	});
}

// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});

		$('#mkecpkhususTS').on('keyup',loadData);
		$('#mkatkecpkhususTS').on('keyup',loadData);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkatkecpkhusus('');

			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH KEC. KHUSUS').fadeIn();
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
		var cari = '&mkecpkhususS='+$('#mkecpkhususTS').val()+'&mkatkecpkhususS='+$('#mkatkecpkhususTS').val();

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR KEC. KHUSUS');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari = '&mkecpkhususS='+$('#mkecpkhususTS').val()+'&mkatkecpkhususS='+$('#mkatkecpkhususTS').val();

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
		
		var id_mkecpkhusus = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mkecpkhusus='+id_mkecpkhusus;
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
	function hapusmkecpkhusus(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mkecpkhusus='+id,
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
	function editmkecpkhusus(id){
		kosongkan();
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mkecpkhusus='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					$('#idformTB').val(id); 
					$('#mkecpkhususTB').val(data.mkecpkhusus);
					combomkatkecpkhusus(data.id_mkatkecpkhusus);
					// $('#mkatkecpkhususTB').val(data.mkatkecpkhusus);

					$('#loadarea').html('<i class="icon-edit"></i> UBAH KEC. KHUSUS').fadeIn();
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
	}
	//end of kosongkan form	