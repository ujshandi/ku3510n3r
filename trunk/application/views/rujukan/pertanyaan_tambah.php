            
<style type="text/css">
	select {width:100%;}
	.tagsinput {
		height:100px !important;
		width:360px !important;
	}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		/*$(selector).tagsInput({
   'autocomplete_url': url_to_autocomplete_api,
   'autocomplete': { option: value, option: value},
   'height':'100px',
   'width':'300px',
   'interactive':true,
   'defaultText':'add a tag',
   'onAddTag':callback_function,
   'onRemoveTag':callback_function,
   'onChange' : callback_function,
   'removeWithBackspace' : true,
   'minChars' : 0,
   'maxChars' : 0 //if not provided there is no limit,
   'placeholderColor' : '#666666'
});*/
		
		$('#opsi_jawaban').tagsInput({
			// my parameters here
			'defaultText':'',
			'height':'200px',
		});
		$('#opsi_jawaban').importTags('');
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
			  <div class="form-group">
                <label class="col-sm-4 control-label">Opsi Jawaban </label>
                <div class="col-sm-8">
					<input type="text"name="opsi_jawaban" id="opsi_jawaban" value="<?=$data[0]->opsi_jawaban?>"/>
					 <p class="help-block" id="opsi_info">Ketik opsi jawaban yang dibutuhkan. Tanda Koma digunakan sebagai pemisah antara opsi satu dan yang lainnya </p>
                </div>
            </div>
          
<style type="text/css">
	select {width:100%;}
</style>