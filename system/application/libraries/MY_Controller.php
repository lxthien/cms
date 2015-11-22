<?php 
class MY_Controller extends Controller{
	var $menu;
	var $logged_in;
	var $role;
	var $menu_current;
	var $menu_sub;
    var $language;
    var $spcategory;
    var $news;
    var $hot_news;
	
    var $partner;
    var $footer_info;
	var $about_us_sub_menu;
    var $news_sub_menu;
    var $shareholder_sub_menu;

	function MY_Controller() {
		parent::Controller();
        $this->load->library('enum');
        $this->load->library('Hit_counter');
        $this->load->config('fireignition');
        $this->load->helper('language');

		if ($this->config->item('fireignition_enabled')) {
			if (floor(phpversion()) < 5) {
				log_message('error', 'PHP 5 is required to run fireignition');
			} else {
			    $this->load->library('FirePHP');
			}
		} else {
			$this->load->library('Firephp_fake');
			$this->firephp =& $this->firephp_fake;
		}
        
        //redirect from old website
        $this->redirectList();
        
        
        $cauhinh= new cauhinh();
        $cauhinh->get();
        $this->cauhinh=$cauhinh;
		
        if($this->uri->segment(1,"") == "admin") {
            $this->logged_in_user=$this->_get_user();  
            $this->admin=$this->config->item('admin');
            $this->admin_url=$this->config->item('admin_url');
            $this->admin_images= base_url()."images/admin/";
            //LOAD HELPER
            $this->load_admin_resource();
			//check maintenance admin , only webmaster can login
	 	} else {
            //check login user
            //$this->flogged_in_user=$this->_fget_user();  
            $this->isCache = false;
            $this->userLoginFlag = 0;
            $userLogin = $this->session->userdata('userLogin');
            $userToken = $this->session->userdata('userToken');
            $customer = new Customer();
            $customer->get_by_username($userLogin);
            
            if($customer->exists() && md5($customer->id) == trim($userToken) ) {   
                $loginUsername = $customer->username;
                $this->customer = $customer;
                if($this->session->userdata('userloginFlag') == "1") {
                    $this->userLoginFlag = 1;
                    $this->session->set_userdata('userloginFlag',"0");
                }
            } else {
                $loginUsername = "";
            }
            
            
            $this->loginUsername = $loginUsername;
            $this->loginUser = $customer;
            
            //compare product put from cookie
            //$compareCookie = $this->input->cookie('compareProduct');
            //$compareArray = explode(",",$compareCookie);
            //array_push($compareArray,0);
            
            
            //$compareProduct = new product();
            //$compareProduct->where_in('id',$compareArray);
            //$compareProduct->get_iterated();
            //$this->compareProduct = $compareProduct;
            //$this->compareArray = $compareArray;
            
            
            
            //product category load
            /*
            $productCat = new Productcat();
            $productCat->where('parentcat_id',null);
            $productCat->order_by('position','asc');
            $productCat->get_iterated();
            
            $productCatAll = new Productcat();
            $productCatAll->order_by('position','asc');
            $productCatAll->get_iterated();

            $productViewMore = new Product();
            $productViewMore->where('active',1);
            $productViewMore->order_by('clicks', 'desc');
            $productViewMore->get_iterated(20);

            $productRelated = new Product();
            $productRelated->where('active',1);
            $productRelated->where_in_related_productcat('id', array(81, 113, 125, 129, 134, 137));
            $productRelated->order_by('clicks', 'desc');
            $productRelated->get_iterated(10);
            */
            
            $news = new Article();
            $news->where('recycle',0);
            $news->where('active',1);
            $news->where_in('newscatalogue_id', array(82, 66, 67, 68, 69));
            $news->order_by('created', 'DESC');
            $news->get_iterated(10);

            $news_cat = new Newscatalogue();
            $news_cat->where('parentcat_id', 58);
            $news_cat->get_iterated();

            $services_cat = new Newscatalogue();
            $services_cat->where('parentcat_id', 59);
            $services_cat->get_iterated();

            $news_post = new Newscatalogue();
            $news_post->where('parentcat_id', 65);
            $news_post->get_iterated();

            $news_services = new Article();
            $news_services->where('newscatalogue_id', 59);
            $news_services->order_by('created', 'desc');
            $news_services->get_iterated();

            $news_technical = new Newscatalogue();
            $news_technical->where('parentcat_id', 60);
            $news_technical->get_iterated();

            $news_abouts = new Article();
            $news_abouts->where('recycle',0);
            $news_abouts->where('active',1);
            $news_abouts->where('newscatalogue_id', 83);
            $news_abouts->order_by('created', 'ASC');
            $news_abouts->get_iterated(10);

            $news_product_related = new Article();
            $news_product_related->where('recycle',0);
            $news_product_related->where('active',1);
            $news_product_related->where_in('newscatalogue_id', array(72, 73, 74, 75, 67));
            $news_product_related->order_by('created', 'ASC');
            $news_product_related->get_iterated(10);
            
            //store load
            //$store = new Store();
            //$store->order_by('id','asc');
            //$store->get_iterated();
            //TODO: will delete
            //$this->visitedProduct = $this->getVisitedProduct();
            
            
            
            //$this->store = $store;
            //$this->productCat = $productCat;
            //$this->productCatAll = $productCatAll;
            //$this->productViewMore = $productViewMore;
            //$this->productRelated = $productRelated;
            $this->news = $news;
            $this->news_cat = $news_cat;
            $this->services_cat = $services_cat;
            $this->news_post = $news_post;
            $this->news_services = $news_services;
            $this->news_technical = $news_technical;
            $this->news_abouts = $news_abouts;
            $this->news_product_related = $news_product_related;
            
            $this->show_analytic = TRUE;
            $this->page_title = getconfigkey("defaultPageTitle");
            $this->page_keyword = getconfigkey("defaultKeyword");
            $this->page_description = getconfigkey("defaultDescription");
            $this->isRobotFollow =  true;
            //$this->lang->load('site');    
            
            //------------------------------------------------
            // Top Advertise
            //------------------------------------------------
            $banner = new banner();
            $banner->where('bannercat_id',1);
            $banner->get_iterated();
            $this->banner = $banner;
            
            /*$bannerDetail = new Banner();
            $bannerDetail->where('bannercat_id',19);
            $bannerDetail->get_iterated();
            $this->bannerDetail = $bannerDetail;*/

            /*$bannerLeft = new Banner();
            $bannerLeft->where('bannercat_id', 19);
            $bannerLeft->get_iterated();
            $this->bannerLeft = $bannerLeft;*/
            
            /*$bannerFooter = new Banner();
            $bannerFooter->where('bannercat_id',20);
            $bannerFooter->get_iterated();
            $this->bannerFooter = $bannerFooter;*/
            
            $menu = new menu();
            $menu->order_by('position','asc');
            $menu->get_iterated(8);
            $this->menu = $menu;
            
            /*$productFooter = new menuitem();
            $productFooter->where('menu_id',9);
            $productFooter->order_by('position','asc');
            $productFooter->get_iterated();
            $this->productFooter = $productFooter;*/
            
            $relation = new menuitem();
            $relation->order_by('position','asc');
            $relation->where('menu_id',10);
            $relation->get_iterated();
            $this->relation = $relation;
            
            $this->_increaseVisiter();
            
            //load product manufacture
            /*$productManufacture = new Productmanufacture();
            $productManufacture->order_by('name','asc');
            $productManufacture->get_iterated();
            
            $this->productManufacture = $productManufacture;*/
	 	}
	}
    
    
    function redirectList() {
        $redirectList["mobile/i-2-41-144/bao-da-galaxy-tab.aspx"]        =  "tin-tuc" ;

        if(array_key_exists(ltrim($this->uri->uri_string(),"\/"),$redirectList)) {
            redirect($redirectList[ltrim($this->uri->uri_string(),"\/")], 'location', 301);   
        }
    }

