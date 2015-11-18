<?php
class Home extends MY_Controller
{
    var $menu_active = "homepage";
    
    function Home() {
        parent::MY_Controller();
		$this->load->helper('form');
		$this->load->library('validation');
		$this->load->library('email');
		$this->load->helper('email');
		$this->load->plugin('phpmailer');
    }
  
    function index() {
        $this->GL();
    }
   
    function GL() {
        $dis['services'] = $this->getNewsHomePage(59, 5);
        $dis['advices'] = $this->getNewsHomePage(85, 5);
        $dis['priceLists'] = $this->getNewsHomePage(83, 5);

        //load view
        $dis['base_url'] = base_url();
        $dis['view'] = 'front/homepage';
		$this->viewfront($dis);
    }
	
	function register()
    {      
        $this->page_title = " - ".$this->page_title;
        $this->menu_active = '';
        $dis['base_url']=base_url();
        $dis['view']='register_first';
		$this->viewfront($dis);
    }
	
    
    function messageBox()
    {
        $dis['base_url'] = base_url();
        $this->load->view('front/includes/contactBox',$dis);
        //exit;
    }    
	
	
	function tags($title){
        $title = gettitlenonefromlink($this->uri->segment(2));

        $tags = explode('-', $title);
        $title = implode(' ', $tags);

        $news = new Article();
        $news->group_start();
        $news->like('tag_search', '%'.$title.'%');
        $news->where(array('recycle'=>0));
        $news->where_not_in('id', array(397, 9, 66));
        $news->order_by('created','desc');
        $news->group_end();
        $news->get();
        $dis['news'] = $news;


        // seo
        $this->page_title = $title.' | '.$this->page_title;
        $this->page_description = "Có ".$news->result_count()." kết quả tìm kiếm với từ khóa ".$title .' | '.$this->page_description;
        $this->page_keyword = $this->page_keyword;

        $this->menu_active = "home1-function";
        $this->column = 2;
        $dis['base_url']=base_url();
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['view']='front/tags';

        $this->viewfront($dis);
    }


    function searchs(){
        $value = $this->input->post('value');
        redirect(base_url().'tim-kiem/?value='.urldecode($value));
    }


    function searchParams(){
        parse_str(array_pop(explode('?', $_SERVER['REQUEST_URI'], 2)), $_GET);

        $value = $_GET['value'];

        $news = new Article();
        $news->group_start();
        $news->like('title_vietnamese', '%'.$value.'%');
        $news->like('tag_search', '%'.$value.'%');
        $news->where(array('recycle'=>0));
        $news->where_not_in('id', array(9, 367, 397));
        $news->group_end();
        $news->get();
        $dis['news'] = $news;


        // seo
        $this->page_title = $value.' | '.$this->page_title;
        $this->page_description = "Có ".$news->result_count()." kết quả tìm kiếm với từ khóa ".$value .' | '.$this->page_description;
        $this->page_keyword = $this->page_keyword;

        $this->column = 2;
        $dis['base_url'] = base_url();
        $dis['value'] = $value;
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['view'] = 'front/search';

        $this->viewfront($dis);
    }
    
    
    function newLetter()
    {
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $email = $this->input->post('emailNewsLetter');
            $newLetter = new newletter();
            $newLetter->where('email',$email);
            $newLetter->get();
            if($newLetter->exists())
            {
                echo "Email này đã tồn tại trong hệ thống. Cám ơn bạn.";
                exit;
            }else{
                $newLetter->email = $email;
                $newLetter->save();
                echo "Chúng tôi đã ghi nhận email của bạn. Cám ơn bạn.";
                exit;
            }
            
        }else
        {
            redirect("");
        }
    }

    function ajaxQuestion()
    {
        $fullname = $this->input->post('fullname');
        $content = $this->input->post('content');
        $questions = new Question();
        $questions->fullname = $fullname;
        $questions->content = $content;
        if($questions->save()){
            echo 1;
        }else{
            echo 0;
        }
        die;
    }

    function priceList()
    {

        $news = new Article(218);
        $dis['news'] = $news;

        $this->menu_active = 'price-list';
        $this->page_title = $news->title_vietnamese;
        $this->page_keyword = $news->tag;
        $this->page_description = $news->short_vietnamese;

        $dis['breadcum'] = "<span>".$news->title_vietnamese."</span>";
        $this->show_news_left = true;
        $dis['base_url']=base_url();
        $dis['view']='singlepage/about_us';
        $this->viewfront($dis);

    }

    function promotions()
    {

        $news = new Article(219);
        $dis['news'] = $news;

        $this->menu_active = 'promotions';
        $this->page_title = $news->title_vietnamese;
        $this->page_keyword = $news->tag;
        $this->page_description = $news->short_vietnamese;

        $dis['breadcum'] = "<span>".$news->title_vietnamese."</span>";
        $this->show_news_left = true;
        $dis['base_url']=base_url();
        $dis['view']='singlepage/about_us';
        $this->viewfront($dis);

    }
}
