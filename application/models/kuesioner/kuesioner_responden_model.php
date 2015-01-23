<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kuesioner_responden_model extends CI_Model
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
		
		$sql = "select distinct r.responden_id,r.nama,i.nama as instansi_nama , kr.responden_id as kr_responden,kr.kuesioner_id 
from responden r inner join instansi i on i.instansi_id = r.instansi_id left join kuesioner_responden kr on r.responden_id= kr.responden_id and kr.kuesioner_id = ".$params['kuesioner_id'];
//where r.responden_id not in (select responden_id from kuesioner_responden where kuesioner_id = ".$params['kuesioner_id']."x)";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		$listSelected  = array();
		$list  = array();
	//	var_dump($result);die;
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->responden_id] = $i->nama.', '.$i->instansi_nama;
				if ($i->kuesioner_id==$params['kuesioner_id'])
					$listSelected[] = $i->responden_id;
			}
		return $list;
	}
	
 
 
	function getdata_status($params){
		$where = " WHERE 1=1 ";
		if ($params['kuesioner_id']) {
			 $where .=' and kr.kuesioner_id = '.$params['kuesioner_id'];
		}
		$sql = "SELECT kr.kuesioner_responden_id, r.nama, kr.status_terkirim, kr.status_respon,kr.kuesioner_id, kr.responden_id  
		FROM kuesioner_responden kr INNER JOIN responden r ON r.responden_id = kr.responden_id ".$where;
		return $this->db->query($sql)->result();
	
	}
	
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select("'' as No,kr.kuesioner_responden_id, r.nama, kr.status_terkirim, kr.status_respon ",false)
		//->unset_column('k.kuesioner_id')
		//->add_column('Actions', kuesioner_action('$1'), 'k.kuesioner_id')
		->from(' kuesioner_responden kr INNER JOIN responden r ON r.responden_id = kr.responden_id');
		  
	 	if (isset($_POST['kuesioner_id'])) {
			 $this->datatables->where('kr.kuesioner_id',$_POST['kuesioner_id']);
		}
		 
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	
		return $this->datatables->generate();
	
	}
    
	 
   
	function simpan($data){
		$this->db->trans_start();
		$pertanyaan = $data['responden_id'];
		//var_dump($pertanyaan);die;
		unset($data['responden_id']);
		//$this->db->insert('model_kuesioner', $data);
		//$kuesioner_id= $this->db->insert_id();
		if (isset($pertanyaan)){
			//$this->db->flush_cache();			
			//$this->db->where('model_kuesioner_id', $kuesioner_id);
			//$result = $this->db->delete('model_kuesioner_jawaban'); 
			foreach ($pertanyaan as $j){
				$this->db->flush_cache();
				$this->db->set('kuesioner_id',$data['kuesioner_id']); 
				$this->db->set('responden_id',$j);
				$this->db->insert('kuesioner_responden');				
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
		$this->mgeneral->delete($whereData,'kuesioner_pertanyaan');
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
