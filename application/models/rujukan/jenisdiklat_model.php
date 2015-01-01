<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Jenisdiklat_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_list_jenis($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct jenis_id, nama from jenis_diklat ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua Jenis Diklat';
		else
			$list["-1"] = 'Pilih Jenis Diklat';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->jenis_id] = $i->nama;
			}
		return $list;
	}
	
	
	
	

}
?>
