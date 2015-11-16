<?php
class Metros extends MY_Controller{
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
        $metro =new metro();
        $metro->order_by('id','asc');
        $metro->get();
        $dis['view']='metro/list';
        $dis['menu_active']='Metro';
        $dis['title']="Metro Slideshow";
        $dis['metro']=$metro;
        $dis['nav_menu']=array(
         /*
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}metros/edit/",
    				"onclick"=>""		
    			)*/
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
		$this->load->library('file_lib');
        $metro=new metro($id);
		
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
			$metro->title=$this->input->post('title');
			$metro->link=$this->input->post('link');
			$metro->dir='img/metro';
            $metro->type = $this->input->post('type');
			
			$new_image=$this->input->post('newimage');
			
			$dataupload=$this->file_lib->upload('image','img/metro');
			if(!is_array($dataupload))
			{
				//flash_message('error',$dataupload);
			}
			else{
				$metro->img='img/metro/'.$dataupload['file_name'];
			}
				
		   
			if($metro->save())
			{
				flash_message('success', 'Thành công. Thao tác đã được thực hiện.');
				redirect($this->admin.'metros/edit/'.$metro->id);
			}
        }
   
        $dis['base_url']=base_url();
        $dis['title']="Add/Edit Metro Slideshow";
        $dis['menu_active']="Metro";
        $dis['view']="metro/edit";
        $dis['object']=$metro;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}metros",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
  
    function delete()
    {
        $id=$this->uri->segment(4);
        $metro=new metro($id);
        if(!$metro->exists())
            show_404();
        $metro->delete();
        redirect($this->admin.'metros/list_all/');
    }
}
/* End of file metros.php */
/* Location: ./application/controller/metros.php */