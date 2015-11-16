<?php
class Adminusers extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $this->load->library('login_manager');
    }

    function index()
    {
        $this->list_all();
    }

    function list_all()
    {
        $this->checkRole(array(1));
        $dis['base_url']=base_url();
        $adminuser =new adminuser();
        $adminuser->where_related_adminrole('level >',$this->logged_in_user->adminrole->level);
        $adminuser->get();
        $dis['view']='adminuser/list';
        $dis['menu_active']='adminuser';
        $dis['title']="User";
        $dis['adminuser']=$adminuser;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Add User",
    				"link"=>"{$this->admin_url}adminusers/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function edit($id=0)
    {
        $this->checkRole(array(1));
        $adminuser=new adminuser($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $adminuser->username=$this->input->post('username');
               $adminuser->password=trim($this->input->post('password'));
               $adminuser->confirm_password=trim($this->input->post('confirm_password'));
               $adminuser->fullname=$this->input->post('fullname');
               $adminuser->phone=$this->input->post('phone');
               $adminuser->email=$this->input->post('email');
               $adminuser->address=$this->input->post('address');
               $role=new adminrole(trim($this->input->post('adminrole')));
               $adminuser->kfm_username=$this->input->post('kfm_username');
               $adminuser->kfm_password=$this->input->post('kfm_password');
               if($adminuser->save($role))
               {
                    redirect($this->admin.'adminusers/edit/'.$adminuser->id);
               }
        }
        $adminrole=new adminrole();
        $adminrole->where('id !=',1);
        $adminrole->where('level >=',$this->logged_in_user->adminrole->level);
        $adminrole->get();
        
        $dis['adminrole']=$adminrole;
        $dis['base_url']=base_url();
        $dis['title']="Admin User";
        $dis['menu_active']="adminuser";
        $dis['view']="adminuser/edit";
        $dis['object']=$adminuser;
        $this->viewadmin($dis);
    }

    function account()
    {
        $adminuser = new adminuser($this->logged_in_user->id);
        if($_SERVER['REQUEST_METHOD']=="GET"){
        }
        else{
            $adminuser->password = trim($this->input->post('password'));
            $adminuser->confirm_password = trim($this->input->post('confirm_password'));
            $adminuser->fullname = $this->input->post('fullname');
            $adminuser->phone = $this->input->post('phone');
            $adminuser->email = $this->input->post('email');
            $adminuser->address = $this->input->post('address');
            if($adminuser->save())
            {
                flash_message('success','Cập nhật thông tin tài khoản thành công.');
                redirect($this->admin.'adminusers/account/'.$adminuser->id);
            }
        }
      
        $dis['base_url']=base_url();
        $dis['title'] = "Thông tin tài khoản";
        $dis['menu_active'] = "Tài khoản";
        $dis['view'] = "adminuser/simpleedit";
        $dis['object'] = $adminuser;
        $this->viewadmin($dis);
    }
  
    function delete()
    {
        $this->checkRole(array(1));
        $id=$this->uri->segment(4);
        $adminuser=new adminuser($id);
        
        if(!$adminuser->exists())
            show_404();
        $adminuser->delete();
        redirect($this->admin.'adminusers/list_all/');
    }
}
/* End of file adminusers.php */
/* Location: ./application/controller/adminusers.php */