<?php
class Carts extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>203));
        $this->load->library('login_manager');
    }
    function index(){
        $this->list_all();
    }
    function list_all($searchKey = "%20",$cartStatus = 0,$offset=0,$limit=20){
        $carts =new Cartitem();
        if($_SERVER['REQUEST_METHOD']=="POST"){    
            $searchKey = $this->input->post("search_name");
            $cartStatus = $this->input->post('cartStatus');
            redirect("admin/carts/list_all/".urlencode(htmlentities($searchKey))."/".$cartStatus);
        }
        $searchKey =  html_entity_decode(urldecode($searchKey));
        if(trim($searchKey) != "")
        {
            $customers =new Customer();
            $customers->like("name","%".$searchKey."%"); 
            $customers->or_like('username',"%".$searchKey."%");
            $customers->or_like('address',"%".$searchKey."%");
            $customers->or_like('homePhone',"%".$searchKey."%");
            $customers->or_like('mobilePhone',"%".$searchKey."%");
            $customers->or_like('email',"%".$searchKey."%");
            $customers->order_by('id','desc');
            $customers->get_iterated();
            $cusArr = array(0);
            foreach($customers as $row)
            {
                array_push($cusArr,$row->id);
            }
            //$carts->like('code',"%".$searchKey."%");
            $carts->where_in('customer_id',$cusArr);
        }
        if($cartStatus != 0)
        {
            $carts->where('status',$cartStatus);
        }
        $carts->order_by('id','desc');
        $carts->get_paged($offset,$limit,TRUE);
        
        setPagination($this->admin.'carts/list_all/'.urlencode(htmlentities($searchKey))."/".$cartStatus,$carts->paged->total_rows,$limit,6);
        
        $dis['base_url']=base_url();
        $dis['view']="cart/list";
        $dis['searchKey'] = $searchKey;
        $dis['cartStatus'] = $cartStatus;
        $dis['menu_active']='Giỏ hàng';
        $dis['title']="Danh sách đơn hàng";
        $dis['title_table']="Tìm được ".$carts->paged->total_rows." kết quả. Trang hiện tại:".$carts->paged->current_page.'/'.$carts->paged->total_pages;
        $dis['carts']=$carts;
        $this->viewadmin($dis);
    }
    
    
    function sendMailCustomerStep1($id)
    {
        $cart = new Cartitem($id);
        if(!$cart->exists())
            show_404();
        $cartDetail = $cart->cartdetail;
        $dis['menu_active']='Giỏ hàng';
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['title']="Xem trước email cho đơn hàng ".$cart->code;
        $dis['base_url']= base_url();
        $dis['view'] = 'cart/emailPreview';
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/edit/".$id,
    				"onclick"=>""		
    			));
        $this->load->view('admin/cart/emailPreview',$dis);
    }
    
    
    
    function sendMailCustomer($id)
    {
        $cart = new Cartitem($id);
        if(!$cart->exists())
            show_404();
        $cartDetail = $cart->cartdetail;
        $dis['menu_active']='Giỏ hàng';
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['title']="Xem trước email cho đơn hàng ".$cart->code;
        $dis['base_url']= base_url();
        $dis['view'] = 'cart/emailPreview';
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/edit/".$id,
    				"onclick"=>""		
    			));
        $this->load->view('admin/cart/emailPreviewFrontend',$dis);
    }
    
    
    function sendMailStore($id)
    {
        $cart = new Cartitem($id);
        if(!$cart->exists())
            show_404();
        $cartDetail = $cart->cartdetail;
        $dis['menu_active']='Giỏ hàng';
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['title']="Xem trước email cho đơn hàng ".$cart->code;
        $dis['base_url']= base_url();
        $dis['view'] = 'cart/emailPreview';
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/edit/".$id,
    				"onclick"=>""		
    			));
        $this->load->view('admin/cart/emailPreviewStore',$dis);
    }
    
    function addDetail($cartId)
    {
        $cart = new cartitem($cartId);
        $arr=$this->input->post('productCheck');
        if($arr != "")
        {
            foreach($arr as $row){
               $product=new Product($row);
               $cartDetailItem = new Cartdetail();
                $cartDetailItem->cartitem_id = $cart->id;
                $cartDetailItem->product_id = $product->id;
                $cartDetailItem->quantity = 1;
                $cartDetailItem->price = $product->getRealPriceNum();
                $cartDetailItem->productName = $product->name;
                $cartDetailItem->status = enum::CARTDETAIL_AVAILABLE;
                $cartDetailItem->save();
                $cartDetailItem->clear();
               
               $product->clear();    
            } 
        }
        $cartDetail = $cart->cartdetail;
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['base_url'] = base_url();
        echo $this->load->view('admin/cart/listDetail',$dis,true);
        exit;
    }
    
    function deleteDetail($cartId)
    {
        $cart = new cartitem($cartId);
        $detailId =$this->input->post('detailId');
        $detail = new Cartdetail($detailId);
        if(!$detail->exists())
            show_404();
        $detail->delete();
        
        $cartDetail = $cart->cartdetail;
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['base_url'] = base_url();
        echo $this->load->view('admin/cart/listDetail',$dis,true);
        exit;
    }
    function sendMailCustomerStep2($id)
    {
        $cart = new Cartitem($id);
        if(!$cart->exists())
            show_404();
        $cartDetail = $cart->cartdetail;
        $dis['menu_active']='Giỏ hàng';
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['title']="Xem trước email cho đơn hàng ".$cart->code;
        $dis['base_url']= base_url();
        $dis['view'] = 'cart/emailPreview';
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/edit/".$id,
    				"onclick"=>""		
    			));
        $emailContent = $this->load->view('admin/cart/emailPreview',$dis,TRUE);
        $emailSubject = "didongviet.vn - Thông báo thanht toán đơn hàng";
        
        $this->_send_email("myemail",$emailSubject,$emailContent,$cart->customer->email);
        $cart->status = enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER;
        $cart->save();
        flash_message("success","Gửi email thành công !");
        redirect('admin/carts/edit/'.$id);
    }
    
    function edit($id)
    {
        $cart = new Cartitem($id);
        if(!$cart->exists())
            show_404();
        
        $cartDetail = $cart->cartdetail;
        
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $cart->status = $this->input->post('cartStatus');
            $cart->description = $this->input->post('description');
            $cart->dateDeliver = $this->input->post('dateDeliver');
            $cart->prePaid = $this->input->post('prePaid');
            $cart->taxInfo = $this->input->post('taxInfo');
            $cart->linkOnline = $this->input->post('linkOnline');
            $cart->total = $this->input->post('hiTotal');
            
            
            
            $cart->shipType = $this->input->post('deliverMethod');
            $cart->paymentType = $this->input->post('payment');
            $cart->deliverStore_id = $this->input->post('branchReceive');
            $cart->paymentStore_id = $this->input->post('branchPayment');
            $cart->shipName = $this->input->post('info_name');
            $cart->shipEmail = $this->input->post('info_email');
            $cart->shipPhone = $this->input->post('info_phone');
            $cart->shipDescription = $this->input->post('info_description');
            $cart->shipAddress = $this->input->post('info_address');
            
            
            $cart->save();
            foreach($cartDetail as $row)
            {
                $row->status = $this->input->post('cartDetailStatus_'.$row->id);
                $row->quantity = $this->input->post('cartDetailQuantity_'.$row->id);
                $row->inBox = $this->input->post('cartDetailInbox_'.$row->id);
                $row->price = $this->input->post('cartDetailPrice_'.$row->id);
                $row->save();
                $row->clear();
            }
            redirect('admin/carts/edit/'.$id);
        }
        
        $store = new store();
        $store->order_by('id','asc');
        $store->get_iterated();
        $dis['store'] = $store;
        $dis['menu_active']='Giỏ hàng';
        $dis['cartdetail'] = $cartDetail;
        $dis['object'] = $cart;
        $dis['cart'] = $cart;
        $dis['title']="Chi tiết đơn hàng";
        $dis['base_url']= base_url();
        $dis['view'] = 'cart/edit';
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}carts/list_all/",
    				"onclick"=>""		
    			));
        $this->viewadmin($dis);
        
        
    }
    
    
    function delete($id)
    {
        $this->checkRole(array(1));
        
        $cart = new cartitem($id);
        $cart->cartdetail->delete_all();
        $cart->delete();
        redirect('admin/carts');
    }
}