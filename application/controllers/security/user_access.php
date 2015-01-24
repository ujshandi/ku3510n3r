<?php
class User_access extends CI_Controller{
	var $extraHeaderContent;
	
	public function __construct()	{
		parent::__construct();
		//if ($this->session->userdata('logged_in_e_tracking') != TRUE) redirect('security/login');		
		if ($this->session->userdata('user_id') != TRUE) redirect(base_url().'welcome');	
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/security/user_access_model');		
		$this->load->model('/security/user_model');		
		 
	 	
	}
		
	public function index(){
	     $setting['sd_left']	= array('cur_menu'	=> "ADMIN");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		  $data = null;   
		$data['list_user'] =$this->user_model->get_list(); 
		$template['konten']	= $this->load->view('security/user_access_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
	}	
	
	function loadMenu(){
		echo $this->sys_menu_model->loadMenu($this->session->userdata('app_type'),1);
	}
	
	public function save() {				
		$this->load->library('form_validation');
		$data = $this->get_form_values();
		$status = FALSE;
		
		//validasi form		
		//$this->form_validation->set_rules('cmbGroupUser', 'Group Name', 'trim|required|min_length[1]|xss_clean');
		/* if ($this->form_validation->run() == FALSE){
			//jika data tidak valid kembali ke view
			if($data['user_id']==''){
				$data["pesan_error"] = "Group User belum ditentukan";
				$data["user_id"] = "-1";
				$this->show_page($data);
			}	
			
		}else { */
		//var_dump($data);
			$result = $this->user_access_model->saveToDb($data);				
			if ($result){
				 $msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Hak Pengguna berhasil disimpan.</p>';
			} else {
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Error</b></h5>
					<p>Data Hak Pengguna gagal disimpan.</p>';
			}
			echo $msg;
		//}
	}
	
    public 	function get_data($user_id ){			
		echo $this->user_access_model->getData($user_id);		
		
	}
	
	
	private function get_form_values() {				
		$data["rowcount"] = $this->input->post('rowcount', TRUE);
		$data["user_id"] = $this->input->post('user_id', TRUE);
		
		for ($i=0;$i<$data["rowcount"];$i++){
			$data["menu_id"][$i] = $this->input->post('menu_id'.($i+1), TRUE);			
			$data["chkView"][$i] = $this->input->post('chkView'.($i+1), true);	
			$data["chkAdd"][$i] = $this->input->post('chkAdd'.($i+1), true);
			$data["chkEdit"][$i] = $this->input->post('chkEdit'.($i+1), true);
			$data["chkDelete"][$i] = $this->input->post('chkDelete'.($i+1), true);
			$data["chkPrint"][$i] = $this->input->post('chkPrint'.($i+1), true);			
			$data["chkExcel"][$i] = $this->input->post('chkExcel'.($i+1), true);
			$data["chkImport"][$i] = $this->input->post('chkImport'.($i+1), true);
			$data["chkProses"][$i] = $this->input->post('chkProses'.($i+1), true);				
			$data["chkCopy"][$i] = $this->input->post('chkCopy'.($i+1), true);				
			$data["chkAuto"][$i] = $this->input->post('chkAuto'.($i+1), true);				
		}		
		return $data;
    }
	
	
}	

