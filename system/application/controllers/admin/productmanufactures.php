<?php
class Productmanufactures extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_all($offset=0,$limit=40){
        $productmanufactures = new Productmanufacture();
        $dis['title']="Tất cả nhà sản xuất/thương hiệu";
        $searchKey = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $productmanufactures->like("name",$searchKey);
            $dis['title']="Kết quả tìm kiếm";
        }
        $productmanufactures->order_by('name','asc');
        $productmanufactures->where('recycle', 0);
        $productmanufactures->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'productmanufactures/list_all/',$productmanufactures->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='productmanufactures/list';
        $dis['productmanufactures']=$productmanufactures;
        $dis['menu_active']="Nhà sản xuất";
        $dis['title_table']="Trang hiện tại:".$productmanufactures->paged->current_page.'/'.$productmanufactures->paged->total_pages;
        $dis['searchKey'] = $searchKey;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}productmanufactures/edit",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0){
        $productmanufacture=new Productmanufacture($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else{
            $this->load->library('file_lib');  
            $productmanufacture->name = $this->input->post('name');
            $productmanufacture->description = $this->input->post('description');
            $productmanufacture->country = $this->input->post('country');
            $productmanufacture->recycle=0;
            $productmanufacture->isShow = $this->input->post('isShow');
            if($_FILES['logo']['name'] != "")
               {
                    $dataupload=$this->file_lib->upload('logo', 'img/manufacture/');   
                    if(is_array($dataupload)){    
                        $productmanufacture->image = 'img/manufacture/' . $dataupload['file_name'];
                    } else{
                         flash_message('error',$dataupload);
                    }
               }
            if($productmanufacture->save()){
                flash_message('success','Thành công. Thao tác đã được thực hiện.');
                redirect($this->admin.'productmanufactures/edit/'.$productmanufacture->id);
            }
        }
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa nhà sản xuất";
        $dis['menu_active']="Nhà sản xuất";
        $dis['view']="productmanufactures/edit";
        $dis['object'] = $productmanufacture;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>base_url().'admin/productmanufactures/list_all',
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function delete($id){
        if($id!=0){
            $productmanufacture=new Productmanufacture($id);
            $productmanufacture->recycle=1;
            if($productmanufacture->save()){
                flash_message('success','Thành công. Đối tượng đã được xóa.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else{
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
                $productmanufacture = new Productmanufacture($row);
                $productmanufacture->recycle=1;
                $productmanufacture->save();  
                flash_message('success','Thành công. Các đối tượng đã được xóa.');
                redirect($_SERVER['HTTP_REFERER']);     
            }
        }
    }
}
?>