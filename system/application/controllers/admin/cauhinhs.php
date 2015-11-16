<?php
class Cauhinhs extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $this->load->library('login_manager');
        $this->checkRole(array(1));
    }
/*************************************
*       List all the position
**************************************/
    function index()
    {
        $this->edit_fomal();
    }
    function list_all()
    {
         $cauhinh=new cauhinh();
         $cauhinh->get();
          $configgroup=new configgroup();
          $configgroup->order_by('position','asc');
          $configgroup->get();
          $dis['configgroup']=$configgroup;
         $dis['base_url']=base_url();
         $dis['menu_active']="Cấu hình hệ thống";
         $dis['title']="Thông số cấu hình";
         $dis['cauhinh']=$cauhinh;
         $dis['view']='cauhinh/list';
         $dis['nav_menu']=array(
         	      array(
    				"type"=>"back",
    				"text"=>"Về",
    				"link"=>"{$this->admin_url}cauhinhs",
    				"onclick"=>""		
    			),
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}cauhinhs/edit/",
    				"onclick"=>""		
    			),
                array(
    				"type"=>"list",
    				"text"=>"Group",
    				"link"=>"{$this->admin_url}configgroups/edit/",
    				"onclick"=>""		
    			)
         );
         $this->viewadmin($dis);
    }
    function edit_fomal()
    {
        $logged_role  = $this->logged_in_user->adminrole->id;
        $cauhinh=new cauhinh();
        $cauhinh->get();
        $this->load->library('file_lib');     
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            foreach($cauhinh as $row)
            {
                
               if( ($logged_role != 1 && $row->for_webmaster == 0) || ($logged_role == 1) )
               {
                    if($row->type == "file" || $row->type == "image")
                    {
                        if($_FILES[$row->fieldname]['name'] != "")
                       {
                            $dataupload=$this->file_lib->upload($row->fieldname, 'img/config/');   
                            if(is_array($dataupload)){    
                                $row->value = 'img/config/' . $dataupload['file_name'];
                                $row->save();   
                            } else{
                                 flash_message('error',$dataupload);
                            }
                       }
                    }
                    else
                    {
                        $row->value =  $this->input->post($row->fieldname);
                        $row->save();    
                    }
                    
                  
               }
              
            }
            $cauhinh->refresh_all();
            redirect("admin/cauhinhs/edit_fomal");
        }
        
        $configgroup=new configgroup();
        $configgroup->order_by('position','asc');
        $configgroup->get();
        $dis['logged_role'] = $logged_role;
         $dis['configgroup']=$configgroup;
         $dis['base_url']=base_url();
         $dis['menu_active']="Cấu hình hệ thống";
         $dis['title']="Thông số cấu hình";
         $dis['cauhinh']=$cauhinh;
         $dis['view']='cauhinh/edit_fomal';
         $dis['nav_menu']=array(
         );
          if($this->logged_in_user->adminrole->id == 1)
                {
                    array_push($dis['nav_menu'],	array(
    				"type"=>"list",
    				"text"=>"Chỉnh sửa",
    				"link"=>"{$this->admin_url}cauhinhs/list_all/",
    				"onclick"=>""		
    			));
                }
         $this->viewadmin($dis);
    }
  
    function edit()
    {
        
        $cauhinh_id=$this->uri->segment(4);
        //if request is GET
        $cauhinh=new cauhinh($cauhinh_id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {       
              //do no-thing
        }
        //if request if POST
        else
        {
            
           $rel = $cauhinh->from_array($_POST, array(
				'name','fieldname','description','configgroup','type','choice_list','for_webmaster','check_for_update','style'
			));
            if($cauhinh->save($rel))
            {
                 redirect($this->admin.'cauhinhs/edit/'.$cauhinh_id);    
            }
        }
                $configgroup=new configgroup();
                $configgroup->order_by('position','asc');
                 $configgroup->get();
                 $dis['configgroup']=$configgroup;
                 $dis['base_url']=base_url();
                 $dis['menu_active']="Cấu hình hệ thống";
                 $dis['title']="Sửa thông tin cấu hình";
                 $dis['object']=$cauhinh;
                 $dis['view']='cauhinh/edit';
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
        $cauhinh=new cauhinh($id);
        if(!$cauhinh->exists())
            show_404();
        $cauhinh->delete();
        redirect($this->admin.'cauhinhs/list_all/');    
    }
}
/* End of file cauhinhs.php */
/* Location: ./application/controller/cauhinhs.php */