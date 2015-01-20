 
 							
            <input type="hidden" name="user_id" value="<?=$data[0]->user_id?>"  />
			 
            
			<div class="form-group">
                <label class="col-sm-4 control-label">Nama User <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                	<input type="text" name="user_name" id="user_name" value="<?=$data[0]->user_name?>"/>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label">Nama Lengkap</label>
                <div class="col-sm-8">
                	<input type="text" name="full_name" id="full_name" value="<?=$data[0]->full_name?>"/>
                </div>
            </div>
			<div class="form-group">
                <label class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                	<input type="password" name="passwd" id="passwd" value="<?=$data[0]->passwd?>"/>
                	<input type="hidden" name="old_passwd" id="old_passwd" value="<?=$data[0]->passwd?>"/>
                </div>
            </div>
			 
          
<style type="text/css">
	select {width:100%;}
</style>
<script>
	 
</script>