            
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            <input type="hidden" name="kuesioner_id" value="<?=$data[0]->kuesioner_id?>"  />
			 
            <div class="form-group">
                <label class="col-sm-4 control-label">Tanggal Buat <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                	<input type="text" size="5" class="form-control form-control-inline input-medium default-date-picker" name="tanggal_buat" id="tanggal_buat" value="<?=$data[0]->tanggal_buat?>"/>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label">Tema</label>
                <div class="col-sm-8">
                	<textarea cols="45" name="tema" id="tema" ><?=$data[0]->tema?></textarea>
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-4 control-label">Periode Awal <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                	<input type="text" size="5" class="form-control form-control-inline input-medium default-date-picker" name="periode_awal" id="periode_awal" value="<?=$data[0]->periode_awal?>"/>
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-4 control-label">Periode Akhir<span class="text-danger">*</span></label>
                <div class="col-sm-3">
                	<input type="text" size="5" class="form-control form-control-inline input-medium default-date-picker" name="periode_akhir" id="periode_akhir" value="<?=$data[0]->periode_akhir?>"/>
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-4 control-label">Keterangan</label>
                <div class="col-sm-8">
					<textarea cols="45" name="keterangan" id="keterangan" ><?=$data[0]->keterangan?></textarea>
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
    });
	
</script>