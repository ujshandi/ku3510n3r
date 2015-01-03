<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar Kuesioner
				</header>
				
				
				<div class="panel-body">
				   <div class="row">
						<div class="col-sm-12">
							<div class="pull-right">
							 
								 <a href="#" data-toggle="modal" class="btn btn-primary btn-sm hide" style="margin-top:-5px;"  ><i class="fa fa-check-square-o"></i> Refresh</a>
								 <a href="#kuesionerModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="kuesionerAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="kuesioner-tbl"  width="100%">
					<thead>
						<tr> 
							  <th>Tgl.Dibuat</th>
							  <th>Tema</th>
							  <th>Periode Awal</th>
							  <th>Periode Akhir</th>
							  <th>Keterangan</th>
							  <th style="width:5%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="kuesionerModal" class="modal fade">
        <div class="modal-dialog" style="width:750px">
        <form method="post" id="kuesioner-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="kuesioner_title_form"></h5>
                </div>
                <div class="modal-body" id="kuesioner_form_konten">
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
	 
		oTable= $('#kuesioner-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": true,
			"sDom": 't<"bottom"plri>',
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url(); ?>kuesioner/kuesioner/datatable',
            "bJQueryUI": true,
			"aoColumns" : [
					{ sWidth: '10%',type:"date"	,dateFormat: "dd-mm-yyyy"				},
					{ sWidth: '40%' },
					{ sWidth: '10%' },
					{ sWidth: '10%' },
					{ sWidth: '15%' },
					{ sWidth: '15%' }
				],
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
	//	$("#kuesioner-tbl").dataTable();
		refreshTable(); 
		$( "#kuesioner-form" ).submit(function( event ) { 
			var kuesioner		= $('#tanya').val(); 
			
			 if(kuesioner==""){
				alert("Kuesioner belum ditentukan");
				$('#tanya').focus();
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
						 refreshTable();
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
						$('#btn-close').click();   
						refreshTable();
					}
				});
			
			  event.preventDefault();
			
			}
		});
		
		
		kuesionerAdd =function(){
			$("#kuesioner_title_form").html('<i class="fa fa-plus-square"></i>  Tambah Kuesioner');
			$("#kuesioner-form").attr("action",'<?=base_url()?>kuesioner/kuesioner/save');
			$.ajax({
				url:'<?=base_url()?>kuesioner/kuesioner/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#kuesioner_form_konten').html(result);
					}
			});
		}
		
		 kuesionerEdit = function(id){
			$("#kuesioner_title_form").html('<i class="fa fa-pencil"></i>  Edit Kuesioner');
			$("#kuesioner-form").attr("action",'<?=base_url()?>kuesioner/kuesioner/update');
			$.ajax({
				url:'<?=base_url()?>kuesioner/kuesioner/edit/'+id,
					success:function(result) {
						$('#kuesioner_form_konten').html(result);
					}
			});
		}
		
		kuesionerDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>kuesioner/kuesioner/hapus/'+id,
					success:function(result) {
						$.gritter.add({text: result});
						refreshTable();
					}
			});
		}
		
		 kuesionerPertanyaan = function(id){
			$("#kuesioner_title_form").html('<i class="fa fa-pencil"></i>  Daftar Pertanyaan Kuesioner');
			$("#kuesioner-form").attr("action",'<?=base_url()?>kuesioner/kuesioner/pertanyaan_submit/'+id);
			$.ajax({
				url:'<?=base_url()?>kuesioner/kuesioner/pertanyaan_add/'+id,
					success:function(result) {
						$('#kuesioner_form_konten').html(result);
					}
			});
		}
	});
</script>	