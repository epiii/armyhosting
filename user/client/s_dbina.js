var dir='server/p_dbina.php';
	
	function combomgudep(id_mkwaran,id_mgudep){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mgudep&id_mkwaran='+id_mkwaran,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mgudepTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mgudep==id_mgudep){
							optiony+='<option selected="selected" value='+item.id_mgudep+'>('+item.nomer_gudep+') '+item.nama_pangkalan+' </option>';
						}else{
							optiony+='<option value='+item.id_mgudep+'>('+item.nomer_gudep+') '+item.nama_pangkalan+' </option>';
						}
					});
					$('#id_mgudepTB').html('<option value="">pilih gudep ..</option>'+optiony);
				}
			}
		});
	}

	function combomkwaran(id_mkwarcab,id_mkwaran){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkwaran&id_mkwarcab='+id_mkwarcab,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkwaranTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkwaran==id_mkwaran){
							optiony+='<option selected="selected" value='+item.id_mkwaran+'>'+item.mkec+' </option>';
						}else{
							optiony+='<option value='+item.id_mkwaran+'>'+item.mkec+' </option>';
						}
					});
					$('#id_mkwaranTB').html('<option value="">pilih Kwaran ..</option>'+optiony);
				}
			}
		});
	}

	function combomkwarcab(id_mkwarcab){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkwarcab',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkwarcabTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkwarcab==id_mkwarcab){
							optiony+='<option selected="selected" value='+item.id_mkwarcab+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkwarcab+'>'+item.mkota+' </option>';
						}
					});
					$('#id_mkwarcabTB').html('<option value="">pilih Kwarcab ..</option>'+optiony);
				}
			}
		});
	}


	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&keahlianS='+$('#keahlianTS').val()
				 +'&thn_binaS='+$('#thn_binaTS').val()
				 +'&thn_selesaiS='+$('#thn_selesaiTS').val()
				 +'&no_gudepS='+$('#no_gudepTS').val()
				 +'&ket_binaS='+$('#ket_binaTS').val();
				 		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR RIWAYAT MEMBINA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&keahlianS='+$('#keahlianTS').val()
				 +'&thn_binaS='+$('#thn_binaTS').val()
				 +'&thn_selesaiS='+$('#thn_selesaiTS').val()
				 +'&no_gudepS='+$('#no_gudepTS').val()
				 +'&ket_binaS='+$('#ket_binaTS').val();

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
		
		var id_dbina = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_dbina='+id_dbina;
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
			data:'aksi=hapus&id_dbina='+id,
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
			data:'aksi=ambiledit&id_dbina='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#keahlianTB').val(data.keahlian);
					$('#thn_binaTB').val(data.thn_bina);
					$('#thn_selesaiTB').val(data.thn_selesai);
					$('#no_gudepTB').val(data.no_gudep);
					$('#ket_binaTB').val(data.ket_bina);
					
					
					/*combomkwarcab(data.id_mpropinsi,data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);*/
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT MEMBINA').fadeIn();
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
		$('#keahlianTB').val('');
		$('#thn_binaTB').val('');
		$('#thn_selesaiTB').val('');
		$('#no_gudepTB').val('');
		$('#ket_binaTB').val('');
		}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_drbina.php'
					+'?tipe=pdf'
					+'&keahlianS='+$('#keahlianTS').val()
					+'&thn_binaS='+$('#thn_binaTS').val()
					+'&thn_selesaiS='+$('#thn_selesaiTS').val()
					+'&no_gudepS='+$('#no_gudepTS').val()
					+'&ket_binaS='+$('#ket_binaTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
			
		$('#keahlianTS').on('keyup',loadData);
		$('#thn_binaTS').on('keyup',loadData);
		$('#thn_selesaiTS').on('keyup',loadData);
		$('#no_gudepTS').on('keyup',loadData);
		$('#ket_binaTS').on('keyup',loadData);
		
		$('#id_mkwarcabTB').on('change',function(){
			var x = $(this).val();
			combomkwaran(x,'');
		});
		
		$('#id_mkwaranTB').change(function(){
			// var y = $('#id_mkwaranTB').attr('name');
			// alert(y);
			combomgudep($('#id_mkwaranTB').val(),'');
		});
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkwarcab('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT MEMBINA').fadeIn();
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
	