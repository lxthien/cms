<?php
class banners extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>11));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function list_all()
    {
        $dis['base_url']=base_url();
        $banner =new banner();
        $banner->order_by('position','asc');
        $banner->get();
        $dis['view']='banner/list';
        $dis['menu_active']='Banner';
        $dis['title']="banner";
        $dis['banner']=$banner;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm banner",
    				"link"=>"{$this->admin_url}banners/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function edit($bannercat_id = 0,$id=0)
    {
        if($bannercat_id == 0)
        {
            show_404();
        }
        $banner=new banner($id);
        $banner->bannercat_id = $bannercat_id;
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
                $this->load->library('file_lib');
               $banner->name  = $this->input->post('name');
               $banner->width = $this->input->post('width');
               $banner->height= $this->input->post('height');
               $banner->link = $this->input->post('link');
               
               if($_FILES['image']['name'] != "")
               {
                    $dataupload=$this->file_lib->upload('image', 'img/banner/');   
                    if(is_array($dataupload)){    
                        $banner->image = 'img/banner/' . $dataupload['file_name'];
                    } else{
                         flash_message('error',$dataupload);
                    }
               }
               if($banner->save())
               {
                    redirect($this->admin.'banners/edit/'.$bannercat_id.'/'.$banner->id);
               }
        }
        
        
        
        
        $dis['base_url']=base_url();
        $dis['title']="Thêm/ Sửa banner";
        $dis['menu_active']="Banner";
        $dis['view']="banner/edit_image";
        $dis['banner']=$banner;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}bannercats/list_image/".$bannercat_id,
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
   
    function up_position($id,$step=1)
    {
        $o=new banner();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'banners/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new banner();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
       for($i=0;$i<$step;$i++)
        {
            $o->down_position();
        }
          //  flash_message('warning','Không th? thay d?i v? trí du?c n?a ');
       redirect($this->admin.'banners/list_all/');
    }
    function up_position_image($id,$banner_id,$step=1)
    {
        $o=new bannercat();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'banners/list_image/'.$banner_id);
    }
    function down_position_image($id,$banner_id,$step=1)
    {
        $o=new bannercat();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
       for($i=0;$i<$step;$i++)
        {
            $o->down_position();
        }
          //  flash_message('warning','Không th? thay d?i v? trí du?c n?a ');
       redirect($this->admin.'banners/list_image/'.$banner_id);
    }
    function delete()
    {
        $id=$this->uri->segment(4);
        if($id != 1 )
        {
            $banner=new banner($id);
            //delete city
            if(count($banner->child->all)>0)
            {
                flash_message('error','không thể xóa menu gốc, vui lòng xóa menu con trước');
            }
            else
            {
                $banner->delete();
            }    
            //redirect to city
        }
        else
        {
            flash_message('error','không thể xóa danh mục này');
        }
        redirect($this->admin.'banners/list_all/');
    }
    
    
    function list_image($banner_id)
    {
        
        $banner=new banner($banner_id);
        $bannercat=new bannercat();
        $bannercat->where('banner_id',$banner_id);
        $bannercat->order_by('position','asc');
        $bannercat->get_iterated();        
        if(!$banner->exists())
            show_404();
        $dis['base_url']=base_url();
        $dis['view']='banner/list_image';
        $dis['banner']=$banner;
        $dis['menu_active']="Banner";
        $dis['title']="Hình ảnh của {$banner->name}";
        $dis['title_table']="Hình ảnh của {$banner->name}";
        $dis['bannercat'] = $bannercat;
        $dis['nav_menu']=array(
                array(
    				"type"=>"back",
    				"text"=>"Về Banner",
    				"link"=>"{$this->admin_url}banners/list_all/",
    				"onclick"=>""		
    			),
                array(
    				"type"=>"add",
    				"text"=>"Thêm banner",
    				"link"=>"{$this->admin_url}banners/edit/".$banner_id,
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function add_image($banner_id)
    {
        $this->load->library('file_lib');
        $banner = new banner($banner_id);
        $dataupload=$this->file_lib->upload('image',"img/banner");
        $this->resize_image("img/banner/".$dataupload['file_name'],200,100);
        if(!is_array($dataupload))
        {
                flash_message('error',"Hình ảnh :".$dataupload);
                $flag_error= true;
        }
        else
        {
                
                $bannercat = new bannercat();
                $bannercat->link = $dataupload['file_name'];
                $bannercat->title = $this->input->post('title');
                $bannercat->banner_id = $banner_id;
                $bannercat->save();
        }
        redirect($this->admin_url."banners/list_image/".$banner_id);
    }
    
    function delete_image($id)
    {
        
        $banner = new banner($id);
        if(!$banner->exists())
            show_404();
            
        $bannercat_id = $banner->bannercat_id;
        $banner->delete();
        redirect($this->admin_url."bannercats/list_image/".$bannercat_id);
    }
     function resize_image($file_link,$width,$height)
    {
      
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_link;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['quality'] = '70%';
        $config['thumb_marker'] = "_thump";
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();          
      //  return null;
    }
}
/* End of file banners.php */
/* Location: ./application/controller/banners.php */