<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar Alumni
				</header>
				<!-- filter area-->
				<div class="feed-box">
			
					<div class="panel-body" style="border:1px solid;border-radius:10px;padding-bottom:0px;border-color:#dddddd">
					   
						<div class="corner-ribon blue-ribon">
						   <i class="fa fa-cog"></i>
						</div>
						<form class="form-horizontal" role="form">
								 
							<div class="form-group">
								<label class="col-md-2 control-label">Instansi</label>
								<div class="col-md-5">
							   <?=form_dropdown('fil_instansi_id',$list_instansi,'0','id="fil_instansi_id" class="populate" style="width:100%"')?>
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
				   <div class="row">
						<div class="col-sm-12">
							<div class="pull-right">
								 <a href="#alumniModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="alumniImport();"><i class="fa fa-download"></i> Import</a>
								 <a href="#alumniModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="alumniAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="alumni-tbl" width="100%">
					<thead>
						<tr> 						  
							  <th>No.</th>
							  <th>Nama</th>
							  <th>Email</th>
							  <th>Instansi</th>
							  <th style="width:80px;">Aksi</th>
						</tr>
					</thead>
					<tbody>					 
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
			</section>    
            </div>
		</div>
	</section>
</section>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="alumniModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="alumni-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="alumni_title_form"></h5>
                </div>
                <div class="modal-body" id="alumni_form_konten">
                </div>
                <div class="modal-footer">
                	<div class="pull-right">
                		<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal" class="close">Batalkan</button>
                    	<button type="submit" id="btn-save" class="btn btn-info">Simpan</button>
                	</div>
                </div>
            </div>
        </form>
        </div>
    </div>
	<style type="text/css">
	select {width:100%;}
</style>
<script>
	var oTable;
	refreshTable = function(){
		if (oTable)
            oTable.fnDestroy();
		var instansi_id = $('#fil_instansi_id').val();	
		oTable= $('#alumni-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": false,
			"sDom": 't<"bottom"plri>',
            "bServerSide": false,
            "sAjaxSource": '<?php echo base_url(); ?>rujukan/alumni/datatable',
            "bJQueryUI": true,
			"aoColumns" : [
					{ sWidth: '1%'  },					
					{ sWidth: '30%' },
					{ sWidth: '20%' },
					{ sWidth: '20%' },
					{ sWidth: '10%' } 
				],
          //  "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
			
			"fnServerParams": function (aoData) {
				aoData.push(
				{ "name": "instansi_id", "value": instansi_id }
				);
			},
            // "oLanguage": {
                // "sProcessing": "<img src='<php echo base_url(); ?>assets/images/ajax-loader_dark.gif'>"
            // },
            "fnInitComplete": function () {
                //oTable.fnAdjustColumnSizing();
				this.fnAdjustColumnSizing(true);
            },
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],
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
	//	$("#alumni-tbl").dataTable();
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#alumni-form" ).submit(function( event ) { 
			var nama		= $('#nama').val();
			var instansi_id		= $('#instansi_id').val();
			 if(nama==""){
				alert("Nama alumni belum ditentukan");
				$('#nama').focus();
				return false;
			}else if(instansi_id==""){
				alert("Instansi belum ditentukan");
				$('#instansi_id').focus();
				return false;
			}else{
				
			 var postData = $(this).serializeArray();
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
						$("#btn-close").click();
						$("#search-btn").click();
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
						$('#btnf-close').click();   
					}
				});
			
			  event.preventDefault();
			
			}
		});
		
		
		alumniAdd =function(){
			$("#alumni_title_form").html('<i class="fa fa-plus-square"></i>  Tambah alumni');
			$("#alumni-form").attr("action",'<?=base_url()?>rujukan/alumni/save');
			$.ajax({
				url:'<?=base_url()?>rujukan/alumni/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#alumni_form_konten').html(result);
					}
			});
		}

		alumniImport =function(){
			$("#alumni_title_form").html('<i class="fa fa-plus-square"></i>  Import Data alumni');
			$("#alumni-form").attr("action",'<?=base_url()?>rujukan/alumni/importdata');
			$.ajax({
				url:'<?=base_url()?>rujukan/alumni/import',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#alumni_form_konten').html(result);
					}
			});
		}
		
		 alumniEdit = function(id){
			$("#alumni_title_form").html('<i class="fa fa-pencil"></i>  Edit alumni');
			$("#alumni-form").attr("action",'<?=base_url()?>rujukan/alumni/update');
			$.ajax({
				url:'<?=base_url()?>rujukan/alumni/edit/'+id,
					success:function(result) {
						$('#alumni_form_konten').html(result);
					}
			});
		}
		
		alumniDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>rujukan/alumni/hapus/'+id,
					success:function(result) {
						$.gritter.add({text: result});
						refreshTable();
					}
			});
		}
		
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	