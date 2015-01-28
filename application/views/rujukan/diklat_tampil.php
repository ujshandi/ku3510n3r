<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar Diklat
				</header>
				<!-- filter area-->
				<div class="feed-box">
			 
					<div class="panel-body" style="border:1px solid;border-radius:10px;padding-bottom:0px;border-color:#dddddd">
					   
						<div class="corner-ribon blue-ribon">
						   <i class="fa fa-cog"></i>
						</div>
						<form class="form-horizontal" role="form">
								
							 
							<div class="form-group">
								<label class="col-md-2 control-label">Jenis Diklat</label>
								<div class="col-md-5">
							   <?=form_dropdown('fil_jenis_diklat',$list_jenisdiklat,'0','id="fil_jenis_diklat" class="populate" style="width:100%"')?>
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
								 <a href="#diklatModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="diklatAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="diklat-tbl" width="100%">
					<thead>
						<tr> 
							  <th>No</th> 
							  <th>Nama diklat</th>
							  <th>Kategori Kuesioner</th>
							  <th>Tahun</th>
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
							   <td><?php echo $datafield->kategori_kuesioner; ?></td>
							   <td><?php echo $datafield->tahun; ?></td>
							  <td>
								 
								<a href="#diklatModal" data-toggle="modal"  class="btn btn-info btn-xs" title="Edit"  onclick="diklatEdit('<?php echo $datafield->diklat_id;?>')"><i class="fa fa-pencil"></i></a>
								</span> 
								<span class="tip">
								<a id="delete_row" class="btn btn-danger btn-xs" href="#" onclick="diklatDelete('<?php echo $datafield->diklat_id;?>')" title="Delete"><i class="fa fa-times"></i></a>
								
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="diklatModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="diklat-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="diklat_title_form"></h5>
                </div>
                <div class="modal-body" id="diklat_form_konten">
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
	 
		oTable= $('#diklat-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": false,
			"sDom": 't<"bottom"plri>',
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url(); ?>rujukan/diklat/datatable',
            "bJQueryUI": true,
          //  "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
			
			"fnServerParams": function (aoData) {
				 
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
	//	$("#diklat-tbl").dataTable();
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#diklat-form" ).submit(function( event ) {
			var tahun 	= $('#tahun').val();
			var nama		= $('#nama').val();
			var jenis		= $('#jenis_diklat').val();
			
			
			if(tahun==""){
				alert("Tahun belum ditentukan");
				 $('#tahun').focus();
				return false;
			}else if(nama==""){
				alert("Judul Diklat belum ditentukan");
				$('#nama').focus();
				return false;
			}else if(jenis==""){
				alert("Jenis Diklat belum ditentukan");
				$('#jenis_diklat').focus();
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
		
		
		diklatAdd =function(){
			$("#diklat_title_form").html('<i class="fa fa-plus-square"></i>  Tambah Diklat');
			$("#diklat-form").attr("action",'<?=base_url()?>rujukan/diklat/save');
			$.ajax({
				url:'<?=base_url()?>rujukan/diklat/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#diklat_form_konten').html(result);
					}
			});
		}
		
		diklatEdit = function(id){
			$("#diklat_title_form").html('<i class="fa fa-pencil"></i>  Edit Diklat');
			$("#diklat-form").attr("action",'<?=base_url()?>rujukan/diklat/update');
			$.ajax({
				url:'<?=base_url()?>rujukan/diklat/edit/'+id,
					success:function(result) {
						$('#diklat_form_konten').html(result);
					}
			});
		}
		
		diklatDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>rujukan/diklat/hapus/'+id,
					success:function(result) {
						$.gritter.add({text: result});
						$("#search-btn").click();
					}
			});
		}
		
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	