    public function getNewsHomePage($categoryID = null, $limit = null) {
        $newsHomepage = new Article();
        $newsHomepage->where('recycle', 0);
        $newsHomepage->where('active', 1);
        $newsHomepage->where('newscatalogue_id', $categoryID);
        $newsHomepage->order_by('created', 'DESC');
        $newsHomepage->get_iterated($limit);

        return $newsHomepage;
    }


    private function _increaseVisiter() {
        $visitExpired = 60*60;
        $visited = $this->input->cookie('visited');       
        if($visited == false) {
            setcookie("visited",mktime().time(),  time()+$visitExpired ,"/" );
            setconfigkey("counter",(int)getconfigkey("counter") + 1);
        }
    }


    function getVisitedProduct() {
        $cartDetail = $this->getProductCookie();
        array_push($cartDetail,0);
        $product = new Product();
        $product->where_in('id',$cartDetail);
        $product->get_iterated();
        return $product;
    }


    function getProductCookie(){
        $ck = $this->input->cookie('userProduct');
        
        $ckDetail = json_decode($ck,true);
        if(!$ckDetail)
        {
            $ckDetail = array();
        }
        $cartReturn = array();
    
        return $ckDetail;
    }


    function addProductCookie($productId)
    {
        $cartDetail = $this->getProductCookie();
        if(!in_array($productId,$cartDetail))
        {
            array_push($cartDetail,$productId);
        }
        if(count($cartDetail) > 10)
        {
            array_shift($cartDetail);
        }
        setcookie("userProduct",json_encode($cartDetail), mktime(). time()+60*60*24*2,"/" ); 
        
    }


