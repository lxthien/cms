<?php
class Sitelanguages extends MY_Controller{
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
        $dis['base_url']=base_url();
        $sitelanguage =new sitelanguage();
        $sitelanguage->order_by('id','asc');
        $sitelanguage->get();
        $dis['view']='sitelanguage/list';
        $dis['menu_active']='SiteLanguage';
        $dis['title']="SiteLanguage";
        $dis['sitelanguage']=$sitelanguage;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Add Language",
    				"link"=>"{$this->admin_url}sitelanguages/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $sitelanguage=new sitelanguage($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $sitelanguage->name=$this->input->post('name');
               $sitelanguage->short=$this->input->post('short');
               $getmenu=new adminmenu();
               
               if($sitelanguage->save())
               {
                    redirect($this->admin.'sitelanguages/edit/'.$sitelanguage->id);
               }
        }
        $adminmenu=new adminmenu();
        $adminmenu->order_by('position','asc');
        $adminmenu->get();
        $dis['adminmenu']=$adminmenu;
        $dis['base_url']=base_url();
        $dis['title']="Add/Edit Language";
        $dis['menu_active']="SiteLanguage";
        $dis['view']="sitelanguage/edit";
        $dis['object']=$sitelanguage;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}sitelanguages",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
  
    function delete()
    {
        $id=$this->uri->segment(4);
        $sitelanguage=new sitelanguage($id);
        if(!$sitelanguage->exists())
            show_404();
        $sitelanguage->delete();
        redirect($this->admin.'sitelanguages/list_all/');
    }
}
/* End of file sitelanguages.php */
/* Location: ./application/controller/sitelanguages.php */