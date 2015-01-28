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
class rpt_lingkungan_kerja extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');   
        $this->load->model('/kuesioner/kuesioner_pertanyaan_model');   
        $this->load->model('/report/lingkungan_kerja_m');   
		$this->load->library('utility');   

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "REPORT");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data['list_kuesioner'] =$this->kuesioner_model->get_list(); 
		$template['konten']	= $this->load->view('report/lingkungan_kerja_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }
 
    
	function datatable(){
		echo $this->lingkungan_kerja_m->get_datatables();
	}
	
	function getdata($kuesioner_id){
		$rs = '';
		$params = array("kuesioner_id"=>$kuesioner_id);
		$jmmlResponden =1;
		$data = $this->lingkungan_kerja_m->getdata($params,$jmlResponden);
		$i=1;
		//var_dump($data);
		foreach ($data as $d){
			$rs .= '<tr class="odd gradeX">';
			$rs .= '<td>'.($i++).'</td>';
			$rs .= '<td>'.$d->tanya.'</td>';
			$skor =  (($d->STS*1)+($d->TS*2)+($d->N*3)+($d->S*4)+($d->SS*5))/$jmlResponden;
			$persen = ($skor/5)*100;
			$rs .= '<td align="right">'.$this->utility->ourFormatNumber($skor,2).'</td>';
			$rs .= '<td align="right">'.$this->utility->ourFormatNumber($persen,2).'</td>';
		
			$rs .= '</tr>';
		}
		echo $rs;
	}

}
