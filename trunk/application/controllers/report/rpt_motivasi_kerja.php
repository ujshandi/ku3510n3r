<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumni
 *
 * @author chan
 */
class rpt_motivasi_kerja extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');   
        $this->load->model('/kuesioner/kuesioner_pertanyaan_model');   
        $this->load->model('/report/motivasi_kerja_m');   
		$this->load->library('utility');   

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "REPORT");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data['list_kuesioner'] =$this->kuesioner_model->get_list(); 
		$template['konten']	= $this->load->view('report/motivasi_kerja_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }
 
    
	function datatable(){
		echo $this->motivasi_kerja_m->get_datatables();
	}
	
	function getdata($kuesioner_id){
		$rs = '';
		$params = array("kuesioner_id"=>$kuesioner_id);
		$jmlResponden =0;
		$jmlTanya = 0;
		$data = $this->motivasi_kerja_m->getdata($params, $jmlResponden, $jmlTanya);
		$i=1;
		//var_dump($data);
		$datachart = '';
		foreach ($data as $d){
			if ($i==1){
				$persen = '';
				$datachart = $d->L1.','.$d->L2.','.$d->L3.','.$d->L4.','.$d->L5;
			}	
			else $persen = ' %';
			$rs .= '<tr class="odd gradeX">';
			$rs .= '<td align="center">'.$this->utility->ourFormatNumber($d->L1,2).$persen.'</td>';
			$rs .= '<td align="center">'.$this->utility->ourFormatNumber($d->L2,2).$persen.'</td>';
			$rs .= '<td align="center">'.$this->utility->ourFormatNumber($d->L3,2).$persen.'</td>';
			$rs .= '<td align="center">'.$this->utility->ourFormatNumber($d->L4,2).$persen.'</td>';
			$rs .= '<td align="center">'.$this->utility->ourFormatNumber($d->L5,2).$persen.'</td>';
			$rs .= '</tr>';
			
			$i++;
		}
		$rs .= '<script type="text/javascript">
			
			$("#data-chart").val("'.$datachart.'");
			$("#jmlResponden").text('.$jmlResponden.');
			$("#jmlTanya").text('.$jmlTanya.');
		</script>';
		
		echo $rs;
	}

}
