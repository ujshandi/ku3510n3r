<!--main content start-->

        <!-- page start-->
                
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       
						<pre>
						<b>DETAIL RESPON KUESIONER</b><br>
						TEMA 		: <?=$kuesioner[0]->tema?><br>
						RESPONDEN 	: <?=$responden?><br>
						PERIODE 	: <?=$kuesioner[0]->periode_awal?> s.d <?=$kuesioner[0]->periode_akhir?>
						</pre>
                        <span class="pull-right">
                            
                         </span> 
                    </header>
                    <div class="panel-body">
						
						<div id="detail_pertanyaan" >
								<?=$data?>	
						</div>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-sm" id=	"cetakpdf_kuesioner"><i class="fa fa-print"></i> Cetak PDF</button>          
							<button type="button" class="btn btn-primary btn-sm" id="cetakexcel_kuesioner"><i class="fa fa-download"></i> Ekspor Excel</button>
						</div>
                    </div>
                </section>
            </div>
        </div>
    <!--main content end-->
	
	<script  type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('#cetakpdf_kuesioner').click(function(){				
			//	window.open('<=base_url()?>laporan/renstra_eselon1/target_print_pdf/<=$periode?>/<=$e1?>','_blank');			
			});
		});
	</script>