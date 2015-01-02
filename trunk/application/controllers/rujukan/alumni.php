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
class alumni extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/alumni_model');             
        $this->load->model('/rujukan/instansi_model');             

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data = null;
		$data['list_instansi'] = $this->instansi_model->get_list(true);
		$template['konten']	= $this->load->view('rujukan/alumni_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->alumni_id = '';
		$data[0]->instansi_id = '';
		$data[0]->nama = '';
		$data[0]->email = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
          
			$data["data"] = $this->initFormData();
			$data['list_instansi'] = $this->instansi_model->get_list();
			$this->load->view('rujukan/alumni_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            
			$data['data']		= $this->alumni_model->pilihdata(array('alumni_id'=>$id));
			$data['list_instansi'] = $this->instansi_model->get_list();
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->alumni_id= $data['data'][0]->alumni_id;
			 
				$data['data'][0]->nama = $data['data'][0]->nama;
			}
			  
			$this->load->view('rujukan/alumni_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }

 
    function save()
    {
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            $data['instansi_id']=$this->input->post('instansi_id'); 
            try{
				$this->alumni_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $alumni_id=$this->input->post('alumni_id');
            $data['instansi_id']=$this->input->post('instansi_id'); 
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            try{
				$this->alumni_model->edit($data,array("alumni_id"=>$alumni_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($alumni_id)
    {
        try{
			$this->alumni_model->hapus(array("alumni_id"=>$alumni_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		echo $msg;
    }
	
	function datatable(){
		echo $this->alumni_model->get_datatables();
	}
    

}
