<?php
class menus extends MY_Controller{
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
    function list_all($offset=0,$limit=20)
    {
        $menu = new menu();
        $menu->order_by('position','asc');
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
            foreach($_POST as $key =>$value)
            {                                     
                if(substr($key,0,8) == "position")
                {
                    if(trim($this->input->post($key)) != "")
                    {
                        $keylist = explode("_",$key);
                        $mId = $keylist[1];
                        $menu = new menu($mId);
                        $menu->position = $this->input->post($key);
                        $menu->save();
                        $menu->clear();
                    }
                }
            }
            flash_message('success','Cập nhật thành công.');
            redirect($this->admin.'menus/list_all/');    
        }
        $menu->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'menus/list_all/',$menu->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='menu/list_all';
        $dis['object']=$menu;
        $dis['menu_active']="Menu";
        $dis['title_table']="Trang hiện tại:".$menu->paged->current_page.'/'.$menu->paged->total_pages;
        $dis['title']="Danh sách Menu cha";
        $dis['nav_menu']=array(
    			
         );
        $this->viewadmin($dis);
    }

    function edit($id=0)
    {
        $menu = new menu($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
           $menu->name=$this->input->post('name');
           $menu->link=$this->input->post('link');
           $menu->active=$this->input->post('active');
           
           if($menu->save())
           {
                flash_message('success','Thêm menu thành công.');
           }
           else
           {
                flash_message('error','Không thêm được menu.');
           }
        }
        
        $dis['base_url'] = base_url();
        $dis['title'] = "Thêm/ Sửa Menu cha";
        $dis['menu_active'] = "Menu";
        $dis['view'] = "menu/edit";
        $dis['object'] = $menu;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Quay về",
    				"link"=>"{$this->admin_url}menus/list_all",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    
    function delete($id)
    {
        $menu = new menu($id);
        //delete bannercat
        $menuitem = new menuitem();
        $menuitem->where('menu_id',$id);
        $menuitem->get_iterated();
        
        if($menuitem->result_count()>0)
        {
            flash_message('error','Không thể xóa menu gốc, vui lòng xóa menu con trước');
        }
        else
        {
            $menu->delete();
            flash_message('success','Menu đã được xóa');
        }
        redirect($this->admin.'menus/list_all/');
    }
    
    function active($id=0,$value)
    {
        $menu=new menu($id);
        if(!$menu->exists())
            show_404();
        $menu->active=($menu->active+1)%2;
        $menu->save();
        flash_message('success',"Kích hoạt thành công.");
        redirect($this->admin.'menus/list_all/');
    }
}
/* End of file menus.php */
/* Location: ./application/controller/menus.php */