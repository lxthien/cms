<?php
class Search extends MY_Controller{
    function __construct() {
        parent::__construct();
		$this->menu_active ="products";
        $this->load->library("pagination");
    }
    
    
    function index() {
        if( getconfigkey('isBothProductAndNews') == 1) {
            $segment1 = $this->uri->segment(1,"");
            $product = new Product();
            $product->where('url',$segment1);
            $product->get();
            if($product->exists())
            {
                $this->detail();
            }else
            {
                $productcat1 = new Productcat();
                $productcat1->where("url",$segment1);
                $productcat1->get();
                if($productcat1->exists())
                {
                    $segment2 = $this->uri->segment(2,"");
                    $productCat2 = new Productcat();
                    $productCat2->where('url',$segment2);
                    $productCat2->get();
                    
                    if($productCat2->exists())
                    {
                        $segment3 = $this->uri->segment(3,"");
                        $productCat3 = new Productcat();
                        $productCat3->where('url',$segment3);
                        $productCat3->get();
                        
                        if($productCat3->exists())
                        {
                            $this->productCat(3);
                        }
                        else
                        {
                            $this->productCat(2);
                        }
                              
                    }
                    else
                    {
                        $this->productCat(1);
                    }
                }else
                { 
                   // Set action for news.
                    if( strpos($this->uri->uri_string, '.html') ){
                        $title_none = gettitlenonefromlink(get_url($this->uri->uri_string));
                        $this->newsDetail($title_none);
                    }else{
                        $cat = get_url($this->uri->uri_string);
                        $this->newCategory($cat);
                    }
                }
            }
        } else {
            // Set action for news.
            if( strpos($this->uri->uri_string, '.html') ){
                $title_none = gettitlenonefromlink(get_url($this->uri->uri_string));
                $this->newsDetail($title_none);
            }else{
                $cat = get_url($this->uri->uri_string);
                $this->newCategory($cat);
            }
        }
    }
    
    /**
    * Description: get news from category
    * Return: list news for category
    */
    public function newCategory( $cat = NULL, $offset = 0, $limit = 6 ) {
        // Find offset pagination
        $offset = get_offset($this->uri->uri_string);
        
        if($cat == "dich-vu-dien-lanh") {
            $cat = "dien-lanh-dan-dung";
        }

        $category = new Newscatalogue();
        $category->where(array('name_none' => $cat))->get();
        if(!$category->exists()){
            show_404();
        }
        $dis['category'] = $category;
        
        //Category news
        $cat_news = new Article();
        $cat_news->where(array('recycle'=>0, 'active'=>1));
        $cat_news->where('newscatalogue_id', $category->id);
        $cat_news->order_by('created','desc');
        $cat_news->get_paged($offset, $limit, TRUE);
        $dis['news'] = $cat_news;

        // Pagination
        setPaginationVb(gen_seo_url($category->name_none), $cat_news->paged->total_rows, $limit, 2);
              
        //link counter
        $links_counter = new Article();
        $links_counter->where('recycle',0);
        $links_counter->where('active',1);
        $links_counter->order_by('clicks', 'DESC');
        $links_counter->get_paged(0,10,TRUE);
        $dis['links_counter'] = $links_counter;

        // Create seo for news category
        $this->page_title = $category->name_vietnamese;
        $this->page_description = $category->slogan;
        $this->page_keyword = $category->keyword;

        $dis['breadcum'] = "<span>".$category->name_vietnamese."</span>";
        $dis['base_url']=base_url();
        $dis['view']='front/news/news';
        $this->viewfront($dis) ;
    }

    /**
    * Description: Get detail news
    * Return: Object News
    */

    public function newsDetail( $title_none = NULL ) {
        $news = new Article();
        $news->where('title_none',$title_none);
        $news->get();
        if(!$news->exists()) {
            show_404();
        }
        
        // links counter
        $news->where('title_none', $title_none)->update('clicks', $news->clicks + 1);
        $dis['news'] = $news;
        
        $related_news = new Article();
        $related_news->where('recycle',0);
        $related_news->where('active',1);
        $related_news->where('newscatalogue_id',$news->newscatalogue_id);
        $related_news->where("id !=", $news->id);
        $related_news->order_by('created', 'DESC');
        $related_news->get_paged(0, 10, TRUE);
        $dis['related_news'] = $related_news;
        
        $category = new Newscatalogue();
        $category->where(array('id' => $news->newscatalogue_id))->get();

        // Create seo for news
        $this->page_title = $news->page_title;
        $this->page_description = $news->page_description;
        $this->page_keyword = $news->page_keyword;

        $dis['breadcum'] = $news->buildBreadCum();
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['base_url'] = base_url();
        $dis['view'] = 'front/news/news_de';
        $this->viewfront($dis) ;
    }
    
