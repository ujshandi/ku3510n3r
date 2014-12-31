<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Diklat_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
    public function isExistKode($kode=null){	
        if ($kode!=null)//utk update
            $this->db->where('alumni_id',$kode); //buat validasi

        $this->db->select('*');
        $this->db->from('alumni');

        $query = $this->db->get();
        $rs = $query->num_rows() ;		
        $query->free_result();
        return ($rs>0);
    }
	    
    function tampildata()
    {       
        return $this->db->query("select * from diklat order by diklat_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'diklat');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'diklat');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'diklat');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['diklat_id'])) $where .= " and diklat_id='".$params['diklat_id']."'";
		}
		$sql = "select * from diklat ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
