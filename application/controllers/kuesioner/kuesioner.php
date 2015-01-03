<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kuesioner
 *
 * @author chan
 */
class Kuesioner extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');          
        $this->load->model('/kuesioner/model_kuesioner_model');          
        $this->load->model('/rujukan/pertanyaan_model');          
		$this->load->library("utility");
    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		$data = null;
		$template['konten']	= $this->load->view('kuesioner/kuesioner_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->kuesioner_id = '';
		$data[0]->tanggal_buat = '';
		$data[0]->tema = '';
		$data[0]->keterangan = '';
		$data[0]->periode_awal = '';
		$data[0]->periode_akhir = '';
		 
		return $data;
	}
	
	
    function tambah() {
			$data["data"] = $this->initFormData();  
			$this->load->view('kuesioner/kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {          
		$data['data']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$id)); 
		if (!isset($data['data'])){
			$data['data'] = $this->initFormData( );
		}else{
			
			// $data['data'][0]->kuesioner_id= $data['data'][0]->kuesioner_id;
		 
			// $data['data'][0]->tanggal_buat = $data['data'][0]->tanggal_buat;
		}
		  
		$this->load->view('kuesioner/kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
  
	function pertanyaan_add($kuesioner_id)
    {
            
			$data['data']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$kuesioner_id)); 
			$data['list_pertanyaan'] = array("-1"=>'tes');
			$data['list_model_kuesioner'] = $this->model_kuesioner_model->get_list();
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				// $data['data'][0]->kuesioner_id= $data['data'][0]->kuesioner_id;
			 
				// $data['data'][0]->tanggal_buat = $data['data'][0]->tanggal_buat;
			}
			  
			$this->load->view('kuesioner/kuesioner_pertanyaan',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	function get_pertanyaan($kuesioner_id,$model_kuesioner_id){
		// echo  json_encode($this->pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id)));
		$list_pertanyaan = $this->pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id));
		echo form_dropdown('pertanyaan_id[]',$list_pertanyaan,'0','id="pertanyaan_id" class="multi-select" style="width:100%"');
	}
 
    function get_form_values(){
		$data['tanggal_buat']=$this->utility->ourDeFormatSQLDate($this->input->post('tanggal_buat')); 
		$data['tema']=$this->input->post('tema'); 
		$data['keterangan']=$this->input->post('keterangan');  
		$data['periode_awal']=$this->utility->ourDeFormatSQLDate($this->input->post('periode_awal')); 
		$data['periode_akhir']=$this->utility->ourDeFormatSQLDate($this->input->post('periode_akhir')); 
		return $data;
	}
	
	
    function save()
    {
			//$this->utility->ourDeFormatSQLDate($data['tanggal'])
			$data = $this->get_form_values();
            try{
				$this->kuesioner_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Kuesioner berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Kuesioner gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $kuesioner_id=$this->input->post('kuesioner_id');
            
			//var_dump($data['model_jawaban']);die;
            try{
				//$this->kuesioner_model->edit($data,array("kuesioner_id"=>$kuesioner_id));
				$this->kuesioner_model->edit($data,$kuesioner_id);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Model Kuesioner gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($kuesioner_id)
    {
        try{
			$this->kuesioner_model->hapus(array("kuesioner_id"=>$kuesioner_id)); 
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
		echo $this->kuesioner_model->get_datatables();
	}

}
