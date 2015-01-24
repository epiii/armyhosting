var dir='server/p_manggota.php';

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
		var cari ='&no_anggotaS='+$('#no_anggotaTS').val()
				 +'&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&jenis_kelaminS='+$('#jenis_kelaminTS').val()
				 +'&nama_pangkalanS='+$('#nama_pangkalanTS').val()
				 +'&mkecS='+$('#mkecTS').val();
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR ANGGOTA (Tingkat Kwarcab)');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&no_anggotaS='+$('#no_anggotaTS').val()
				 +'&full_anggotaS='+$('#full_anggotaTS').val()
				 +'&jenis_kelaminS='+$('#jenis_kelaminTS').val()
				 +'&nama_pangkalanS='+$('#nama_pangkalanTS').val()
				 +'&mkecS='+$('#mkecTS').val();
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
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_manggota.php'
					+'?tipe=pdf'
					+'&no_anggota='+$('#no_anggotaTS').val()
					+'&full_anggota='+$('#full_anggotaTS').val()
					+'&jenis_kelamin='+$('#jenis_kelaminTS').val()
					+'&nama_pangkalan='+$('#nama_pangkalanTS').val()
					+'&mkec='+$('#mkecTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})

		$('#no_anggotaTS').on('keyup',loadData);
		$('#full_anggotaTS').on('keyup',loadData);
		$('#jenis_kelaminTS').on('change',loadData);
		$('#nama_pangkalanTS').on('keyup',loadData);
		$('#mkecTS').on('keyup',loadData);
		
		$('form').on('submit', submitForm);
	
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkota('');
			combodsubpendf('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH ANGGOTA (Tingkat Kwarcab)').fadeIn();
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
	