    function getOrderBy($inp) {
        switch($inp)
        {
            case "moi-nhat": return "updated";
            case "gia-giam-dan": return "finalPrice";
            case "gia-tang-dan": return "finalPrice";
            default: return "id";
        }
    }
    
    function choiceDetail() {
        $choiceList = $this->uri->segment(2);
        $choice = explode("-",$choiceList);
        $product = new Product();
        $product->where_in('id',$choice);
        $product->get_iterated();
        $dis['mainProduct'] = $choice[0];
        $dis['base_url'] = base_url();
        $dis['product']  = $product;
        $this->load->view('front/product/choiceList',$dis);
        
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
    
    
    function loadCompareProductSmall()
    {
        setcookie("compareProduct",$this->input->post('compareCookie'), time()+60*60*24*7,"/" );
        $compareCookie = $this->input->post('compareCookie');
        //$compareCookie = $this->input->cookie('compareProduct');
    
        $compareArray = explode(",",$compareCookie);
        array_push($compareArray,0);
        $compareProduct = new product();
        $compareProduct->where_in('id',$compareArray);
        $compareProduct->get_iterated();
        $this->compareProduct = $compareProduct;
        $dis['base_url'] = base_url();
        $this->load->view('front/includes/compareProductSmall',$dis);
    }
    function addCompareProduct()
    {
        $url = $this->uri->segment(2);
        $product = new Product();
        $product->where('url',$url);
        $product->get();
        
        $compareCookie = $this->input->cookie('compareProduct');
        $compareArray = explode(",",$compareCookie);
        array_push($compareArray,$product->id);
        
        $compare = implode(",",$compareArray);
        setcookie("compareProduct",$compare, time()+60*60*24*7,"/" );
        redirect("so-sanh");
        
    }
    
    function getPageNumber($inp)
    {
        $arr = explode("-",$inp);
        return $arr[1];
    }
    
    function advangeSearch()
    {
        $viewMode = $this->uri->segment(2,"") == ""?"ma-tran":$this->uri->segment(2);
        $orderBy = $this->uri->segment(3,"") == ""?"moi-nhat":$this->uri->segment(3);
        $page = $this->uri->segment(4,"") == "" ? "trang-1":$this->uri->segment(4);
        $dis['viewMode'] = $viewMode;
        $dis['orderBy'] = $orderBy;
        $dis['page'] = $page;
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $searchKey = $this->input->post('searchKey');
            $this->session->set_userdata('searchKey',$searchKey);
        }
        $searchKey = $this->session->userdata('searchKey');
    
        
        $limit = $viewMode == "ma-tran"?15:10;
        $offset = ( $this->getPageNumber($page) - 1)*$limit;
        
        
        $product = new Product();
        if(trim($searchKey) != "")
        {
            $product->like('name',$searchKey);
        }
        $product->where('active',1);
        $product->order_by($this->getOrderBy($orderBy),$this->getOrderDirection($orderBy));
        $product->get_paged_iterated($offset,$limit,TRUE);
        $dis['product'] = $product;
        
        $url= "tim-nang-cao";
        $dis['pageUrl'] = "tim-nang-cao/";
        $dis['url'] = "tim-nang-cao/";
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
        $productSaleOff->get_iterated(20);
        
        $dis['productSaleOff'] = $productSaleOff;
        
        
        $dis['base_url']=base_url();
        
		$this->viewfront($dis);
    }
    
    /**
     * fproduct::getListId()
     * get list of id from list of object
     * @param mixed $list
     * @return
     */
    function getListId($list)
    {
        $listIntChildCat = array();
        foreach($list as $row)
        {
            array_push($listIntChildCat,$row->id);
            //array_push($listNameChildCat,$row->name);
        } 
        return $listIntChildCat;
    }
    
