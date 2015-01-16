<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Responden_model extends CI_Model
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
		$this->datatables->select("'' as No,r.responden_id,r.nama, r.email,i.nama as nama_instansi",false)
		->unset_column('r.responden_id')
		->add_column('Actions', responden_action('$1'), 'r.responden_id')
		->from(' responden r left join instansi i on r.instansi_id = i.instansi_id');
		  
		if (isset($_POST['instansi_id'])) {
			if ($_POST['instansi_id']!="-1") $this->datatables->where('r.instansi_id',$_POST['instansi_id']);
		}
		 
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
        return $this->db->query("select r.*,i.nama as instansi from responden r left join instansi i on r.instansi_id = i.instansi_id order by responden_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'responden');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'responden');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'responden');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['responden_id'])) $where .= " and responden_id='".$params['responden_id']."'";
		}
		$sql = "select * from responden ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
