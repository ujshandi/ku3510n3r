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
        $this->load->model('/kuesioner/jawaban_model');            

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
		$data[0]->caption_pertanyaan = '';
		$data[0]->tipe_jawaban = '';
		 
		return $data;
	}
	
	function get_model_info($model_kuesioner_id){
		$rs = '';
		$data =  $this->model_kuesioner_model->pilihdata(array('model_kuesioner_id'=>$model_kuesioner_id)); 
		if (isset($data)){
			$rs =  $data[0]->tipe_jawaban;
		}
		echo $rs;
	}
	
    function tambah() {
			$data["data"] = $this->initFormData(); 
			$data["multiselect_jawab"] = $this->jawaban_model->get_multiselect();
			$data["list_tipejawaban"] = array('Pilihan'=>"Pilihan",'Pendapat'=>'Pendapat');
			$this->load->view('kuesioner/model_kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
          
			$data['data']		= $this->model_kuesioner_model->pilihdata(array('model_kuesioner_id'=>$id)); 
			$data["list_tipejawaban"] = array('Pilihan'=>"Pilihan",'Pendapat'=>'Pendapat');
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->model_kuesioner_id= $data['data'][0]->model_kuesioner_id;
			 
				$data['data'][0]->singkatan = $data['data'][0]->singkatan;
				$listJawaban = $this->model_kuesioner_model->get_list_jawaban($data['data'][0]->model_kuesioner_id);
			}
			
			 $data["multiselect_jawab"] = $this->jawaban_model->get_multiselect($listJawaban);  
			$this->load->view('kuesioner/model_kuesioner_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
 
	function get_form_values(){
		$data['singkatan']=$this->input->post('singkatan'); 
		$data['nama']=$this->input->post('nama'); 
		$data['petunjuk']=$this->input->post('petunjuk'); 
		$data['caption_pertanyaan']=$this->input->post('caption_pertanyaan'); 
		$data['tipe_jawaban']=$this->input->post('tipe_jawaban'); 
		$data['model_jawaban']=$this->input->post('model_jawaban'); 
		return $data;
	}
    
    function save()
    {
            $data = $this->get_form_values();
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
             $data = $this->get_form_values();
			//var_dump($data['model_jawaban']);die;
            try{
				//$this->model_kuesioner_model->edit($data,array("model_kuesioner_id"=>$model_kuesioner_id));
				$this->model_kuesioner_model->edit($data,$model_kuesioner_id);
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
