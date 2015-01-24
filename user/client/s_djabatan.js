var dir='server/p_djabatan.php';
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&nm_orgS='+$('#nm_orgTS').val()
				 +'&nm_jabS='+$('#nm_jabTS').val()
				 +'&tgl_lantikS='+$('#tgl_lantikTS').val()
				 +'&tgl_purnaS='+$('#tgl_purnaTS').val()
				 +'&ket_jabS='+$('#ket_jabTS').val();
				 		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR RIWAYAT ORGANISASI DILUAR PRAMUKA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&nm_orgS='+$('#nm_orgTS').val()
				 +'&nm_jabS='+$('#nm_jabTS').val()
				 +'&tgl_lantikS='+$('#tgl_lantikTS').val()
				 +'&tgl_purnaS='+$('#tgl_purnaTS').val()
				 +'&ket_jabS='+$('#ket_jabTS').val();

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
		
		var id_djabatan = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_djabatan='+id_djabatan;
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
			data:'aksi=hapus&id_djabatan='+id,
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
			data:'aksi=ambiledit&id_djabatan='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#nm_orgTB').val(data.nm_org);
					$('#nm_jabTB').val(data.nm_jab);
					$('#tgl_lantikTB').val(data.tgl_lantik);
					$('#tgl_purnaTB').val(data.tgl_purna);
					$('#ket_jabTB').val(data.ket_jab);
					
					
					/*combomkota(data.id_mpropinsi,data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);*/
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT JABATAN DILUAR PRAMUKA').fadeIn();
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
		$('#nm_orgTB').val('');
		$('#nm_jabTB').val('');
		$('#tgl_lantikTB').val('');
		$('#tgl_purnaTB').val('');
		$('#ket_jabTB').val('');
		}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		$("#tgl_lantikTB,#tgl_purnaTB").datepicker(function(){
			format:"yyyy-mm-dd"
		});
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_djabatan.php'
					+'?tipe=pdf'
					+'&nm_org='+$('#nm_orgTS').val()
					+'&nm_jab='+$('#nm_jabTS').val()
					+'&tgl_lantik='+$('#tgl_lantikTS').val()
					+'&tgl_purna='+$('#tgl_purnaTS').val()
					+'&ket_jabTS='+$('#ket_jabTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
			
		$('#nm_orgTS').on('keyup',loadData);
		$('#nm_jabTS').on('keyup',loadData);
		$('#tgl_lantikTS').on('keyup',loadData);
		$('#tgl_purnaTS').on('keyup',loadData);
		$('#ket_jabTS').on('keyup',loadData);
		
		
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
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT JABATAN DILUAR PRAMUKA').fadeIn();
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
	