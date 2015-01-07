            
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="model_kuesioner_id" value="<?=$data[0]->model_kuesioner_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Singkatan <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="singkatan" id="singkatan" value="<?=$data[0]->singkatan?>"/>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label">Nama Model</label>
                <div class="col-sm-8">
                	<textarea cols="45" name="nama" id="nama" ><?=$data[0]->nama?></textarea>
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-4 control-label">Petunjuk</label>
                <div class="col-sm-8">
					<textarea cols="45" name="petunjuk" id="petunjuk" ><?=$data[0]->petunjuk?></textarea>
                </div>
            </div>
			 <div class="form-group">
                <label class="col-sm-4 control-label">Caption Pertanyaan <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="caption_pertanyaan" id="caption_pertanyaan" value="<?=$data[0]->caption_pertanyaan?>"/>
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-4 control-label">Model Jawaban</label>
                <div class="col-sm-8">
					 <select class="populate select2-offscreen" style="width:300px" id="model_jawaban" name="model_jawaban[]" multiple="" tabindex="-1">
                                       <?=$multiselect_jawab?>
                                    </select>
                </div>
            </div>
          
<style type="text/css">
	select {width:100%;}
</style>