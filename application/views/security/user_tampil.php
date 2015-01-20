<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
                        
			<section class="panel">
				<header class="panel-heading">
					Daftar user
				</header>
				 
				
				<div class="panel-body">
				   <div class="row">
						<div class="col-sm-12">
							<div class="pull-right">
								 <a href="#userModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="userAdd();"><i class="fa fa-plus-circle"></i> Tambah</a>
							 </div>
						</div>
					</div>	
					  <br />
				   <div class="adv-table">
					<table class="display table table-bordered table-striped" id="user-tbl" width="100%">
					<thead>
						<tr> 
							  <th>No.</th>
							  <th>Nama User</th>
							  <th>Nama Lengkap</th>
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="userModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="user-form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="user_title_form"></h5>
                </div>
                <div class="modal-body" id="user_form_konten">
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
		var tahun = "0";//ga jadi dipake $('#fil_tahun').val();	
		var jenis_user = $('#fil_jenis_user').val();	
		oTable= $('#user-tbl').dataTable({
            "bProcessing": true,
            "searching": false,
			"autoWidth": false,
			"sDom": 't<"bottom"plri>',
            "bServerSide": false,
			"aoColumns" : [
					{ sWidth: '1%'  },					
					{ sWidth: '30%' },
					{ sWidth: '50%' },
					{ sWidth: '20%' } 
				],
            "sAjaxSource": '<?php echo base_url(); ?>security/user/datatable',
            "bJQueryUI": true,
          //  "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
			"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],
			'fnRowCallback':function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
				var index = iDisplayIndexFull  +1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			"fnServerParams": function (aoData) {
				// aoData.push(
				// { "name": "tahun", "value": tahun },
				// { "name": "jenis_user", "value": jenis_user }
				// );
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
		refreshTable();
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$( "#user-form" ).submit(function( event ) { 
			var user_name		= $('#user_name').val();
			var full_name		= $('#full_name').val();
			var passwd		= $('#passwd').val();
			
			
			if(user_name==""){
				alert("User Name belum ditentukan");
				 $('#user_name').focus();
				return false;
			}else if(full_name==""){
				alert("Nama Lengkap belum ditentukan");
				$('#full_name').focus();
				return false;
			}else if(passwd==""){
				alert("Password user belum ditentukan");
				$('#passwd').focus();
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
						//$("#search-btn").click();
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails   
						$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
						$('#btn-close').click();   
					}
				});
			
			  event.preventDefault();
			
			}
		});
		
		
		userAdd =function(){
			$("#user_title_form").html('<i class="fa fa-plus-square"></i>  Tambah User');
			$("#user-form").attr("action",'<?=base_url()?>security/user/save');
			$.ajax({
				url:'<?=base_url()?>security/user/tambah',
					success:function(result) {
						//$.gritter.add({text: data});
						$('#user_form_konten').html(result);
					}
			});
		}
		
		userEdit = function(id){
			$("#user_title_form").html('<i class="fa fa-pencil"></i>  Edit User');
			$("#user-form").attr("action",'<?=base_url()?>security/user/update');
			$.ajax({
				url:'<?=base_url()?>security/user/edit/'+id,
					success:function(result) {
						$('#user_form_konten').html(result);
					}
			});
		}
		
		userDelete = function(id){
			$.ajax({
				url:'<?=base_url()?>security/user/hapus/'+id,
					success:function(result) {
						$.gritter.add({text: result});
						refreshTable();
						$("#search-btn").click();
					}
			});
		}
		
		$("#search-btn").click(function(){
			refreshTable();
		});
	});
</script>	