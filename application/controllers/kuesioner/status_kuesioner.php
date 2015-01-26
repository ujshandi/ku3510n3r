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
class status_kuesioner extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			
		if ($this->session->userdata('user_id') != TRUE) redirect(base_url().'welcome');
        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');   
        $this->load->model('/kuesioner/kuesioner_responden_model');   
        $this->load->model('/kuesioner/kuesioner_jawaban_model');   

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data['list_kuesioner'] =$this->kuesioner_model->get_list(); 
		$template['konten']	= $this->load->view('kuesioner/status_kuesioner_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }
 
    function datatable(){
		echo $this->kuesioner_responden_model->get_datatables();
	}
	
	
	function getdata($kuesioner_id){
		$rs = '';
		$params = array("kuesioner_id"=>$kuesioner_id);
		$data = $this->kuesioner_responden_model->getdata_status($params);
		$i=1;
		//var_dump($data);
		foreach ($data as $d){
			$rs .= '<tr class="odd gradeX">';
			$rs .= '<td>'.($i++).'</td>';
			$rs .= '<td>'.$d->nama.'</td>';
			$rs .= '<td>'.$d->status_terkirim.'</td>';
			$rs .= '<td><a href="#" onclick="detail_jawaban('.$d->kuesioner_id.','.$d->responden_id.')"> '.$d->status_respon.'</a></td>'; 
			$rs .= '</tr>';
		}
		echo $rs;
	}
	
	function get_detail_respon($kuesioner_id,$responden_id){
	
		$setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load_popup($setting); #load static template file		
		$data['data'] = $this->get_respon_preview($kuesioner_id,$responden_id);
		$data['kuesioner']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$kuesioner_id)); 
		$data['responden']		= $this->mgeneral->getValue('nama',array('responden_id'=>$responden_id),'responden'); 
		$template['konten']	= $this->load->view('kuesioner/kuesioner_respon',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}

	function get_respon_preview($kuesioner_id,$responden_id){
		$rs = '';
		$params['kuesioner_id']= $kuesioner_id;
		$params['responden_id']= $responden_id;
		 
			 
	//	$rs .= "<b>Nama Model : ".$model->nama." (".$model->singkatan.")</b><br>";
		$respons = $this->kuesioner_jawaban_model->get_preview_data($params);
		if (!isset($respons)){
			$rs .= 'Belum ada Respon';
		}else {
		 
			$rs .= '<table class="display table table-bordered table-striped">';
			$rs .= '<thead><tr  align="center">						
				
				<th style="vertical-align:middle;text-align:center;width:1%"  width="20">No.</th>
				<th  style="vertical-align:middle;text-align:center" width="230" >Pertanyaan / Pernyataan / Uraian</th>';
				
			 
				$rs .= '<th style="vertical-align:middle;text-align:center" width="100" >Jawaban / Pendapat</th>
			</tr>';				
			 
			$rs .= 	'</thead>';	
			$rs .= '<tbody>';		
			$i=1;
			$model = '';
			$seq ='';
			$model_pendapat = $this->mgeneral->getValue('model_kuesioner_sarandiklat',array('id'=>'1'),'konstanta');  
			foreach($respons as $r){
				if ($model!=$r->nama_model){
					$model=$r->nama_model;
					$rs .= '<tr>';
					$rs .= '<td colspan="3"><b>'.$r->nama_model.' ('.$r->singkatan_model.')'.'</b></td>';
					$rs .= '</tr>';
					$i=1;
					
				}
				
				if ($model_pendapat==$r->model_kuesioner_id){
					if ($seq!=$r->seq){
						$seq = $r->seq;
						$rs .= '<tr>';
						$rs .= '<td colspan="3"><b>Saran/Pendapat ke - '.$seq.'</b></td>';
						$rs .= '</tr>';
						$i=1;
					}
				}
				$rs .= '<tr>';
				$rs .= '<td>'.$i++.'</td>';
				$rs .= '<td>'.$r->tanya.'</td>';
				$rs .= '<td>'.$r->jawaban.'</td>';
				$rs .= '</tr>';
				
				if ($r->tanya_tambahan1!=""){
					$rs .= '<tr>';
					$rs .= '<td>&nbsp;</td>';
					$rs .= '<td>'.$r->tanya_tambahan1.'</td>';
					$rs .= '<td>'.$r->jawaban_tambahan1.'</td>';
					$rs .= '</tr>';
				}
				if ($r->tanya_tambahan2!=""){
					$rs .= '<tr>';
					$rs .= '<td>&nbsp;</td>';
					$rs .= '<td>'.$r->tanya_tambahan2.'</td>';
					$rs .= '<td>'.$r->jawaban_tambahan2.'</td>';
					$rs .= '</tr>';
				}
			
			}//end foreach pertanyaan
			$rs .= '</tbody>';		
			$rs .= '</table><br>';		
		}//end if isset pertanyaan
		 
		 
		return $rs;
		
	}
	
	function sent_email($kuesioner_responden_id){
		$this->load->library('email');
		$this->load->library('parser');
		
		$this->email->from('admin@in-visi.com', 'yJs');
		$this->email->to('ujshandi@gmail.com'); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();

		echo $this->email->print_debugger();
	
	}

}
