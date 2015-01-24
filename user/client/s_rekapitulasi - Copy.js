var dir = 'server/p_rekapitulasi.php';

$(document).ready(function(){
	loadBio();
	$('#infoBC').on('click',function(){
		loadInfo();
	});
});
//load biodata dosen
	function loadBio(){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=bio',
			dataType:'json',
			success:function(data){
				var nipy	= data.nip;
				var nmy 	= data.nm;
				var agmy	= data.agm;
				var jky		= data.jk;
				var tly		= data.tl;
				var tglly	= data.tgll;
				var tmtJaby	= data.tmtJab;
				var tmtGoly	= data.tmtGol;
				// var gtoty 	= data.gtot;
				//------------
				var pty 	= data.pt;
				var masaJaby= parseInt(data.masaJab);
				var masaGoly= parseFloat(data.masaGol);
				var jabFungy= data.jabFung;
				var golFungy= data.golFung;
				var urutGoly= data.urutGol;
				var pointgt = data.pointgt;
				//-----------

				// alert(data.tmtGols);
				$('#_nip').html(nipy);
				$('#_nm').html(nmy);
				$('#_agm').html(agmy);
				$('#_jk').html(jky);
				$('#_ttl').html(tly+' / '+tglly);
				$('#_fungJG').html(jabFungy+' / '+golFungy);
				$('#_tmtJG').html(tmtJaby+' / '+tmtGoly);
				
				loadTarget(urutGoly,pty,masaJaby,masaGoly);
				// alert(masaGoly);return false;
				// loadTarget(urutGoly,gtoty,pty,masaJaby,masaGoly);
			}
		});
	}
//end of loadbio___________________________________________________________________________________

//load target______________________________________________________________________________________
	function loadTarget(urtGol,ptDt,masaJabDt,masaGolDt){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=target&urutGol='+urtGol+'&ptDt='+ptDt+'&masaJabDt='+masaJabDt+'&masaGolDt='+masaGolDt,
			// data:'aksi=target&urutGol='+urtGol+'&ptDt='+ptDt+'&gtotDt='+gtotDt+'&masaJabDt='+masaJabDt+'&masaGolDt='+masaGolDt,
			dataType:'json',
			error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS: ' + textStatus +','+errorThrown);
			},
			success:function(data){ //ajax-success-function ---------------------
				// alert(data);return false;

				// $.each(data,function(id,item){
				// 	alert(item.goltgt);
				// });
				// "idgoltgt": "2",
				//"idjabtgt": "1",
				//"goltgt": "III B",
				//"jabtgt": "asisten ahli",
				//"pttgt": "S2",
				//"pointgt": "50",
				//"masaGoltgt": "2",
				//"masaJabtgt": "1"
				// var masaGoltgty	= data.masaGoltgt;
				// var masaJabtgty	= data.masaJabtgt;
				// var pttgty 		= data.pttgt;
				// var goltgty 	= data.goltgt;
				// var jabtgty 	= data.jabtgt;
				// var pointgty 	= data.pointgt;
				var kurangany	= new Array();
					// kurangany	= data[1].kurangan[1];
					alert('kur:'+kurangany);
					// alert(data);
				// //pend. terakhir --------------
				// var ptx		='';
				// if(ptDt<pttgty){
				// 	 ptx	+='<label data-toggle="tooltip" data-placement="top" title="pend. terakhir minimal '+pttgty+'" class="label label-warning">'
				// 				+ptDt
				// 			+'</label>'
				// 			+'<i class="icon-arrow-up"></i>';
				// }else{
				// 	 ptx	+='<label data-toggle="tooltip" data-placement="top" title="pend. terakhir memenuhi" class="label label-success">'
				// 				+ptDt
				// 			+'</label>'
				// 			+'<i class="icon-ok"></i>';
				// }
				// //pend. terakhir --------------

				// //masa gol------------------------
				// var masaGoltgtx='';
				// if(masaGolDt<masaGoltgty){
				// 	 masaGoltgtx+='<label data-toggle="tooltip" data-placement="top" title="masa golongan minimal '+masaGoltgty+' th" class="label label-warning">'
				// 					+masaGolDt
				// 				+'</label>'
				// 				+'th <i class="icon-arrow-up"></i>';
				// }else{
				// 	 masaGoltgtx+='<label data-toggle="tooltip" data-placement="top" title="masa golongan memenuhi" class="label label-success">'
				// 					+masaGolDt
				// 				+'</label>'
				// 				+'th <i class="icon-ok"></i>';
				// }
				// //masa jab ----------------------
				// var masaJabtgtx='';
				// if(masaJabDt<masaJabtgty){
				// 	 masaJabtgtx+='<label data-toggle="tooltip" data-placement="top" title="masa jabatan minimal'+masaJabtgty+'" class="label label-warning">'
				// 					+masaJabDt
				// 				+'</label>'
				// 				+'th <i class="icon-arrow-up"></i>';
				// }else{
				// 	 masaJabtgtx+='<label data-toggle="tooltip" data-placement="top" title="masa jabatan memenuhi" class="label label-success">'
				// 					+masaJabDt
				// 				+'</label>'
				// 				+'th <i class="icon-ok"></i>';
				// }
				//end of masa ------------------
				
					// $('#_pt').html(ptx); //pend terakhir
					// $('#_masaJG').html(masaJabtgtx+' / '+masaGoltgtx); //masa jab n gol
					// $('#_tgtJG').html(jabtgty+' / '+goltgty); //target kenaikan jab n gol
					loadKeg('','','',kurangany);
					// loadKeg(goltgty,jabtgty,pointgty,kurangany);
					// loadKeg(goltgty,jabtgty,pointgty,kurangany);
					// loadKeg(goltgty,jabtgty,pointgty,gtotDt,kurangany);
				// });
			}
		});
	}
