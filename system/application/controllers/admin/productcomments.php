<?php
class Productcomments extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function index(){
        //$this->list_all();
    }
    
	function list_all()
    {
        $dis['base_url']=base_url();
        $productcomments =new Productcomment();
        $productcomments->order_by('created','desc');
        $productcomments->get();
        $dis['view']='productcomments/list';
        $dis['menu_active']='Phản hồi comments';
        $dis['title']="Phản hồi comments";
        $dis['productcomments']=$productcomments;
        $this->viewadmin($dis);
    }
    
	function reply($id=0)
    {
        $productcomments=new Productcomment($id);
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa danh mục tin tức";
        $dis['menu_active']="Danh mục";
        $dis['view']="contact/edit";
        $dis['productcomments']=$productcomments;
        $this->load->view('admin/productcomments/reply',$dis);
    }
	
    function edit($product_id,$id = 0){
        if($id == 0)
            $id = $this->input->post('commentId');
        $productcomments = new Productcomment($id);
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $result = array();
            if(!$productcomments->exists())
            {
                $result['status'] = false;
            }
            else
            {
                $result['status'] = true;
                $result['name'] = $productcomments->name;
                $result['title'] = $productcomments->title;
                $result['email'] = $productcomments->email;
                $result['content'] = $productcomments->content;
                $result['creationDate'] = $productcomments->creationDate;
                $result['id'] = $productcomments->id;
               
            }
        }
        else{
            $productcomments->title = $this->input->post('title');
            $productcomments->product_id = $product_id;
            $productcomments->name = $this->input->post('name');
            $productcomments->email = $this->input->post('email');
            $productcomments->content = $this->input->post('content');
            $productcomments->creationDate = $this->input->post('creationDate');
            if($productcomments->creationdate  == "" )
            {
                $productcomments->creationDate = date("Y-m-d H:i:s");
            }
            if($productcomments->save())
            {
                $result =array('status'=>"true"); 
            }
            else
            {
                $result =array('status'=>"false"); 
            }
            
        }   
         echo  json_encode($result);
         exit;    
        
    }
    function delete($id=0){
            $productcomments = new Productcomment($id);
            if(!$productcomments->exists())
                show_404();
            $productcomments->delete();
    }
	
	function delete_on_list($id=0){
            $productcomments = new Productcomment($id);
            if(!$productcomments->exists())
                show_404();
            $productcomments->delete();
			redirect($this->admin.'productcomments/list_all/');
    }
}