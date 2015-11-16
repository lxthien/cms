<?php
class contactpersons extends MY_Controller{
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
    function list_all()
    {
        $dis['base_url']=base_url();
        $contactperson =new contactperson();
        $contactperson->order_by('position','asc');
        $contactperson->get();
        $dis['view']='contactperson/list';
        $dis['menu_active']='Người liên hệ';
        $dis['title']="Danh sách người liên hệ";
        $dis['contactperson']=$contactperson;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm liên hệ",
    				"link"=>"{$this->admin_url}contactpersons/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function edit($id=0)
    {
        $contactperson=new contactperson($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $contactperson->name=trim($this->input->post('name'));
               $contactperson->role = trim($this->input->post('role'));
               $contactperson->email = trim($this->input->post('email'));
               $contactperson->phone = trim($this->input->post('phone'));
               
               if($contactperson->save())
               {
                    redirect($this->admin.'contactpersons/list_all/');
               }
        }
        
        
        
        
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa liên hệ";
        $dis['menu_active']="Người liên hệ";
        $dis['view']="contactperson/edit";
        $dis['object']=$contactperson;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}contactpersons/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
    function up_position($id,$step=1)
    {
        $o=new contactperson();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'contactpersons/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new contactperson();
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
       redirect($this->admin.'contactpersons/list_all/');
    }
    function delete()
    {
        $id=$this->uri->segment(4);
        $contactperson=new contactperson($id);
        //delete city
       
       $contactperson->delete();
        
        //redirect to city
        redirect($this->admin.'contactpersons/list_all/');
    }
    
    
   
    
    
    
}
/* End of file contactpersons.php */
/* Location: ./application/controller/contactpersons.php */