    function _checkLogin() {
        if($this->loginUsername == "")
            return false;
        else
            return true;
    }


    private function load_admin_resource() {
        $this->load->helper(array('create_link_table_helper','flash_message',"admin_log_helper"));
    }


	function viewadmin($data) {
	    $this->menu=$this->logged_in_user->adminrole->adminmenu->where('parentmenu_id',NULL)->order_by('position','asc')->get();
		$this->menu_current = $this->session->userdata(config_item('session_admin').'menu_current');
		if($this->menu_current==false or $this->menu_current==NULL)  $this->menu_current=11;
        $adminmenu=new adminmenu($this->menu_current);
		$this->menu_sub=$adminmenu->child->where_related_adminrole('id',$this->logged_in_user->adminrole->id)->order_by('position','asc')->get();	
		$this->load->view('admin/layout/main',$data);	
	}


    function viewfront($data) {
        //$this->isCache = false;
        /*if($this->isCache)
        {
            $this->output->cache(1440);
        }*/
        $this->load->view('front/main', $data);
    }


	private function _get_user() {
		$id = $this->session->userdata('logged_in_id');
		if(is_numeric($id))
		{
			$u = new adminuser();
			$u->get_by_id($id);
			if($u->exists()) {
				$logged_in_user = $u;
				return $logged_in_user;
			}
		}
		return FALSE; 
	}
    

    private function _fget_user() {
		$id = $this->session->userdata('flogged_in_id');
		if(is_numeric($id))
		{
			$u = new user();
			$u->get_by_id($id);
			if($u->exists()) {
				$logged_in_user = $u;
				return $logged_in_user;
			}
		}
		return FALSE; 
	}
    

    function backaction() {
        back_admin();
    }
    

    function clearCacheFolder() {
        $this->load->helper('file');
        delete_files('system/cache');
    }
    
    
    function _send_email($emailPreset,$subject,$content,$to) {
        $testmail = "";
        $this->load->plugin('phpmailer');
		$this->load->config('email');
       
        $emailConfig = $this->config->item($emailPreset);
        
		//Establish settings for phpmailer to use to send the mail
		$mailer = new PHPMailer();
		$mailer->CharSet = 'UTF-8';
		$mailer->SMTPDebug = 1;
		
		$mailer->IsSMTP(); // set mailer to use SMTP
		$mailer->Host = $emailConfig['server']; // specify main and backup server
		$mailer->Port = $emailConfig['port']; // set the port to use
		$mailer->SMTPAuth = $emailConfig['SMTPAuth']; // turn on SMTP authentication
		$mailer->SMTPSecure = $emailConfig['SMTPSecure'];
		$mailer->Username = $emailConfig['username']; // your SMTP username or your gmail username
		$mailer->Password = $emailConfig['password']; // your SMTP password or your gmail password
		
		$mailer->From = $emailConfig['from'] ;
		$mailer->FromName = $emailConfig['fromName'];
		$mailer->Subject = $subject;
		$mailer->Body = $content;
		//$mailer->AddAttachment($file_path, $file_name); // add attache file
		$mailer->WordWrap = 50;
		$mailer->IsHTML(true);
		//$mailer->AddAddress('info@lienminh.com.vn','Info - Lien Minh');
        if($testmail != "")
            $mailer->AddAddress($testmail);
        else
            $mailer->AddAddress($to);
        
		//Send the mail
		if(!$mailer->Send()) {
            log_message('error','Mail error: '.$mailer->ErrorInfo);     
    		return true;
    	} else {
    		
    		return true;
    	}
    }


    function sendMail($content) {	
        $config = Array(
		    'mailtype'  => 'html'
		);
		$this->load->helper('email');
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('info@lienminh.com.vn', 'Liên minh');
		$this->email->to(getconfigkey("email"));
		$this->email->subject("There're a new contact infomation from liemminh.com.vn");
		$this->email->message($content);
		$this->email->send();
    }
    

    function checkRole($role = array()) {
        if(!in_array($this->logged_in_user->adminrole_id, $role))
            show_error('Bạn không có quyền truy cập chức năng này.');
    }
}