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
class responden extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/responden_model');             
        $this->load->model('/rujukan/instansi_model');             

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		    
		$data["isi"]  = 'rujukan/responden_tambah';
		$data['result'] = $this->responden_model->tampildata();
		$data["ket"]  = 'tambah';
		$data['list_instansi'] = $this->instansi_model->get_list(true);
		$template['konten']	= $this->load->view('rujukan/responden_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->responden_id = '';
		$data[0]->instansi_id = '';
		$data[0]->nama = '';
		$data[0]->email = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
            $data['isi'] = 'rujukan/responden_tambah';
            $data["ket"]  = 'tambah';
			$data["data"] = $this->initFormData();
			$data['list_instansi'] = $this->instansi_model->get_list();
			$this->load->view('rujukan/responden_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            $data['isi'] = 'rujukan/responden_tambah';
            $data["ket"]  = 'edit';
			$data['data']		= $this->responden_model->pilihdata(array('responden_id'=>$id));
			$data['list_instansi'] = $this->instansi_model->get_list();
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->responden_id= $data['data'][0]->responden_id;
			 
				$data['data'][0]->nama = $data['data'][0]->nama;
			}
			  
			$this->load->view('rujukan/responden_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }


    function tampil()
    {
            $data['isi'] = 'rujukan/responden_tampil';
            $data['result'] = $this->responden_model->tampildata();
            $this->load->view('admin/index',$data);   
    }

    
    function save()
    {
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            $data['instansi_id']=$this->input->post('instansi_id'); 
            try{
				$this->responden_model->simpan($data);
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
            $responden_id=$this->input->post('responden_id');
            $data['instansi_id']=$this->input->post('instansi_id'); 
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            try{
				$this->responden_model->edit($data,array("responden_id"=>$responden_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($responden_id)
    {
        try{
			$this->responden_model->hapus(array("responden_id"=>$responden_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		echo $msg;
    }

    

}
