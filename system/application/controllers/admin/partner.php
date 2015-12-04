<?php
class Partner extends MY_Controller{
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
        $khachhang = new khachhang();
        $khachhang->order_by('position','asc');
        $khachhang->get();
        $dis['base_url']=base_url();
        $dis['view']='khachhang/list';
        $dis['menu_active']='Đối tác';
        $dis['title']="Danh sách đối tác";
        $dis['khachhang']=$khachhang;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm đối tác",
    				"link"=>"{$this->admin_url}partner/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function edit($id=0)
    {
        $khachhang=new khachhang($id);
        if($_SERVER['REQUEST_METHOD']=="GET"){
        }
        else
        {
            $file = 'img/logo/';
            $position = $this->input->post('position');
            $partner = new Khachhang();
            $partner->where('position >', $position);
            $partner->get()->all;
            foreach($partner as $row){
                $row->position = $row->position + 1;
                $row->save();
                $row->clear();
            }
            $this->load->library('file_lib');
            $khachhang->name_vietnamese=$this->input->post('name');
            $khachhang->description=$this->input->post('description');
            $khachhang->link =  $this->input->post('link');
            $khachhang->address =  $this->input->post('address');
            $khachhang->email =  $this->input->post('email');
            $khachhang->phone  =  $this->input->post('phone');
            $khachhang->position = $position;
            $dataupload=$this->file_lib->upload('image',$file);
                if(!is_array($dataupload))
                {
                    flash_message('info',$dataupload);
                }
                else{
                    $khachhang->logo = $file.$dataupload['file_name'];
                    $this->resize_image('img/partner/'.$dataupload['file_name']);
                }


            if($khachhang->save())
            {
                redirect($this->admin.'partner/edit/'.$khachhang->id);
            }
        }
        $dis['base_url']=base_url();
        $dis['title']="Add/Edit Language";
        $dis['menu_active']="Đối tác";
        $dis['view']="khachhang/edit";
        $dis['object']=$khachhang;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}partner",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
  
    function delete()
    {
        $id=$this->uri->segment(4);
        $khachhang=new khachhang($id);
        if(!$khachhang->exists())
            show_404();
        $khachhang->delete();
        redirect($this->admin.'partner/list_all/');
    }
    
    function resize_image($file_link)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_link;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['height'] = 100;
        $config['quality'] = '100%';
        $config['thumb_marker'] = "_thump";
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
}