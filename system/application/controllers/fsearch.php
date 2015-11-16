<?php
class fsearch extends MY_Controller{
    var $menu_active = "project";
     var $submenu_active = "";
    
    function __construct()
    {
        parent::__construct();
       
    }
      function getOrderBy($inp)
    {
        switch($inp)
        {
            case "moi-nhat": return "id";
            case "gia-giam-dan": return "price";
            case "gia-tang-dan": return "price";
            default: return "id";
        }
    }
    
    function getOrderDirection($inp)
    {
        switch($inp)
        {
            case "moi-nhat": return "desc";
            case "gia-giam-dan": return "desc";
            case "gia-tang-dan": return "asc";
            default: return "desc";
        }
    }
    function getPageNumber($inp)
    {
        $arr = explode("-",$inp);
        return $arr[1];
    }
    
    function ajaxSearch()
    {
        
    }
    
    function search()
    {
        $viewMode = $this->uri->segment(2,"") == ""?"ma-tran":$this->uri->segment(2);
        $orderBy = $this->uri->segment(3,"") == ""?"moi-nhat":$this->uri->segment(3);
        $page = $this->uri->segment(4,"") == "" ? "trang-1":$this->uri->segment(4);
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $searchKey = $this->input->post('searchKey');
            $this->session->set_userdata('searchKey',$searchKey);
        }
        $searchKey = $this->session->userdata('searchkey');
        
        
        $limit = $viewMode == "ma-tran"?15:10;
        $offset = ( $this->getPageNumber($page) - 1)*$limit;
        
        
        $product = new Product();
        if(trim($searchKey) != "")
        {
            $product->like('name',$searchKey);
        }
        $product->where('active',1);
        $product->order_by($this->getOrderBy($orderBy),$this->getOrderDirection($orderBy));
        $product->get_paged_iterated();
        $dis['product'] = $product;
        
        
        $dis['pageUrl'] = "tim-kiem";
        $config['base_url'] = site_url($url."/".$viewMode."/".$orderBy."/trang-");
        $config['total_rows'] = $product->paged->total_rows;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']          =     4;
        $config['num_links']            = 3;
        $config['full_tag_open']		= '<span class="pagin">';
        $config['full_tag_close']		= "</span>";
       	$config['first_link'] 			= FALSE;
    	$config['first_tag_open']		= '';
    	$config['first_tag_close']		= '';
    	$config['last_link'] 			= FALSE;
    	$config['last_tag_open'] 		= '';
    	$config['last_tag_close'] 		= '';
    	$config['next_link']			= '<img src="'.base_url().'images/pagination_next.png" />';
    	$config['next_tag_open'] 		= '';
    	$config['next_tag_close'] 		= '';
    	$config['prev_link'] 			= '<img src="'.base_url().'images/pagination_pre.png" /';
    	$config['prev_tag_open'] 		= '';
    	$config['prev_tag_close'] 		= '';
    	$config['num_tag_open'] 		= '';
    	$config['num_tag_close'] 		= '';
    	$config['cur_tag_open'] 		= '<span class="active">';
    	$config['cur_tag_close']		= '</span>';
        
        $this->pagination->initialize($config);      
        
        if($viewMode == 'ma-tran')
            $dis['view']='product/product_grid';
        else
            $dis['view']='product/product_list';
                 
        
        $productSaleOff = new product();
        $productSaleOff->where('active',1);
        $productSaleOff->where('isSale',1);
        $productSaleOff->order_by('id','desc');
        $productSaleOff->get_iterated(15);
        
        $dis['productSaleOff'] = $productSaleOff;
        
        
        $dis['base_url']=base_url();
        
		$this->viewfront($dis);
        
    }
    
}