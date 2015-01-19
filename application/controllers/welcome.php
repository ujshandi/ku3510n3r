<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
		$this->load->model('security/sys_login_model','login');
	}
	
	function index($err_msg='')
	{
		$setting			= array(); #settingan untuk static template file
		$setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "");
		$template			= $this->template->load($setting); #load static template file
		
		$data['err_msg']=$err_msg;
		$template['konten']	= $this->load->view('welcome',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}
	
	public function login_usr($form='') {
		//var_dump($this->input->post('txtUser'));die;
		$response = $this->login->cek_login($this->input->post('username'),$this->input->post('p4ss'));
		//var_dump($response);die;
		if(is_string($response) && $response == 'REQUIRED') {
			$this->index('Username and Password required',$this->input->post('username'));
		}else if($response == true) {
			echo "home";
				//redirect(base_url().'home');
		}else {
			echo  'Invalid Username and Password';
			//	redirect(base_url().'welcome/'.$err);
				//$this->index('Invalid Username and Password');
				
			//$this->session->flash_data();
		}
	}
	
	public function logout_user() {
		$response = $this->login->logout();
		if($response) 
			//redirect(base_url().'security/login');
			redirect(base_url());
	}
	
}