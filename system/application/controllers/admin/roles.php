<?php
class Roles extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>45));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function list_all()
    {
        $dis['base_url']=base_url();
        $role =new role();
        $role->order_by('position','asc');
        $role->get_iterated();
        $dis['view']='role/list';
        $dis['menu_active']='Role';
        $dis['title']="Danh sách role";
        $dis['role']=$role;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}roles/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $role=new role($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $role->name_vietnamese=$this->input->post('name_vietnamese');
               $role->name_english=$this->input->post('name_english');
               $role->fieldname=$this->input->post('fieldname');
               if($role->save())
               {
                    redirect($this->admin.'roles/list_all/');
               }
        }
       
        $dis['base_url']=base_url();
        $dis['title']="Menu";
        $dis['menu_active']="Role";
        $dis['view']="role/edit";
        $dis['object']=$role;
    
        $this->viewadmin($dis);
    }
   
    function up_position($id,$step=1)
    {
        $o=new role();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'roles/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new role();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
       for($i=0;$i<$step;$i++)
        {
            $o->down_position();
        }
          //  flash_message('warning','Không th? thay d?i v? trí du?c n?a ');
       redirect($this->admin.'roles/list_all/');
    }
    function delete()
    {
        $id=$this->uri->segment(4);
        $role=new role($id);
        //delete city
        if(count($role->role->all)>0)
        {
            flash_message('error','không th? xóa menu g?c, vui lòng xóa menu con tru?c');
        }
        else
        {
            $role->delete();
        }    
        //redirect to city
        redirect($this->admin.'roles/list_all/');
    }
    function deleteall()
    {
        $menu=$this->input->post('checkinput');
        foreach($menu as $row)
        {
            $role=new role($row);
            if(!$role->exists())
                continue;
            if($role->parentmenu_id==NULL)
            {
                $role->delete();
                 
            }
            else
            {
                if($role->child->count()>0)
                {
                    flash_message('error','Vui lòng xóa h?t menu con c?a '.$role->name);
                }
                else
                {
                   // $this->firephp->log("sdf");
                     $role->delete();
                }
            }
        
        }
        redirect($this->admin.'roles/list_all');
    }
}
/* End of file roles.php */
/* Location: ./application/controller/roles.php */