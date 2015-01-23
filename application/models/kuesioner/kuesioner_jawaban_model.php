<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Kuesioner_jawaban_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	
	function get_preview_data($params){
		$where = " WHERE 1=1 ";
		if ($params['kuesioner_id']) $where .= " and kp.kuesioner_id = ".$params['kuesioner_id'];
		if ($params['responden_id']) $where .= " and kj.responden_id = ".$params['responden_id'];
		$sql = "SELECT kj.responden_id,mk.nama as nama_model,mk.singkatan as singkatan_model, p.tanya,p.tanya_tambahan1, p.tanya_tambahan2,kj.jawaban, kj.jawaban_tambahan1, kj.jawaban_tambahan2
FROM kuesioner_jawaban kj inner join kuesioner_pertanyaan kp on kj.kuesioner_pertanyaan_id = kp.kuesioner_pertanyaan_id
INNER JOIN pertanyaan p ON p.pertanyaan_id = kp.pertanyaan_id INNER JOIN model_kuesioner mk ON kp.model_kuesioner_id = mk.model_kuesioner_id ".$where;
		$sql .= ' ORDER BY mk.singkatan ';
		return $this->db->query($sql)->result();
	
	}
	
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select('r.model_kuesioner_id,r.singkatan, r.nama , r.petunjuk,r.caption_pertanyaan,r.tipe_jawaban ')
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

   
    function ourEkstrakString($input,$limiter,$count){
   /* I.S. : Input = string yang akan di-extract, Limiter = karakter yang
           dipakai sebagai tanda pemisah, Count = bagian ke berapa yang
           akan diambil, paling kiri adalah bagian ke-1
    F.S. : menghasilkan substring ke-Count dari Input dengan batas Limiter 
	*/
		$tmpString = "";
		$ctr = 0;
		$tmpInput = $input;
		
		do {
			$posisi = strpos($input,$limiter);
			//$posisi = strpos("32-45","-");
			if ($posisi==false)
				$posisi = strlen($input);
			$tmpString = substr($input,0,$posisi);
			$input = substr($input,$posisi+1,strlen($input)-1);
			$ctr++;
		}while ($ctr<=$count);
		
		
		return ($tmpString);
		//return (strpos($limiter,$input));
	
   }
   
   
	function simpan($data){
		//$this->mgeneral->save($data,'model_kuesioner');
		$this->db->trans_start();
		$listjawaban = $data['pertanyaan'];
		unset($data['pertanyaan']);
		 
		if (isset($listjawaban)){
			$this->db->flush_cache();			
			 
			foreach ($listjawaban as $j){
				$this->db->flush_cache();
				$this->db->set('kuesioner_pertanyaan_id',$j['id']);
				$this->db->set('responden_id',$data['responden_id']);
				if (!isset($j['jawab'])){
					$this->db->set('jawaban','');
				}
				else{
					$this->db->set('jawaban',$this->ourEkstrakString($j['jawab'],';',1));
					$this->db->set('jawaban_id',$this->ourEkstrakString($j['jawab'],';',0));
					
				}
				if (isset($j['tambahan1']))
					$this->db->set('jawaban_tambahan1',$j['tambahan1']);
				if (isset($j['tambahan2']))
					$this->db->set('jawaban_tambahan2',$j['tambahan2']);	
				
				$this->db->insert('kuesioner_jawaban');				
			}
			
			$this->db->flush_cache();
			$this->db->where('kuesioner_id',$data['kuesioner_id']);	
			$this->db->where('responden_id',$data['responden_id']);	
			$this->db->set('status_respon',date('Y-m-d H:i:s'));//$this->session->userdata('user_id').';'.
			$this->db->update('kuesioner_responden');
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

	function get_list_jawaban($model_kuesioner_id){
		
		$sql = "select * from model_kuesioner_jawaban where model_kuesioner_id= ".$model_kuesioner_id;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
