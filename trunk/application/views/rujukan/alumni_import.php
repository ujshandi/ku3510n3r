<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});		
		
	});
</script>								
            
            <div class="form-group">
                <label class="col-sm-4 control-label"> Pilih File Excel* :  <span class="text-danger"></span></label>
                 <div class="col-sm-8">
                    <input type="file" class="fileupload" name="userfile" class="validate[required] large"/>
                </div>
                 <label> * file yang bisa di import adalah .xls (Excel 2003-2007) . Download template excel : <a href="<?=base_url()?>temp_upload/alumni.xls" class="red" title="Download template excel alumni"> alumni.xls </a> <span class="f_help"> </span></label>
               
            </div>


          
<style type="text/css">
	select {width:100%;}
</style>