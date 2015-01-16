<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Peruntukkan_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_list_peruntukkan($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct nama from peruntukkan ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua Peruntukkan';
		else
			$list["-1"] = 'Pilih Peruntukkan';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->nama] = $i->nama;
			}
		return $list;
	}
	
	
	
	

}
?>
