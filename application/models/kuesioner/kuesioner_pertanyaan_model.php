<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kuesioner_pertanyaan_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_list($params, & $listSelected) {
		$where = ' where 1=1 ';
		
		$sql = "select distinct p.pertanyaan_id,p.tanya , kp.pertanyaan_id as kp_pertanyaan, kp.model_kuesioner_id
from pertanyaan p left join kuesioner_pertanyaan kp on p.pertanyaan_id= kp.pertanyaan_id and kp.kuesioner_id = ".$params['kuesioner_id']." and kp.model_kuesioner_id = ".$params['model_kuesioner_id']."
where p.pertanyaan_id not in (select pertanyaan_id from kuesioner_pertanyaan where kuesioner_id = ".$params['kuesioner_id']." and model_kuesioner_id <> ".$params['model_kuesioner_id'].")";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		$listSelected  = array();
	//	var_dump($result);die;
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->pertanyaan_id] = $i->tanya;
				if ($i->model_kuesioner_id==$params['model_kuesioner_id'])
					$listSelected[] = $i->pertanyaan_id;
			}
		return $list;
	}
	
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select("k.kuesioner_id,date_format(k.tanggal_buat,'%d-%m-%Y') as tanggal_buat, k.tema ,date_format(k.periode_awal,'%d-%m-%Y') as periode_awal  , date_format(k.periode_akhir,'%d-%m-%Y') as periode_akhir, k.keterangan",false)
		->unset_column('k.kuesioner_id')
		->add_column('Actions', kuesioner_action('$1'), 'k.kuesioner_id')
		->from(' kuesioner k ');
		  
		// if (isset($_POST['keterangan'])) {
			// if ($_POST['keterangan']!="-1") $this->datatables->where('k.keterangan',$_POST['keterangan']);
		// }s
		 
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
        return $this->db->query("select k.*,i.tanggal_buat as instansi from kuesioner r left join instansi i on k.keterangan = i.keterangan order by kuesioner_id");    
    }

   
	function simpan($data){
		$this->db->trans_start();
		$pertanyaan = $data['pertanyaan_id'];
		//var_dump($pertanyaan);die;
		unset($data['pertanyaan_id']);
		//$this->db->insert('model_kuesioner', $data);
		//$kuesioner_id= $this->db->insert_id();
		if (isset($pertanyaan)){
			//$this->db->flush_cache();			
			//$this->db->where('model_kuesioner_id', $kuesioner_id);
			//$result = $this->db->delete('model_kuesioner_jawaban'); 
			foreach ($pertanyaan as $j){
				$this->db->flush_cache();
				$this->db->set('kuesioner_id',$data['kuesioner_id']);
				$this->db->set('model_kuesioner_id',$data['model_kuesioner_id']);
				$this->db->set('pertanyaan_id',$j);
				$this->db->insert('kuesioner_pertanyaan');				
			}
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
		
	}

   function edit($data,$whereData){
		
		//$this->mgeneral->update($whereData,$data,'kuesioner');
		$this->db->trans_start(); 
		$this->db->where('kuesioner_id', $whereData);
		$this->db->update('kuesioner', $data);
		 
		 
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'kuesioner');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['kuesioner_id'])) $where .= " and kuesioner_id='".$params['kuesioner_id']."'";
		}
		$sql = "select k.kuesioner_id,date_format(k.tanggal_buat,'%d-%m-%Y') as tanggal_buat, k.tema ,date_format(k.periode_awal,'%d-%m-%Y') as periode_awal  , date_format(k.periode_akhir,'%d-%m-%Y') as periode_akhir, k.keterangan from kuesioner k ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>