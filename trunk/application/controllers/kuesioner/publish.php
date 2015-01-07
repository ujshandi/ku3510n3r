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

 
	
	
     
	
	function load($kuesioner_id){
		$setting['sd_left']	= array('cur_menu'	=> "KUESIONER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load_popup($setting); #load static template file		
		$data['data'] = $this->get_pertanyaan_preview($kuesioner_id);
		 $data['kuesioner']		= $this->kuesioner_model->pilihdata(array('kuesioner_id'=>$kuesioner_id)); 
		$template['konten']	= $this->load->view('kuesioner/publish_v',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container_popup',$template);
	}
	
	function get_pertanyaan($kuesioner_id,$model_kuesioner_id){
		// echo  json_encode($this->pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id)));
		$list_pertanyaan = $this->kuesioner_pertanyaan_model->get_list(array('kuesioner_id'=>$kuesioner_id,'model_kuesioner_id'=>$model_kuesioner_id),$listSelected);
		echo form_multiselect('pertanyaan_idzx[]',$list_pertanyaan,$listSelected,'id="pertanyaan_id" class="multi-select" style="width:100%"');
	}
	
	/* <h2>First Step</h2>

                            <section>
                                <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Full Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email Address</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">User Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Username">
                                            </div>
                                        </div>
                                    </form>
                            </section>*/
	function get_pertanyaan_preview($kuesioner_id){
		$rs = '';
		$listmodel = $this->kuesioner_pertanyaan_model->get_distinct_model($kuesioner_id);
		//var_dump($listmodel);
		if (!isset($listmodel)){
			$rs ="Data belum ada";
		}
		else{
			foreach ($listmodel as $model){
				$rs .= "<h2>".$model->nama." (".$model->singkatan.")</h2>";
				$listpertanyaan = $this->kuesioner_pertanyaan_model->get_complete_pertanyaan($kuesioner_id,$model->model_kuesioner_id);
				if (!isset($listpertanyaan)){
					$rs .= 'Belum ada Pertanyaan';
				}else {
					$listjawab = $this->kuesioner_pertanyaan_model->get_model_jawab($model->model_kuesioner_id);
					$rs .= '<section>
                                <form class="form-horizontal">';
					$rs .= '<table class="table table-bordered">';
					$rs .= '<thead><tr  align="center">						
						
						<th rowspan="2" style="vertical-align:middle;text-align:center;width:1%"  width="30">NO.</th>
						<th rowspan="2"  style="vertical-align:middle;text-align:center" width="230" >'.strtoupper($model->caption_pertanyaan).'</th>';
						
					if (!isset($listjawab)){
						$rs .= '<th style="vertical-align:middle;text-align:center"   >JAWABAN</th>
					</tr>';				
						$rs .= '<th style="vertical-align:middle;text-align:center" width="100" >Model Jawaban Belum di Setting</th>'	;
					}
					else{
						$rs .= '<th colspan="'.count($listjawab).'" style="vertical-align:middle;text-align:center" width="100" >JAWABAN</th>
					</tr>';				
						$rs .= '<tr  align="center">';
						foreach ($listjawab as $jawab){
							$rs .= '<th style="vertical-align:middle;text-align:center;width:1%"  >'.$jawab->singkatan.'</th>'	;
						}
						//width="'.(round(100/count($listjawab))).'"
						$rs .= '</tr>';
					}
					$rs .= 	'</thead>';	
					$rs .= '<tbody>';		
					$i=1;
					foreach($listpertanyaan as $pertanyaan){
						$rs .= '<tr>';
						$rs .= '<td>'.$i++.'</td>';
						$rs .= '<td>'.$pertanyaan->tanya.'</td>';
						foreach ($listjawab as $jawab){
							switch ($jawab->tipe){
								case 'radio':
									$component = ' <div class="col-sm-9 icheck ">
                                            <div class="square single-row">
                                                <div class="radio ">
                                                    <input  type="radio"  name="radio-'.$kuesioner_id.'-'.$model->model_kuesioner_id.'-'.$pertanyaan->pertanyaan_id.'"/>                                                   
                                                </div>
                                            </div>
                                            </div>';
								break;
								default : $component = '';
							}
							$rs .= '<td>'.$component.'</td>';
						}
						$rs .= '</tr>';
						if ($pertanyaan->tanya_tambahan1!=""){
							$rs .= '<tr>';
							$rs .= '<td>&nbsp;</td>';
							$rs .= '<td>'.$pertanyaan->tanya_tambahan1.'&nbsp;<input type="text"/></td>';
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
					$rs .= ' </form>
                            </section>';		
				}//end if isset pertanyaan
			}//end foreach model
		}//end if isset model
		return $rs;
		
	}
 
    

}
