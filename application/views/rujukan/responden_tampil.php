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
			
					<div class="panel-body">
					   
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
					<table class="display table table-bordered table-striped" id="responden-tbl">
					<thead>
						<tr>
							  <th>No</th> 
							  <th>Instansi</th>
							  <th>Nama</th>
							  <th>Email</th>
							  <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					  <?php $no=1; 					 
						if ($result->result() != null){
						   foreach($result->result() as $datafield){ ?>
							<tr class="odd gradeX">
							   <td><?php echo $no; ?></td>
							   <td><?php echo $datafield->instansi; ?></td>
							   <td><?php echo $datafield->nama; ?></td>
							   <td><?php echo $datafield->email; ?></td>
							  <td>
								 
								<a href="#respondenModal" data-toggle="modal"  class="btn btn-info btn-xs" title="Edit"  onclick="respondenEdit('<?php echo $datafield->responden_id;?>')"><i class="fa fa-pencil"></i></a>
								</span> 
								<span class="tip">
								<a id="delete_row" class="btn btn-danger btn-xs" href="#" onclick="respondenDelete('<?php echo $datafield->responden_id;?>')" title="Delete"><i class="fa fa-times"></i></a>
								
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
	$(document).ready(function(){
	//	$("#responden-tbl").dataTable();
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
						
					}
			});
		}
	});
</script>	