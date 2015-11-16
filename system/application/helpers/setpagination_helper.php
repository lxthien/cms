<?php 
function setPagination($site,$total_rows,$perpage,$urisegment=3)
{
	$CI =& get_instance();
	$CI->load->library('pagination');
	$config['base_url'] 			= site_url($site); // What will CI use for the page links?
    $config['total_rows'] 			= $total_rows;
    $config['per_page'] 			= $perpage; // How many items per page?
    $config['num_links'] = 2;
    $config['full_tag_open']		= '<div class="pagination">';
    $config['full_tag_close']		= "</div>";
   	$config['first_link'] 			= 'First';
	$config['first_tag_open']		= '';
	$config['first_tag_close']		= '';
	$config['last_link'] 			= 'Last &raquo;';
	$config['last_tag_open'] 		= '';
	$config['last_tag_close'] 		= '';
	$config['next_link']			= 'Next &raquo;';
	$config['next_tag_open'] 		= '';
	$config['next_tag_close'] 		= '';
	$config['prev_link'] 			= '&laquo; Previous';
	$config['prev_tag_open'] 		= '';
	$config['prev_tag_close'] 		= '';
	$config['num_tag_open'] 		= '';
	$config['num_tag_close'] 		= '';
	$config['cur_tag_open'] 		= '<span class="active">';
	$config['cur_tag_close']		= '</span>';

	$config['uri_segment'] 			= 		$urisegment;
	$CI->pagination->initialize($config); // config pagination
}
//pagination for front page document catalogue
function setPaginationVb($site,$total_rows,$perpage,$urisegment=3)
{
	$CI =& get_instance();
	$CI->load->library('pagination');
	$config['base_url'] 			= site_url($site); // What will CI use for the page links?
    $config['total_rows'] 			= $total_rows;
    $config['per_page'] 			= $perpage; // How many items per page?
    $config['num_links'] = 2;
    $config['full_tag_open']		= '<div class="news-pagination" style="padding-top:10px;">';
    $config['full_tag_close']		= "</div>";
   	$config['first_link'] 			= 'Đầu';
	$config['first_tag_open']		= '';
	$config['first_tag_close']		= '';
	$config['last_link'] 			= 'Cuối &raquo;';
	$config['last_tag_open'] 		= '';
	$config['last_tag_close'] 		= '';
	$config['next_link']			= 'Tiếp &raquo;';
	$config['next_tag_open'] 		= '';
	$config['next_tag_close'] 		= '';
	$config['prev_link'] 			= '&laquo; Trước';
	$config['prev_tag_open'] 		= '';
	$config['prev_tag_close'] 		= '';
	$config['num_tag_open'] 		= '';
	$config['num_tag_close'] 		= '';
	$config['cur_tag_open'] 		= '<span class="active">';
	$config['cur_tag_close']		= '</span>';

	$config['uri_segment'] 			= 		$urisegment;
	$CI->pagination->initialize($config); // config pagination
}