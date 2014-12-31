            
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="diklat_id" value="<?=$data[0]->diklat_id?>"  />
			 <div class="form-group">
                <label class="col-sm-4 control-label">Tahun <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <input type="text"  class="form-control input-sm" data-mask="9999"  id="tahun" name="tahun" value="<?=$data[0]->tahun?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Judul Diklat <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="nama" id="nama" value="<?=$data[0]->nama?>" class="validate[required] large" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Jenis Diklat <span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    <select data-placeholder="Pilih Jenis Diklat..." class="chzn-select" tabindex="2" name="jenis_diklat" id="jenis_diklat">	
					  <option value=""/>	
					  <option value="1" >Diklat Teknis</option>
					  <option value="2" >Diklat Terstruktur</option>
					  <option value="3" >Diklat Prajabatan</option>
					  
					</select>    
                </div>
            </div>
           
          <div class="form-group">
                 <div class="col-sm-4">
				 </div>
                <div class="col-sm-8">
					<label class="control-label" for="ref"><input type="checkbox"  value="ya" name="ref" id="ref" > Referensi Kuesioner</label>
                    
                </div>
            </div>
<style type="text/css">
	select {width:100%;}
</style>