//end of loadtarget______________________________________________________________

//load kegiatan__________________________________________________________________
	// function loadKeg(goltgt,jabtgt,pointgt,gtotDt,kuranganDt){
	function loadKeg(goltgt,jabtgt,pointgt,kuranganDt){
		//ajax-funct-------------------------------------------------------------
		$.ajax({
			url:dir,
			type:'get',
			cache:false,
			data:'aksi=keg&pointgt='+pointgt+'&kuranganDt='+kuranganDt,
			dataType:'json',
			error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS: ' + textStatus +','+errorThrown);
			},
			success:function(data){ //ajax-success-function ---------------------
				var TB='';
				var katArrx 	= new Array();
				 	katArrx 	= data.katArr;
				var gtotNumDt	= data.gtot;
				var kuranganDtx	= new Array();
					kuranganDtx	= kuranganDt;
				var kuranganx 	= new Array();
					kuranganx 	= data.kurangan;
					// alert(kuranganx[0]);

				//info  naik / belum  -------------------------------------------
					var info='';
						info+='<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">'
								+'<ul class="nav nav-tabs">';
					$.each(kuranganx, function(id,item){
						// alert('halloooo');
						// if(kuranganx[id]==){
							// info+='<li class="active">'
							// 		+'<a href="#panel1" data-toggle="tab" style="color:#080"><b>Data Login</b></a>'
							// 	+'</li>'
							
						// }
					});
						info+=' </ul>'
							+'</div>';
					$('#popMeDV').html(info);

					//naik pangkat 
					// if(kuranganDtx=='' && kuranganx==''){
					// 	alert('ksong');
					// 	var iduserx		= $('#iduser').val();
					// 	var idsesix 	= $('#idsesi').val();
					// 	var targetx 	= "_blank";
					// 	var ruwet 		= encode64(idsesix+iduserx+idsesix);
					// 	var hrefx 		= "view/c_rekap.php?ruwet="+ruwet+'&jabtgt='+jabtgt+'&goltgt='+goltgt;
					// 	$('#cetakBC').attr('href',hrefx);
					// 	$('#cetakBC').attr('target',targetx);
					// 	$('#cetakBC').toggle();
					// 	info+='<h4  align="left"class="span5 pull-left" >Selamat Anda direkomendasikan naik jabatan <b class="badge badge-success">'+jabtgt+'</b > golongan <b class="badge badge-success">'+goltgt+'</b></h4>';
					// }
					// //belum naik pangkat
					// else{
					// 	alert('berisi');
					// 	// alert(katArrx);return false;
					// 	var iduserx		= $('#iduser').val();
					// 	var idsesix 	= $('#idsesi').val();
					// 	var targetx 	= "_blank";
					// 	var ruwet 		= encode64(idsesix+iduserx+'dupak'+idsesix);
					// 	var hrefx 		= 'view/r_cetak2.php?tipe=pdf&ruwet='+ruwet;
					// 	//alert(hrefx);
					// 	$('#cetakBC').attr('href',hrefx);
					// 	$('#cetakBC').attr('target',targetx);
					// 	$('#cetakBC').toggle();
					
					// 	info+='<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">'
					// 				+'<ul class="nav nav-tabs">';
					// 			// $.each(kuranganx,function(id,item){
					// 			// 	alert('halooo');
					// 			// 	// if(kuranganx[id]==){
					// 			// 		// info+='<li class="active">'
					// 			// 		// 		+'<a href="#panel1" data-toggle="tab" style="color:#080"><b>Data Login</b></a>'
					// 			// 		// 	+'</li>'
										
					// 			// 	// }
					// 			// });
					// 				+'</ul>'
									
					// 				+'<form class="form-horizontal" >'
					// 					+'<div class="tab-content">'
					// 						+'<div align="center" class="tab-pane active" id="panel1">'
					// 							+'<div class="control-group">'
					// 								+'<table class="table table-striped" width="100%" border="0">'
					// 									+'<tr id="usernameTR">'
					// 										+'<td width="25%"><label class="control-label">Username</label></td>'
					// 										+'<td width="5%"><label class="control-label"> :</label></td>'
					// 										+'<td width="70%" id="usernameTD"></td>'
					// 									+'</tr>'
					// 	                    		+'</table>'
					// 							+'</div>'
					// 						+'</div>'

					// 						+'<div  align="center"class="tab-pane" id="panel2">'
					// 							+'<table class="table table-striped" width="100%" border="0">'
					// 								+'<tr>'
					// 									+'<td width="25%"><label class="control-label">NIP</label></td>'
					// 									+'<td width="5%"><label class="control-label"> :</label></td>'
					// 									+'<td width="70%" id="nipTD"></td>'
					// 								+'</tr>'
					// 							+'</table>'
					// 						+'</div>'
					// 					+'</div>'
					// 				+'</form>'
					// 			+'</div>';
					/*info+='<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">'
								+'<ul class="nav nav-tabs" id="nav-tabs">'
									+'<li class="active"><a href="#panel1"> III A</a></li>'
									+'<li><a href="#panel2">III B</a></li>'
									+'<li><a href="#panel3">III C</a></li>'
									+'<li><a href="#panel4">III D</a></li>'
								+'</ul>'

								+'<div class="tab-content">'
									+'<div class="tab-pane active" id="panel1">'
										+'<li align="left" class="pull-left" style="list-style:none;">'
											+'<i class="icon-ok"></i>kurang xxx'
										+'</li>'
									+'</div>'
									+'<div class="tab-pane" id="panel2">B</div>'
									+'<div class="tab-pane" id="panel3">C</div>'
									+'<div class="tab-pane" id="panel4">D</div>'
								+'</div>'
							+'</div>';*/

						// info+=  '<div style="padding-left:20px; padding-top:20px;" class="tabbable" id="tabs-104268">'
				  //                   +'<ul class="nav nav-tabs" id="nav-tabs">';
				  //                       +'<li class="active">'
			   //                          	+'<a  title="" href="#panel1" data-toggle="tab" conclick="return loadData(\'tampil\',1,\'\',\'\');" style="color:#080"><b>III B</b>'
			   //                      	+'</li>'
			   //                      	+'<li>'
			   //                          	+'<a  title="" href="#panel2" data-toggle="tab" conclick="return loadData(\'tampil\',1,\'\',\'\');" style="color:#080"><b>III C</b>'
			   //                      	+'</li>'
			   //                      	+'<li>'
			   //                          	+'<a  title="" href="#panel3" data-toggle="tab" conclick="return loadData(\'tampil\',1,\'\',\'\');" style="color:#080"><b>III D</b>'
			   //                      	+'</li>';
				  //                   +'</ul>';
				                // +'</div>';

							// info+=	'<div class="tab-content">'
							// 			+'<div align="center" class="tab-pane active" id="panel1">'
							// 				+'<h4 align="left"class="span5 pull-left">'
							// 					+'Untuk naik jabatan <b  class="badge badge-warning">'+jabtgt+'</b> golongan <b  class="badge badge-warning">'+goltgt+'</b> lengkapi persyaratan berikut:'
							// 				+'</h4>';
								// $.each(kuranganDt, function(id,item){
									// info+=	'<li align="left" class="pull-left" style="list-style:none;"><i class="icon-ok"></i> '+item+'</li>';
								// });
								// $.each(kuranganx, function(id,item){
									// info+=	'<li align="left" class="pull-left" style="list-style:none;"><i class="icon-ok"></i> '+item+'</li>';
								// });
								// info+=	'</div>'
									// +'</div>'
								// +'</div>';
					// }
					// $('#SMeDV').html(info);
				//end of info naik/belum ------------------------------------------

				//kategri kosong-------------------------------------------------
				// if(data==''){
				// 	TB+='<div class="label label-important">kategori kosong</div>';
				// }//end of kategori kosong----------------------------------------

				// //kategori ada --------------------------------------------------
				// else{
					//loop kategori ---------------------------------------------
					$.each(katArrx, function(id,item){
						//tampung katArr -> var ------------ 
						var katkegy			= item.katkeg;
						var subTotTgtPerc	= item.subTotTgtPerc;
						var subTotTgtNum	= item.subTotTgtNum;
						var tipey			= item.tipe;
						var cumy			= item.cum;
						var sisay			= item.subsisa;
						var kegArrx 		= new Array();
							kegArrx 		= item.kegArr;
						var nox				= 1;
						var subtotNumDt;
						
						if(item.subtot==null){
							subtotNumDt=0;
						}else{
							subtotNumDt	=item.subtot;
						}
						var	subtotPercDt=(parseFloat(subtotNumDt) /  parseFloat(pointgt) * 100).toFixed(2);
						//end of tampung katArr -> var ------------
						
						//header tabel kegiatan per kategori --------------------
						TB+='<div class="badge badge-inverse pull-left">'+katkegy+'</div>'
							+'<a href="view/r_cetak.php?tipe=pdf&kat='+cumy+'&ruwet='+item.ruwet+'" target="_blank" class="btn btn-secondary pull-right">cetak <i class="icon-print"></i></a><br>'
						 	+'<table class="table table-hover table-bordered table-striped" width="100%" border="0">'
								+'<tr class="info">'
									+'<td width="5%"><b>no.</b></td>'
									+'<td width="78%"><label class="text-center control-label">Kegiatan</label></td>'
									+'<td width="5%"><b>Point</b></td>'
								+'</tr>'
			
						//kegiatan kosong ----------------------------------------	
						if(kegArrx==''){
							TB+='<tr>'
									+'<td colspan="2"><label class="label label-important">data kosong</label></td>'
									+'<td><p class="pull-right">0</p></td>'
								+'</tr>';						
						}//end of kegiatan kosong --------------------------------

						//kegiatan ada -------------------------------------------
						else{
							//loop kegiatan --------------------------------------
							$.each(kegArrx, function(id,item){
								var poinAwly= item.poinAwl;
								var poinCury 	= item.poinCur;
								var nakegy 	= item.nakeg;
								var statusy	= item.status;
								var tr;
								if(statusy=='done'){
									tr ='<tr class="warning" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="poin awal : '+poinAwly+'" data-placement="bottom" >';
								}else{
									tr='<tr>';
								}
								//record tabel -----------------------------------
								TB+=tr
								// '<tr '+tr+'>'
									+'<td  width="5%">'+nox+'</label></td>'
									+'<td  width="78%"><label class="control-label">'+nakegy+'</label></td>'
									+'<td  width="5%"><label class="pull-right control-label">'+poinCury+'</label></td>'
							 	+'</tr>'
							 	//end of record tabel ----------------------------
								nox++;
							});//end of loop kegiatan ----------------------------
						}//end of kegiatan : ada ----------------------------------
					
						//data : marking min - max subtotal ------------------
						var clrsub,clrsubpro,iconsub,infosub;
						if(tipey=='mn'){//min 
							infosub		= 'minimal '+subTotTgtPerc+'% ('+subTotTgtNum+' poin)';
							if(subtotNumDt<subTotTgtNum){ //min : kurang
								clrsub		= ' style="background-color:orange;color:white;"';	
								clrsubpro	= ' class="badge badge-warning"';	
								iconsub		= '<i class="icon-arrow-up">';
							}else{ //min : pas/lebih
								clrsub		= ' style="background-color:green;color:white;"';	
								clrsubpro	= ' class="badge badge-success"';	
								iconsub		= '<i class="icon-ok">';
							}//end of data : marking min - max subtotal -----------
						}else if(tipey=='mx'){ // max						
							infosub		= 'maximal '+subTotTgtPerc+'% ('+subTotTgtNum+' poin)';
							if(subtotNumDt>subTotTgtNum){ //max: lebih
								clrsub		= ' style="background-color:red;color:white;"';	
								clrsubpro	= ' class="badge badge-important"';	
								iconsub		= '<i class="icon-arrow-down">';
							}else if(subtotNumDt==0){ //max : 0 nol
								clrsub		= ' style="background-color:orange;color:white;"';	
								clrsubpro	= ' class="badge badge-warning"';	
								iconsub		= '<i class="icon-arrow-up">';
							}else{ //max : pas/kurang
								clrsub		= ' style="background-color:green;color:white;"';	
								clrsubpro	= ' class="badge badge-success"';	
								iconsub		= '<i class="icon-ok">';
							}//end of data : marking min - max subtotal -----------
						}			
						TB+='<tr>'
								+'<td colspan="2" align="right">'
									+'<span class="pull-right">'
										+'<b>Sisa Point <i>(sebelumnya)</i></b>'
									+'</span>'
								+'</td>'
								+'<td align="right">'
									+'<span class="pull-right" >'+sisay+'</span>'
								+'</td>'
							+'</tr>'
						//record subtotal -----------------------------------------
						TB+='<tr class="info" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="'+infosub+'" data-placement="bottom">'
								+'<td colspan="2" align="right">'
									+'<span class="pull-right">'
										+'<b>Sub Total : </b><label '+clrsubpro+'>'+subtotPercDt+' %</label>&nbsp;'+iconsub+'</i>'
									+'</span>'
								+'</td>'
								+'<td '+clrsub+'>'
									+'<span class="pull-right" ><b>'+subtotNumDt+'</b></span>'
								+'</td>'
							+'</tr>'
						//end of record subtotal ------------------------------
						+'</table>'
					+'</div>';
				});//end of loop kategori -------------------------------------
			// }//end of kategori : ada --------------------------------------------
					
			//grand total -------------------------------------------------------
			var info,icon,colortot;
			if(gtotNumDt<pointgt){
				info		= 'minimal '+pointgt+' poin';
				icon		= '<i class="icon-arrow-up"></i>';
				colortot	= ' style="background-color:orange;color:white;cursor:pointer;"';	
			}else{
				info		= 'poin memenuhi syarat ';
				icon		= '<i class="icon-ok"></i>';
				colortot	= ' style="background-color:green;color:white;cursor:pointer;"';	
			}
			TB+='<table class="table table-striped ">'
					+'<tr class="info" data-toggle="tooltip" title="'+info+'" data-placement="bottom">'
						+'<td width="81%"><span class="pull-right"><b>Grand Total : '+icon+'</b></span></td>'
						+'<td width="7%" '+colortot+'><span class="pull-right"><b>'+gtotNumDt+'</b></span></td>'
					+'</tr>'
				+'</table>';
			//end of grand total -------------------------------------------------------
			$('#isi').html(TB);
			loadInfo();
		}//end of success-function -------------------------------------------- 
	});//end of ajax-function -------------------------------------------------		
}//end of load kegiatan_________________________________________________________

//fungsi pop up info : naik pangkat atau belum_________________________________
	function loadInfo(){
		$('#popMe').modal('show');
	}
//end of pop up info___________________________________________________________ 

//fungsi tooltip_______________________________________________________________
	function tooltipx(event){
		$("[data-toggle=tooltip]").tooltip({ 
			//placement: 'right'
		});
	}
//end of fungsi tooltip________________________________________________________
	