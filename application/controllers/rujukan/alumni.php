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
class alumni extends CI_Controller 
{
    //put your code here
     function __construct()
    {
        parent::__construct();			

        //	$userdata = array ('userLogin' => $userLogin,'logged_in' => TRUE,'groupId'=>$this->sys_login_model->groupId,'fullName'=>$this->sys_login_model->fullName,'userId'=>$this->sys_login_model->userId,'groupLevel'=>$this->sys_login_model->level);

        $this->load->model('/security/sys_menu_model');
        $this->load->model('/rujukan/alumni_model');             
        $this->load->model('/rujukan/instansi_model');             

    }

    function index()
    {
        $setting['sd_left']	= array('cur_menu'	=> "MASTER");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		     
		$data = null;
		$data['list_instansi'] = $this->instansi_model->get_list(true);
		$template['konten']	= $this->load->view('rujukan/alumni_tampil',$data,true); #load konten template file
		#load container for template view
		$this->load->view('template/container',$template);
            //$this->load->view('admin/index', $data);  
    }

	function initFormData(){
		$data[0]->alumni_id = '';
		$data[0]->instansi_id = '';
		$data[0]->nama = '';
		$data[0]->email = '';
		 
		return $data;
	}
	
	
    function tambah()
    {
          
			$data["data"] = $this->initFormData();
			$data['list_instansi'] = $this->instansi_model->get_list();
			$this->load->view('rujukan/alumni_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }
	

     function import()
    {
          
			$data["data"] = $this->initFormData();
			$data['list_instansi'] = $this->instansi_model->get_list();
			$this->load->view('rujukan/alumni_import',$data);
            //$this->load->view('admin/index',$data);  
    }

	 function edit($id)
    {
            
			$data['data']		= $this->alumni_model->pilihdata(array('alumni_id'=>$id));
			$data['list_instansi'] = $this->instansi_model->get_list();
			if (!isset($data['data'])){
				$data['data'] = $this->initFormData( );
			}else{
				
				$data['data'][0]->alumni_id= $data['data'][0]->alumni_id;
			 
				$data['data'][0]->nama = $data['data'][0]->nama;
			}
			  
			$this->load->view('rujukan/alumni_tambah',$data);
            //$this->load->view('admin/index',$data);  
    }

 
    function save()
    {
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            $data['instansi_id']=$this->input->post('instansi_id'); 
            try{
				$this->alumni_model->simpan($data);
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil ditambahkan.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden gagal ditambahkan.</p>';
			}
			echo $msg;
            
    }

    function update()
    {
            $alumni_id=$this->input->post('alumni_id');
            $data['instansi_id']=$this->input->post('instansi_id'); 
            $data['nama']=$this->input->post('nama'); 
            $data['email']=$this->input->post('email'); 
            try{
				$this->alumni_model->edit($data,array("alumni_id"=>$alumni_id));
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil diupdate.</p>';
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden gagal diupdate.</p>';
			}
			echo $msg;
    }

    function hapus($alumni_id)
    {
        try{
			$this->alumni_model->hapus(array("alumni_id"=>$alumni_id)); 
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		catch(Exception $e){
			$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Responden berhasil dihapus.</p>';
		}
		echo $msg;
    }
	
	function datatable(){
		echo $this->alumni_model->get_datatables();
	}


	function importdata()
    {   
        
    	$config['upload_path'] = './temp_upload/';
		$config['allowed_types'] = 'xls';
        $this->load->library('upload', $config);

        include_once ( APPPATH."libraries/excel_reader2.php");
            try{
            	$excel = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
        		$hasildata = $excel->rowcount($sheet_index=0);

        		$sukses = 0;
        		$gagal = 0;

        		for ($i=2; $i<=$hasildata; $i++)
        		{
           			$data['nama'] = $excel->val($i,2); 
            		$data['email'] = $excel->val($i,3);
            		$data['instansi_id'] = $excel->val($i,3);
           
            		$this->alumni_model->import($data);
           
           				if ($hasildata) $sukses++;
            			else $gagal++;
        		}

				
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Import data selesai</p>';
        
			}
			catch (Exception $e){
				$msg = '<h5><i class="fa fa-check-square-o"></i> <b>Sukses</b></h5>
					<p>Data Alumni gagal dimport.</p>';
			}
			echo $msg;

	}


		public function do_upload()
		{
			$config['upload_path'] = "./temp_upload/";
			$config['allowed_types'] = 'xls';
             
			$this->load->library('upload', $config);
            $this->upload->initialize($config);
			if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
					echo $error;
				}
			else { echo "Berhasil"; }	 
			
			
            	
				/*$upload_data = $this->upload->data();
            	$this->load->library('excel_reader');
				$this->excel_reader->setOutputEncoding('230787');
				$file =  $upload_data['full_path'];
				$this->excel_reader->read($file);
				error_reporting(E_ALL ^ E_NOTICE);
				// Sheet 1
				$data = $this->excel_reader->sheets[0] ;
                $dataexcel = Array();
				for ($i = 1; $i <= $data['numRows']; $i++) 
				{
                            if($data['cells'][$i][1] == '') break;
                            $dataexcel[$i-1]['nama'] = $data['cells'][$i][1];
                            $dataexcel[$i-1]['email'] = $data['cells'][$i][2];
                            $dataexcel[$i-1]['instansi_id'] = $data['cells'][$i][3];
                }        
            	delete_files($upload_data['file_path']);
            	$this->load->model('alumni_model');
            	$this->alumni_model->import($dataexcel);*/
					
		}
}
