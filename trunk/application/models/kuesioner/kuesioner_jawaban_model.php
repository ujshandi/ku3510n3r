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
		$listpendapat = $data['pendapat'];
		unset($data['pertanyaan']);
		unset($data['pendapat']);
		// var_dump( $listpendapat );die;
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
		
		if (isset($listpendapat)){
			$this->db->flush_cache();			
			 
			foreach ($listpendapat as $j){
				var_dump($j);continue;
				$this->db->flush_cache();
				$this->db->set('responden_id',$data['responden_id']);
				$this->db->set('kuesioner_id',$data['kuesioner_id']);
				if (!isset($j['pendapat'])){
					$this->db->set('pendapat','');
				}
				else{
					$this->db->set('pendapat',$j['pendapat']);
					$this->db->set('jawaban_id',$this->ourEkstrakString($j['jawab'],';',0));
					$this->db->set('uraian',$this->ourEkstrakString($j['jawab'],';',1));
					
				}
				  	
				
				//$this->db->insert('kuesioner_pendapat');				
			}
			
		 
		}
		
		//echo $this->db->last_query();
		
		 $this->db->trans_complete();
		return $this->db->trans_status();
	}

    

	function get_list_jawaban($model_kuesioner_id){
		
		$sql = "select * from model_kuesioner_jawaban where model_kuesioner_id= ".$model_kuesioner_id;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
