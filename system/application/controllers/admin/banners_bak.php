<?php
class Banners extends MY_Controller{
    public function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_all($offset=0,$limit=5){
        $banners = new Banner();
        $banners->order_by('id', 'desc');
        $banners->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'banners/list_all/',$banners->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='banners/list';
        $dis['menu_active']="Banner top";
        $dis['title_table']="Trang hiện tại:".$banners->paged->current_page.'/'.$banners->paged->total_pages;
        $dis['title']="Danh sách banner";
        $dis['banners'] = $banners;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}banners/edit",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id = 0){
        $banners = new Banner($id);
        if($_SERVER['REQUEST_METHOD']=='GET'){
            
        }
        else{
            $this->load->library('file_lib');
            $dataupload=$this->file_lib->upload('image',"img/banner");
            if(!is_array($dataupload)){
                flash_message('error',"Hình ảnh :".$dataupload);
                $flag_error= true;
            }
            else{
                $banners-> productscatalogue_id = $this->input->post('productscatalogue_id');
                $banners-> name = $this->input->post('name');
                $banners-> size = $dataupload['file_size'];
                $banners-> image = $dataupload['file_name'];
                $banners-> active = 0;
                if($banners->save()){
                    flash_message('success', 'Thành công. Thao tác đã được thực hiện.');
                    redirect($this->admin.'banners/list_all/');
                }
            }
        }
        $productcatalogues = new Productscatalogue();
        $productcatalogues->order_by('id', 'desc');
        $productcatalogues->get()->all;
        $dis['base_url']=base_url();
        $dis['view']='banners/edit';
        $dis['checked'] = 'checked=""';
        $dis['object'] = $banners;
        $dis['productcatalogues']=$productcatalogues;
        $dis['menu_active']="Banner top";
        $dis['title_table']="Trang hiện tại:".$banners->paged->current_page.'/'.$banners->paged->total_pages;
        $dis['title']="Thêm / sửa banner";
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}banners/list_all",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function active($id){
        $banners = new Banner($id);
        if(!$banners->exists()){
            show_404();
        }
        $banners->active = ($banners->active+1)%2;
        if($banners->save()){
            flash_message('success', 'Thành công. Thao tác đã được thực hiện.');
            redirect($this->admin.'banners/list_all/');
        }
    }
    function delete($id){
        $banners = new Banner($id);
        if(!$banners->exists()){
            show_404();
        }
        if($banners->delete()){
            flash_message('success', 'Thành công. Thao tác đã được thực hiện.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
?>