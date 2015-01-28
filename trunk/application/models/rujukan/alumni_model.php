<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Alumni_model extends CI_Model
{	
	 public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select("'' as No,r.alumni_id,r.nama, r.email,i.nama as nama_instansi",false)
		->unset_column('r.alumni_id')
		->add_column('Actions', alumni_action('$1'), 'r.alumni_id')
		->from(' alumni r left join instansi i on r.instansi_id = i.instansi_id');
		  
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
        return $this->db->query("select r.*,i.nama as instansi from alumni r left join instansi i on r.instansi_id = i.instansi_id order by alumni_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'alumni');
	}

	
		function import($dataarray)
    {
        for($i=0;$i<count($dataarray);$i++)
        {
            $data = array(
                'nama'=>$dataarray[$i]['nama'],
                'email'=>$dataarray[$i]['email'],
                'instansi_id'=>$dataarray[$i]['instansi_id']
            );
            $this->db->insert('alumni', $data);
        }
    }     
	

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'alumni');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'alumni');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['alumni_id'])) $where .= " and alumni_id='".$params['alumni_id']."'";
		}
		$sql = "select * from alumni ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
