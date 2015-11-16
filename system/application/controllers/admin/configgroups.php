<?php
class Configgroups extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $this->load->library('login_manager');
    }
/*************************************
*       List all the position
**************************************/
    function index()
    {
        $this->list_all();
    }
    
  
    function edit()
    {
        $configgroup_id=$this->uri->segment(4);
        //if request is GET
        $configgroup=new configgroup($configgroup_id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {       
              //do no-thing
        }
        //if request if POST
        else
        {
           $rel = $configgroup->from_array($_POST, array(
				'name','for_webmaster'
			));
            if($configgroup->save($rel))
            {
                 redirect($this->admin.'cauhinhs/list_all/');    
            }
        }
                 $dis['base_url']=base_url();
                 $dis['menu_active']="Cấu hình hệ thống";
                 $dis['title']="Thêm/sửa thông tin group";
                 $dis['object']=$configgroup;
                 $dis['view']='configgroup/edit';
                 $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Quay lại",
    				"link"=>"{$this->admin_url}cauhinhs/",
    				"onclick"=>""		
    			)
         );
                 $this->viewadmin($dis);
         
    }
   
    function delete()
    {
        $id=$this->uri->segment(4);
        $configgroup=new configgroup($id);
        if(!$configgroup->exists())
            show_404();
        $configgroup->delete();
        redirect($this->admin.'cauhinhs/list_all/');    
    }
}
/* End of file configgroups.php */
/* Location: ./application/controller/configgroups.php */