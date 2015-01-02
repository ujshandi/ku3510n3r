<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar Responden
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
								 <a href="#respondenModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="respondenAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="responden-tbl" width="100%">
					<thead>
						<tr> 						  
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="respondenModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="responden-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="responden_title_form"></h5>
                </div>
                <div class="modal-body" id="responden_form_konten">
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
		oTable= $('#responden-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": false,
			"sDom": 't<"bottom"plri>',
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url(); ?>rujukan/responden/datatable',
            "bJQueryUI": true,
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
			'fnRowCallback ':function(){
				var index = iDisplayIndex +1;
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
	//	$("#responden-tbl").dataTable();
		refreshTable();
		 $('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#responden-form" ).submit(function( event ) { 
			var nama		= $('#nama').val();
			var instansi_id		= $('#instansi_id').val();
			 if(nama==""){
				alert("Nama Responden belum ditentukan");
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
		
		
		respondenAdd =function(){
			$("#responden_title_form").html('<i class="fa fa-plus-square"></i>  Tambah Responden');
			$("#responden-form").attr("action",'<?=base_url()?>rujukan/responden/save');
			$.ajax({
				url:'<?=base_url()?>rujukan/responden/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#responden_form_konten').html(result);
					}
			});
		}
		
		 respondenEdit = function(id){
			$("#responden_title_form").html('<i class="fa fa-pencil"></i>  Edit Responden');
			$("#responden-form").attr("action",'<?=base_url()?>rujukan/responden/update');
			$.ajax({
				url:'<?=base_url()?>rujukan/responden/edit/'+id,
					success:function(result) {
						$('#responden_form_konten').html(result);
					}
			});
		}
		
		respondenDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>rujukan/responden/hapus/'+id,
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