            
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
                <label class="col-sm-4 control-label hide">Pertanyaan</label>
				 <input type="hidden" name="multiple_value" id="multiple_value"  />
               <div class="col-md-9" id="divResponden">
                 <?=form_multiselect('responden_id[]',$list_responden,'0','id="responden_id" class="multi-select" style="width:100%"')?>
				 
				</div>
            </div>
			 
			
		
          
<style type="text/css">
	select {width:100%;}
</style>
<script>
	$(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
	 
		 
			 var kuesioner_id = $('#kuesioner_id').val();
			 
			$("#divResponden").load("<?=base_url()?>kuesioner/kuesioner_responden/get_responden/"+kuesioner_id,function(){
				$('#responden_id').multiSelect({
					selectableHeader: "<div class='custom-header'>Daftar responden yang ada</div><input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
					selectionHeader: "<div class='custom-header'>Daftar responden yang dipilih</div><input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
					dblClick:true,
					afterInit: function (ms) {
						var that = this,
						$selectableSearch = that.$selectableUl.prev(),
						$selectionSearch = that.$selectionUl.prev(),
						selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
						selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
						that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
						.on('keydown', function (e) {
							if (e.which === 40) {
								that.$selectableUl.focus();
								return false;
							}
						});
						that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
						.on('keydown', function (e) {
							if (e.which == 40) {
								that.$selectionUl.focus();
								return false;
							}
						});
					},
					afterSelect: function (value, text) {
						this.qs1.cache();
						this.qs2.cache();
						var hidden_val = $("#multiple_value").val();
						$("#multiple_value").val(hidden_val+","+value);
					},
					afterDeselect: function (value, text) {
						this.qs1.cache();
						this.qs2.cache();
						var new_val = $("#multiple_value").val().replace(","+value, "");
						$("#multiple_value").val(new_val);
					}
				});//end multiselect
				/*$('#responden_id').multiSelect({
					selectableHeader: "<div class='custom-header'>Daftar responden yang ada</div>",
					selectionHeader: "<div class='custom-header'>Daftar responden yang dipilih</div>",					
					dblClick:true,
					afterSelect: function(value, text){
						// var get_val = $("#multiple_value").val();
						//var hidden_val = (get_val != "") ? get_val+"," : get_val;
						var hidden_val = $("#multiple_value").val();
						$("#multiple_value").val(hidden_val+","+value);
					  },
					  afterDeselect: function(value, text){
						// var get_val = $("#multiple_value").val();
						// var new_val = get_val.replace(value, "");
						var new_val = $("#multiple_value").val().replace(","+value, "");
						$("#multiple_value").val(new_val);
					  }
				});	*/
				 
			});//end divpertanyaan load
			 
			
		 
    });
	
</script>