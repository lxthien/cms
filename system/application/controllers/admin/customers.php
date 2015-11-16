<?php
class Customers extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>223));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_all($offset=0,$limit=20){
        $customers =new Customer();
        $searchKey = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            $searchKey = $this->input->post("search_name");
            if($searchKey!= "")
            {
                $customers->like("name","%".$searchKey."%"); 
                $customers->or_like('username',"%".$searchKey."%");
                $customers->or_like('address',"%".$searchKey."%");
                $customers->or_like('homePhone',"%".$searchKey."%");
                $customers->or_like('mobilePhone',"%".$searchKey."%");
                $customers->or_like('email',"%".$searchKey."%");
            }
        }
        
        $customers->order_by('id','desc');
        $customers->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'customers/list_all/',$customers->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']="customer/list";
        $dis['menu_active']='Khách hàng';
        $dis['title']="Danh sách khách hàng";
        $dis['searchKey'] = $searchKey;
        $dis['title_table']="Trang hiện tại:".$customers->paged->current_page.'/'.$customers->paged->total_pages;
        $dis['customers']=$customers;
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $customer=new customer($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $customer->name=$this->input->post('name');
               $customer->address=$this->input->post('address');
               $customer->username=$this->input->post('username');
               $customer->homePhone=$this->input->post('homePhone');
               $customer->mobilePhone=$this->input->post('mobilePhone');
               $customer->email=$this->input->post('email');
               $customer->username=$this->input->post('username');
              
               if($this->input->post('password') != "")
               {
                   if( $this->input->post('password') == $this->input->post('confirmPassword'))
                   {
                        $customer->password=md5($this->input->post('password'));
                        if($customer->save())
                           {
                                redirect($this->admin.'customers/edit/'.$customer->id);
                           }
                   }else
                   {
                        flash_message("error","Xác nhận mật khẩu phải giống mật khẩu");
                   }
               }else
               {
                    if($customer->save())
                           {
                                redirect($this->admin.'customers/edit/'.$customer->id);
                           }
               }
               
        }
        setPagination($this->admin.'carts/list_all/',1,100000000,4);
        $dis['carts'] = $customer->cartitem;
       $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>$this->admin.'customers/list_all/',
    				"onclick"=>""		
    			)
         );
         $dis['title_table']="Danh sách đơn hàng ";
        $dis['base_url']=base_url();
        $dis['title']="Menu";
        $dis['menu_active']="Khách hàng";
        $dis['view']="customer/edit";
        $dis['object']=$customer;
        $this->viewadmin($dis);
    }
    function active($id){
        $customers =new Customer($id);
        if(!$customers->exists()){
            show_404();
        }
        $customers->active = ($customers->active + 1)%2;
        if($customers->save()){
            flash_message('success', 'Thành công. Thao tác đã được thực hiện');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    function delete($id){
        $this->checkRole(array(1));
        $customers =new Customer($id);
        if(!$customers->exists()){
            show_404();
        }
        if($customers->delete()){
            flash_message('success', 'Thành công. Đối tượng đã được xóa');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
?>