<style type="text/css">
	select {width:100%;}
	.right {text-align:right}
	
	th{
		text-align:center;
		vertical-align:middle !important;
	}
</style>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Pemahaman Visi-Misi Perusahaan
				</header>
				<!-- filter area-->
				<div class="feed-box">
			 
					<div class="panel-body" style="border:1px solid;border-radius:10px;padding-bottom:0px;border-color:#dddddd">
					   
						<div class="corner-ribon blue-ribon">
						   <i class="fa fa-cog"></i>
						</div>
						<form class="form-horizontal" role="form">
								
							<div class="form-group">
							 
							<div class="form-group">
								<label class="col-md-2 control-label">Tema Kuesioner</label>
								<div class="col-md-5">
							   <?=form_dropdown('fil_kuesioner_id',$list_kuesioner,'0','id="fil_kuesioner_id" class="populate" style="width:100%"')?>
								</div>
							</div> 
							<div class="form-group">
								<label class="col-md-2 control-label">&nbsp;</label>
								<button type="button" class="btn btn-info" id="search-btn" style="margin-left:15px;">
									<i class="fa fa-check-square-o"></i> Tampilkan Data
								</button>
							</div>	
								
						</form>
						
					</div> 
			</div>
				<!-- end filter area-->
				
				<div class="panel-body">
				    
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="rpt-tblx" width="100%">
					<thead>
						<tr> 
							  <th  rowspan="2"  align="center" valign="middle">No.</th>
							  <th rowspan="2">Pertanyaan</th>
							  <th colspan="3">Jumlah Jawaban</th>
							  <th colspan="3">Persentase Jawaban Dari Jumlah Responden</th>
						</tr>
						<tr>
							<th>Ya</th>
							<th>Tidak</th>
							<th>Kosong</th>
							<th>Ya</th>
							<th>Tidak</th>
							<th>Kosong</th>
						</tr>
						
					</thead>
					<tbody id="body-visimisi">					 
							<tr class="odd gradeX">
							   <td>&nbsp;</td>
							   <td>&nbsp;</td>
							   <td>&nbsp;</td>
							   <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>				 
					  </tbody>
					</table>
					</div>

				</div>
			</section>    
            </div>
		</div>
	</section>
</section>

	
<script>
	var oTable;
	refreshTable = function(){
		 
		var kuesioner_id = $('#fil_kuesioner_id').val();	
		$('#body-visimisi').load('<?=base_url()?>report/rpt_pemahaman_visimisi/getdata/'+kuesioner_id);
		
	};
	$(document).ready(function(){
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		
		
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	