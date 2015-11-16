<?php
class Productstatus extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_all($offset=0,$limit=5){
        $productstatus = new Productstatu();
        $productstatus->order_by('position','asc');
        $productstatus->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'productstatus/list_all/',$productstatus->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='productstatus/list';
        $dis['productstatus']=$productstatus;
        $dis['menu_active']="Trạng thái sản phẩm";
        $dis['title_table']="Trang hiện tại:".$productstatus->paged->current_page.'/'.$productstatus->paged->total_pages;
        $dis['title']="Danh sách trạng thái sản phẩm";
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}productstatus/edit",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id){
        $productstatus = new Productstatu($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else{
            $productstatus->name = $this->input->post('name');
            $productstatus->description = $this->input->post('description');
            if($productstatus->save()){
                flash_message('success','Thành công. Thao tác đã được thực hiện.');
                redirect($this->admin.'productstatus/list_all/');
            }
        }
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa trạng thái sản phẩm";
        $dis['menu_active']="Trạng thái sản phẩm";
        $dis['view']="productstatus/edit";
        $dis['object'] = $productstatus;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>$_SERVER['HTTP_REFERER'],
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function delete($id){
        if($id!=0){
            $productstatus = new Productstatu($id);
            if($productstatus->delete()){
                flash_message('success','Thành công. Đối tượng đã được xóa.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else{
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
                $productstatus = new Productstatu($id);
                $productmanufacture->delete();  
                flash_message('success','Thành công. Các đối tượng đã được xóa.');
                redirect($_SERVER['HTTP_REFERER']);     
            }
        }
    }
    function up_position($id,$step=1)
    {
        $o=new Productstatu();
        $o->get_by_id($id);
        if(!$o->exists()){
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++){
            $o->up_position();
        }
      redirect($this->admin.'productstatus/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new Productstatu();
        $o->get_by_id($id);
        if(!$o->exists()){
            show_404("Không tìm thấy");
        }
       for($i=0;$i<$step;$i++){
            $o->down_position();
        }
          //  flash_message('warning','Không th? thay d?i v? trí du?c n?a ');
       redirect($this->admin.'Productstatus/list_all/');
    }
}
?>