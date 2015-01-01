<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_kuesioner
 *
 * @author chan
 */
class Model_kuesioner extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/model_kuesioner_model');            

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		$data = null;
		$template['konten']	= $this->load->view('kuesioner/model_kuesioner_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->model_kuesioner_id = '';
		$data[0]->singkatan = '';
		$data[0]->nama = '';
		$data[0]->petunjuk = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
            $data['isi'] = 'kuesioner/model_kuesioner_tambah';
            $data["ket"]  = 'tambah';
			$data["data"] = $this->initFormData(); 
			$this->load->view('kuesioner/model_kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
           
			$data['data']		= $this->model_kuesioner_model->pilihdata(array('model_kuesioner_id'=>$id)); 
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->model_kuesioner_id= $data['data'][0]->model_kuesioner_id;
			 
				$data['data'][0]->singkatan = $data['data'][0]->singkatan;
			}
			  
			$this->load->view('kuesioner/model_kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
 
    
    function save()
    {
            $data['singkatan']=$this->input->post('singkatan'); 
            $data['nama']=$this->input->post('nama'); 
            $data['petunjuk']=$this->input->post('petunjuk'); 
            try{
				$this->model_kuesioner_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $model_kuesioner_id=$this->input->post('model_kuesioner_id');
            $data['petunjuk']=$this->input->post('petunjuk'); 
            $data['singkatan']=$this->input->post('singkatan'); 
            $data['nama']=$this->input->post('nama'); 
            try{
				$this->model_kuesioner_model->edit($data,array("model_kuesioner_id"=>$model_kuesioner_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($model_kuesioner_id)
    {
        try{
			$this->model_kuesioner_model->hapus(array("model_kuesioner_id"=>$model_kuesioner_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner berhasil dihapus.</p>';
		}
		echo $msg;
    }

    function datatable(){
		echo $this->model_kuesioner_model->get_datatables();
	}

}
