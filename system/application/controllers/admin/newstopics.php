<?php
class Newstopics extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>91));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function list_all()
    {
        $dis['base_url']=base_url();
        $newstopic =new newstopic();
        $newstopic->order_by('id','desc');
        $newstopic->get();
        $dis['view']='newstopic/list';
        $dis['menu_active']='Dòng sự kiện';
        $dis['title']="Danh sách dòng sự kiện";
        $dis['newstopic']=$newstopic;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm sự kiện",
    				"link"=>"{$this->admin_url}newstopics/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $newstopic=new newstopic($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $newstopic->name=$this->input->post('name');
               $this->load->helper('remove_vn_helper');
               $newstopic->name_none=remove_vn($newstopic->name);
               if($newstopic->save())
               {
                    redirect($this->admin.'newstopics/edit/'.$newstopic->id);
               }
        }
    
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa dòng sự kiện tin tức";
        $dis['menu_active']="Dòng sự kiện";
        $dis['view']="newstopic/edit";
        $dis['object']=$newstopic;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}newstopics/",
    				"onclick"=>""		
    			),
                array(
    				"type"=>"add",
    				"text"=>"Thêm mới",
    				"link"=>"{$this->admin_url}newstopics/edit",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function delete()
    {
        $id=$this->uri->segment(4);
        $newstopic=new newstopic($id);
        //delete city
       
            $newstopic->delete();
      
        redirect($this->admin.'newstopics/list_all/');
    }
}
/* End of file newstopics.php */
/* Location: ./application/controller/newstopics.php */