    function ajaxSearch(){
        $dis['base_url']=base_url();
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $searchKey = $this->input->post('searchKey');
            //find dien thoai & mtb
            $phoneCat = new productcat($this->config->item('catPhoneId'));
            $phoneChildCat = $this->getListId($phoneCat->getAllChildCat());
            
            $tabletCat = new productcat($this->config->item('catTabletId'));
            $tabletChildCat = $this->getListId($tabletCat->getAllChildCat());
            
            $phoneTabletCat = array_merge($phoneChildCat,$tabletChildCat);
            
            $phoneTabletProduct = new product();
            $phoneTabletProduct->distinct();
            $phoneTabletProduct->group_start();
            $phoneTabletProduct->like('name',$searchKey);
            $phoneTabletProduct->or_like('searchKey',$searchKey);
            $phoneTabletProduct->group_end();            
            $phoneTabletProduct->where_in_related_productcat('id',$phoneTabletCat);
            $phoneTabletProduct->where('active',1);
            $phoneTabletProduct->order_by('id','desc');
            $phoneTabletProduct->group_by('id');
            $phoneTabletProduct->get_iterated(10);
            
            $dis['phoneTabletProduct'] = $phoneTabletProduct;
            
            //find accessory with the searchkey condition
            $accessoryCat = new productcat();
            $accessoryCat->where_in('id',$this->config->item('allAccessoriesId'));
            $accessoryCat->get_iterated();
            $accessoryChildCat = array();
            foreach($accessoryCat as $row)
            {
                $accessoryChildCat =  array_merge($accessoryChildCat,$this->getListId($row->getAllChildCat()));
            }
            
            $accessoryProduct = new product();
            $accessoryProduct->distinct();
            $accessoryProduct->group_start();
            $accessoryProduct->like('name',$searchKey);
            $accessoryProduct->or_like('searchKey',$searchKey);
            $accessoryProduct->group_end();   
            $accessoryProduct->where_in_related_productcat('id',$accessoryChildCat);
            $accessoryProduct->where('active',1);
            $accessoryProduct->order_by('id','desc');
            $accessoryProduct->get_iterated(10);
            
            $dis['accessoryProduct'] = $accessoryProduct;
            
            
            //find the new by keyword
            $newCat = array(58,59,60,61,62,64);
            $newsResult =  new article();
            $newsResult->where_in('newscatalogue_id',$newCat);
            $newsResult->like('title_vietnamese',$searchKey);
            $newsResult->where('active',1);
            $newsResult->where('recycle',0);
            $newsResult->order_by('id','desc');
            $newsResult->get_iterated(10);
            $dis['newsResult'] = $newsResult;
            
            $dis['searchKey'] = $searchKey;
            
            
        }
        else
        {
            show_404();
        }
        $this->load->view('front/product/ajaxSearch',$dis);
    }
    
    
    
    
    
    function searchKey()
    {
        if($_SERVER['REQUEST_METHOD']=="POST") {
            $searchKey = $this->input->post('keyword');
            $searchType = $this->input->post('type');
            redirect("tim-kiem?q=".urlencode(htmlentities($searchKey)).'&type='.urlencode(htmlentities($searchType)));
        }


        parse_str(array_pop(explode('?', $_SERVER['REQUEST_URI'], 2)), $_GET);

        $searchKey = $_GET['q'];
        $viewType = $_GET['type'];

        $page = $this->uri->segment(4,"trang-1");
        $limitProduct = 50;
        $limitNews = 10;
        $dis['page'] = $page;
        $searchKeyEncode = $searchKey;
        $searchKey = html_entity_decode(urldecode($searchKey));
                
        if($searchKey == "") {
            $resultStatus = false;
        }
        
        if($viewType == 81 || $viewType == 300 || $viewType == 301) {

            $resultStatus = true;

            $productCat = new Productcat($viewType);
            $productChildCat = $this->getListId($productCat->getAllChildCat());
            
            $product = new product();
            $product->distinct();
            $product->group_start();
            $product->like('name',$searchKey);
            $product->group_end();  
            $product->where_in_related_productcat('id', $productChildCat);
            $product->where('active',1);
            $product->order_by('id','desc');
            $product->group_by('id');
            $product->get_iterated(10);
            $dis['product'] = $product;
            
            //find accessory with the searchkey condition
            /*$accessoryCat = new productcat();
            $accessoryCat->where_in('id',$this->config->item('allAccessoriesId'));
            $accessoryCat->get_iterated();
            $accessoryChildCat = array();
            foreach($accessoryCat as $row)
            {
                $accessoryChildCat =  array_merge($accessoryChildCat,$this->getListId($row->getAllChildCat()));
            }
            
            $accessoryProduct = new product();
            $accessoryProduct->distinct();
            $accessoryProduct->group_start();
            $accessoryProduct->like('name',$searchKey);
            $accessoryProduct->or_like('searchKey',$searchKey);
            $accessoryProduct->group_end();  
            $accessoryProduct->where_in_related_productcat('id',$accessoryChildCat);
            $accessoryProduct->where('active',1);
            $accessoryProduct->group_by('id');
            $accessoryProduct->order_by('id','desc');
            $accessoryProduct->get_iterated(10);
            
            $dis['accessoryProduct'] = $accessoryProduct;*/
            
            
            //find the new by keyword
            /*$newCat = array(58,59,60,61,62,64);
            $newsResult =  new article();
            $newsResult->where_in('newscatalogue_id',$newCat);
            $newsResult->like('title_vietnamese',$searchKey);
            $newsResult->where('active',1);
            $newsResult->where('recycle',0);
            $newsResult->order_by('id','desc');
            $newsResult->get_iterated(10);
            $dis['newsResult'] = $newsResult;*/
        }
     
        if($viewType == "dien-thoai-may-tinh-bang") {
            $resultStatus = true;
            //find dien thoai & mtb
            $phoneCat = new productcat($this->config->item('catPhoneId'));
            $phoneChildCat = $this->getListId($phoneCat->getAllChildCat());
            
            $tabletCat = new productcat($this->config->item('catTabletId'));
            $tabletChildCat = $this->getListId($tabletCat->getAllChildCat());
            
            $phoneTabletCat = array_merge($phoneChildCat,$tabletChildCat);
            $offset = ( $this->getPageNumber($page) - 1)*$limitProduct;    
            $phoneTabletProduct = new product();
            $phoneTabletProduct->distinct();
            $phoneTabletProduct->group_start();
            $phoneTabletProduct->like('name',$searchKey);
            $phoneTabletProduct->or_like('searchKey',$searchKey);
            $phoneTabletProduct->group_end(); 
            $phoneTabletProduct->where_in_related_productcat('id',$phoneTabletCat);
            $phoneTabletProduct->where('active',1);
            $phoneTabletProduct->order_by('id','desc');
            $phoneTabletProduct->group_by('id');
            $phoneTabletProduct->get_paged_iterated($offset,$limitProduct);
            $dis['phoneTabletProduct'] = $phoneTabletProduct;
            $dis['view'] = 'product/search_product';
                              
            $url= "tim-kiem/".$searchKeyEncode.'/dien-thoai-may-tinh-bang';
            
            $dis['url'] =$url;
            $config['base_url']             = site_url($url."/trang-");
            $config['total_rows']           = $phoneTabletProduct->paged->total_rows;
            $config['per_page']             = $limitProduct;
            $config['use_page_numbers']     = TRUE;
            $config['uri_segment']          = 4;
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
        	$config['cur_tag_open'] 		= '<span class="active fl">';
        	$config['cur_tag_close']		= '</span>';
        
            $this->pagination->initialize($config);      
        }
        
        
        if($viewType == "phu-kien") {
            $resultStatus = true;
            //find dien thoai & mtb
            $phoneCat = new productcat($this->config->item('catPhoneId'));
            $phoneChildCat = $this->getListId($phoneCat->getAllChildCat());
            
            $tabletCat = new productcat($this->config->item('catTabletId'));
            $tabletChildCat = $this->getListId($tabletCat->getAllChildCat());
            
            $phoneTabletCat = array_merge($phoneChildCat,$tabletChildCat);
            $offset = ( $this->getPageNumber($page) - 1)*$limitProduct;    
        
            
            
            
            //find accessory with the searchkey condition
            $accessoryCat = new productcat();
            $accessoryCat->where_in('id',$this->config->item('allAccessoriesId'));
            $accessoryCat->get_iterated();
            $accessoryChildCat = array();
            foreach($accessoryCat as $row)
            {
                $accessoryChildCat =  array_merge($accessoryChildCat,$this->getListId($row->getAllChildCat()));
            }
            //$this->firephp->log($accessoryChildCat);
            $accessoryProduct = new product();
            $accessoryProduct->distinct();
            $accessoryProduct->group_start();
            $accessoryProduct->like('name',$searchKey);
            $accessoryProduct->or_like('searchKey',$searchKey);
            $accessoryProduct->group_end(); 
            $accessoryProduct->where_in_related_productcat('id',$accessoryChildCat);
            $accessoryProduct->where('active',1);
            $accessoryProduct->group_by('id');
            $accessoryProduct->order_by('id','desc');
            $accessoryProduct->get_paged_iterated($offset,$limitProduct);
            
            $dis['accessoryProduct'] = $accessoryProduct;
            
            $dis['view'] = 'product/search_accessory';
                              
            $url= "tim-kiem/".$searchKeyEncode.'/phu-kien';
            
            $dis['url'] =$url;
            $config['base_url']             = site_url($url."/trang-");
            $config['total_rows']           = $accessoryProduct->paged->total_rows;
            $config['per_page']             = $limitProduct;
            $config['use_page_numbers']     = TRUE;
            $config['uri_segment']          = 4;
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
        	$config['cur_tag_open'] 		= '<span class="active fl">';
        	$config['cur_tag_close']		= '</span>';
        
            $this->pagination->initialize($config);      
        }
        
        
        if($viewType == "tin-tuc") {
            $resultStatus = true;
            //find dien thoai & mtb
            $phoneCat = new productcat($this->config->item('catPhoneId'));
            $phoneChildCat = $this->getListId($phoneCat->getAllChildCat());
            
            $tabletCat = new productcat($this->config->item('catTabletId'));
            $tabletChildCat = $this->getListId($tabletCat->getAllChildCat());
            
            $phoneTabletCat = array_merge($phoneChildCat,$tabletChildCat);
            $offset = ( $this->getPageNumber($page) - 1)*$limitProduct;    
        
            //find the new by keyword
            $newCat = array(58,59,60,61,62,64);
            $newsResult =  new article();
            $newsResult->where_in('newscatalogue_id',$newCat);
            $newsResult->like('title_vietnamese',$searchKey);
            $newsResult->where('active',1);
            $newsResult->where('recycle',0);
            $newsResult->order_by('id','desc');
            $newsResult->get_paged_iterated($offset,$limitNews);
            $dis['newsResult'] = $newsResult;
            
            
            
            $dis['view'] = 'product/search_news';
                              
            $url= "tim-kiem/".$searchKeyEncode.'/tin-tuc';
            
            $dis['url'] =$url;
            $config['base_url']             = site_url($url."/trang-");
            $config['total_rows']           = $newsResult->paged->total_rows;
            $config['per_page']             = $limitNews;
            $config['use_page_numbers']     = TRUE;
            $config['uri_segment']          = 4;
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
        	$config['cur_tag_open'] 		= '<span class="active fl">';
        	$config['cur_tag_close']		= '</span>';
        
            $this->pagination->initialize($config);      
        }
        
        
        $dis['view'] = 'front/product/search_all';
        $dis['searchKey'] = $searchKey;
        $dis['base_url']=base_url();
        
		$this->viewfront($dis);
    }
    function search2()
    {
        $viewMode = $this->uri->segment(2,"") == ""?"ma-tran":$this->uri->segment(2);
        $orderBy = $this->uri->segment(3,"") == ""?"moi-nhat":$this->uri->segment(3);
        $page = $this->uri->segment(4,"") == "" ? "trang-1":$this->uri->segment(4);
        $dis['viewMode'] = $viewMode;
        $dis['orderBy'] = $orderBy;
        $dis['page'] = $page;
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $searchKey = $this->input->post('searchKey');
            $this->session->set_userdata('searchKey',$searchKey);
        }
        $searchKey = $this->session->userdata('searchKey');
        
        $limit = $viewMode == "ma-tran"?15:10;
        $offset = ( $this->getPageNumber($page) - 1)*$limit;
        
        
        $product = new Product();
        if(trim($searchKey) != "")
        {
            $product->like('name',$searchKey);
        }
        $product->where('active',1);
        $product->order_by($this->getOrderBy($orderBy),$this->getOrderDirection($orderBy));
        $product->get_paged_iterated($offset,$limit,TRUE);
        $dis['product'] = $product;
        
        $url= "tim-kiem";
        $dis['pageUrl'] = "tim-kiem/";
        $dis['url'] = "tim-kiem/";
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
    
    function productCat($level)
    {
        $categoryUrl = $this->uri->segment($level);
        $viewMode = $this->uri->segment($level + 1,"") == ""?"ma-tran":$this->uri->segment($level + 1);
        $orderBy = $this->uri->segment($level + 2,"") == ""?"moi-nhat":$this->uri->segment($level + 2);
        $page = $this->uri->segment($level + 3,"") == "" ? "trang-1":$this->uri->segment($level + 3);
        
        $dis['viewMode'] = $viewMode;
        $dis['orderBy'] = $orderBy;
        $dis['page'] = $page;
        
        
        //limit
        $limit = $viewMode == "ma-tran"?12:12;
        $offset = ( $this->getPageNumber($page) - 1)*$limit;

        $productCat = new productCat();
        $productCat->where("url",$categoryUrl);
        $productCat->get();
        $dis['productCat'] = $productCat;

        $this->page_title = $productCat->seo_title ;
        if($this->getPageNumber($page) != 1)
            $this->page_title .= '  - Trang '.$this->getPageNumber($page);
        $this->page_description = $productCat->seo_description.' - Trang '.$this->getPageNumber($page);
        $this->page_keyword = $productCat->seo_keyword;


        
        //get root id for hover main menu
        $rootId = $productCat->getRootId();
        $product = $productCat->getAllProduct(
                                                array("active"=>1),
                                                $this->getOrderBy($orderBy),
                                                $this->getOrderDirection($orderBy),
                                                $offset,
                                                $limit
                                                );
        $dis['product'] = $product;
        
        //load all product to get the total
        $allProduct = $productCat->getAllProduct(
                                                array("active"=>1),
                                                $this->getOrderBy($orderBy),
                                                $this->getOrderDirection($orderBy)
                                                );
        $total = $allProduct->result_count();
        

        $url = "";
        for($i = 1;$i<=$level;$i++)
        {
            $url .= $this->uri->segment($i)."/";
        }
        $dis['pageUrl'] = $url;
        $config['base_url'] = site_url($url."/".$viewMode."/".$orderBy."/trang-");
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = $level + 3;
        $config['num_links'] = 3;
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
            $dis['view']='front/product/product_grid';
        else
            $dis['view']='front/product/product_list';
                 
        
        $productSaleOff = new product();
        $productSaleOff->where('active',1);
        $productSaleOff->where('isSale',1);
        $productSaleOff->order_by('id','desc');
        $productSaleOff->get_iterated(15);
        $dis['productSaleOff'] = $productSaleOff;

        $post_category = new Newscatalogue();
        $post_category->where('name_none', $categoryUrl)->get();

        if($post_category->exists()){
            $cat_news_by_products = new Article();
            $cat_news_by_products->where(array('recycle'=>0));
            $cat_news_by_products->where('active',1);
            $cat_news_by_products->where('newscatalogue_id', $post_category->id);
            $cat_news_by_products->order_by('created','desc');
            $cat_news_by_products->get_iterated(5);
            $dis['cat_news_by_products'] = $cat_news_by_products;
        }

        $title_about = '';
        if( $productCat->id == 81 ){
            $title_about = 'Ford EcoSport hoàn toàn mới';
        }elseif( $productCat->id == 113 ){
            $title_about = 'Ford Everest mới';
        }elseif( $productCat->id == 125 ){
            $title_about = 'Ford Fiesta mới';
        }elseif( $productCat->id == 129 ){
            $title_about = 'Ford Focus hoàn toàn mới';
        }elseif( $productCat->id == 134 ){
            $title_about = 'Ford Ranger mới';
        }elseif( $productCat->id == 137 ){
            $title_about = 'Ford Transit mới';
        }

        //build breadcum
        $dis['title_about'] = $title_about;
        $dis['breadcum'] = $productCat->buildBreadCum();
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['base_url']=base_url();
		$this->viewfront($dis);
    }
    
    
    
    function saleOffList()
    {
       
        //level1 : category is root cat
        
            //load param from url
            $level = 1;
        
        $viewMode = $this->uri->segment($level + 1,"") == ""?"ma-tran":$this->uri->segment($level + 1);
        $orderBy = $this->uri->segment($level + 2,"") == ""?"moi-nhat":$this->uri->segment($level + 2);
        $page = $this->uri->segment($level + 3,"") == "" ? "trang-1":$this->uri->segment($level + 3);
        
        $dis['viewMode'] = $viewMode;
        $dis['orderBy'] = $orderBy;
        $dis['page'] = $page;
        
        
        //limit
        $limit = $viewMode == "ma-tran"?15:10;
        $offset = ( $this->getPageNumber($page) - 1)*$limit;
        
        
        
        
        $productCat = new productCat();
        $dis['productCat'] = $productCat;
        $this->page_title = "Danh sách giảm giá" ;
        if($this->getPageNumber($page) != 1)
            $this->page_title .= '  - Trang '.$this->getPageNumber($page);
        $this->page_description = "Danh sách giảm giá".' - Trang '.$this->getPageNumber($page);
        $this->page_keyword = "giảm giá";
        //build breadcum
        //$dis['breadcum'] = $productCat->buildBreadCum();
        
        
        //get root id for hover main menu
       
        
        $product = new product();
        $product->where('active',1);
        $product->where('isSale',1);
        $product->order_by($this->getOrderBy($orderBy),$this->getOrderDirection($orderBy));
        $product->get_iterated($limit,$offset);
        
        $dis['product'] = $product;
        $productCat = new Productcat(0);
        $dis['productCat']= $productCat;
        
        //load all product to get the total
        $allProduct = new product();
        $allProduct->where('active',1);
        $allProduct->where('isSale',1);
        $allProduct->order_by('id','desc');
        $allProduct->get_iterated();
        
        $total = $allProduct->result_count();
        
        
        
        $url = "";
        for($i = 1;$i<=$level;$i++)
        {
            $url .= $this->uri->segment($i)."/";
        }
        $dis['pageUrl'] = $url;
        $config['base_url'] = site_url($url."/".$viewMode."/".$orderBy."/trang-");
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = $level + 3;
        $config['num_links'] = 3;
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
    
    
                            
    function detail(){
        $url = $this->uri->segment(1);
        $product = new Product();
        $product->where('url', $url);
        $product->include_related('productphoto');
        $product->get();
    
        if(!$product->exists())
            redirect("");

        $product->where('url', $url)->update('clicks', $product->clicks + 1);

        $dis['product'] = $product;

        //hide video
        $dis['showVideo'] = trim($product->txtVideo)!= "";
        $dis['showGift'] = trim($product->txtGift)!= "";
        $dis['showImage'] = $product->productphoto->result_count() > 0;
        $dis['showAccessory'] = $product->accessory->result_count() > 0;

        //add to cookie
        //$this->addProductCookie($product->id);
        $productCat = $product->productcat->get();
        $dis['productCat'] = $productCat;
        //build breadcum
        $dis['breadcum'] = $productCat->buildBreadCum()." <span>".$product->name."</span>";
        $rootId = $productCat->getRootId();
        
        
        //$comment_reply = new productcomments_reply();
		
        /*$comment = new productcomment();
        $comment->where('product_id',$product->id);
        $comment->order_by('creationDate','asc');
        $comment->get_iterated();
        $dis['comment'] = $comment;*/
        
        $sameCategoryProduct = new Product();
        $sameCategoryProduct->distinct();
        $sameCategoryProduct->where_in_related_productcat('id',$product->productcat);
        $sameCategoryProduct->where('id !=',$product->id);
        $sameCategoryProduct->get_iterated(9);
        $dis['sameCategoryProduct'] = $sameCategoryProduct;
        
        $productphotos= new Productphoto();
        $productphotos->where('product_id', $product->id);
        $productphotos->order_by('position','asc');
        $productphotos->order_by('id', 'desc');
        $productphotos->get_iterated();
        $dis['productPhotos'] = $productphotos;


        $post_category = new Newscatalogue();
        $post_category->where('name_none', $product->productcat->url)->get();

        if($post_category->exists()){
            $cat_news_by_products = new Article();
            $cat_news_by_products->where(array('recycle'=>0));
            $cat_news_by_products->where('active',1);
            $cat_news_by_products->where('newscatalogue_id', $post_category->id);
            $cat_news_by_products->order_by('created','desc');
            $cat_news_by_products->get_iterated(10);
            $dis['cat_news_by_products'] = $cat_news_by_products;
        }

        // Seo
        $this->page_title = $product->seo_title;
        $this->page_description = $product->seo_description;
        $this->page_keyword = $product->seo_keyword;

        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['base_url']=base_url();
        $dis['view']='front/product/product_detail';
		$this->viewfront($dis);
    }
    
    
    function loadComment($id)
    {
        $direction = $this->input->post('direction')?$this->input->post('direction'):"asc";
        $comment = new Productcomment();
        $comment->where('product_id',$id);
        $comment->order_by('creationDate',$direction);
        $comment->get_iterated();
        $dis['comment'] = $comment;
        $dis['base_url'] = base_url();
        $this->load->view('front/product/product_comment',$dis);
        
    }

	function like_dislike($id)
    {
		$comment = new Productcomment();
        
        $type=$_POST['type'];
		$id=$_POST['id'];
		
		if(isset($_COOKIE['likeDislike'."_".$id])){
			echo "error||Bạn đã bỏ phiếu cho bình luận này";
			exit();
		}else{
			if($type=='like'){
			   $field_name='likes';
			}elseif($type=='dislike'){
			   $field_name='dislikes';
			}else{
			   die();
			}
			
			$comment->where('id',$id)->update($field_name, $field_name.' + 1', false);
			//print_r($this->db->last_query());exit();
			$comment->get_where(array('id'=>$id));
			
			// expired cookie is 30days
			$expire=time()+60*60*24*30;
			
			setcookie("likeDislike"."_".$id, "likeDislike"."_".$id, $expire);
			
			echo "success||".$comment->{$field_name}; exit;
		}
        
    }

    function addComment($id)
    {
        $this->load->library("securimage");
        $comment = new Productcomment();
        $comment->title = $this->input->post('title');
        $comment->content = $this->input->post('content');
        $comment->email = $this->input->post('commentEmail');
        $comment->phone = $this->input->post('commentPhone');
        $comment->name = $this->input->post('name');
        $comment->creationDate = date("Y-m-d H:i:s");
		$comment->likes = 0;
		$comment->dislikes = 0;
        $comment->product_id = $id;
        $dis['status'] = true;
        if($this->securimage->check($_POST['captcha_code']) == false)
        {
            $dis['status'] = false;
            $dis['message'] = "Vui lòng nhập hình ảnh xác nhận";    
        }else
        {
            $comment->save();    
        }
        header('Content-Type: application/json');
        echo json_encode($dis);
        //$this->firephp->log( json_encode($dis));
        exit;
        
    }

    function store(){
        $storeId = $this->uri->segment(2);
        $store = new store($storeId);
        echo $store->map;
        exit;
    }

    function compare()
    {
        $this->isCache = false;
        //compare product put from cookie
        $compareCookie = $this->input->cookie('compareProduct');
        $compareArray = explode(",",$compareCookie);
        array_push($compareArray,0);
        
        
        $compareProduct = new product();
        $compareProduct->where_in('id',$compareArray);
        $compareProduct->get_iterated();
        $this->compareProduct = $compareProduct;
        $this->compareArray = $compareArray;
        
        $this->menu_active = 'compare';
        $dis['base_url']=base_url();
        $dis['view']='product/product_compare';
        $this->page_title = "So sánh sản phẩm - Di động việt";
        $this->page_description = "So sánh các tính năng sản phẩm";
        $this->page_keyword = "So sánh tính năng sản phẩm";
        $dis['breadcum'] = "So sánh sản phẩm";
        $this->viewfront($dis);
    }
    
	function grid()
    {
        //$this->page_title = lang("home")." - product";
        $this->menu_active = 'product';
        $dis['base_url']=base_url();
        $dis['news_link'] = gen_seo_url($this->lang->line('news')).'/';
        $dis['view']='product_grid';
		$this->viewfront($dis);
    }
	
	function plist()
    {
        $this->page_title = lang("home")." - product";
        $this->menu_active = 'product';
        $dis['base_url']=base_url();
        $dis['news_link'] = gen_seo_url($this->lang->line('news')).'/';
        $dis['view']='product_list';
		$this->viewfront($dis);
    }
	

    function priceTable($id = "0")
    {
        $dis['base_url'] = base_url();
        if($id != "0")
        {
            $id = explode("_",$id);
            $id = $id[1];
            $manu = new Productmanufacture($id);
            $product = new product();
            $product->where('productmanufacture_id',$id);
            $product->where('status',enum::PRODUCT_AVAILABLE);
            $product->order_by('name','asc');
            $product->get_iterated();
            $dis['product'] = $product;
            $this->load->view('front/product/ajaxPriceTable',$dis);
            
        }else
        {
            //manufacture
            $manu = new Productmanufacture();
            $manu->where('isShow',1);
            $manu->get_iterated();
            $dis['manu'] = $manu;
            $dis['view'] = 'product/priceTable';
            $this->viewfront($dis);
        }
    }
    
    
}