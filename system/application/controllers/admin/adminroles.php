<?php
class Adminroles extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $this->load->library('login_manager');
        $this->checkRole(array(1));
    }
    function index()
    {
        $this->list_all();
    }
    function list_all()
    {
        $dis['base_url']=base_url();
        $adminrole =new adminrole();
        $adminrole->order_by('id','asc');
        $adminrole->get();
        $dis['view']='adminrole/list';
        $dis['menu_active']='adminrole';
        $dis['title']="Usergroup";
        $dis['adminrole']=$adminrole;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Add Role",
    				"link"=>"{$this->admin_url}adminroles/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $adminrole=new adminrole($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $adminrole->name=$this->input->post('name');
               $adminrole->level=$this->input->post('level');
               $menu=$this->input->post('checkmenu');
               $getmenu=new adminmenu();
               $getmenu->where_in('id',$menu);
               $getmenu->get();
               if($adminrole->exists())
               {
                    $adminrole->delete($adminrole->adminmenu->all);
               }
               if($adminrole->save($getmenu->all))
               {
                    redirect($this->admin.'adminroles/edit/'.$adminrole->id);
               }
        }
        $adminmenu=new adminmenu();
        $adminmenu->order_by('position','asc');
        $adminmenu->get();
        $dis['adminmenu']=$adminmenu;
        $dis['base_url']=base_url();
        $dis['title']="Menu";
        $dis['menu_active']="adminrole";
        $dis['view']="adminrole/edit";
        $dis['object']=$adminrole;
        $this->viewadmin($dis);
    }
   
  
    function delete()
    {
        $id=$this->uri->segment(4);
        $adminrole=new adminrole($id);
        
        if(!$adminrole->exists())
            show_404();
        $adminrole->delete();
        redirect($this->admin.'adminroles/list_all/');
    }
}
/* End of file adminroles.php */
/* Location: ./application/controller/adminroles.php */