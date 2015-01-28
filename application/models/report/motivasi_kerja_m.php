<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class motivasi_kerja_m extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	
	function getdata($params, & $jmlResponden, & $jmlPertanyaan){
		$model_kuesioner_id =$this->mgeneral->getValue('model_kuesioner_motivasikerja',array('id'=>'1'),'konstanta');  
		$jmlResponden  = $this->mgeneral->getValue('count(distinct responden_id)',array('kp.model_kuesioner_id'=>$model_kuesioner_id,'kp.kuesioner_id'=>$params['kuesioner_id']),'kuesioner_jawaban kj  inner join
kuesioner_pertanyaan kp on kj.kuesioner_pertanyaan_id = kp.kuesioner_pertanyaan_id');   
		
		$sql = "select kuesioner_pertanyaan_id,tanya,STS, TS,N, S,SS, Kosong,
				(STS/jml_responden*100) as persen_STS,
				(TS/jml_responden*100) as persen_TS,
				(N/jml_responden*100) as persen_N,
				(S/jml_responden*100) as persen_S,
				(SS/jml_responden*100) as persen_SS,
				(Kosong/jml_responden*100) as persen_kosong,jawaban_id,coalesce(bobot,0) as bobot
				 from  (
				select distinct p.tanya,kj.kuesioner_pertanyaan_id, count(*) as jml_responden, count(case when jawaban='Sangat Tidak Setuju' then jawaban end) as STS
				, count(case when jawaban='Tidak Setuju' then jawaban end) as TS, count(case when jawaban='Netral' then jawaban end) as N, 
				count(case when jawaban='Setuju' then jawaban end) as S , count(case when jawaban='Sangat Setuju' then jawaban end) as SS,
				 count(case when jawaban='' then jawaban end) as Kosong,kj.jawaban_id,j.bobot
				from kuesioner_jawaban kj inner join
				kuesioner_pertanyaan kp on kj.kuesioner_pertanyaan_id = kp.kuesioner_pertanyaan_id
				inner join pertanyaan p on p.pertanyaan_id=kp.pertanyaan_id
				LEFT JOIN jawaban j on kj.jawaban_id = j.jawab_id
				where kp.model_kuesioner_id =  ".$model_kuesioner_id."  and kp.kuesioner_id = ".$params['kuesioner_id']."
				group by kj.kuesioner_pertanyaan_id
				) as t1";
		 
		$data= $this->db->query($sql)->result();
	//	var_dump($data);die;
		$jmlTanya = 0;$jmlSkor=0;
		$lvl = 1; 
		$jmlPertanyaan = count($data);
		if (count($data)>0){
			$kuesioner_pertanyaan_id=-1;
			foreach ($data as $d){
				if ($jmlTanya==4){
					$jmlTanya =1;
					switch ($lvl){
						case 1 : 
							$rs[0]->L1 =($jmlSkor )/(4*$jmlResponden);
							$rs[1]->L1 =($rs[0]->L1/5)*100;
						break;
						case 2 : 
							$rs[0]->L2 =($jmlSkor )/(4*$jmlResponden);
							$rs[1]->L2 =($rs[0]->L2/5)*100;
						break;
						case 3 : 
							$rs[0]->L3 =($jmlSkor )/(4*$jmlResponden);
							$rs[1]->L3 =($rs[0]->L3/5)*100;
						break;
						case 4 : 
							$rs[0]->L4 =($jmlSkor )/(4*$jmlResponden);
							$rs[1]->L4 =($rs[0]->L4/5)*100;
						break;
						// case 5 : 
							// $rs[0]->L5 =($jmlSkor*$jmlResponden)/(4*$jmlResponden);
							// $rs[1]->L5 =($rs[0]->L5/5)*100;
						// break;
					}
					$jmlSkor=0;
					$lvl++;
				}else{
					//$jmlSkor+=($d->STS*$d->bobot)+($d->TS*$d->bobot)+($d->N*$d->bobot)+($d->S*$d->bobot)+($d->SS*$d->bobot);
					$jmlSkor+=($d->STS*1)+($d->TS*2)+($d->N*3)+($d->S*4)+($d->SS*5);
					$jmlTanya++;
				}
			}
			$rs[0]->L5 = ($jmlSkor)/(4*$jmlResponden);
			$rs[1]->L5 =($rs[0]->L5/5)*100;
				
		}else{
			$rs[0]->L1 =0;
			$rs[0]->L2 =0;
			$rs[0]->L3 =0;
			$rs[0]->L4 =0;
			$rs[0]->L5 =0;
			$rs[1]->L1 =0;
			$rs[1]->L2 =0;
			$rs[1]->L3 =0;
			$rs[1]->L4 =0;
			$rs[1]->L5 =0;
			 
		}
	//	var_dump($rs);die;
		return $rs;
	
	}
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$model_kuesioner_id = $this->mgeneral->getValue('model_kuesioner_target',array('id'=>'1'),'konstanta');  
		$listjawab = $this->kuesioner_pertanyaan_model->get_model_jawab($model_kuesioner_id);
		$select = 'p.tanya,';
		foreach ($listjawab as $j){
			$select .= $j->jawab_id.', ';
		}
		
		$this->datatables->select('@curRow:=@curRow+1 AS No,tanya,  Ya, Tidak, Kosong,
(Ya/jml_responden*100) as persen_ya,
(Tidak/jml_responden*100) as persen_tidak,
(Kosong/jml_responden*100) as persen_kosong',false)
		//->unset_column('alumni_id')
		//->add_column('Actions', alumni_action('$1'), 'alumni_id')
		->from(" (
select distinct p.tanya,kj.kuesioner_pertanyaan_id, count(*) as jml_responden, count(case when jawaban='Ya' then jawaban end) as Ya
, count(case when jawaban='Tidak' then jawaban end) as Tidak,  count(case when jawaban='' then jawaban end) as Kosong
from kuesioner_jawaban kj inner join
kuesioner_pertanyaan kp on kj.kuesioner_pertanyaan_id = kp.kuesioner_pertanyaan_id
inner join pertanyaan p on p.pertanyaan_id=kp.pertanyaan_id
where kp.model_kuesioner_id = ".$model_kuesioner_id." and kp.kuesioner_id = ".$_POST['kuesioner_id']."
group by kj.kuesioner_pertanyaan_id
) as t1 join (SELECT @curRow := 0) r",false);
		//$this->datatables->where('kp.model_kuesioner_id',$model_kuesioner_id);
		
		// if (isset($_POST['kuesioner_id'])) {
			// if ($_POST['kuesioner_id']!="-1") $this->datatables->where('r.kuesioner_id',$_POST['kuesioner_id']);
		// }
		
				
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	
		return $this->datatables->generate();
	
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
