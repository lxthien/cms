<?php
class fposts extends MY_Controller{
    var $menu_active = "posts";
    
    function __construct()
    {
        parent::__construct();
        $this->show_products_left = true;
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

    function index()
    {
		// lastest news
		$lastest_news = new Article();
        $lastest_news->where('recycle',0);
        $lastest_news->where('active',1);
		$lastest_news->where('newscatalogue_id <>',64);
        //$lastest_news->where('newscatalogue_id',$cat);
        $lastest_news->order_by('created', 'DESC');
        $lastest_news->get_paged(0,5,TRUE);
		$dis['lastest_news'] = $lastest_news;
		
		// news
		$news = new Article();
        $news->where('recycle',0);
        $news->where('active',1);
        $news->where('newscatalogue_id',58);
        $news->order_by('created', 'DESC');
        $news->get_paged(0,4,TRUE);
		$dis['news'] = $news;
		
		$cat_news = new Newscatalogue();
		$cat_news->where(array('id' => 58))->get();
		$dis['cat_news'] = $cat_news->name_vietnamese;
		$dis['cat_news_none'] = $cat_news->name_none;
			
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
		
		//promotion news
		$promo_news = new Article();
        $promo_news->where('recycle',0);
        $promo_news->where('active',1);
        $promo_news->where('newscatalogue_id',62);
        $promo_news->order_by('created', 'DESC');
        $promo_news->get_paged(0,4,TRUE);
		$dis['promo_news'] = $promo_news;
		
		$cat_promotion = new Newscatalogue();
		$cat_promotion->where(array('id' => 62))->get();
		$dis['cat_promotion'] = $cat_promotion->name_vietnamese;
		$dis['cat_promotion_none'] = $cat_promotion->name_none;
		
		//relax news
		$relax_news = new Article();
        $relax_news->where('recycle',0);
        $relax_news->where('active',1);
        $relax_news->where('newscatalogue_id',60);
        $relax_news->order_by('created', 'DESC');
        $relax_news->get_paged(0,4,TRUE);
		$dis['relax_news'] = $relax_news;
		
		$cat_relax = new Newscatalogue();
		$cat_relax->where(array('id' => 60))->get();
		$dis['cat_relax'] = $cat_relax->name_vietnamese;
		$dis['cat_relax_none'] = $cat_relax->name_none;
		
		//advisory news
		$advisory_news = new Article();
        $advisory_news->where('recycle',0);
        $advisory_news->where('active',1);
        $advisory_news->where('newscatalogue_id',61);
        $advisory_news->order_by('created', 'DESC');
        $advisory_news->get_paged(0,4,TRUE);
		$dis['advisory_news'] = $advisory_news;
		
		$cat_advisory = new Newscatalogue();
		$cat_advisory->where(array('id' => 61))->get();
		$dis['cat_advisory'] = $cat_advisory->name_vietnamese;
		$dis['cat_advisory_none'] = $cat_advisory->name_none;
        
		//link counter
		$links_counter = new Article();
        $links_counter->where('recycle',0);
        $links_counter->where('active',1);
        $links_counter->order_by('clicks', 'DESC');
        $links_counter->get_paged(0,10,TRUE);
		$dis['links_counter'] = $links_counter;
		
		//Video on youtube
		$videos = new Article();
        $videos->where('recycle',0);
        $videos->where('active',1);
        $videos->where('newscatalogue_id',64);
        $videos->order_by('created', 'DESC');
        $videos->get_paged(0,4,TRUE);
		$dis['videos'] = $videos;
		
		//
        $this->page_title = "Di động việt - Tin tức";
        
        $dis['base_url']=base_url();
        $dis['link'] = gen_seo_url($this->lang->line('news')).'/';
        $dis['view']='news/news';
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
        setPaginationVb('tin-tuc/'.gen_seo_url($dis['cat_name']), $cat_news->paged->total_rows, $limit, 2);
		
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
        $this->page_title = $category->title_bar;
        $this->page_description = $category->slogan;
        $this->page_keyword = $category->keyword;

        $dis['breadcum'] = "<span>".$category->name_vietnamese."</span>";
        $dis['base_url']=base_url();
        $dis['view']='posts/news_cat';
        $this->viewfront($dis) ;
    }
	
	function detail($title_none = NULL)
    {
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
        $dis['view']='posts/news_de';
        $this->viewfront($dis) ;
    }

}