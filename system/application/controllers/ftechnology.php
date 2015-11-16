<?php
class ftechnology extends MY_Controller{
    var $menu_active = "technology";
    
    function __construct()
    {
        parent::__construct();
        $this->show_products_left = true;
        $this->load->helper('remove_vn_helper');
    }

    function set_action(){
        if( strpos($this->uri->uri_string, '.html') ){
            $title_none = gettitlenonefromlink(get_url($this->uri->uri_string));
            $this->detail($title_none);
        }else{
            $cat = get_url($this->uri->uri_string);
            $this->cat($cat);
        }
    }

    function index($offset = 0, $limit = 10)
    {
        if(empty($offset))
            $offset = $this->uri->segment(2);

        //category news
        $cat_news = new Article();
        $cat_news->where(array('recycle'=>0));
        $cat_news->where('newscatalogue_id', 60);
        $cat_news->order_by('created','desc');
        $cat_news->get_paged($offset,$limit,TRUE);
        $dis['news'] = $cat_news;
        setPaginationVb('tin-tuc/', $cat_news->paged->total_rows, $limit, 2);

        //seo
        $category = new Newscatalogue(60);
        $dis['category'] = $category;
        $this->page_title = $category->title_bar;
        $this->page_description = $category->slogan;
        $this->page_keyword = $category->keyword;
        
		$this->isRobotFollow = 1;
        $dis['base_url']=base_url();
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['view']='technology/news';
        $this->viewfront($dis) ;
		
    }

    function cat($cat = NULL, $offset = 0, $limit = 15 )
    {
        $dis['cat_name'] = '';
        $dis['cat_id'] = '';
        $dis['name_none'] = '';
        if( isset($_GET['page']) ){
            $offset = ($_GET['page'] - 1)*$limit;
        }

        $category = new Newscatalogue();
        $category->where(array('name_none' => $cat))->get();
        if(!$category->exists()){
            show_404();
        }

        $cat = $category->id;
        $dis['cat_id'] = $category->id;
        $dis['cat_name'] = $category->{'name_vietnamese'};
        $dis['name_none'] = $category->name_none;

        //Category news
        $cat_news = new Article();
        $cat_news->where(array('recycle'=>0));
        $cat_news->where('active',1);
        $cat_news->where('newscatalogue_id', $cat);
        $cat_news->order_by('created','desc');
        $cat_news->get_paged($offset, $limit, TRUE);
        $dis['cat_news'] = $cat_news;

        // Pagination
        setPaginationVb('dich-vu/'.gen_seo_url($dis['cat_name']), $cat_news->paged->total_rows, $limit, 2);

        //DDV news
        $ddv_news = new Article();
        $ddv_news->where('recycle',0);
        $ddv_news->where('active',1);
        $ddv_news->where('newscatalogue_id',59);
        $ddv_news->order_by('created', 'DESC');
        $ddv_news->get_paged(0,4,TRUE);
        $dis['ddv_news'] = $ddv_news;

        $cat_ddv = new Newscatalogue();
        $cat_ddv->where(array('id' => 59))->get();
        $dis['cat_ddv'] = $cat_ddv->name_vietnamese;
        $dis['cat_ddv_none'] = $cat_ddv->name_none;

        //link counter
        $links_counter = new Article();
        $links_counter->where('recycle',0);
        $links_counter->where('active',1);
        $links_counter->order_by('clicks', 'DESC');
        $links_counter->get_paged(0,10,TRUE);
        $dis['links_counter'] = $links_counter;

        // Seo
        $this->page_title = $category->name_vietnamese;
        $this->page_description = $category->slogan;
        $this->page_keyword = $category->keyword;

        $dis['breadcum'] = "<span>".$category->name_vietnamese."</span>";
        $dis['base_url']=base_url();
        $dis['view']='services/news_cat';
        $this->viewfront($dis) ;
    }

	
	function detail($title_none = NULL){
        $news = new Article();
        $news->where('title_none',$title_none);
        $news->get();
        if(!$news->exists())
            show_404();

        // links counter
        $news->where('title_none',$title_none)->update('clicks', $news->clicks + 1);
        $dis['news'] = $news;

        $related_news = new Article();
        $related_news->where('recycle',0);
        $related_news->where('active',1);
        $related_news->where('newscatalogue_id',$news->newscatalogue_id);
        $related_news->where("id !=",$news->id);
        $related_news->order_by('created', 'DESC');
        $related_news->get_paged(0, 10, TRUE);
        $dis['related_news'] = $related_news;


        $category = new Newscatalogue();
        $category->where(array('id' => $news->newscatalogue_id))->get();

        // Seo
        $this->page_title = $news->{'title_vietnamese'};
        $this->page_description = $news->short_vietnamese;
        $this->page_keyword = $news->tag;

        $dis['breadcum'] = $category->buildBreadCum().'<span>'.$news->title_vietnamese.'</span>';
        $this->uri = base_url().substr($this->uri->uri_string, 1, strlen($this->uri->uri_string));
        $dis['base_url']=base_url();
        $dis['view']='technology/news_de';
        $this->viewfront($dis) ;
    }
}