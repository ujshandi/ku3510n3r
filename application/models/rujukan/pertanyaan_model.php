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
		$this->datatables->select("'' as No,r.pertanyaan_id,r.tanya, r.tanya_tambahan1 , r.tanya_tambahan2,,GROUP_CONCAT(o.opsi SEPARATOR ',') as opsi_jawaban,d.nama as nama_diklat ",false)
		->unset_column('r.pertanyaan_id')
		->add_column('Actions', pertanyaan_action('$1'), 'r.pertanyaan_id')
		->from(' pertanyaan r LEFT JOIN pertanyaan_opsi o ON r.pertanyaan_id = o.pertanyaan_id left join diklat d on d.diklat_id=r.diklat_id ')
		->group_by('r.pertanyaan_id'); 
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
	     

   
	function simpan($data){
		$this->db->trans_start();
		$opsijawab = explode(',',$data['opsi_jawaban']);
		unset($data['opsi_jawaban']);
		$this->mgeneral->save($data,'pertanyaan');
		$pertanyaan_id= $this->db->insert_id();
		if (isset($opsijawab)){
			$this->db->flush_cache();			
			$this->db->where('pertanyaan_id', $pertanyaan_id);
			$result = $this->db->delete('pertanyaan_opsi'); 
			foreach ($opsijawab as $j){
				$this->db->flush_cache();
				$this->db->set('pertanyaan_id',$pertanyaan_id);
				$this->db->set('opsi',$j);
				$this->db->insert('pertanyaan_opsi');				
			}
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
	}

   function edit($data,$whereData){
		$this->db->trans_start();
		$opsijawab = explode(',',$data['opsi_jawaban']);
		unset($data['opsi_jawaban']);
		$this->mgeneral->update($whereData,$data,'pertanyaan');
		
		if (isset($opsijawab)){
			$this->db->flush_cache();			
			$this->db->where($whereData);
			$result = $this->db->delete('pertanyaan_opsi'); 
			foreach ($opsijawab as $j){
				$this->db->flush_cache();
				$this->db->set($whereData);
				$this->db->set('opsi',$j);
				$this->db->insert('pertanyaan_opsi');				
			}
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
		
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
	
	function get_opsijawaban($pertanyaan_id){
		$sql = "select * from pertanyaan_opsi where pertanyaan_id=".$pertanyaan_id;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
