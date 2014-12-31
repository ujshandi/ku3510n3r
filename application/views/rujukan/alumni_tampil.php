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
								 <a href="#alumniModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="alumniAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="alumni-tbl">
					<thead>
						<tr>
							  <th style="width:1%">No</th> 
							  <th>NIK</th>
							  <th>Nama</th>
							  <th>Tempat Lahir</th>
							  <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					  <?php $no=1; 					 
						if ($result->result() != null){
						   foreach($result->result() as $datafield){ ?>
							<tr class="odd gradeX">
							   <td><?php echo $no; ?></td>
							   <td><?php echo $datafield->nik; ?></td>
							   <td><?php echo $datafield->nama; ?></td>
							   <td><?php echo $datafield->tempat_lahir; ?></td>
							  <td>
								 
								<a href="#alumniModal" data-toggle="modal"  class="btn btn-info btn-xs" title="Edit"  onclick="alumniEdit('<?php echo $datafield->alumni_id;?>')"><i class="fa fa-pencil"></i></a>
								</span> 
								<span class="tip">
								<a id="delete_row" class="btn btn-danger btn-xs" href="#" onclick="alumniDelete('<?php echo $datafield->alumni_id;?>')" title="Delete"><i class="fa fa-times"></i></a>
								
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
			
		oTable= $("#alumni-tbl").dataTable({
			"searching": false,
			"sDom": 'rt<"top"lpi>',
			 // Disable sorting on the first column
        "aoColumnDefs" : [ {
            'bSortable' : false,
            'aTargets' : [ 0 ]
        } ]
		});
		
	}
	$(document).ready(function(){
		
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#alumni-form" ).submit(function( event ) { 
			var nama		= $('#nama').val();
			var instansi_id		= $('#instansi_id').val();
			 if(nama==""){
				alert("Nama Alumni belum ditentukan");
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
			$("#alumni_title_form").html('<i class="fa fa-plus-square"></i>  Tambah Alumni');
			$("#alumni-form").attr("action",'<?=base_url()?>rujukan/alumni/save');
			$.ajax({
				url:'<?=base_url()?>rujukan/alumni/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#alumni_form_konten').html(result);
					}
			});
		}
		
		 alumniEdit = function(id){
			$("#alumni_title_form").html('<i class="fa fa-pencil"></i>  Edit Alumni');
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
						
					}
			});
		}
		
		
		
		$("#search-btn").click(function(){
			refreshTable();
		
		});
	});
</script>	