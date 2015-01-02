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
	
	function get_list($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct model_kuesioner_id,nama,singkatan from model_kuesioner ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua Model Kuesioner';
		else
			$list["-1"] = 'Pilih Model Kuesioner';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->model_kuesioner_id] = $i->nama.' ('.$i->singkatan.')';
			}
		return $list;
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
		//$this->mgeneral->save($data,'model_kuesioner');
		$this->db->trans_start();
		$modeljawab = $data['model_jawaban'];
		unset($data['model_jawaban']);
		$this->db->insert('model_kuesioner', $data);
		$kuesioner_id= $this->db->insert_id();
		if (isset($modeljawab)){
			$this->db->flush_cache();			
			$this->db->where('model_kuesioner_id', $kuesioner_id);
			$result = $this->db->delete('model_kuesioner_jawaban'); 
			foreach ($modeljawab as $j){
				$this->db->flush_cache();
				$this->db->set('model_kuesioner_id',$kuesioner_id);
				$this->db->set('jawab_id',$j);
				$this->db->insert('model_kuesioner_jawaban');				
			}
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
	}

   function edit($data,$whereData){
		
		//$this->mgeneral->update($whereData,$data,'model_kuesioner');
		$this->db->trans_start();
		$modeljawab = $data['model_jawaban'];
		unset($data['model_jawaban']);
		$this->db->where('model_kuesioner_id', $whereData);
		$this->db->update('model_kuesioner', $data);
		 
		
		if (isset($modeljawab)){
			$this->db->flush_cache();			
			$this->db->where('model_kuesioner_id', $whereData);
			$result = $this->db->delete('model_kuesioner_jawaban'); 
			foreach ($modeljawab as $j){
				$this->db->flush_cache();
				$this->db->set('model_kuesioner_id',$whereData);
				$this->db->set('jawab_id',$j);
				$this->db->insert('model_kuesioner_jawaban');				
			}
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
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
