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
					Motivasi Kerja
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
				     <p class="help-block " id="motivasi_info">Jumlah skor per tingkat kebutuhan dengan <span id="jmlResponden">xx</span> responden dan <span id="jmlTanya">xx</span> item pertanyaan</p>
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="rpt-tblx" width="100%">
					<thead>
						<tr> 							 
							  <th >Level 1</th>
							  <th >Level 2</th>
							  <th >Level 3</th>
							  <th >Level 4</th>
							  <th >Level 5</th>
						</tr>
					</thead>
					<tbody id="body-motivasi">					 
							<tr class="odd gradeX">
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
				<div class="panel-body">
				<input type="hidden" value="0,0,0,0,0" id="data-chart"/>
				<center>
					<header class="panel-heading">Tensi Kebutuhan</header> 
					<canvas id="myChart" width="800" height="400"></canvas>
					</center>
				</div>
			</section>    
            </div>
		</div>
	</section>
</section>

<script src="<?=base_url('static')?>/js/chart-js/Chart.js"></script>
	
<script>
	var oTable;
	refreshTable = function(){
		 
		var kuesioner_id = $('#fil_kuesioner_id').val();	
		$('#body-motivasi').load('<?=base_url()?>report/rpt_motivasi_kerja/getdata/'+kuesioner_id,function(){
			var datachart = $('#data-chart').val().split(',');
			var data = {
				labels: ["L1", "L2", "L3", "L4", "L5"],
				datasets: [
					{
						label: "My First dataset",
						 fillColor: "rgba(151,187,205,0.2)",
						strokeColor: "rgba(151,187,205,1)",
						pointColor: "rgba(151,187,205,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						scaleShowLabels: true,
						pointHighlightStroke: "rgba(151,187,205,1)",
						data: datachart //[2.75, 2.88, 0.63, 1.63, 1.50 ]
					}
				]
			};
			
			//var ctx = document.getElementById("myChart").getContext("2d");
			var myLine = new Chart(document.getElementById("myChart").getContext("2d")).Bar(data);
			
		});
		
		
	};
	$(document).ready(function(){
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		
		
		$("#search-btn").click(function(){
			refreshTable();
		});
		
		
		
	});
</script>	