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
class instansi extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/instansi_model');
       

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		    
		$data["isi"]  = 'rujukan/instansi_tambah';
		$data['result'] = $this->instansi_model->tampildata();
		$data["ket"]  = 'tambah';
		$data['list_tahun'] = array('-1'=>'Tampilkan semua');
		$template['konten']	= $this->load->view('rujukan/instansi_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->instansi_id = '';
		$data[0]->nama = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
            $data['isi'] = 'rujukan/instansi_tambah';
            $data["ket"]  = 'tambah';
			$data["data"] = $this->initFormData();
			$this->load->view('rujukan/instansi_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            $data['isi'] = 'rujukan/instansi_tambah';
            $data["ket"]  = 'edit';
			$data['data']		= $this->instansi_model->pilihdata(array('instansi_id'=>$id));
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->instansi_id= $data['data'][0]->instansi_id;
			 
				$data['data'][0]->nama = $data['data'][0]->nama;
			}
			  
			$this->load->view('rujukan/instansi_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }


    function tampil()
    {
            $data['isi'] = 'rujukan/instansi_tampil';
            $data['result'] = $this->instansi_model->tampildata();
            $this->load->view('admin/index',$data);   
    }

    
    function save()
    {
            $data['nama']=$this->input->post('nama'); 
            try{
				$this->instansi_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $instansi_id=$this->input->post('instansi_id');
            $data['nama']=$this->input->post('nama'); 
            try{
				$this->instansi_model->edit($data,array("instansi_id"=>$instansi_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($instansi_id)
    {
        try{
			$this->instansi_model->hapus(array("instansi_id"=>$instansi_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Instansi berhasil dihapus.</p>';
		}
		echo $msg;
    }

    

}
