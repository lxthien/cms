<?php
class Lienkets extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>11));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function list_all($offset = 0,  $limit =5)
    {
        $lienket = new lienket();
        $lienket->order_by('id','desc');
        $lienket->get();
        $dis['base_url']=base_url();
        $dis['view']='lienket/list';
        $dis['menu_active']='Liên kết';
        $dis['title']="Danh sách link liên kết";
        $dis['lienket']=$lienket;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm liên kết mới",
    				"link"=>"{$this->admin_url}lienkets/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $lienket=new lienket($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
          
               $lienket->name_vietnamese = $this->input->post('name_vietnamese');
               $lienket->name_english =$this->input->post('name_english');
               $lienket->link =  $this->input->post('link');

               if($lienket->save())
               {
                    redirect($this->admin.'lienkets/edit/'.$lienket->id);
               }
        }
        $dis['base_url']=base_url();
        $dis['title']="Add/Edit Lienket";
        $dis['menu_active']="Liên kết";
        $dis['view']="lienket/edit";
        $dis['object']=$lienket;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}lienkets",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
  
    function delete()
    {
        $id=$this->uri->segment(4);
        $lienket=new lienket($id);
        if(!$lienket->exists())
            show_404();
        $lienket->delete();
        redirect($this->admin.'lienkets/list_all/');
    }
   
}