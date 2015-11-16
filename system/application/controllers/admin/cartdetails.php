<?php
class Cartdetails extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>203));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_by_parent($id, $customer_id){
        $cartdetails =new Cartdetail();
        $cartdetails->order_by('id','desc');
        $cartdetails->where('cart_id', $id);
        $cartdetails->get();
        $customers = new Customer($customer_id);
        $customers->order_by('id', 'asc');
        $customers->where('id', $customer_id);
        $customers->get();
        $dis['base_url']=base_url();
        $dis['view']="cartdetail/listbyparent";
        $dis['menu_active']='Giỏ hàng';
        $dis['title']="Chi tiết giỏ hàng";
        $dis['title_customer']="Thông tin khách hàng";
        $dis['cartdetails']=$cartdetails;
        $dis['customers']=$customers;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/list_all/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
}
?>