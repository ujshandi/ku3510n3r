<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class template 
{
	
	function load($setting)
	{
		$ci = & get_instance();
		
		$temp['inc_header']		= $ci->load->view('template/inc_header',$setting['page'],true);
		$temp['header']			= $ci->load->view('template/header',isset($setting['header'])?$setting['header']:'',true);
		$temp['sidebar_left']	= $ci->load->view('template/sidebar_left',$setting['sd_left'],true);
		$temp['sidebar_right']	= $ci->load->view('template/sidebar_right',isset($setting['sd_right'])?$setting['sd_right']:'',true);
		$temp['inc_footer']		= $ci->load->view('template/inc_footer',$setting['page'],true);
		
		return $temp;
	}
	
	function load_popup($setting)
	{
		$ci = & get_instance();
		
		$temp['inc_header']		= $ci->load->view('template/inc_header',$setting['page'],true);		
		$temp['inc_footer']		= $ci->load->view('template/inc_footer',$setting['page'],true);
		
		return $temp;
	}
		
	function cek_tipe_numerik($str)
	{
		if(is_numeric($str)):
			$cekFormat = explode(".",$str);
			if(count($cekFormat)==1): $fangka = "0"; else: $fangka="2"; endif;
			$format = number_format($str,$fangka,',','.');
			return $format;
		else:
			return $str;
		endif;
	}
		
}

?>