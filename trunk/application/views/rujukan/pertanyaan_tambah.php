            
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="pertanyaan_id" value="<?=$data[0]->pertanyaan_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Pertanyaan <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<textarea cols="45" name="tanya" id="tanya" ><?=$data[0]->tanya?></textarea>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label">Pertanyaan Tambahan 1</label>
                <div class="col-sm-8">
                	<textarea cols="45" name="tanya_tambahan1" id="tanya_tambahan1" ><?=$data[0]->tanya_tambahan1?></textarea>
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-4 control-label">Pertanyaan Tambahan 2 </label>
                <div class="col-sm-8">
					<textarea cols="45" name="tanya_tambahan2" id="tanya_tambahan2" ><?=$data[0]->tanya_tambahan2?></textarea>
                </div>
            </div>
          
<style type="text/css">
	select {width:100%;}
</style>