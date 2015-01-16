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
class diklat extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/diklat_model');
        $this->load->model('/rujukan/jenisdiklat_model');
        $this->load->model('/rujukan/peruntukkan_model');
        $this->load->model('/rujukan/alumni_model');        

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		//ga jadi $data['list_tahun'] =$this->diklat_model->get_list_tahun(true);
		$data['list_jenisdiklat'] =$this->jenisdiklat_model->get_list_jenis(true);
		$template['konten']	= $this->load->view('rujukan/diklat_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->diklat_id = '';
		$data[0]->nama = '';
		$data[0]->jenis_diklat = '';
		$data[0]->kategori_kuesioner = '';
		$data[0]->tahun = '';
		return $data;
	}
	
	
    function tambah()
    {
            $data['isi'] = 'rujukan/diklat_tambah';
            $data["ket"]  = 'tambah';
			$data["data"] = $this->initFormData();
			$data['list_jenisdiklat'] =$this->jenisdiklat_model->get_list_jenis(false);
			$data['list_peruntukkan'] =$this->peruntukkan_model->get_list_peruntukkan(false);
			$this->load->view('rujukan/diklat_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            $data['isi'] = 'rujukan/diklat_tambah';
            $data["ket"]  = 'edit';
			$data['list_jenisdiklat'] =$this->jenisdiklat_model->get_list_jenis(false);
			$data['list_peruntukkan'] =$this->peruntukkan_model->get_list_peruntukkan(false);
			$data['data']		= $this->diklat_model->pilihdata(array('diklat_id'=>$id));
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->diklat_id= $data['data'][0]->diklat_id;
				$data['data'][0]->tahun = $data['data'][0]->tahun;
				$data['data'][0]->nama = $data['data'][0]->nama;
				$data['data'][0]->jenis_diklat = $data['data'][0]->jenis_diklat;
				$data['data'][0]->kategori_kuesioner = $data['data'][0]->kategori_kuesioner;
			}
			  
			$this->load->view('rujukan/diklat_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }


    function tampil()
    {
            $data['isi'] = 'rujukan/diklat_tampil';
            $data['result'] = $this->diklat_model->tampildata();
            $this->load->view('admin/index',$data);   
    }
	
	function get_form_values(){
		$data['nama']=$this->input->post('nama');
		$data['jenis_diklat']=$this->input->post('jenis_diklat');
		$data['tahun']=$this->input->post('tahun');
		$data['kategori_kuesioner']=$this->input->post('ref');
		return $data;
	}
    
    function save()
    {
            $data = $this->get_form_values();
            try{
				$this->diklat_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $diklat_id=$this->input->post('diklat_id');
            $data = $this->get_form_values();
            try{
				$this->diklat_model->edit($data,array("diklat_id"=>$diklat_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($diklat_id)
    {
        try{
			$this->diklat_model->hapus(array("diklat_id"=>$diklat_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Diklat berhasil dihapus.</p>';
		}
		echo $msg;
    }

    
	function datatable(){
		echo $this->diklat_model->get_datatables();
	}

}
