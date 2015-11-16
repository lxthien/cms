<?php 
class Navi extends MY_Controller{
    function __construct()
	{
		parent::__construct();
		$this->load->library('login_manager');
	}
	function index()
	{
		$id=$this->uri->segment(4);
		$this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$id));
        $adminmenu=new adminmenu($id);
        if(!$adminmenu->exists())
            show_404();
        $sub=$adminmenu->child->where_related_adminrole('id',$this->logged_in_user->adminrole->id)->order_by('position','asc')->get(1);
		
        redirect($this->admin.$sub->link);
	}
}