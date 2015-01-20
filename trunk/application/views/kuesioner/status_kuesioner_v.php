<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Status Kuesioner
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
					<table class="display table table-bordered table-striped" id="rpt-tbl" width="100%">
					<thead>
						<tr> 
							  <th rowspan="2">No.</th>
							  <th rowspan="2">kuesioner_responden_id</th>
							  <th rowspan="2">Responden</th>
							  <th colspan="2">Status</th>
							  
						</tr>
						<tr>
							<th>Terkirim</th>
							<th>Direspon</th>
						</tr>
						
					</thead>
					<tbody>					 
							<tr class="odd gradeX">
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

	<style type="text/css">
	select {width:100%;}
</style>
<script>
	var oTable;
	refreshTable = function(){
		if (oTable)
            oTable.fnDestroy();
		var kuesioner_id = $('#fil_kuesioner_id').val();	
		oTable= $('#rpt-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": false,
			"sDom": 't<"bottom"plri>',
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url(); ?>kuesioner/status_kuesioner/datatable',
            "bJQueryUI": true,
			"aoColumns" : [
					{ sWidth: '1%'  },					
					{ sWidth: '0%'  },					
					{ sWidth: '50%' },
					{ sWidth: '25%' },
					{ sWidth: '25%' } 
				],
			"columnDefs" :  [
				{"orderable": false},
				{"targets": [ 2 ],"visible": false,},
				{"orderable": false},
				{"orderable": false},
				{"orderable": false}
			
			],
          //  "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
			
			"fnServerParams": function (aoData) {
				aoData.push(
				{ "name": "kuesioner_id", "value": kuesioner_id }
				);
			},
			"fnCreatedRow": function( nRow, aData, iDataIndex ) {
				//alert(aData[2]);
				//var fields = aData.split(',');		
					if (aData[3]==null)
					$('td:eq(2)', nRow).append("<div class='col1d'><button class='editBut' onclick='sentEmail("+aData[1]+")'>Click</button></div>");
			   },
            "fnInitComplete": function () {
                //oTable.fnAdjustColumnSizing();
				this.fnAdjustColumnSizing(true);
            },
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] },
				{"aTargets": [ 1 ],"bVisible": false}],
			'fnRowCallback':function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
				var index = iDisplayIndexFull  +1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax
                ({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            }
        });
	};
	$(document).ready(function(){
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		
		sentEmail = function (id){
			alert('Ok siap kirim ke-'+id);
			$.ajax(
				{
					url : '<?=base_url()?>kuesioner/status_kuesioner/sent_email/'+id,
					type: "POST",
					//data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						//data: return data from server
						$.gritter.add({text: data});
						//$("#btn-close").click();
						//$("#search-btn").click();
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
					//	$('#btnf-close').click();   
					}
				});
			
		}
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	