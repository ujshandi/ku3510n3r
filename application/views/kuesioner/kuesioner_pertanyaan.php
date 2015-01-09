            
<style type="text/css">
	select {width:100%;}
	.ms-container{
		width: 710px;
	}
	.ms-container .ms-list{
		height: 300px;
	}

</style>
<script>
	$(document).ready(function(){
		//$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		$('#pertanyaan_id').multiSelect({
			selectableHeader: "<div class='custom-header'>Daftar pertanyaan yang ada</div>",
			selectionHeader: "<div class='custom-header'>Daftar pertanyaan yang dipilih</div>"
		});
		// $('#pertanyaan_id').multiSelect('deselect_all');
	});
</script>								
            <input type="hidden" name="kuesioner_id" id="kuesioner_id" value="<?=$data[0]->kuesioner_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Model Kuesioner <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	 <?=form_dropdown('model_kuesioner_id',$list_model_kuesioner,'0','id="model_kuesioner_id" class="populate" style="width:100%"')?>
					 <p class="help-block" id="model_info"></p>
					 <input type="hidden" id="tipe_jawaban" name="tipe_jawaban"/>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label hide">Pertanyaan</label>
				 <input type="hidden" name="multiple_value" id="multiple_value"  />
               <div class="col-md-9" id="divPertanyaan">
                 <?=form_dropdown('pertanyaan_id[]',$list_pertanyaan,'0','id="pertanyaan_id" class="multi-select" style="width:100%"')?>
				 
				</div>
            </div>
			 
			
		
          
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		$('.default-date-picker').datepicker({
			format: 'dd-mm-yyyy'
		});
		
		$('#model_kuesioner_id').change(function(){
			 var kuesioner_id = $('#kuesioner_id').val();
			 var model_kuesioner_id = $('#model_kuesioner_id').val();
			 $('#model_info').text('');
			 $('#tipe_jawaban').val('');
			 $.ajax({
                url:"<?php echo site_url(); ?>kuesioner/model_kuesioner/get_model_info/"+model_kuesioner_id,
                success:function(result) {
					 
						
				 
					$('#tipe_jawaban').val(result);
					$('#model_info').text('Tipe jawaban : '+result);
				}
			});
			 
			$("#divPertanyaan").load("<?=base_url()?>kuesioner/kuesioner/get_pertanyaan/"+kuesioner_id+"/"+model_kuesioner_id,function(){
				$('#pertanyaan_id').multiSelect({
					selectableHeader: "<div class='custom-header'>Daftar pertanyaan yang ada</div>",
					selectionHeader: "<div class='custom-header'>Daftar pertanyaan yang dipilih</div>",					
					dblClick:true,
					afterSelect: function(value, text){
						// var get_val = $("#multiple_value").val();
						//var hidden_val = (get_val != "") ? get_val+"," : get_val;
						var hidden_val = $("#multiple_value").val();
						$("#multiple_value").val(hidden_val+","+value);
					  },
					  afterDeselect: function(value, text){
						// var get_val = $("#multiple_value").val();
						// var new_val = get_val.replace(value, "");
						var new_val = $("#multiple_value").val().replace(","+value, "");
						$("#multiple_value").val(new_val);
					  }
				});	
				 
			});//end divpertanyaan load
			 
			
		});
    });
	
</script>