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
		if ($this->session->userdata('user_id') != TRUE) redirect(base_url().'welcome');
        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');          
        $this->load->model('/kuesioner/kuesioner_pertanyaan_model');          
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
			$data['list_pertanyaan'] = array();
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
	
	function pertanyaan_preview($kuesioner_id){
		$setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load_popup($setting); #load static template file		
		$data['data'] = $this->get_pertanyaan_preview($kuesioner_id);
		 $data['kuesioner']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$kuesioner_id)); 
		$template['konten']	= $this->load->view('kuesioner/kuesioner_preview',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}
	
 
	
	function get_pertanyaan_preview($kuesioner_id){
		$rs = '';
		$listmodel = $this->kuesioner_pertanyaan_model->get_distinct_model($kuesioner_id);
		//var_dump($listmodel);
		if (!isset($listmodel)){
			$rs ="Data belum ada";
		}
		else{
			foreach ($listmodel as $model){
				$rs .= "<b>Nama Model : ".$model->nama." (".$model->singkatan.")</b><br>";
				$listpertanyaan = $this->kuesioner_pertanyaan_model->get_complete_pertanyaan($kuesioner_id,$model->model_kuesioner_id);
				if (!isset($listpertanyaan)){
					$rs .= 'Belum ada Pertanyaan';
				}else {
					$listjawab = $this->kuesioner_pertanyaan_model->get_model_jawab($model->model_kuesioner_id);
					$rs .= '<table class="table table-bordered">';
					$rs .= '<thead><tr  align="center">						
						
						<th rowspan="2" style="vertical-align:middle;text-align:center;width:1%"  width="30">NO.</th>
						<th rowspan="2"  style="vertical-align:middle;text-align:center" width="230" >'.strtoupper($model->caption_pertanyaan).'</th>';
						
					if (!isset($listjawab)){
						$rs .= '<th style="vertical-align:middle;text-align:center" width="100" >JAWABAN</th>
					</tr>';				
						$rs .= '<th style="vertical-align:middle;text-align:center" width="100" >Model Jawaban Belum di Setting</th>'	;
					}
					else{
						$rs .= '<th colspan="'.count($listjawab).'" style="vertical-align:middle;text-align:center" width="100" >JAWABAN</th>
					</tr>';				
						$rs .= '<tr  align="center">';
						foreach ($listjawab as $jawab){
							$rs .= '<th style="vertical-align:middle;text-align:center" width="'.(round(100/count($listjawab))).'" >'.$jawab->singkatan.'</th>'	;
						}
						$rs .= '</tr>';
					}
					$rs .= 	'</thead>';	
					$rs .= '<tbody>';		
					$i=1;
					foreach($listpertanyaan as $pertanyaan){
						$rs .= '<tr>';
						$rs .= '<td>'.$i++.'</td>';
						$rs .= '<td>'.$pertanyaan->tanya.'</td>';
						$rs .= '</tr>';
						if ($pertanyaan->tanya_tambahan1!=""){
							$rs .= '<tr>';
							$rs .= '<td>&nbsp;</td>';
							$rs .= '<td>'.$pertanyaan->tanya_tambahan1.'</td>';
							$rs .= '</tr>';
						}
						if ($pertanyaan->tanya_tambahan2!=""){
							$rs .= '<tr>';
							$rs .= '<td>&nbsp;</td>';
							$rs .= '<td>'.$pertanyaan->tanya_tambahan2.'</td>';
							$rs .= '</tr>';
						}
					}//end foreach pertanyaan
					$rs .= '</tbody>';		
					$rs .= '</table><br>';		
				}//end if isset pertanyaan
			}//end foreach model
		}//end if isset model
		return $rs;
		
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
	
	function pertanyaan_submit()
    {
			//$this->utility->ourDeFormatSQLDate($data['tanggal'])
			$data['kuesioner_id']=$this->input->post('kuesioner_id'); 
			$data['model_kuesioner_id']=$this->input->post('model_kuesioner_id'); 
			//$data['pertanyaan_id']=explode(',',$this->input->post('daftar_pertanyaan'));  
			$hidden = $this->input->post('multiple_value'); //get the values from the hidden field
			$hidden = substr($hidden,1);
            $hidden_in_array = explode(",", $hidden); //convert the values into array
            //$filter_array = array_filter($hidden_in_array); //remove empty index 
            //$reset_keys = array_values($filter_array); 
			$data['pertanyaan_id'] = $hidden_in_array;
			//var_dump($data['pertanyaan_id']);die;
            try{
				$this->kuesioner_pertanyaan_model->simpan($data);
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
