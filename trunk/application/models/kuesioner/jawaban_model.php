<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Jawaban_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	private function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
		if ($strict) { 
			foreach ($haystack as $item) 
				if (isset($item->$needle_field) && $item->$needle_field === $needle) 
					return true; 
		} 
		else { 
			foreach ($haystack as $item) 
				if (isset($item->$needle_field) && $item->$needle_field == $needle) 
					return true; 
		} 
		return false; 
	} 
	
	function get_multiselect($selectedItem=null) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct jawab_id, nama, tipe, singkatan, coalesce(parent_id,0) as parent_id, value, hide  from jawaban order by jawab_id ";
		//var_dump($selectedItem);
		
		$result = $this->mgeneral->run_sql($sql);
		$list = '';
		$parent_id = -1;
		if (isset($result))
			foreach ($result as $i) {
				if ($parent_id != $i->parent_id){
					if ($parent_id!=-1)
						$list .= '</optgroup>';
					$parent_id = $i->jawab_id;
					$list .= '<optgroup label="'.$i->nama.'">';
				}else {
					if(isset($selectedItem))
						$list .= '<option value="'.$i->jawab_id.'" '.($this->in_array_field($i->jawab_id,'jawab_id',$selectedItem)?"selected='selected'":"").'>'.$i->nama.'</option>';
					else
						$list .= '<option value="'.$i->jawab_id.'">'.$i->nama.'</option>';
				}
				
					
				 
			}
		return $list;
	} 
  
}
?>
