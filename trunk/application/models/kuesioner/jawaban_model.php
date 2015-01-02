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
	
	function get_multiselect() {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct jawab_id, nama, tipe, singkatan, coalesce(parent_id,0) as parent_id, value, hide  from jawaban order by jawab_id ";
		
		
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
					$list .= '<option value="'.$i->jawab_id.'">'.$i->nama.'</option>';
				}
				
					
				 
			}
		return $list;
	} 
  
}
?>
