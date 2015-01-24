<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class User_model extends CI_Model
{	var $user_id;
	var $user_name;
	
	/**
	* constructor
	*/
	public function __construct()
    {
        parent::__construct();
		//$this->CI =& get_instance();
		$this->reset();
    }
	
	public function reset(){
		$this->user_id = 0;
		$this->user_name = "";
	}
	
	function get_list($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct user_id,full_name from tbl_user where user_id <> 1 ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		// if ($forFilter)
			// $list["-1"] = 'Semua Instansi';
		// else
			// $list["-1"] = 'Pilih Instansi';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->user_id] = $i->full_name;
			}
		return $list;
	}
	
	public function GetList() {
		
		$pdfdata = array();
		$query = $this->db->get('sys_user');

		
		foreach ($query->result() as $row)
		{
			$pdfdata[] = array($row->user_id,$row->user_name,$row->full_name,$row->group_id,$row->job_title,$row->disabled,$row->notes);
			
		}
		return $pdfdata;		
		$this->db->free_result();
		
	}
	
	public function getListGrup($app_type=null,$level=null,$withoutSuperAdmin=null){
		
		$this->db->flush_cache();
		$this->db->select('group_id,group_name');
		$this->db->from('tbl_group_user');
		//var_dump($app_type);
		if ($app_type!=null)
			$this->db->where('app_type',$app_type);
		if ($withoutSuperAdmin!=null)
			$this->db->where('app_type is not null');
		if ($level!=null){
			$this->db->where("level <=",$level);
		}	
		$this->db->order_by('group_id');
		
		$que = $this->db->get();
		
		$out = '<select name="group_id" required="true">';
		
		foreach($que->result() as $r){
			$out .= '<option value="'.$r->group_id.'">'.$r->group_name.'</option>';
		}
		
		$out .= '</select>';
		
		echo $out;
	}
	
        public function getListUser($objectId,$withoutSuperAdmin=null,$withAll=TRUE){
		
		$this->db->flush_cache();
		$this->db->select('user_id,full_name');
		$this->db->from('tbl_user');
		
		if ($withoutSuperAdmin!=null)
			$this->db->where("lower(user_name) <> 'superadmin'");
		$this->db->order_by('full_name');
		
		$que = $this->db->get();
		
		$out = '<select name="user_id" id="user_id'.$objectId.'">';
		if ($withAll)
			$out .= '<option value="-1">Semua</option>';
		foreach($que->result() as $r){
                    $out .= '<option value="'.$r->user_id.'">'.$r->full_name.'</option>';			
		}
		
		$out .= '</select>';
		
		echo $out;
	}
	
        
	public function getListGrupFilter($objectId,$app_type=null,$level=null,$withoutSuperAdmin=null,$withAll=true,$idAsKey=false){
		
		$this->db->flush_cache();
		$this->db->select('app_type,group_id,group_name');
		$this->db->from('tbl_group_user');
		//var_dump($app_type);
		if ($app_type!=null)
			$this->db->where('app_type',$app_type);
		if ($withoutSuperAdmin!=null)
			$this->db->where('app_type is not null');
		if ($level!=null){
			$this->db->where("level <=",$level);
		}	
		$this->db->order_by('group_id');
		
		$que = $this->db->get();
		
		$out = '<select name="filter_apptype" id="filter_apptype'.$objectId.'" required="true">';
		if ($withAll)
			$out .= '<option value="-1">Semua</option>';
		foreach($que->result() as $r){
			if ($idAsKey)
				$out .= '<option value="'.$r->group_id.'">'.$r->group_name.'</option>';
			else
				$out .= '<option value="'.$r->app_type.'">'.$r->group_name.'</option>';
		}
		
		$out .= '</select>';
		
		echo $out;
	}
	
	
	function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select("'' as No,u.user_id,u.user_name, u.full_name",false)
		->unset_column('u.user_id')
		->add_column('Actions', user_action('$1'), 'u.user_id')
		->from(' tbl_user u');
		  
		// if (isset($_POST['instansi_id'])) {
			// if ($_POST['instansi_id']!="-1") $this->datatables->where('r.instansi_id',$_POST['instansi_id']);
		// }
		 
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	
		return $this->datatables->generate();
	
	}
	
	 
	public function isExistKode($user_name)
	{
		$this->db->where('user_name',$user_name); //buat validasi
		
		$this->db->select('*');
		$this->db->from('sys_user');
						
		$query = $this->db->get();
		$rs = $query->num_rows() ;		
		$query->free_result();
		return ($rs>0);
	}
	
	
	public function InsertOnDb($data ) {
		//query insert data		
	 
		unset($data['old_passwd']);
		$data['passwd'] = md5($data['passwd']);
		$data['log_insert'] = $this->session->userdata('user_id').';'.date('Y-m-d H:i:s');
		$result = $this->db->insert('tbl_user',$data);
		
		
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	//update data
	public function UpdateOnDb($data, $kode) {
		$this->db->where('user_id',$kode);
		if ($data['old_passwd']!=$data['passwd']) 
			$data['passwd'] = md5($data['passwd']);
		else 
			unset($data['passwd']);	
		unset($data['old_passwd']);	
		$data['log_update'] = $this->session->userdata('user_id').';'.date('Y-m-d H:i:s');
		unset($data['old_passwd']);
		$result=$this->db->update('tbl_user',$data);
		
		$errNo   = $this->db->_error_number();
	    $errMess = $this->db->_error_message();
		//var_dump($errMess);die;
		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	
	public function changePassword($id, $data) {
	
		$this->db->where('user_id',$id);				
		$this->db->set('passwd',md5($data['npass']));		
		$this->db->set('log_update',$this->session->userdata('user_id').';'.date('Y-m-d H:i:s'));
		$result=$this->db->update('tbl_user');

		//return
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}


	public function DeleteOnDb($id)
	{
		$this->db->where('user_id',$id);
		$result = $this->db->delete('tbl_user');

		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function SelectInDb($params){

	$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['user_id'])) $where .= " and user_id='".$params['user_id']."'";
		}
		$sql = "select * from tbl_user ".$where;
		return $this->mgeneral->run_sql($sql);
	}
	
	
	//buat ambil pas edit
	public function GetFromDb($id = NULL,$user_name=NULL)
	{
		$this->db->select('user_id,user_name,full_name,passwd,group_id,job_title,disabled,notes');
		$query=$this->db->from('tbl_user');

		//cek id
		if($id != NULL)
			$this->db->where('user_id',$id); //buat edit
		else if($user_name != NULL)
			$this->db->where('user_name',$user_name); //buat validasi
		if ($id != NULL || $user_name != NULL) {
			$query = $this->db->get();
			if($query->num_rows() == 1) {
				return $query->row(); //jika cocok
			}else {
				return FALSE; //tidak ditemukan
			}
		}
		//$this->db->free_result();
		$this->db->free_result();
	}

	public function getPassword($id){
		$this->db->flush_cache();
		$this->db->select('passwd');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		
		return $query->row()->passwd;
		
	}
        
        public function getFullName($id){
		$this->db->flush_cache();
		$this->db->select('full_name');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		
		return $query->row()->full_name;
		
	}
	
	//jumlah data record
	public function GetRecordCount($file1=null,$file2=null,$filapptype=null,$fillevel=null){
		
/*		if (($fillevel==null)||($fillevel=="-1"))
			//$fillevel = $this->session->userdata('level');
			$this->db->where("l.level <=",$this->session->userdata('level'));
		else	
			$this->db->where("l.level",$fillevel);
		
			
		if($file1 != '' && $file1 != '-1' && $file1 != null) {
			$this->db->where("u.unit_kerja_e1",$file1);
		}	
		
		if($file2 != '' && $file2 != '-1' && $file2 != null) {
			$this->db->where("u.unit_kerja_e2",$file2);
		}	
		
		if($filapptype != '' && $filapptype != '-1' && $filapptype != null) {
			$this->db->where("g.app_type",$filapptype);
		}	
		*/
		$query=$this->db->from('tbl_user u left join tbl_group_user g on g.group_id = u.group_id left join tbl_group_level l on u.level_id = l.level_id');
		return $this->db->count_all_results();
		$this->db->free_result();
	}
	
}

	//public function all(){
		//$this->db->select('user_id,user_name,full_name,passwd,group_id,job_title,disabled,notes');
		//$this->db->from('user_id');
		//return $this->db->get();
		//$this->db->free_result();
	//}

//}

//b_express/application/model/bengkel/jenis_oli_model.php
?>
