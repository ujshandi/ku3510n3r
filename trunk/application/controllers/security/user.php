<?php

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();			
		
	//	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);
							
		$this->load->model('/security/sys_menu_model');
		$this->load->model('/security/user_model');
		$this->load->model('/security/group_level_model');
		$this->load->library("utility");
		
	}
	
	function index(){
		$setting['sd_left']	= array('cur_menu'	=> "ADMIN");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data = null;
		$template['konten']	= $this->load->view('security/user_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
	}
	
	function datatable(){
		echo $this->user_model->get_datatables();
	}
	
 
	private function get_form_values() {
		// XXS Filtering enforced for user input
		$data['user_id'] = $this->input->post("user_id", TRUE);
		$data['user_name'] = $this->input->post("user_name", TRUE);
		$data['full_name'] = $this->input->post("full_name", TRUE);		
		$data['passwd'] = $this->input->post("passwd", TRUE);
		$data['old_passwd'] = $this->input->post("old_passwd", TRUE);
	 
		return $data;
    }
	
	function initFormData(){
		$data[0]->user_id = '';
		$data[0]->user_name = '';
		$data[0]->full_name = '';
		$data[0]->passwd = '';
		$data[0]->old_passwd = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
          
			$data["data"] = $this->initFormData();
			//$data['list_instansi'] = $this->instansi_model->get_list();
			$this->load->view('security/user_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            
			$data['data']		= $this->user_model->SelectInDb(array('user_id'=>$id));
			//$data['list_instansi'] = $this->instansi_model->get_list();
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->user_id= $data['data'][0]->user_id;
			 
				$data['data'][0]->user_name = $data['data'][0]->user_name;
			}
			  
			$this->load->view('security/user_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }

 
    function save()
    {
            $data = $this->get_form_values(); 
            try{
				$this->user_model->InsertOnDb($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $user_id=$this->input->post('user_id');
			$data = $this->get_form_values(); 
            try{
				$this->user_model->UpdateOnDb($data, $user_id);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($user_id)
    {
        try{
			$this->user_model->hapus(array("user_id"=>$user_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data User berhasil dihapus.</p>';
		}
		echo $msg;
    }
	
	function changePasswd(){
		
		$data['opass'] = $this->input->post("pass_lama", TRUE);
		$data['npass'] = $this->input->post("pass_baru", TRUE);
		$data['cpass'] = $this->input->post("pass_baru_confirm", TRUE);
		$data['pesan_error']= '';
		$result = false;
		if ($this->user_model->getPassword($this->session->userdata('user_id'))!=md5($data['opass']))			
			$data['pesan_error'] = "Password lama tidak sesuai";
		else if ($data['cpass']!=$data['npass'])
			$data['pesan_error'] = "Password baru tidak sama dengan konfirmasi password";
		else
			$result = $this->user_model->changePassword($this->session->userdata('user_id'),$data);
		if ($result){
			echo 'Ubah password berhasil';
		} else {
			echo 'Ubah password gagal';
		}
	}
	
	
	
	
	 
	
}
?>