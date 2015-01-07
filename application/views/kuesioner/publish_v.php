<!--main content start-->
		<link rel="stylesheet" href="<?=base_url('static')?>/css/jquery.stepsc4ca.css?1">
		
	    <link href="<?=base_url('static')?>/js/iCheck/skins/square/square.css" rel="stylesheet">
		<style>
			.wizard > .content > .body{
				position:unset;
			}
		</style>
        <!-- page start-->
                
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b>PREVIEW DAFTAR PERTANYAAN KUESIONER</b><br>
						TEMA : <?=$kuesioner[0]->tema?><br>
						PERIODE : <?=$kuesioner[0]->periode_awal?> s.d <?=$kuesioner[0]->periode_akhir?>
                        <span class="pull-right">
                            
                         </span> 
                    </header>
					 			
                    <div class="panel-body">
					
						<div id="wizard">
                            <?=$data?>
						</div> 
                    </div>
                </section>
            </div>
        </div>
    <!--main content end-->
	 
	<script src="<?=base_url('static')?>/js/jquery-steps/jquery.steps.js"></script>
	<script src="<?=base_url('static')?>/js/iCheck/jquery.icheck.js"></script>
	<script src="<?=base_url('static')?>/js/bootstrap-switch.js"></script>
	<script  type="text/javascript" language="javascript">
		$(document).ready(function() {

			

			 $("#wizard").steps({
					headerTag: "h2",
					bodyTag: "section",
					transitionEffect: "slideLeft",
					onInit : function (event, currentIndex) {
						alert('kadie');
						$('.square input').iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%' // optional
						});
					}
				});

			$('#cetakpdf_kuesioner').click(function(){				
			//	window.open('<=base_url()?>laporan/renstra_eselon1/target_print_pdf/<=$periode?>/<=$e1?>','_blank');			
			});
		});
	</script>