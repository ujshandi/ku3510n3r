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
		$where2 = " WHERE 1=1 ";
		if ($params['kuesioner_id']) {
			$where .= " and kp.kuesioner_id = ".$params['kuesioner_id'];
			$where2 .= " and kp.kuesioner_id = ".$params['kuesioner_id'];
		}
		if ($params['responden_id']) {
			$where .= " and kj.responden_id = ".$params['responden_id'];
			$where2 .= " and kp.responden_id = ".$params['responden_id'];
		}
		$sql = "SELECT kj.responden_id,mk.nama as nama_model,mk.singkatan as singkatan_model, p.tanya,p.tanya_tambahan1, p.tanya_tambahan2,kj.jawaban, kj.jawaban_tambahan1, kj.jawaban_tambahan2,0 as seq,mk.model_kuesioner_id
FROM kuesioner_jawaban kj inner join kuesioner_pertanyaan kp on kj.kuesioner_pertanyaan_id = kp.kuesioner_pertanyaan_id
INNER JOIN pertanyaan p ON p.pertanyaan_id = kp.pertanyaan_id INNER JOIN model_kuesioner mk ON kp.model_kuesioner_id = mk.model_kuesioner_id ".$where;
		$sql .= "
union all
select * from (
SELECT kp.responden_id,  mk.nama as nama_model, mk.singkatan as singkatan_model, uraian as tanya, '' as tanya_tambahan1, '' as tanya_tambahan2,kp.pendapat as jawaban,
'' as jawaban_tambahan1, '' as jawaban_tambahan2, kp.seq,mk.model_kuesioner_id
from kuesioner_pendapat kp LEFT JOIN model_kuesioner mk ON kp.model_kuesioner_id = mk.model_kuesioner_id ".$where2." 
order by seq ) as t1 ";
		$sql .= ' ORDER BY singkatan_model ';
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
		$this->db->trans_begin();
		$listjawaban = $data['pertanyaan'];
		$listpendapat = $data['pendapat'];
		unset($data['pertanyaan']);
		unset($data['pendapat']);
		//var_dump( $listjawaban );	die;
	//	 var_dump( $listpendapat ); 
			$this->db->flush_cache();
			$this->db->where('kuesioner_id',$data['kuesioner_id']);	
			$this->db->where('responden_id',$data['responden_id']);	
			$this->db->set('status_respon',date('Y-m-d H:i:s'));//$this->session->userdata('user_id').';'.
		 	$this->db->update('kuesioner_responden');
			
	
		if (isset($listjawaban)){
		//	$this->db->flush_cache();			
			if ($listjawaban) {
				foreach ($listjawaban as $j){
					$this->db->flush_cache();
					$this->db->set('kuesioner_pertanyaan_id',$j['id']);
					$this->db->set('responden_id',$data['responden_id']);
					if (isset($j['opsijawab'])){
					
						$opsi ='';
					
						foreach ($j['opsijawab'] as $o){
							$opsi .= $this->ourEkstrakString($o,';',1).', ';
						}					
						$this->db->set('jawaban',substr($opsi,0,strlen($opsi)-1));	
					}
					else if (!isset($j['jawab'])){
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
			}
			
			
		}
		
		if (isset($listpendapat)){
			$model_kuesioner_id = $this->mgeneral->getValue('model_kuesioner_sarandiklat',array('id'=>'1'),'konstanta');  
			 
			foreach ($listpendapat as $j){
			//	var_dump($j['jawab']);continue;
				
				$this->db->flush_cache();
				if (isset($j['jawab'])){
					//foreach ($j['jawab'] as $x){
						//	var_dump($x);
						///if (isset($x['id'])){
							for ($i=0;$i<count($j['jawab']['id']);$i++){
								$this->db->flush_cache();
								$this->db->set('kuesioner_id',$data['kuesioner_id']);
								$this->db->set('responden_id',$data['responden_id']);
								$this->db->set('seq',$j['seq']);	
								$this->db->set('model_kuesioner_id',$model_kuesioner_id);
								
								$this->db->set('pendapat',$j['jawab']['pendapat'][$i]);
								$this->db->set('jawaban_id',$this->ourEkstrakString($j['jawab']['id'][$i],';',0));
								$this->db->set('uraian',$this->ourEkstrakString($j['jawab']['id'][$i],';',1));	
								$this->db->insert('kuesioner_pendapat');	
							}
						//}
				//	}
				
				}
				 
				  	
				
							
			}
			//die;
		 
		}
		
		//echo $this->db->last_query();
		
		 if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
		}
		else
		{
				$this->db->trans_commit();
				return true;
		}
	}

    

	function get_list_jawaban($model_kuesioner_id){
		
		$sql = "select * from model_kuesioner_jawaban where model_kuesioner_id= ".$model_kuesioner_id;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
