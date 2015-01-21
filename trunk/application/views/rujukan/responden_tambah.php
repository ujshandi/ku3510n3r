<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="responden_id" value="<?=$data[0]->responden_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Nama <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="nama" id="nama" value="<?=$data[0]->nama?>" class="validate[required] large" >
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="email" id="email" value="<?=$data[0]->email?>" class="validate[required] large" >
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-4 control-label">Instansi <span class="text-danger">*</span></label>
                <div class="col-sm-8">
					 <?=form_dropdown('instansi_id',$list_instansi,$data[0]->instansi_id,'id="instansi_id" class="populate" style="width:100%"')?>
                </div>
            </div>
          
<style type="text/css">
	select {width:100%;}
</style>