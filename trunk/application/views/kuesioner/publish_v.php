<!--main content start-->
		<link rel="stylesheet" href="<?=base_url('static')?>/css/jquery.stepsc4ca.css?1">
		
	    <link href="<?=base_url('static')?>/js/iCheck/skins/square/square.css" rel="stylesheet">
		<style>
			.wizard, .tabcontrol {
				 
				width: 95%;
				padding:0;
			}
			.wizard > .steps > ul > li {
				width: 16%;
			}
			.wizard > .content > .body{
				position:unset;
				padding:0;
			}
			
			input {
				border: 1px solid #494949;
				padding: 10px;
				outline: 0;
				color: #494949;
				font-size: 14px;
			  width: 100%
			}
			label.label-floatlabel {
				font-weight: bold;
				font-size: 11px;
			}
			label.red-label {
				color: red !important;
			}
		</style>
        <!-- page start-->
                
        <div class="panel-body"> 
                <section class="panel">
                    <header class="panel-heading">
                        <b>PREVIEW DAFTAR PERTANYAAN KUESIONER</b><br>
						TEMA : <?=$kuesioner[0]->tema?><br>
						PERIODE : <?=$kuesioner[0]->periode_awal?> s.d <?=$kuesioner[0]->periode_akhir?>
                        <span class="pull-right">
                            
                         </span> 
                    </header>
					
					
                    <div class="panel-body">
					
						<form  id="wizard" method="post" action="<?=base_url()?>/kuesioner/publish/submit">
                            <?=$data?>
						</form > 
                    </div>
					 
                </section> 
        </div>
    <!--main content end-->
	 
	<script src="<?=base_url('static')?>/js/jquery-steps/jquery.steps.js"></script>
	<script src="<?=base_url('static')?>/js/iCheck/jquery.icheck.js"></script>
	<script src="<?=base_url('static')?>/js/bootstrap-switch.js"></script>
	<script src="<?=base_url('static')?>/js/floatlabels.js"></script>
	<script  type="text/javascript" language="javascript">
		var pendapatCounter = 1;
		$(document).ready(function() {
			

			

			 $("#wizard").steps({
					headerTag: "h2",
					bodyTag: "section",
					transitionEffect: "slideLeft",
					onInit : function (event, currentIndex) {
						//alert('kadie');
						$('.square input').iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%' // optional
						});
					},
					onFinishing: function (event, currentIndex) { 
						alert('validation here...');
						return true; 
					}, 
					onFinished: function (event, currentIndex) { 
						 var form = $(this);
						var postData = form.serializeArray();
						// Submit form input
						//alert(postData);
						form.submit();
						//alert('finish uy');	
						//	alert('action : '+ $(this).attr("action"));
						$("#frmPublish").submit(function( event ) { 
							  
								
								var postData = $(this).serializeArray();
								
								// if (purpose=="pertanyaan"){
									// alert($("#multiple_value").val());
									// return false;
									// if ($("#model_kuesioner_id").val()=="-1"){
										// alert("Model Kuesioner belum ditentukan");
										// $('#model_kuesioner_id').focus();
										// return false;
									// }
									// else if ($("#multiple_value").val()==""){
										// alert('Pertanyaan belum ada yang dipilih');
										// return false;
									// }
									
								//	postData.push({name:"daftar_pertanyaan",value:ids});
								 alert(postData);
								var formURL = $(this).attr("action");
								$.ajax(
								{
									url : formURL,
									type: "POST",
									data : postData,
									success:function(data, textStatus, jqXHR) 
									{
										//data: return data from server
										$.gritter.add({text: data});
										//$("#btn-close").click();
									},	
									error: function(jqXHR, textStatus, errorThrown) 
									{
										//if fails   
										$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
									//	$('#btn-close').click();   
										
									}
								});
							
							  event.preventDefault();
							
							
						});//end form submit
					},
				 
						
					
					 
					 /* Labels */
					labels: {
						cancel: "Cancel",
						current: "current step:",
						pagination: "Pagination",
						finish: "Selesai",
						next: "Selanjutnya",
						previous: "Sebelumnya",
						loading: "Loading ..."
					}
				});

			$('#cetakpdf_kuesioner').click(function(){				
			//	window.open('<=base_url()?>laporan/renstra_eselon1/target_print_pdf/<=$periode?>/<=$e1?>','_blank');			
			});
			
			
			pendapatAdd = function (model_kuesioner_id){
				var klone = $('#divPendapat-1').clone();
				pendapatCounter++;				
				klone.attr('id','divPendapat-'+pendapatCounter);
				//input[id], textarea[id], 
				klone.find('#labelPendapat-1').each(function() {
					if($(this).is('label')) {
						$(this).html('<h4>Pendapat ke-'+pendapatCounter+'</h4>');
					} else {
						
					}
				});     
				$(klone).insertBefore("#divTambahPendapat");
				
			
			};
			
			$('.floatlabel').floatlabel();
		});
	</script>