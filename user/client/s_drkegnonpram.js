var dir='server/p_drkegnonpram.php';
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&drkegnonpramS='+$('#drkegnonpramTS').val()
				 // +'&tglS='+$('#tglTS').val()
				 +'&lokasiS='+$('#lokasiTS').val()
				 +'&tingkatS='+$('#tingkatTS').val()
				 +'&stusS='+$('#stusTS').val()
				 +'&plenggaraS='+$('#plenggaraTS').val()
				 +'&ketS='+$('#ketTS').val();
				 		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR RIWAYAT KEGIATAN NON PRAMUKA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&drkegnonpramS='+$('#drkegnonpramTS').val()
				 +'&tglS='+$('#tglTS').val()
				 +'&lokasiS='+$('#lokasiTS').val()
				 +'&tingkatS='+$('#tingkatTS').val()
				 +'&stusS='+$('#stusTS').val()
				 +'&plenggaraS='+$('#plenggaraTS').val()
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
		
		var id_drkegnonpram = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_drkegnonpram='+id_drkegnonpram;
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
			data:'aksi=hapus&id_drkegnonpram='+id,
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
			data:'aksi=ambiledit&id_drkegnonpram='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#drkegnonpramTB').val(data.drkegnonpram);
					$('#tglTB').val(data.tgl);
					$('#lokasiTB').val(data.lokasi);
					$('#tingkatTB').val(data.tingkat);
					$('#stusTB').val(data.stus);
					$('#plenggaraTB').val(data.plenggara);
					$('#ketTB').val(data.ket);
					
					
					/*combomkota(data.id_mpropinsi,data.id_mkota);
					combomkec(data.id_mkota,data.id_mkec);*/
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH RIWAYAT KEGIATAN NON PRAMUKA').fadeIn();
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
		$('#drkegnonpramTB').val('');
		$('#tglTB').val('');
		$('#lokasiTB').val('');
		$('#tingkatTB').val('');
		$('#stusTB').val('');
		$('#plenggaraTB').val('');
		$('#ketTB').val('');
		}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		$("#tglTB").datepicker(function(){
			format:"yyyy-mm-dd"
		});
		//load data saat refresh halaman
		loadData();
		$('#cetakBC').on('click',function(){
			var href='report/r_drkegnonpram.php'
					+'?tipe=pdf'
					+'&drkegnonpram='+$('#drkegnonpramTS').val()
					// +'&tgl='+$('#tglTS').val()
					+'&lokasi='+$('#lokasiTS').val()
					+'&tingkat='+$('#tingkatTS').val()
					+'&stus='+$('#stusTS').val()
					+'&plenggara='+$('#plenggaraTS').val()
					+'&ket='+$('#ketTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})
			
		// $('#tglTS').on('keyup',loadData);
		$('#drkegnonpramTS').on('keyup',loadData);
		$('#lokasiTS').on('keyup',loadData);
		$('#tingkatTS').on('change',loadData);
		$('#stusTS').on('change',loadData);
		$('#plenggaraTS').on('keyup',loadData);
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
			
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH RIWAYAT KEGIATAN NON PRAMUKA').fadeIn();
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
	