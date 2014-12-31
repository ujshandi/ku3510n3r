<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Instansi_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_list($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct instansi_id,nama from instansi ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua Instansi';
		else
			$list["-1"] = 'Pilih Instansi';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->instansi_id] = $i->nama;
			}
		return $list;
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
        return $this->db->query("select * from instansi order by instansi_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'instansi');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'instansi');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'instansi');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['instansi_id'])) $where .= " and instansi_id='".$params['instansi_id']."'";
		}
		$sql = "select * from instansi ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
