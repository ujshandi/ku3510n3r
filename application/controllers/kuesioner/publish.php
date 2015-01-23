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
class Publish extends CI_Controller {
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/kuesioner/kuesioner_model');          
        $this->load->model('/kuesioner/kuesioner_pertanyaan_model');          
        $this->load->model('/kuesioner/kuesioner_jawaban_model');          
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
		$template['konten']	= $this->load->view('kuesioner/publish_v',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

 
	
	
     
	
	function load($kuesioner_id,$responden_id=1){
		$setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load_popup($setting); #load static template file		
		$data['data'] = $this->get_pertanyaan_preview($kuesioner_id,$responden_id);
		 $data['kuesioner']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$kuesioner_id)); 
		 $data['kuesioner_id'] = $kuesioner_id;
		 $data['responden_id'] = $responden_id;
		 $data['responden']		= $this->mgeneral->getValue('nama',array('responden_id'=>$responden_id),'responden');
		$template['konten']	= $this->load->view('kuesioner/publish_v',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}
	
	function get_pertanyaan($kuesioner_id,$model_kuesioner_id){
		// echo  json_encode($this->pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id)));
		$list_pertanyaan = $this->kuesioner_pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id,'model_kuesioner_id'=>$model_kuesioner_id),$listSelected);
		echo form_multiselect('pertanyaan_idzx[]',$list_pertanyaan,$listSelected,'id="pertanyaan_id" class="multi-select" style="width:100%"');
	}
	
	
	function get_pertanyaan_preview($kuesioner_id,$responden_id){
		$rs = '<input type="hidden" name="kuesioner_id" id="kuesioner_id" value="'.$kuesioner_id.'"/>
					<input type="hidden" name="responden_id" id="responden_id" value="'.$responden_id.'"/>';
		$listmodel = $this->kuesioner_pertanyaan_model->get_distinct_model($kuesioner_id);
		//var_dump($listmodel);
		
		//periksa jika sudah pernah isi kuesioner 
		$sudahIsi = $this->mgeneral->getValue('status_respon',array('kuesioner_id'=>$kuesioner_id,'responden_id'=>$responden_id),'kuesioner_responden');
		if (isset($sudahIsi)){
			$rs = 'Maaf, anda sebelumnya sudah menyelesaikan pengisian kuesioner ini.';
			return $rs;
		}
		if (!isset($listmodel)){
			$rs .="Data belum ada";
		}
		else{
			$idx=0;
			foreach ($listmodel as $model){
				$rs .= "<h2>".$model->nama." (".$model->singkatan.")</h2>";
				if ($model->tipe_jawaban=='Pilihan'){
					$listpertanyaan = $this->kuesioner_pertanyaan_model->get_complete_pertanyaan($kuesioner_id,$model->model_kuesioner_id);
					
					if (!isset($listpertanyaan)){
						$rs .= 'Belum ada Pertanyaan';
					}else {
						$listjawab = $this->kuesioner_pertanyaan_model->get_model_jawab($model->model_kuesioner_id);
						$listparent = $this->kuesioner_pertanyaan_model->get_distinct_parent_jawab($model->model_kuesioner_id);
					
						$rs .= '<section>
									<div class="form" id="content-'.$model->model_kuesioner_id.'">';
						$rs .= '<div class="alert alert-block alert-danger fade in">
                                
                                <h4>Petunjuk</h4> 
								<p>'.$model->petunjuk.'</p>
                            </div>';						
						
						$i=1;
						foreach($listpertanyaan as $pertanyaan){
							$opsijawaban = $this->pertanyaan_model->get_opsijawaban($pertanyaan->pertanyaan_id);
							$rs .= ' <div class="form-group">
										<input type="hidden" name="pertanyaan['.$idx.'][id]" value="'.$pertanyaan->kuesioner_pertanyaan_id.'"/>
												<label class="col-lg-12 control-label">'.$i++.'. '.$pertanyaan->tanya.'</label>
												<div class="col-lg-12">';
							if (isset($opsijawaban)){
								//jika ada opsi jawaban buat check box utk opsi jawaban dan abaikan model jawaban dari model kuesionernya
								$component = ' <div class="col-sm-9 icheck ">
													<div class="square single-row">
														<div class="checkbox ">';  
								foreach ($opsijawaban as $jawab){
										 
									$component .=' <label class="control-label"> <input  type="checkbox"  name="pertanyaan['.$idx.'][opsijawab]" value="'.$jawab->opsi_id.';'.$jawab->opsi.'"/>'.$jawab->opsi.'</label>&nbsp;&nbsp;';
							 
										
										//$rs .= $component ;
									}//end foreach listjawab
								$component .= '</div>
												</div>
												</div>';	
								$rs .= $component ;					
							}
							else if (isset($listjawab)){                         
								$component = '';            
								if (count($listparent)==1){
									$component = ' <div class="col-sm-9 icheck ">
													<div class="square single-row">
														<div class="radio">';        
									foreach ($listjawab as $jawab){
										switch ($jawab->tipe){
											case 'radio':
												 $component .=' <label class="control-label">                                    <input  type="radio"  name="pertanyaan['.$idx.'][jawab]" value="'.$jawab->jawab_id.';'.$jawab->singkatan.'"/>'.$jawab->nama.'</label>&nbsp;&nbsp;';
											break;
											default : $component .= '';
										}
										
										//$rs .= $component ;
									}//end foreach listjawab
									$component .= '</div>
													</div>
													</div>';	
								}//end jika jumlah distinct parent model jawab cuman 1
								else {  //jika parent model jawab >1
									foreach ($listparent as $parent){
										//$component .= '<div class="form-group">'.$parent->nama;
										$component .= '  <div class="form-group" style="margin-left:20px">
											<label class="col-sm-3 control-label" style="padding-top:10px"><b>'.$parent->nama.'&nbsp;:</b>&nbsp;</label>
											<div class="col-sm-9">';
										$component .= ' <div class="col-sm-8 icheck ">
													<div class="square single-row">
														<div class="radio">'; 
										foreach ($listjawab as $jawab){	
											if ($jawab->parent_id != $parent->parent_id) continue;
											switch ($jawab->tipe){
												case 'radio':
													 $component .=' <label class="control-label">                                    <input  type="radio"  name="pertanyaan['.$idx.'][jawab]" value="'.$jawab->jawab_id.';'.$jawab->singkatan.'"/>'.$jawab->nama.'</label>&nbsp;&nbsp;';
												break;
												default : $component .= '';
											}
										}//end foreach listjawab
										$component .= '</div>
													</div>
													</div>';
										$component .='</div></div>';
										
									}//end foreach listparent
								}//end jika parent model jawab >1
								
								$rs .= $component ;	
							}//end if isset listjawab	
							$rs .= '</div>
											</div>';
							 
							 // class="floatlabel_3" placeholder="Floated Label" data-label="This is floated"
							 //<label class="col-sm-12 control-label"> '.$pertanyaan->tanya_tambahan1.'</label>
							if ($pertanyaan->tanya_tambahan1!=""){
								$rs .= ' <div class="form-group" style="margin-left:20px">
												
												<div class="col-sm-12"><input type="text"  placeholder="'.$pertanyaan->tanya_tambahan1.'" data-label="'.$pertanyaan->tanya_tambahan1.'" class="floatlabel" size="100" name="pertanyaan['.$idx.'][tambahan1]"/>';
								$rs .= '</div></div>' ;
							}
							//<label class="col-sm-12 control-label"> '.$pertanyaan->tanya_tambahan2.'</label>
							if ($pertanyaan->tanya_tambahan2!=""){
								$rs .= ' <div class="form-group" style="margin-left:20px">
												
												<div class="col-sm-12"><input type="text" placeholder="'.$pertanyaan->tanya_tambahan2.'" data-label="'.$pertanyaan->tanya_tambahan2.'" class="floatlabel" size="100" name="pertanyaan['.$idx.'][tambahan2]"/>';
								$rs .= '</div></div>' ;
							}
							$idx++;
						}//end foreach pertanyaan
					 
						
						$rs .= ' </div>						
								</section>';		
					}//end if isset pertanyaan
				}//end if tipejawban Pilihan
				else if($model->tipe_jawaban=="Pendapat"){
						//tidak usah ada pertanyaan hanya isian berdasarkan kriteria kriteria pada modeljawaban;
					$listjawab = $this->kuesioner_pertanyaan_model->get_model_jawab($model->model_kuesioner_id);
					$rs .= '<section>
									<div class="form" id="content-'.$model->model_kuesioner_id.'">';
					$rs .= '<div class="alert alert-block alert-danger fade in">
							<h4>Petunjuk</h4> 
								<p>'.$model->petunjuk.'</p>
                            </div>';	
							
					if (isset($listjawab)){                         
						$component = '<div id="divPendapat-1" class="form-group" style="margin-left:20px">
												<label id="labelPendapat-1" class="col-sm-12 control-label"><h4 color="#3c763d">Pendapat ke-1</h4></label>
												<div class="col-lg-12" style="border:1px solid;border-radius:10px;padding-top:10px;border-color:#dddddd;padding-bottom:20px">';    
						foreach ($listjawab as $jawab){
							//	<label class="col-sm-12 control-label"> '.$jawab->nama.'</label>
							$component .= ' <div class="form-group" style="margin-left:20px">
												<div class="col-sm-12"><input name="pendapat[]" type="text"   placeholder="'.$jawab->nama.'" data-label="'.$jawab->nama.'" class="floatlabel" size="100"/>';
							$component .= '</div></div>' ;
						}//endforeacch listjawab
						$component .= '</div></div><br><br>';
					}
					$rs .= $component;
					$rs .= '<div class="form-group" id="divTambahPendapat">	
								 <a href="#" class="btn btn-primary btn-sm" style="margin:10px 0 0 70px" onclick="pendapatAdd('.$model->model_kuesioner_id.');"><i class="fa fa-plus-circle"></i> Tambah Pendapat</a>
							</div>	';
					$rs .= ' </div>
								</section>';	
				}//end if tipejawaban Pendapat
			}//end foreach model
		}//end if isset model
		return $rs;
		
	}
	
	function get_form_values(){
		$data['kuesioner_id'] = $this->input->post('kuesioner_id');
		$data['responden_id'] = $this->input->post('responden_id');
		$data['pertanyaan'] = $this->input->post('pertanyaan');
		if (isset($data['pertanyaan'])){
			for ($i=0;$i<count($data['pertanyaan'])-1;$i++){
				//$data[$data['kuesioner_pertanyaan_id']]['jawab'] = $data['kuesioner_pertanyaan_id'][$i];
			}
		}
		return $data;
	}
	function submit(){
		 $data = $this->get_form_values();
		// var_dump($data);die;
            try{
				$this->kuesioner_jawaban_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Terima kasih atas partisipasinya.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Error</b></h5>
					<p>Maaf data kuesioner gagal tersimpan, silahkan hubungi administrator.</p>';
			}
			$this->after_submit($msg);
	}
	
	
	function after_submit($msg){
		$setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load_popup($setting); #load static template file		
		$data['msg'] = $msg;
		$template['konten']	= $this->load->view('kuesioner/publish_after_v',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}
	

    

}
