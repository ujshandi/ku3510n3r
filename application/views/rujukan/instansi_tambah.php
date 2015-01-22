            
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="instansi_id" value="<?=$data[0]->instansi_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Nama Instansi <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="nama" id="nama" value="<?=$data[0]->nama?>" size="45" class="validate[required] large" >
                </div>
            </div>
          
           
          
<style type="text/css">
	select {width:100%;}
</style>