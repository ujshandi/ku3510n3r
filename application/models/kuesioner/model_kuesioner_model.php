<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Model_kuesioner_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select('r.model_kuesioner_id,r.singkatan, r.nama , r.petunjuk ')
		->unset_column('r.model_kuesioner_id')
		->add_column('Actions', model_kuesioner_action('$1'), 'r.model_kuesioner_id')
		->from(' model_kuesioner r ');
		  
		// if (isset($_POST['petunjuk'])) {
			// if ($_POST['petunjuk']!="-1") $this->datatables->where('r.petunjuk',$_POST['petunjuk']);
		// }
		 
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	
		return $this->datatables->generate();
	
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
        return $this->db->query("select r.*,i.singkatan as instansi from model_kuesioner r left join instansi i on r.petunjuk = i.petunjuk order by model_kuesioner_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'model_kuesioner');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'model_kuesioner');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'model_kuesioner');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['model_kuesioner_id'])) $where .= " and model_kuesioner_id='".$params['model_kuesioner_id']."'";
		}
		$sql = "select * from model_kuesioner ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
