<?php 
class Cart extends MY_Controller{
   
    function Cart()
    {
        parent::__construct();
        $this->menu_active = "";
        $this->isCache = false;
        $this->isRobotFollow =false;
    }
    
    function getCartCookie(){
        $cart = $this->input->cookie('userCart');
        
        $cartDetail = json_decode($cart,true);
        $cartReturn = array();
        return $cartDetail;
    }
    
    function showCart()
    {
        $step = 1;
    
        if($this->uri->segment(2,"") != "")
        {
            $stepStr = $this->uri->segment(2,"");
            $stepStr = explode("-",$stepStr);
            $step = $stepStr[1];
            if($step != '2' && $step != '3')
            {
                show_404();
            }
            if(!$this->_checkLogin())
            {
                redirect('dang-nhap/'.'gio-hang/buoc-'.$step );
            }
        }
        //get product from cookie
        $cartDetail = $this->getCartCookie();
        $product = new product();
        $productList = array(0);
        
        $store = new store();
        $store->get_iterated();
        
        $dis['store'] = $store;
        
        
        foreach($cartDetail as $key => $value)
        {
            array_push($productList,$key);
        }
        
        $product->where_in('id',$productList);
        $product->get();
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cart = new Cartitem();
            $cart->customer_id = $this->customer->id;
            $cart->shipType = $this->input->post('receiveType');
            $cart->paymentType = $this->input->post('payment');
            $cart->deliverStore_id = $this->input->post('branchReceive');
            $cart->paymentStore_id = $this->input->post('branchPayment');
            $cart->shipName = $this->input->post('info_name');
            $cart->shipEmail = $this->input->post('info_email');
            $cart->shipPhone = $this->input->post('info_phone');
            $cart->shipDescription = $this->input->post('info_description');
            $cart->shipAddress = $this->input->post('info_address');
            $cart->status = enum::CART_WAIT_FOR_PROCESS;
            $cart->save();
            
            $sum = 0;
            foreach($product as $row):
                $cartDetailItem = new Cartdetail();
                $cartDetailItem->cartitem_id = $cart->id;
                $cartDetailItem->product_id = $row->id;
                $cartDetailItem->quantity = $cartDetail[$row->id];
                $cartDetailItem->price = $row->getRealPriceNum();
                $cartDetailItem->productName = $row->name;
                $cartDetailItem->inBox = $row->inBox;
                $cartDetailItem->status = enum::CARTDETAIL_AVAILABLE;
                $cartDetailItem->save();
                $cartDetailItem->clear();
                
                $itemTotal = $cartDetail[$row->id]*$row->getRealPriceNum(); 
                $sum += $itemTotal;
            endforeach;
            
            $cart->total = $sum;
            $cart->save();
            
            $this->sendMailCustomer($cart->id);
            $this->sendMailCustomerService($cart->id);
            //save cart detail
            setcookie("userCart",json_encode(array()), mktime(). time()+60*60*24*7,"/" );
            
            
            
            $dis['view'] = 'cart/cart4';
        }
        else
        {
            $dis['step'] = $step;
            $dis['product'] = $product;
            $dis['cartDetail'] = $cartDetail;
            $dis['view'] = 'cart/cart1';
        }
        
        $dis['base_url'] = base_url();
        $this->viewfront($dis);
    }
    
    function addCart()
    {
        $cartAdd = $this->uri->segment(2);
        $cartAddList = explode("-",$cartAdd);
        
        $cartDetail = $this->getCartCookie();
        
        foreach($cartAddList as $row)
        {
            if(is_array($cartDetail) && array_key_exists($row,$cartDetail))
            {
                $cartDetail[$row]++;
            }else
            {
                $cartDetail[$row] = 1 ;
            }
        }
        setcookie("userCart",json_encode($cartDetail),  time()+60*60*24*7,"/" );
       

        
        redirect('gio-hang');
    }
    function updateCart()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data = $this->input->post('sentData');
            $realData  = json_decode($data,true);
            $cartDetail = $this->getCartCookie();
            foreach($realData as $row){
                if(array_key_exists($row['id'],$cartDetail))
                {
                    $cartDetail[$row['id']] = $row['value'];
                }
            }
            setcookie("userCart",json_encode($cartDetail),  time()+60*60*24*7,"/" );
        }
        else
        {
            show_404();
        }
        exit();
        
    }
    
    function deleteCart()
    {
        $cartAdd = $this->uri->segment(2);
        $cartAdd = rtrim($cartAdd,"-");
        $cartAddList = explode("-",$cartAdd);
        
        $cartDetail = $this->getCartCookie();
        
        foreach($cartAddList as $row)
        {
            if(array_key_exists($row,$cartDetail))
            {
                unset($cartDetail[$row]);
            }
        }
       setcookie("userCart",json_encode($cartDetail),  time()+60*60*24*7,"/" );
        echo 'true';
        exit;
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
        
        $emailContent = $this->load->view('admin/cart/emailPreviewFrontend',$dis,TRUE);
        $emailSubject = "didongviet.vn - Bạn đã đặt hàng thành công vào lúc ".date("d-m-Y h:i");
        
        $this->_send_email("myemail",$emailSubject,$emailContent,$cart->customer->email);
    }
    
    
    function sendMailCustomerService($id)
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
       
                
       
        $emailContent = $this->load->view('admin/cart/emailPreviewCustomerService',$dis,TRUE);
        $emailSubject = "didongviet.vn - Có đơn đặt hàng mới từ ".$cart->customer->name." vào lúc ".date("d-m-Y h:i");
        //load email customer service
        $customerServiceEmail = getconfigkey('customerServiceEmail');
        if(trim($customerServiceEmail)!="")
            $this->_send_email("myemail",$emailSubject,$emailContent,$customerServiceEmail);
    }
    
    
}