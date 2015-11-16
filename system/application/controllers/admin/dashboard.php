<?php 
class Dashboard extends MY_Controller{
	function Dashboard(){
		parent::MY_Controller();
		$this->session->set_userdata(config_item('session_admin').'menu_current','11')	;
        $this->load->library('login_manager');
	}
	function index(){
		$dis['base_url']=base_url();
        $dis['title']="Dashboard";
		$dis['view']='dashboard/sumary';
        $dis['article']=new article(4);
		$this->viewadmin($dis);			
	}
    
    function clearCache()
    {
        $this->clearCacheFolder();
    }
}