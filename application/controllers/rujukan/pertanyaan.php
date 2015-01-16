<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pertanyaan
 *
 * @author chan
 */
class pertanyaan extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/pertanyaan_model');            
        $this->load->model('/rujukan/diklat_model');            

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		    
		$data["isi"]  = 'rujukan/pertanyaan_tambah'; 
		$data["ket"]  = 'tambah'; 
		$template['konten']	= $this->load->view('rujukan/pertanyaan_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->pertanyaan_id = '';
		$data[0]->tanya = '';
		$data[0]->tanya_tambahan1 = '';
		$data[0]->tanya_tambahan2 = '';
		$data[0]->opsi_jawaban = '';
		$data[0]->diklat_id = '0';
		
		 
		return $data;
	}
	
	
    function tambah()
    {
            $data['isi'] = 'rujukan/pertanyaan_tambah';
            $data["ket"]  = 'tambah';
			$data["data"] = $this->initFormData(); 
			$data['list_diklat'] =$this->diklat_model->get_list(false);;
			$this->load->view('rujukan/pertanyaan_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	
	 function edit($id)
    {
            $data['isi'] = 'rujukan/pertanyaan_tambah';
            $data["ket"]  = 'edit';
			$data['list_diklat'] =$this->diklat_model->get_list(false);;
			$data['data']		= $this->pertanyaan_model->pilihdata(array('pertanyaan_id'=>$id)); 
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->pertanyaan_id= $data['data'][0]->pertanyaan_id;
			 
				$data['data'][0]->tanya = $data['data'][0]->tanya;
				$opsi = $this->pertanyaan_model->get_opsijawaban($id);
				if (isset($opsi)){
					foreach ($opsi as $o){
						$data['data'][0]->opsi_jawaban .= $o->opsi.',';
					}
				}	
				else {
					$data['data'][0]->opsi_jawaban .= '';
				}
			}
			  
			$this->load->view('rujukan/pertanyaan_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }


    function get_form_values(){
		$data['tanya']=$this->input->post('tanya'); 
		$data['tanya_tambahan1']=$this->input->post('tanya_tambahan1'); 		
		$data['tanya_tambahan2']=$this->input->post('tanya_tambahan2'); 
		$data['opsi_jawaban']=$this->input->post('opsi_jawaban'); 
		$data['diklat_id']=$this->input->post('diklat_id'); 
		return $data;
	}
    
    function save(){   
		$data = $this->get_form_values();		
		try{
			$this->pertanyaan_model->simpan($data);
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
				<p>Data Pertanyaan berhasil ditambahkan.</p>';
		}
		catch (Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
				<p>Data Pertanyaan gagal ditambahkan.</p>';
		}
		echo $msg;
            
    }

    function update()
    {
			$data = $this->get_form_values();
            $pertanyaan_id=$this->input->post('pertanyaan_id');
            try{
				$this->pertanyaan_model->edit($data,array("pertanyaan_id"=>$pertanyaan_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Pertanyaan berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Pertanyaan gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($pertanyaan_id)
    {
        try{
			$this->pertanyaan_model->hapus(array("pertanyaan_id"=>$pertanyaan_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Pertanyaan berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Pertanyaan berhasil dihapus.</p>';
		}
		echo $msg;
    }

    function datatable(){
		echo $this->pertanyaan_model->get_datatables();
	}

}
