<?php
class Cnews extends MY_Controller{
    private $currentdir;
    /**
     * Cnews::__construct()
     * 
     * @return
     */
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>91));
        $this->load->library('login_manager');
    }
    /**
     * Cnews::index()
     * 
     * @return
     */
    function index()
    {
        $this->list_all();
    }
    /**
     * Cnews::list_all()
     * 
     * @param integer $offset
     * @param integer $limit
     * @return
     */
    function list_all($offset=0,$limit=5)
    {      
        $news=new article();
        $news->where(array('recycle'=>0));
        $news->where_related_newscatalogue('group',1);
        $news->order_by('id','desc');
        $news->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'cnews/list_all/',$news->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='news/list';
        $dis['news']=$news;
        $dis['menu_active']="Tin";
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_pages;
        $dis['title']="Tất cả các tin";
        $this->viewadmin($dis);
    }
    //list all news in cat by catalogue_id
    /**
     * Cnews::list_by_cat()
     * 
     * @param integer $catalogue_id
     * @param integer $offset
     * @param integer $limit
     * @return
     */
    function list_by_cat($catalogue_id=0,$offset=0,$limit=5)
    {
        $newscatalogue=new newscatalogue($catalogue_id);
        $news=new article();
        $news->where('newscatalogue_id',$catalogue_id);
        $news->where(array('recycle'=>0));
         $news->order_by('id','desc');
        $news->get_paged($offset,$limit,TRUE);
        $total=count($news);
        setPagination($this->admin.'cnews/list_by_cat/'.$catalogue_id,$news->paged->total_rows,$limit,5);
        if(!$newscatalogue->exists())
            show_404();
        $dis['base_url']=base_url();
        $dis['view']='news/list';
        $dis['news']=$news;
        $dis['menu_active']="Tin";
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_pages;
        $dis['title']="Tin danh mục \"{$newscatalogue->name_vietnamese}\"";
        $n = new Article();
        $n->where('newscatalogue_id',$catalogue_id);
        $n->where(array('recycle'=>1));
        $count_recycle = $n->count();
        $dis['nav_menu']=array(
                array(
    				"type"=>"back",
    				"text"=>"Về danh mục",
    				"link"=>"{$this->admin_url}newscatalogues/list_by_catparent/7",
    				"onclick"=>""		
    			),
    			array(
    				"type"=>"add",
    				"text"=>"Thêm tin mới",
    				"link"=>"{$this->admin_url}cnews/edit/".$catalogue_id,
    				"onclick"=>""		
    			)
                
    			
                
         );
       
         if($this->logged_in_user->adminrole->id==1)
            {
                array_push($dis['nav_menu'],
                array(
    				"type"=>"recycle",
    				"text"=>"Thùng rác <span style='color:red'>(".$count_recycle.") </span>",
    				"link"=>"{$this->admin_url}cnews/list_recycle_by_cat/".$catalogue_id,
    				"onclick"=>""		
    			));
            }
        $this->viewadmin($dis);
    }
    
    
    
    function isolate_list_by_cat($catalogue_id=0,$offset=0,$limit=10)
    {
        
        $newscatalogue=new newscatalogue($catalogue_id);
        $news=new article();
        $news->where('newscatalogue_id',$catalogue_id);
        $news->where(array('recycle'=>0));
        $news->order_by('id','desc');
        $news->get_paged($offset,$limit,TRUE);
        $total=count($news);
        setPagination($this->admin.'cnews/isolate_list_by_cat/'.$catalogue_id,$news->paged->total_rows,$limit,5);
        if(!$newscatalogue->exists())
            show_404();
        $dis['base_url']=base_url();
        $dis['view']='news/isolate_list';
        $dis['news']=$news;
        
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_pages;
        $dis['title']="Tin danh mục \"{$newscatalogue->name_vietnamese}\"";
        $n = new Article();
        $n->where('newscatalogue_id',$catalogue_id);
        $n->where(array('recycle'=>1));
        $count_recycle = $n->count();
        $dis['nav_menu']=array(     
    			array(
    				"type"=>"add",
    				"text"=>"Thêm tin mới",
    				"link"=>"{$this->admin_url}cnews/isolate_edit/".$catalogue_id,
    				"onclick"=>""		
    			)             
         );
         
         if($this->logged_in_user->adminrole->id==1)
            {
                array_push($dis['nav_menu'],
                array(
    				"type"=>"recycle",
    				"text"=>"Thùng rác <span style='color:red'>(".$count_recycle.") </span>",
    				"link"=>"{$this->admin_url}cnews/list_recycle_by_cat/".$catalogue_id,
    				"onclick"=>""		
    			));
            }
            
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
        if(empty($newscatalogue->menu_active))
        {
            $dis['menu_active'] = $newscatalogue->name_vietnamese;
        }
        else
        {
            $dis['menu_active'] = $newscatalogue->menu_active;
        }
        
        $this->viewadmin($dis);
    }
    
    
    //show recycle
    /**
     * Cnews::list_recycle_by_cat()
     * 
     * @param integer $catalogue_id
     * @param integer $offset
     * @param mixed $limit
     * @return
     */
    function list_recycle_by_cat($catalogue_id=0,$offset=0,$limit)
    {
        $newscatalogue=new newscatalogue($catalogue_id);
        $news=new article();
        $news->where('newscatalogue_id',$catalogue_id);
        $news->where(array('recycle'=>1));
        $news->order_by('id','desc');
        $news->get_paged($offset,$limit,TRUE);
        $total=count($news);
        setPagination($this->admin.'cnews/list_recycle_by_cat/'.$catalogue_id,$news->paged->total_rows,$limit,5);
        if(!$newscatalogue->exists())
            show_404();
        $dis['base_url']=base_url();
        $dis['view']='news/list_recycle';
        $dis['news']=$news;
        $dis['menu_active']="Tin";
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_rows;
        $dis['title']="Tin rác danh mục \"{$newscatalogue->name_vietnamese}\"";
        $dis['nav_menu']=array(
                array(
    				"type"=>"back",
    				"text"=>"Về Chính",
    				"link"=>"{$this->admin_url}cnews/list_by_cat/".$catalogue_id,
    				"onclick"=>""		
    			)           
         );
        $this->viewadmin($dis);
    }
    /**
     * Cnews::list_by_catparent()
     * 
     * @param integer $catalogue_id
     * @param integer $offset
     * @param integer $limit
     * @return
     */
    function list_by_catparent($catalogue_id=0,$offset=0,$limit=10)
    {
        
        $newscatalogue=new newscatalogue($catalogue_id);
        $news=new article();
        $news->where('newscatalogue_id',$catalogue_id);
        $news->where(array('recycle'=>0));
        $news->get_paged($offset,$limit,TRUE);
        $total=count($news);
        setPagination($this->admin.'cnews/list_by_cat/'.$catalogue_id,$news->paged->total_rows,$limit,5);
        if(!$newscatalogue->exists())
            show_404();
        $dis['base_url']=base_url();
        $dis['view']='news/list';
        $dis['news']=$news;
        $dis['menu_active']="Tin";
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_rows;
        $dis['title']="Tin danh mục \"{$newscatalogue->name}\"";
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm tin mới",
    				"link"=>"{$this->admin_url}cnews/edit/".$catalogue_id,
    				"onclick"=>""		
    			)
                
         );
        $this->viewadmin($dis);
    }
    /**
     * Cnews::edit()
     * 
     * @param integer $catalogue_id
     * @param integer $news_id
     * @return
     */
    function edit($catalogue_id=0,$news_id=0)
    {
        $newscatalogue=new newscatalogue($catalogue_id);
        if(!$newscatalogue->exists())
            show_404();
        
        $news=new article($news_id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
                if(!$news->exists())
                {
                    
                }
                else
                {
                    if(getconfigkey('use_ftp'))
                    {
                        $this->load->library('ftp');
                		$config['hostname'] = $this->cauhinh->where('fieldname','ftp_server')->get()->value;
                		$config['username'] = $this->cauhinh->where('fieldname','ftp_username')->get()->value;
                		$config['password'] = $this->cauhinh->where('fieldname','ftp_password')->get()->value;
                        if(empty($news->dir)  )
                        {
                            $ex=explode(' ',$news->created);
                            $createdate=$ex[0];
                            $y=getyear($createdate);
                            $m=getmonth($createdate);
                            $d=getday($createdate);
                            $ddir="img/news/".$y.'/'.$m.'/'.$d.'/'.md5(date("Y-m-d h:i:s")).'/';
                            $news->dir=$ddir;
                            $news->save();
                            $this->_create_dir($ddir);
                        }
                        else{
                                if($this->ftp->list_files($news->dir) == FALSE)
                                {
                                    $this->_create_dir($news->dir);
                                }
                            
                        }
                        $this->ftp->close();
                    }
                    else
                    {
                        if(empty($news->dir)  )
                            $news->dir = getconfigkey("default_news_dir");
                    }
                    
                    
                }
                
        }
        else
        {
                $this->load->helper('remove_vn_helper');
                $this->load->library('file_lib');
                $news->title_vietnamese=$this->input->post('title_vietnamese');
                $news->title_english=$this->input->post('title_english');
                $news->title_none=remove_vn($news->title_vietnamese);
                $news->author= $this->input->post('author');
                $news->tag=$this->input->post('tag');
                $news->short_vietnamese=strip_tags($this->input->post('txtShort_vietnamese'));
                $news->full_vietnamese=$this->input->post('txtFull_vietnamese');
                $news->short_english=strip_tags($this->input->post('txtShort_english'));
                $news->full_english=$this->input->post('txtFull_english');
                $news->dir=$this->input->post('dir');
                $news->pagi = $this->input->post('pagi');
                if($this->logged_in_user->adminrole->id == 1)
                {
                    $news->navigation =  $this->input->post('navigation');
                    $news->menu_active = $this->input->post('menu_active');
                    $news->old_id = $this->input->post('old_id');
                }
                $new_image=$this->input->post('newimage');
                if($new_image=='1')
                {
                    $dataupload=$this->file_lib->upload('image',"img/news");
                    if(!is_array($dataupload))
                    {
                        flash_message('error',$dataupload);
                    }
                    else{
                        $news->image=$dataupload['file_name'];
                        $this->resize_image($news->dir.$dataupload['file_name']);
                    }
                }
                else
                {
                    $news->image=trim($this->input->post('imagelink'));
                }
                //newstopic
                $newstp=new newstopic($this->input->post('newstopic'));
                $newsc=new newscatalogue($this->input->post('newscatalogue'));
                if(!$news->exists())
                {
                    $news->active=0;
                }
               if($news->save(array($newsc,$newstp)))
               {         
                    $this->session->unset_userdata('dir_for_news');
                   
                    redirect($this->admin.'cnews/edit/'.$news->newscatalogue->id.'/'.$news->id);
               }
               else
               {
                    flash_message("error","Lỗi");
               }
        }
        //setup start folder for kfm
        
        $newscat = new newscatalogue();
        $newscat->where('parentcat_id !=','NULL');
        $newscat->where('parentcat_id',$newscatalogue->parentcat_id);
        $newscat->order_by('position','asc');
        $newscat->get();
        $newstopic=new newstopic();
        $newstopic->order_by('id','desc');
        $newstopic->get();
        $sitelanguage=new Sitelanguage();
        $sitelanguage->order_by('position','asc');
        $sitelanguage->get();
        $dis['sitelanguage']=$sitelanguage;
        $dis['newstopic']=$newstopic;
        $dis['base_url']=base_url();
        $dis['newscatalogue']=$newscat;
        $dis['currentcatalogue']=$newscatalogue;
        $dis['title']="Thêm/ Sửa trang";
        $dis['menu_active']="Tin";
        $dis['view']="news/edit";
        $dis['object']=$news;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}cnews/list_by_cat/".$catalogue_id,
    				"onclick"=>""		
    			)
         );
          if($this->logged_in_user->adminrole->id == 1 && $this->logged_in_user->adminrole->id == 1)
            {
                array_push($dis['nav_menu'],
                    array(
        				"type"=>"copymove",
        				"text"=>"Copy/Move",
        				"link"=>"javascript:void(0);",
        				"onclick"=>"show_copy()"		
        			)
                );
            }
        
        $this->viewadmin($dis);
    }
    

    function isolate_edit($catalogue_id=0, $news_id=0)
    {
        $newscatalogue=new newscatalogue($catalogue_id);
        if(!$newscatalogue->exists())
            show_404();
        
        $news=new article($news_id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
            if(!$news->exists())
            {
                $news->newscatalogue_id = $catalogue_id;
                $news->dir = getconfigkey("default_news_dir");
            }
        }
        else
        {
            $this->load->helper('remove_vn_helper');
            $this->load->library('file_lib');
            $news->title_vietnamese=$this->input->post('title_vietnamese');
            $news->title_english=$this->input->post('title_english');
            $news->title_none=remove_vn($news->title_vietnamese);
            $news->author= $this->input->post('author');
            $news->tag=$this->input->post('tag');
            $news->short_vietnamese =$this->input->post('short_vietnamese');
            $news->full_vietnamese=$this->input->post('txtFull_vietnamese');
            $news->full_english=$this->input->post('txtFull_english');
            $news->dir=$this->input->post('dir');
            $new_image=$this->input->post('newimage');
            $news->pagi = $this->input->post('pagi');

            $folder = 'img/news/';
            if($_FILES['image']['name'] != "") {
                $dataupload=$this->file_lib->upload('image', $folder);
                if (!is_array($dataupload)) {
                    flash_message('error',$dataupload);
                } else {
                    $news->image = $folder.$dataupload['file_name'];
                }
            }

            //newstopic
            $newstp=new newstopic($this->input->post('newstopic'));
            $newsc=new newscatalogue($this->input->post('newscatalogue'));
            $isnews = $news->exists();
            if(!$news->exists())
            {
                $news->active=1;
            }
            if($news->save(array($newsc,$newstp)))
            {
                $this->session->unset_userdata('dir_for_news');
                if($isnews)
                {
                    flash_message("success","Cập nhật thành công");
                }
                else
                {
                    flash_message("success","Thêm mới thành công");
                }
                if($news->navigation != "")
                {
                    $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
                    if(empty($newscatalogue->menu_active))
                    {
                        $dis['menu_active'] = "Tin";
                    }
                    else
                    {
                        $dis['menu_active'] = $newscatalogue->menu_active;
                    }
                }
                else
                {
                    $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$news->navigation));
                    if(empty($newscatalogue->menu_active))
                    {
                        $dis['menu_active'] = "Tin";
                    }
                    else
                    {
                        $dis['menu_active'] = $news->title_vietnamese;
                    }
                }
                redirect($this->admin.'cnews/isolate_edit/'.$news->newscatalogue->id.'/'.$news->id);
            }
            else
            {
                flash_message("error","Lỗi");
            }
        }
      
        $newscat = new newscatalogue();
        //$newscat->where('parentcat_id !=','NULL');
        $newscat->where('parentcat_id', $newscatalogue->parentcat_id);
        $newscat->order_by('position','asc');
        $newscat->get();

        $newstopic=new newstopic();
        $newstopic->order_by('id','desc');
        $newstopic->get();

        $sitelanguage=new Sitelanguage();
        $sitelanguage->order_by('position','asc');
        $sitelanguage->get();

        $dis['sitelanguage']=$sitelanguage;
        $dis['newstopic']=$newstopic;
        $dis['base_url']=base_url();
        $dis['newscatalogue']=$newscat;
        $dis['currentcatalogue']=$newscatalogue;
        $dis['title']="Thêm/ Sửa tin tức";
        $dis['menu_active']="Tin";
        
        if($catalogue_id == 39)
        {
            $dis['view'] = "news/isolate_full_hirarchy_edit";
        }
        else
        {
            $dis['view']="news/isolate_edit";
        }

        $dis['object']=$news;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}cnews/isolate_list_by_cat/".$catalogue_id,
    				"onclick"=>""		
    			)
        );

        if($news->exists())
        {
            if(!empty($news->navigation))
            {
                $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$news->navigation));
                $dis['menu_active'] = $news->title_vietnamese;
            }
            else
            {
                $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
                if(empty($newscatalogue->menu_active))
                {
                    $dis['menu_active'] = $newscatalogue->name_vietnamese;
                }
                else
                {
                    $dis['menu_active'] = $newscatalogue->menu_active;
                }
            }
        }
        else
        {
            $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
            $dis['menu_active'] = $newscatalogue->name_vietnamese;
        }
        if($this->logged_in_user->adminrole->id == 1 )
        {
            array_push($dis['nav_menu'],
                array(
                    "type"=>"copymove",
                    "text"=>"Copy/Move",
                    "link"=>"javascript:void(0);",
                    "onclick"=>"show_copy()"
                )
            );
        }
        
        $this->viewadmin($dis);
    }
    /**
     * Cnews::edit_individual()
     * 
     * @param integer $catalogue_id
     * @param integer $news_id
     * @return
     */
    function edit_individual($catalogue_id=0,$news_id=0)
    {
        
        $newscatalogue=new newscatalogue($catalogue_id);
        if(!$newscatalogue->exists())
            show_404();
        
        $news=new article($news_id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
                
                
                
        }
        else
        {        
                $news->full_vietnamese=$this->input->post('txtFull_vietnamese');
                $news->full_english=$this->input->post('txtFull_english');
                $news->dir=$this->input->post('dir');
                $news->pagi = $this->input->post('pagi');
                //newstopic
               if($news->save())
               {
                    $this->session->unset_userdata('dir_for_news');
                   redirect($this->admin.'cnews/edit_individual/'.$news->newscatalogue->id.'/'.$news->id);
               }
        }
        //setup start folder for kfm
    
        
        $sitelanguage=new Sitelanguage();
        $sitelanguage->order_by('position','asc');
        $sitelanguage->get();
        $dis['sitelanguage']=$sitelanguage;
    
        $dis['base_url']=base_url();
        $dis['title']=$news->title_vietnamese;
        $dis['menu_active']=$news->title_vietnamese;
        $dis['view']="news/edit_individual";
        $dis['object']=$news;
        
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
        if(empty($news->menu_active))
        {
            $dis['menu_active'] = $news->title_vietnamese;
        }
        else
        {
            $dis['menu_active'] = $news->menu_active;
        }
        $this->viewadmin($dis);
    }
    /**
     * Cnews::active()
     * 
     * @param integer $id
     * @param mixed $value
     * @return
     */
    function active($id=0,$value)
    {
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            $news->active=($news->active+1)%2;
            $news->save();
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
               $news=new article($row);
               $news->active = $value;
               $news->save(); 
               $news->clear();         
            }
        }
        flash_message('success',"Kích hoạt thành công.");
        redirect_admin(); 
    }
    /**
     * Cnews::recycle()
     * 
     * @param integer $id
     * @param mixed $value
     * @return
     */
    function recycle($id=0,$value)
    {
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            $news->recycle=($news->recycle+1)%2;
            $news->save();
             $news->unset_home();
            if($news->recycle==1)
                flash_message('success',"Xóa thành công.");
            else
                flash_message('success',"Phục hồi thành công.");
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
               $news=new article($row);
               $news->recycle = $value;
               $news->save(); 
               $news->unset_home();
               $news->clear();         
            }
            if($value==1)
                flash_message('success',"Xóa thành công.");
            else
                flash_message('success',"Phục hồi thành công.");
        }
        
       
        redirect_admin(); 
    }
    
    /**
     * Cnews::delete()
     * 
     * @param integer $id
     * @return
     */
    function delete($id=0)
    {
        $this->checkRole(array(1));
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            $news->delete();
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
               $news=new article($row);
               $news->delete();
               $news->clear();     
            }
        }
        flash_message('success',"Xóa hoàn toàn thành công.");
        redirect_admin(); 
    }
    /**
     * Cnews::resize_image()
     * 
     * @param mixed $file_link
     * @return
     */
    function resize_image($file_link)
    {
        
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_link;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 80;
        $config['height'] = 60;
        $config['quality'] = '100%';
        $config['thumb_marker'] = "_small";
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    
    
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_link;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 160;
        $config['height'] = 90;
        $config['quality'] = '100%';
        $config['thumb_marker'] = "_medium";
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
        $this->image_lib->clear();
        
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_link;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = 235;
        $config['height'] = 175;
        $config['quality'] = '100%';
        $config['thumb_marker'] = "_big";
        $this->image_lib->initialize($config); 
        $this->image_lib->resize();
        $this->image_lib->clear();
     
      //  return null;
    }
    /**
     * Cnews::_create_dir()
     * 
     * @param mixed $dir
     * @return
     */
    private function _create_dir($dir)
    {
        //get the next id
                    $dir_part=explode("/",$dir);
                    $this->load->library('ftp');
            		$config['hostname'] = $this->cauhinh->where('fieldname','ftp_server')->get()->value;
            		$config['username'] = $this->cauhinh->where('fieldname','ftp_username')->get()->value;
            		$config['password'] = $this->cauhinh->where('fieldname','ftp_password')->get()->value;
                    $config['debug']    = FALSE;
            		$this->ftp->connect($config);
            		$current_path=$this->currentdir;
            		$absolutePath="";
                    foreach($dir_part as $row):
                        $absolutePath.="/".$row;
                		if($this->ftp->list_files($current_path.$absolutePath) == FALSE)
                		{
                  			$this->ftp->mkdir($current_path.$absolutePath , DIR_WRITE_MODE);
                		}	
                    endforeach;
    }
    
    //set hot  for each newscatalogue
    /**
     * Cnews::set_hot()
     * 
     * @param integer $id
     * @return
     */
    function set_hot($id=0)
    {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            foreach($news->newscatalogue->article as $row)
            {
                $row->hot = 0;
                $row->save();
                $row->clear();
            }   
            $news->hot=1;
            $news->save();
            redirect_admin(); 
    }
    //home hot
    /**
     * Cnews::add_home()
     * 
     * @param integer $id
     * @param mixed $value
     * @return
     */
    function add_home($id=0,$value)
    {
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            if($value==1)
                $news->set_home();
            else
                $news->unset_home();
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
               $news=new article($row);
              if($value==1)
                $news->set_home();
                else
                $news->unset_home();
               $news->clear();     
            }
        }
         if($value==1)
            flash_message('success',"Thêm vào tiêu điểm thành công.");
         else
            flash_message('info',"Remove khỏi danh sách tiêu điểm .");
        redirect($this->admin.'cnews/list_homepage');
    }
    /**
     * Cnews::up_position_homepage()
     * 
     * @param mixed $id
     * @param integer $step
     * @return
     */
    function up_position_homepage($id,$step=1)
    {
        $o=new article();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        if($o->home_hot == 1 )
        {
             for($i=0;$i<$step;$i++)
            {
                $o->up_position_home();
            }
           
        }
        redirect($this->admin.'cnews/list_homepage/');
    }
    /**
     * Cnews::up_position_homepage_top()
     * 
     * @param mixed $id
     * @return
     */
    function up_position_homepage_top($id)
    {
        $o=new article();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        if($o->home_hot == 1 )
        {
               $o->up_position_home_top();  
        }
        redirect($this->admin.'cnews/list_homepage/');
    }
    /**
     * Cnews::down_position_homepage_bottom()
     * 
     * @param mixed $id
     * @return
     */
    function down_position_homepage_bottom($id)
    {
        $o=new article();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        if($o->home_hot == 1 )
        {
               $o->down_position_home_bottom();  
        }
        redirect($this->admin.'cnews/list_homepage/');
    }
    /**
     * Cnews::down_position_homepage()
     * 
     * @param mixed $id
     * @param integer $step
     * @return
     */
    function down_position_homepage($id,$step=1)
    {
        $o=new article();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm th?y");
        }
        if($o->home_hot == 1 )
        {
           for($i=0;$i<$step;$i++)
            {
                $o->down_position_home();
            }
        }
          //  flash_message('warning','Không th? thay d?i v? trí du?c n?a ');
       redirect($this->admin.'cnews/list_homepage/');
    }
    //list news hot homepage
    /**
     * Cnews::list_homepage()
     * 
     * @param integer $offset
     * @param integer $limit
     * @return
     */
    function list_homepage($offset=0,$limit=14)
    {
         $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>173));
        $news=new article();
        $news->where(array('recycle'=>0));
        $news->where('home_hot',1);
        $news->order_by('home_hot_position','asc');
        $news->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'cnews/list_homepage/',$news->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='news/list_homepage';
        $dis['news']=$news;
        $dis['menu_active']="Tin tiêu điểm";
        $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_pages;
        $dis['title']="Tin tức tiêu điểm";
        $this->viewadmin($dis);
    }
    
    /**
     * Cnews::search()
     * 
     * @return
     */
    function search()
    {
        $newscatalogue =  new Newscatalogue();
        $newscatalogue->where('parentcat_id',7);
        $newscatalogue->order_by('position','asc');
        $newscatalogue->get();
        $dis['base_url'] = base_url();
        $dis['newscatalogue'] =  $newscatalogue;
        $dis['view'] = "news/search";
        $dis['menu_active'] = "Tìm kiếm";
        $dis['title'] = "Tìm kiếm";
        $dis['news'] = new Article();
        $dis['searchkey'] = "";
        $dis['catalogue_id'] = "";
        $dis['date_start'] = "";
        $dis['date_end'] = "";
        $dis['recycle'] = 0;
        $dis['active'] = 3;
        $dis['hot_cat'] = 3;
        $dis['hot_home'] = 3;
        $dis['arrange_by'] = "thoigian";
        $dis['arrange_direct'] = "desc";
        $dis['showperpage'] = 5;
        $this->viewadmin($dis);
    }
    /**
     * Cnews::dosearch()
     * 
     * @param string $st
     * @param integer $offset
     * @param integer $limit
     * @return
     */
    function dosearch($st="",$offset=0,$limit=5)
    {   
        $this->load->helper('text');
        $separate = "aaaaaaa23423dddeeeeee838234eeeeefffffff99923ffffffsdfsdfsdfsdf";
        $sep = "239847293dlkfaslf::sdflksdf::sdkfjsldf";
        $this->load->helper('remove_vn');
        $logged_role = $this->logged_in_user->adminrole->id;
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
            $key_list = explode($sep,$st);
         //   $this->firephp->log($key_list); 
            
            $news=new article();
            if($key_list[0]!=$separate)
            {
                $news->like('title_vietnamese',$key_list[0]);
            }
            if($key_list[1]!=$separate)
            {
                $news->where('newscatalogue_id',$key_list[1]);
            }
            else
            {
                $news->where_related_newscatalogue('parentcat_id',7);
            }
            if($key_list[2]!=$separate)
            {
                $news->where('created >',$key_list[2]);
                $news->where('created <',$key_list[3]);
            }
            if($key_list[4] != 3) $news->where('active',$key_list[4]);
            if($key_list[5] != 3)  $news->where('hot',$key_list[5]);
            if($key_list[6] != 3) $news->where('home_hot',$key_list[6]);
            
            $news->where('recycle',$key_list[7]);
                
            
            //arrange by
            switch($key_list[8])
            {
                case "thoigian":$news->order_by('id',$key_list[9]); break;
                case "docnhieu":$news->order_by('view_count', $key_list[9]);break;
            }
          
            $news->get_paged($offset,$key_list[10],TRUE);
    //       $this->firephp->log($news->check_last_query());
            setPagination($this->admin.'cnews/dosearch/'.$st,$news->paged->total_rows,$key_list[10],5);
            $dis['base_url']=base_url();
            $dis['view']='news/search';
            $dis['news']=$news;
            $dis['search_result']=1;
            $dis['menu_active']="Tìm kiếm";
            $dis['title_table']="Trang hiện tại:".$news->paged->current_page.'/'.$news->paged->total_pages ;
            $dis['title']="Kết quả tìm kiếm";
            
            $dis['searchkey'] = $key_list[0]!=$separate?$key_list[0]:"";
            $dis['catalogue_id'] = $key_list[1];
            $dis['date_start'] = $key_list[2]!=$separate?$key_list[2]:"";
            $dis['date_end'] = $key_list[3]!=$separate?$key_list[3]:"";
            $dis['active'] =  $key_list[4];
            $dis['hot_cat'] =  $key_list[5];
            $dis['hot_home'] = $key_list[6];
            $dis['recycle'] = $key_list[7];
            $dis['arrange_by'] = $key_list[8];
            $dis['arrange_direct'] = $key_list[9];
            $dis['showperpage'] = $key_list[10];
            
            $newscatalogue =  new Newscatalogue();
            $newscatalogue->where('parentcat_id',7);
            $newscatalogue->order_by('position','asc');
            $newscatalogue->get();
            $dis['newscatalogue'] =  $newscatalogue;
            $this->viewadmin($dis);   
        }
        else
        {
            
            $searchkey = trim($this->input->post('searchkey'));
            $catalogue_id = $this->input->post('newscatalogue');
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $active =  $this->input->post('active');
            $hot_cat =  $this->input->post('hot_cat');
            $hot_home = $this->input->post('hot_home');
            $arrange_by = $this->input->post('arrange_by');
            $arrange_direct = $this->input->post('arrange_direct');
            $showperpage = $this->input->post('showperpage');
            $recycle = $this->input->post('recycle')==1?$this->input->post('recycle'):0;
            
            //create string uri query
            $search_string = "";        
            $search_string .= $searchkey==""?$separate:$searchkey;
            $search_string .= $sep.($catalogue_id?$catalogue_id:$separate);
            $search_string .= $sep.($date_start!=""?$date_start:$separate);
            $search_string .= $sep.($date_end!=""?$date_end:$separate);
            $search_string .= $sep.$active;
            $search_string .= $sep.$hot_cat;
            $search_string .= $sep.$hot_home;
            $search_string .= $sep.$recycle;
            $search_string .= $sep.$arrange_by;
            $search_string .= $sep.$arrange_direct;
            $search_string .= $sep.$showperpage;
        
           
             $this->firephp->log($search_string);
            redirect($this->admin.'cnews/dosearch/'.$search_string.'/0/'.$showperpage);
        }
    }
    /**
     * Cnews::copy_2_cat()
     * 
     * @param mixed $id
     * @return
     */
    function copy_2_cat($id)
    {
        $this->load->helper('remove_vn_helper');
        $news =  new article($id);
        if(!$news->exists())
        
        {
            show_404();
        }
        $cat_id = $news->newscatalogue_id;
        $copy_newscatalogue = $this->input->post('copy_newscatalogue');
        $copy_type = $this->input->post('copy_type');
        $copy_amount = $this->input->post('copy_amount');
        $flag_error = false;

        if($copy_newscatalogue == 0 )
        {
            $newscatalogue =  new newscatalogue();
            $newscatalogue->where('id !=',$news->newscatalogue_id);
            $newscatalogue->get();
            $vb = new article();
            $vb->hot = 0;
            $vb->home_hot = 0;
            foreach($newscatalogue as $row){
              for($i=0;$i<$copy_amount;$i++)
              {
                $vb =  $news->get_copy();
                $vb->code="";
                if(!$vb->save(array($row)))
                    foreach($vb->error->all  as $r)
                    {
                        flash_message('error',$r);
                        $flag_error = true;
                    }      
                else
                {
                    $vb->title_vietnamese = $vb->code.": ".$vb->title_vietnamese;
                    $vb->title_none =  remove_vn($vb->title_vietnamese)."-".md5($vb->id);
                    $vb->save();
                }
                $vb->clear();
              }
            }
        }
        else
        {
            
            $newscatalogue =  new newscatalogue($copy_newscatalogue);
            $vb = new article();
            $vb->hot = 0;
            $vb->home_hot = 0;
            for($i=0;$i<$copy_amount;$i++)
              {
                $vb =  $news->get_copy();
                $vb->code="";
                 if(!$vb->save(array($newscatalogue)))
                    foreach($vb->error->all  as $r)
                    {
                        flash_message('error',$r);
                        $flag_error = true;
                    }
                else
                {
                    $vb->title_vietnamese = $vb->code.": ".$vb->title_vietnamese;
                    $vb->title_none =  remove_vn($vb->title_vietnamese)."-".md5($vb->id);
                    $vb->save();
                }
                $vb->clear();
              }
        }   
        if($copy_type=="move")
        {
            $news->delete();
        }
        if($flag_error ==  false)
            flash_message('success',"Thực hiện thành công xong copy/move");
        else
            flash_message('info',"Có 1 vài lỗi trên");
       redirect($this->admin.'cnews/edit/'.$cat_id.'/'.$id);
            
    }
    
    /**
     * Cnews::active()
     * 
     * @param integer $id
     * @param mixed $value
     * @return
     */
    function isolate_active($id=0,$value)
    {
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();
            $news->active=($news->active+1)%2;
            $news->save();
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
               $news=new article($row);
               $id = $news->id;
               $news->active = $value;
               $news->save(); 
               $news->clear();         
            }
        }
        flash_message('success',"Kích hoạt thành công.");
        $n = new Article($id);
        $newscatalogue = $n->newscatalogue;
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
        if(empty($newscatalogue->menu_active))
        {
            $dis['menu_active'] = "Tin";
        }
        else
        {
            $dis['menu_active'] = $newscatalogue->menu_active;
        }
        redirect($this->admin."cnews/isolate_list_by_cat/".$newscatalogue->id);
    }
    /**
     * Cnews::recycle()
     * 
     * @param integer $id
     * @param mixed $value
     * @return
     */
    function isolate_recycle($id=0,$value)
    {
        if($id!=0)
        {
            $news=new article($id);
            if(!$news->exists())
                show_404();

            if($news->newscatalogue_id == 16 || $news->newscatalogue_id == 59){
                flash_message('info',"Đây là trang đặc biệt. Bạn không thể xóa bài viết này.");
            }else{
                $news->recycle=($news->recycle+1)%2;
                $news->save();
                $news->unset_home();

                if($news->recycle==1)
                    flash_message('success',"Xóa thành công.");
                else
                    flash_message('success',"Phục hồi thành công.");
            }
        }
        else
        {
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)
            {
                $news=new article($row);
                $id = $news->id;
                $news->recycle = $value;
                $news->save();
                $news->unset_home();
                $news->clear();
            }
            if($value==1)
                flash_message('success',"Xóa thành công.");
            else
                flash_message('success',"Phục hồi thành công.");
        }

        $n = new Article($id);
        $newscatalogue = $n->newscatalogue;
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>$newscatalogue->navigation));
        if(empty($newscatalogue->menu_active)){
            $dis['menu_active'] = "Tin";
        }
        else{
            $dis['menu_active'] = $newscatalogue->menu_active;
        }
        redirect($this->admin."cnews/isolate_list_by_cat/".$newscatalogue->id);
    }
}
/* End of file newss.php */
/* Location: ./application/controller/newss.php */