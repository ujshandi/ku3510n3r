<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('kuesioner_action'))
{
	function kuesioner_action($id)
	{	
		$CI = & get_instance();
		$format = '
		<a href="#kuesionerModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Pertanyaan" onclick="kuesionerPertanyaan('.$id.')"><i class="fa fa-list-alt"></i></a>
		<a href="#" class="btn btn-info btn-xs" data-toggle="modal"   title="Preview" target="blank" onclick="kuesionerPreview('.$id.')"><i class="fa fa-eye"></i></a>
		<a href="#kuesionerModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="kuesionerEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="kuesionerDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}

if ( ! function_exists('alumni_action'))
{
	function alumni_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#alumniModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="alumniEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="alumniDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
if ( ! function_exists('model_kuesioner_action'))
{
	function model_kuesioner_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#model_kuesionerModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="model_kuesionerEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="model_kuesionerDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
if ( ! function_exists('pertanyaan_action'))
{
	function pertanyaan_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#pertanyaanModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="pertanyaanEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="pertanyaanDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
if ( ! function_exists('diklat_action'))
{
	function diklat_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#diklatModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="diklatEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="diklatDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
if ( ! function_exists('instansi_action'))
{
	function instansi_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#instansiModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="instansiEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="instansiDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
if ( ! function_exists('responden_action'))
{
	function responden_action($id)
	{	
		$CI = & get_instance();
		$format = '<a href="#respondenModal" class="btn btn-info btn-xs" data-toggle="modal"   title="Edit" onclick="respondenEdit('.$id.')"><i class="fa fa-pencil"></i></a>
				  <a href="#" onclick="respondenDelete('.$id.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>';
		return $format;
	}
}
	
if ( ! function_exists('kontak_action'))
{
	function kontak_action($id)
	{	
		$CI = & get_instance();
		$format = '<div class="btn-group">
			<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
			<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="'.base_url().'staff_kontak/staff_kontak_detail/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Detail</a></li>
				</ul>
		   </div>';
		return $format;
	}
}

if ( ! function_exists('konsultasi_action'))
{
	function konsultasi_action($id)
	{	
		$CI = & get_instance();
		$format = '<div class="btn-group">
			<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
			<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="'.base_url().'staff_konsultasi/detail/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Detail</a></li>
					<li><a href="'.base_url().'staff_konsultasi/jawab/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Jawab</a></li>
					<li><a href="#" onclick="hapus_konsultasi(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
				</ul>
		   </div>';
		return $format;
	}
}

if (!function_exists('faq_action')) {
	
	function faq_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
			<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
			<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="'.base_url().'staff_setting/faq_aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
		   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
				</ul>
		   </div>';
		return $format;
	}
}

if (!function_exists('package_action')) {
	
	function package_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff_package/detail/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Detail</a></li>
							<li><a href="'.base_url().'staff_package/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('artikel_action')) {
	
	function artikel_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff_artikel/detail/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Detail</a></li>
							<li><a href="'.base_url().'staff_artikel/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('link_action')) {
	
	function link_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff_link/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('galeri_action')) {
	
	function galeri_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff_galeri/foto/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Lihat Foto</a></li>
							<li><a href="'.base_url().'staff_galeri/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('galeri_foto_action')) {
	
	function galeri_foto_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('jumlah_foto')) {
	
	function jumlah_foto($id) {
		$CI =& get_instance();
		$total	= $CI->mgeneral->getWhere(array('galeri_id'=>$id),'tbl_galeri_foto');
		return count($total)." foto";
	}
}

if ( ! function_exists('promo_action'))
{
	function promo_action($id)
	{	
		$CI = & get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff_promo/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('staff_action')) {
	
	function staff_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="'.base_url().'staff/ganti_password/'.$CI->mconverter->encode($id).'"><span class="i-box"></span> Ganti Password</a></li>
							<li><a href="'.base_url().'staff/aksi/edit/'.$CI->mconverter->encode($id).'"><span class="i-pencil"></span> Ubah</a></li>
				   			<li><a href="#" onclick="hapus(\''.$CI->mconverter->encode($id).'\');" ><span class="i-cancel-2"></span> Hapus</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

if (!function_exists('staff_package_name')) {
	
	function staff_package_name($id) {
		$CI =& get_instance();
		$format	= $CI->mgeneral->getValue('package_title',array('package_id'=>$id),'tbl_package');
		return $format;
	}
}

if (!function_exists('staff_package_status')) {
	
	function staff_package_status($status) {
		$CI =& get_instance();
		$format	= strtoupper($status);
		return $format;
	}
}

if (!function_exists('staff_package_trx_action')) {
	
	function staff_package_trx_action($id) {
		$CI =& get_instance();
		$format = '<div class="btn-group">
					<a class="btn btn-success" data-toggle="dropdown" href="#">Aksi</a>
					<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#" onclick="ubah(\'book\',\'trx_package\', \''.$CI->mconverter->encode($id).'\');"><span class="i-pencil"></span> Book</a></li>
							<li><a href="#" onclick="ubah(\'payment\',\'trx_package\', \''.$CI->mconverter->encode($id).'\');"><span class="i-pencil"></span> Payment</a></li>
				   			<li><a href="#" onclick="ubah(\'cancel\',\'trx_package\', \''.$CI->mconverter->encode($id).'\');"><span class="i-pencil"></span> Cancel</a></li>
						</ul>
				   </div>';
		return $format;
	}
}

?>