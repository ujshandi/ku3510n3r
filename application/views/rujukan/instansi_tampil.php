<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar Instansi
				</header>
				
				
				<div class="panel-body">
				   <div class="row">
						<div class="col-sm-12">
							<div class="pull-right">
							 
								 <a href="#" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;"  ><i class="fa fa-check-square-o"></i> Refresh</a>
								 <a href="#instansiModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="instansiAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="instansi-tbl">
					<thead>
						<tr>
							  <th style="width:1%">No</th>
							  <th>Nama Instansi</th>
							  <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					  <?php $no=1; 					 
						if ($result->result() != null){
						   foreach($result->result() as $datafield){ ?>
							<tr class="odd gradeX">
							   <td><?php echo $no; ?></td>
							   <td><?php echo $datafield->nama; ?></td>
							  <td>
								 
								<a href="#instansiModal" data-toggle="modal"  class="btn btn-info btn-xs" title="Edit"  onclick="instansiEdit('<?php echo $datafield->instansi_id;?>')"><i class="fa fa-pencil"></i></a>
								</span> 
								<span class="tip">
								<a id="delete_row" class="btn btn-danger btn-xs" href="#" onclick="instansiDelete('<?php echo $datafield->instansi_id;?>')" title="Delete"><i class="fa fa-times"></i></a>
								
							  </td>
							</tr>
							<?php $no++; } 
						}else { ?>
							<tr class="odd gradeX">
							   <td colspan="5">Data tidak ditemukan</td>
							  
							  </tr>
						<? }?>
					  </tbody>
					</table>
					</div>

				</div>
			</section>    
            </div>
		</div>
	</section>
</section>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="instansiModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="instansi-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="instansi_title_form"></h5>
                </div>
                <div class="modal-body" id="instansi_form_konten">
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
	$(document).ready(function(){
	//	$("#instansi-tbl").dataTable();
		 
		$( "#instansi-form" ).submit(function( event ) { 
			var nama		= $('#nama').val(); 
			
			 if(nama==""){
				alert("Nama Instansi belum ditentukan");
				$('#nama').focus();
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
						$("#fungsi-btn").click();
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
		
		
		instansiAdd =function(){
			$("#instansi_title_form").html('<i class="fa fa-plus-square"></i>  Tambah Instansi');
			$("#instansi-form").attr("action",'<?=base_url()?>rujukan/instansi/save');
			$.ajax({
				url:'<?=base_url()?>rujukan/instansi/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#instansi_form_konten').html(result);
					}
			});
		}
		
		 instansiEdit = function(id){
			$("#instansi_title_form").html('<i class="fa fa-pencil"></i>  Edit Instansi');
			$("#instansi-form").attr("action",'<?=base_url()?>rujukan/instansi/update');
			$.ajax({
				url:'<?=base_url()?>rujukan/instansi/edit/'+id,
					success:function(result) {
						$('#instansi_form_konten').html(result);
					}
			});
		}
		
		instansiDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>rujukan/instansi/hapus/'+id,
					success:function(result) {
						$.gritter.add({text: result});
						
					}
			});
		}
	});
</script>	