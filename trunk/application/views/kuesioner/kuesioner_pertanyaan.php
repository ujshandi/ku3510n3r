            
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
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label hide">Pertanyaan</label>
               <div class="col-md-9" id="divPertanyaan">
                 <?=form_dropdown('pertanyaan_id[]',$list_pertanyaan,'0','id="pertanyaan_id" class="multi-select" style="width:100%"')?>
				 
				</div>
            </div>
			 
			
		
          
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(function(){
		$('.default-date-picker').datepicker({
			format: 'dd-mm-yyyy'
		});
		
		$('#model_kuesioner_id').change(function(){
			 var kuesioner_id = $('#kuesioner_id').val();
			 var model_kuesioner_id = $('#model_kuesioner_id').val();
			 // $.ajax({
                    // url:"<?php echo site_url(); ?>kuesioner/kuesioner/get_pertanyaan/"+kuesioner_id+"/"+model_kuesioner_id,
                    // success:function(result) {
                       // $('#pertanyaan_id').empty();
						// $('#pertanyaan_id').multiSelect({
							// selectableHeader: "<div class='custom-header'>Daftar pertanyaan yang ada</div>",
							// selectionHeader: "<div class='custom-header'>Daftar pertanyaan yang dipilih</div>"
						// });
                        // result = JSON.parse(result);
                      //  for (k in result) {
                           // $('#pertanyaan_id').append(new Option(result[k],k));// , nested: 'optgroup_label'
						  // alert(result[k]);
						   // var selectValues = "10=one more test\n11=and another test"
                            // $('#pertanyaan_id').multiSelect('addOption', { value: 14, text: 'tes'  });
							//{ value: k, text: 'tes', index: 0 }
                      //  }
                        //sasaran.select2({minimumResultsForSearch: -1, width:'resolve'});
						// $('#pertanyaan_id').multiSelect({
			// selectableHeader: "<div class='custom-header'>Daftar pertanyaan yang ada</div>",
			// selectionHeader: "<div class='custom-header'>Daftar pertanyaan yang dipilih</div>"
		// });
						//$('#pertanyaan_id').multiSelect('deselect_all');
                    // }
                });
		});
    });
	
</script>