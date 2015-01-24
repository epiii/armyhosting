var dir='server/p_manggota.php';
// panggil fungsi2 di ready function ==============================================================

	$(document).ready(function(){
		// $('#cetakBC').on('click',function(){
		$('.cetakBC').on('click',function(){
			// alert('okoko');return false;
			var href='report/r_dkta.php'
					+'?tipe=pdf'
					+'&no_anggota='+$('#no_anggotaTS').val()
					+'&full_anggota='+$('#full_anggotaTS').val()
					+'&jenis_kelamin='+$('#jenis_kelaminTS').val()
					+'&malamat='+$('#malamatTS').val()
					+'&mgudep='+$('#mgudepTS').val()
					+'&mkwaran='+$('#mkwaranTS').val()
					+'&mkwarcab='+$('#mkwarcabTS').val()
					+'&usia='+$('#usiaTS').val()
					+'&kode_pos='+$('#kode_posTS').val()
					+'&mkec='+$('#mkecTS').val()
					+'&mkota='+$('#mkotaTS').val()
					+'&isActive='+$('#isActiveTS').val()
					+'&email='+$('#emailTS').val()
					+'&id_manggota='+$('#id_manggotaH').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			
			window.open(href);
		})

		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});

		$('#no_anggotaTS').on('keyup',loadData);
		$('#full_anggotaTS').on('keyup',loadData);
		$('#jenis_kelaminTS').on('change',loadData);
		$('#malamatTS').on('keyup',loadData);
		$('#mgudepTS').on('keyup',loadData);
		$('#mkwaranTS').on('keyup',loadData);
		$('#mkwarcabTS').on('keyup',loadData);
		$('#usiaTS').on('keyup',loadData);
		$('#kode_posTS').on('keyup',loadData);
		$('#mkecTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#emailTS').on('keyup',loadData);
		$('#isActiveTS').on('change',loadData);
		
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
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH ANGGOTA').fadeIn();
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
//view / detail anggota (rekap) ----------------------
	function viewAnggotaDtl(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=view&id_manggota='+id_manggota,
			dataType:'json',
			success:function(data){
				// alert(data.full_anggota);
				$('#id_manggotaH').val(data.id_manggota);
				$('#nomer_gudepTD').html(data.nomer_gudep);
				$('#malamatTD').html(data.malamat);
				$('#full_anggotaTD').html(data.full_anggota);
				$('#agamaTD').html(data.agama);
				$('#ttlTD').html(data.temp_lahir+', '+data.tgl_lahir);
				$('#tgl_lahir').html(data.tgl_lahir);
				$('#gol_darahTD').html(data.gol_darah);
				$('#malamatTD').html(data.malamat+','+data.kode_pos+','+data.mkec+','+data.mkota);
				$('#mkecTD').html(data.mkec);
				$('#mkotaTD').html(data.mkota);
				$('#kode_posTD').html(data.kode_pos);
				$('#nm_mgudepTD').html(data.nm_mgudep+'/'+data.nm_mkwaran+'/'+data.nm_mkwarcab);
				$('#jenis_kelaminTD').html(data.jenis_kelamin);

				loadpf(id_manggota);
				loadpi(id_manggota);
				loadrku(id_manggota);
				loadrkk(id_manggota);
				loadrpres(id_manggota);
				loadrjdp(id_manggota);
				loadrbina(id_manggota);
				loadrkpram(id_manggota);
				loadrknonpram(id_manggota);
				$('#loadarea').html('<h3><i class="icon-search"></i> DETAIL ANGGOTA</h3>').fadeIn();
				$('#i_kegPN').toggle(1000);
				$('#v_kegPN').toggle();
				$('#viewBC').toggle();
			}
		}); 
	}

	function loadpf(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vdrpendf&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#drpendfDV').html(data);
			}
		}); 
	}


	function loadpi(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vdrpendi&id_manggota='+id_manggota,
			success:function(data){
				$('#drpendiDV').html(data);
			}
		}); 
	}
	
	function loadrku(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrku&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rkuDV').html(data);
			}
		}); 
	}
	function loadrkk(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrkk&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rkkDV').html(data);
			}
		}); 
	}
	function loadrpres(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrpres&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rpresDV').html(data);
			}
		}); 
	}
	function loadrjdp(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrjdp&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rjdpDV').html(data);
			}
		}); 
	}
	function loadrbina(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrbina&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rbinaDV').html(data);
			}
		}); 
	}
	function loadrkpram(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrkpram&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rkpramDV').html(data);
			}
		}); 
	}
	function loadrknonpram(id_manggota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=vrknonpram&id_manggota='+id_manggota,
			// dataType:'json',
			success:function(data){
				// alert();
				$('#rknonpramDV').html(data);
			}
		}); 
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var aksi ='aksi=tampil';
		var cari = '&no_anggotaS='+$('#no_anggotaTS').val()
					+'&full_anggotaS='+$('#full_anggotaTS').val()
					+'&jenis_kelaminS='+$('#jenis_kelaminTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&mgudepS='+$('#mgudepTS').val()
					+'&mkwaranS='+$('#mkwaranTS').val()
					+'&mkwarcabS='+$('#mkwarcabTS').val()
					+'&usiaS='+$('#usiaTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&mkecS='+$('#mkecTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&isActiveS='+$('#isActiveTS').val()
					+'&emailS='+$('#emailTS').val();
					

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR ANGGOTA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari = '&no_anggotaS='+$('#no_anggotaTS').val()
					+'&full_anggotaS='+$('#full_anggotaTS').val()
					+'&jenis_kelaminS='+$('#jenis_kelaminTS').val()
					+'&malamatS='+$('#malamatTS').val()
					+'&mgudepS='+$('#mgudepTS').val()
					+'&mkwaranS='+$('#mkwaranTS').val()
					+'&mkwarcabS='+$('#mkwarcabTS').val()
					+'&usiaS='+$('#usiaTS').val()
					+'&kode_posS='+$('#kode_posTS').val()
					+'&mkecS='+$('#mkecTS').val()
					+'&mkotaS='+$('#mkotaTS').val()
					+'&isActiveS='+$('#isActiveTS').val()
					+'&emailS='+$('#emailTS').val();

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

	/*function combomkota(id_mkota){
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
*/
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

					$('#loadarea').html('<i class="icon-edit"></i> UBAH ANGGOTA').fadeIn();
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
	
		//fungsi tooltip_______________________________________________________________
	function tooltipx(event){
		$("[data-toggle=tooltip]").tooltip({ 
			//placement: 'right'
		});
	}

//end of fungsi tooltip________________________________________________________
	function statAnggota(id_manggota,isActive) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=status&id_manggota='+id_manggota+'&isActive='+isActive,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					alert(data.status);
				}else{
					loadData();
				}
			}
		});
	}