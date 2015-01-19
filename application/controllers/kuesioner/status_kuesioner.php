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
class status_kuesioner extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			
		if ($this->session->userdata('user_id') != TRUE) redirect(base_url().'welcome');
        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');   
        $this->load->model('/kuesioner/kuesioner_responden_model');   

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data['list_kuesioner'] =$this->kuesioner_model->get_list(); 
		$template['konten']	= $this->load->view('kuesioner/status_kuesioner_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }
 
    
	function datatable(){
		echo $this->kuesioner_responden_model->get_datatables();
	}

}
