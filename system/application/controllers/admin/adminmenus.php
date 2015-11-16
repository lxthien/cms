<?php
class Adminmenus extends MY_Controller{
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
        $adminmenu =new adminmenu();
        $adminmenu->order_by('position','asc');
        $adminmenu->get();
        $dis['view']='adminmenu/list';
        $dis['menu_active']='Adminmenu';
        $dis['title']="Danh sách menu admin";
        $dis['adminmenu']=$adminmenu;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Add Menu",
    				"link"=>"{$this->admin_url}adminmenus/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $adminmenu=new adminmenu($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $adminmenu->name=$this->input->post('name');
               $adminmenu->link=$this->input->post('link');
               $parentmenu=new adminmenu(trim($this->input->post('parent')));
               $adminmenu->class=$this->input->post('class');
               $adminmenu->li_class=$this->input->post('li_class');
               if($adminmenu->save(array('parentmenu'=>$parentmenu)))
               {
                    redirect($this->admin.'adminmenus/list_all/');
               }
        }
        $parentmenu = new adminmenu();
        $parentmenu->where('parentmenu_id',NULL);
        if($adminmenu->exists())
        {
            $parentmenu->where('id !=',$adminmenu->id);
        }
        $parentmenu->order_by('position','asc');
        $parentmenu->get();
        $dis['base_url']=base_url();
        $dis['parentmenu']=$parentmenu;
        $dis['title']="Menu";
        $dis['menu_active']="Adminmenu";
        $dis['view']="adminmenu/edit";
        $dis['object']=$adminmenu;
    
        $this->viewadmin($dis);
    }
   
    function up_position($id,$step=1)
    {
        $o=new adminmenu();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'adminmenus/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new adminmenu();
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
       redirect($this->admin.'adminmenus/list_all/');
    }
    function delete()
    {
        $id=$this->uri->segment(4);
        $adminmenu=new adminmenu($id);
        //delete city
        if(count($adminmenu->adminmenu->all)>0)
        {
            flash_message('error','không thể xóa menu gốc, vui lòng xóa menu con trước');
        }
        else
        {
            $adminmenu->delete();
        }    
        //redirect to city
        redirect($this->admin.'adminmenus/list_all/');
    }
    function deleteall()
    {
        $menu=$this->input->post('checkinput');
        foreach($menu as $row)
        {
            $adminmenu=new adminmenu($row);
            if(!$adminmenu->exists())
                continue;
            if($adminmenu->parentmenu_id==NULL)
            {
                $adminmenu->delete();
                 
            }
            else
            {
                if($adminmenu->child->count()>0)
                {
                    flash_message('error','Vui lòng xóa hết menu con của '.$adminmenu->name);
                }
                else
                {
                   // $this->firephp->log("sdf");
                     $adminmenu->delete();
                }
            }
        
        }
        redirect($this->admin.'adminmenus/list_all');
    }
}
/* End of file adminmenus.php */
/* Location: ./application/controller/adminmenus.php */