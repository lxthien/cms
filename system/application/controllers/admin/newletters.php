<?php 
class newletters extends MY_Controller{
	function newletters(){
		parent::MY_Controller();
		$this->session->set_userdata(config_item('session_admin').'menu_current','11')	;
        $this->load->library('login_manager');
	}

	function index(){
		$dis['base_url']=base_url();
        $dis['title']="newletter";
		$dis['view']='newletter/sumary';

        $newletter = new newletter();
        $newletter->order_by('id','asc');
        $newletter->get_iterated();
        $dis['newletter']= $newletter;

        $this->load->view('admin/newletter/sumary',$dis);
	}
}