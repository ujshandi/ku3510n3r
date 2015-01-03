<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Pertanyaan_model extends CI_Model
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
		$sql = "select distinct pertanyaan_id,tanya from pertanyaan ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		// if ($forFilter)
			// $list["-1"] = 'Semua Instansi';
		// else
			// $list["-1"] = 'Pilih Instansi';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->pertanyaan_id] = $i->tanya;
			}
		return $list;
	}
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select('r.pertanyaan_id,r.tanya, r.tanya_tambahan1 , r.tanya_tambahan2 ')
		->unset_column('r.pertanyaan_id')
		->add_column('Actions', pertanyaan_action('$1'), 'r.pertanyaan_id')
		->from(' pertanyaan r ');
		  
		// if (isset($_POST['tanya_tambahan2'])) {
			// if ($_POST['tanya_tambahan2']!="-1") $this->datatables->where('r.tanya_tambahan2',$_POST['tanya_tambahan2']);
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
        return $this->db->query("select r.*,i.tanya as instansi from pertanyaan r left join instansi i on r.tanya_tambahan2 = i.tanya_tambahan2 order by pertanyaan_id");    
    }

   
	function simpan($data){
		$this->mgeneral->save($data,'pertanyaan');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'pertanyaan');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'pertanyaan');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['pertanyaan_id'])) $where .= " and pertanyaan_id='".$params['pertanyaan_id']."'";
		}
		$sql = "select * from pertanyaan ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
