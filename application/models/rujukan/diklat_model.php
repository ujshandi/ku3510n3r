<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *INVISI
*/

class Diklat_model extends CI_Model
{	
	/**
	* constructor
	*/
    public function __construct()    {
        parent::__construct();
		//$this->CI =& get_instance();
    }
	
	function get_list($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct diklat_id,nama from diklat ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua Diklat';
		else
			$list["-1"] = 'Pilih Diklat';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->diklat_id] = $i->nama;
			}
		return $list;
	}
	
	function get_list_tahun($forFilter=false) {
		$where = ' where 1=1 ';
		if (isset($params)){
			//if (isset($params['kode_e1'])) $where .= " and kode_e1='".$params['kode_e1']."'";
		}
		$sql = "select distinct tahun from diklat ";
		
		
		$result = $this->mgeneral->run_sql($sql);
		
		if ($forFilter)
			$list["-1"] = 'Semua';
		else
			$list["-1"] = 'Pilih Tahun';
		if (isset($result))
			foreach ($result as $i) {
				$list[$i->tahun] = $i->tahun;
			}
		return $list;
	}
	
	
	
	
    public function isExistKode($kode=null){	
        if ($kode!=null)//utk update
            $this->db->where('alumni_id',$kode); //buat validasi

        $this->db->select('*');
        $this->db->from('alumni');

        $query = $this->db->get();
        $rs = $query->num_rows() ;		
        $query->free_result();
        return ($rs>0);
    }
	    
    function tampildata()
    {       
        return $this->db->query("select d.*,j.nama as nama_jenis from diklat d left join jenis_diklat j on d.jenis_diklat = j.jenis_id order by diklat_id");    
    }

   function get_datatables(){
		//$this->datatables->add_column('NOMOR','');
		$this->datatables->select("'' as No, d.diklat_id,d.tahun,d.nama, d.jenis_diklat,j.nama as nama_jenis,d.kategori_kuesioner ",false)
		->unset_column('d.diklat_id')
		->unset_column('d.jenis_diklat')
		->add_column('Actions', diklat_action('$1'), 'd.diklat_id')
		->from(' diklat d left join jenis_diklat j on d.jenis_diklat = j.nama');
		
	 //var_dump($_POST['jenis_diklat']);
		if (isset($_POST['tahun'])) {
			if ($_POST['tahun']!="-1") $this->datatables->where('tahun',$_POST['tahun']);
		}
		if (isset($_POST['jenis_diklat'])) {
			if ($_POST['jenis_diklat']!="-1") $this->datatables->where('jenis_diklat',$_POST['jenis_diklat']);
		}
		 
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	/*	if ( isset( $aOrder ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<count($aOrder) ; $i++ )
			{
				if ( $aCols[intval($aOrder[$i]['column'])]['orderable'] == "true" )
				{
					$sOrder .= $aCols[intval($aOrder[$i]['column'])]['data']." ".($aOrder[$i]['dir']=='asc' ? 'ASC' : 'DESC') .", ";
				}
			}
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}*/
		//$this->datatables->join('anev_eselon1 e1', 'e1.kode_e1=e2.kode_e1 and e1.tahun_renstra=e2.tahun_renstra', 'left');
		//$this->datatables->add_column('aksi', '$1','e2_action(e2.kode_e2)');
		return $this->datatables->generate();
	
	}
	
	
	function simpan($data){
		$this->mgeneral->save($data,'diklat');
	}

   function edit($data,$whereData){
		
		$this->mgeneral->update($whereData,$data,'diklat');
	}
	
   function hapus($whereData){		
		$this->mgeneral->delete($whereData,'diklat');
	}

    function pilihdata($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['diklat_id'])) $where .= " and diklat_id='".$params['diklat_id']."'";
		}
		$sql = "select * from diklat ".$where;
		return $this->mgeneral->run_sql($sql);
	}

}
?>
