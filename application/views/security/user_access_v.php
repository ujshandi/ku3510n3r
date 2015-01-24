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
					Hak Pengguna
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
								<label class="col-md-2 control-label">Pengguna</label>
								<div class="col-md-5">
							   <?=form_dropdown('fil_user_id',$list_user,'0','id="fil_user_id" class="populate" style="width:100%"')?>
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
				   <form id="access-form" method="post" action="<?=base_url()?>security/user_access/save"> 
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="rpt-tblx" width="100%">
					<thead>
						<tr> 
							  <th  rowspan="2"  align="center" width="1%" valign="middle">No.</th>
							  <th rowspan="2">Menu</th>
							  <th colspan="6">Hak Akses</th>
						</tr>
						<tr>
							<th>Tambah</th>
							<th>Edit</th>
							<th>Hapus</th>
							<th>Lihat</th>
							<th>Cetak</th>
							<th>Excel</th>
							<th>Import</th>
						</tr>
						
					</thead>
					<tbody id="body-access">					 
							<tr class="odd gradeX">
							   <td>&nbsp;</td>
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
					  <div class="pull-right">
						<button type="submit" id="btn-save" class="btn btn-info">Simpan</button>       
					</div>
					</form>
					
				</div>
			</section>    
            </div>
		</div>
	</section>
</section>

	
<script>
	var oTable;
	refreshTable = function(){
		 
		var fil_user_id = $('#fil_user_id').val();	
		$('#body-access').load('<?=base_url()?>security/user_access/get_data/'+fil_user_id);
		
	};
	$(document).ready(function(){
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#access-form" ).submit(function( event ) {
			var fil_user_id 	= $('#fil_user_id').val();
		 
			
			if(fil_user_id==""){
				alert("Pengguna belum ditentukan");
				 $('#fil_user_id').focus();
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
					 
						 
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
					 
					}
				});
			
			  event.preventDefault();
			
			}
		});
		
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	