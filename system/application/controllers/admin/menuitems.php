<?php
class menuitems extends MY_Controller{
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
    function list_all($offset=0,$limit=10)
    {
        $menuitem = new menuitem();
        $menuitem->order_by('position','asc');
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
            foreach($_POST as $key =>$value)
            {                                     
                if(substr($key,0,8) == "position")
                {
                    if(trim($this->input->post($key)) != "")
                    {
                        $keylist = explode("_",$key);
                        $mId = $keylist[1];
                        $menuitem = new menuitem($mId);
                        $menuitem->position = $this->input->post($key);
                        $menuitem->save();
                        $menuitem->clear();
                    }
                }
            }
            flash_message('success','Cập nhật thành công.');
            redirect($this->admin.'menuitems/list_all/');    
        }
        $menuitem->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'menuitems/list_all/',$menu->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='menuitem/list_all';
        $dis['object']=$menuitem;
        $dis['menu_active']="Menu";
        $dis['title_table']="Trang hiện tại:".$menu->paged->current_page.'/'.$menu->paged->total_pages;
        $dis['title']="Danh sách Menu con";
        $this->viewadmin($dis);
    }
    
    function list_by_cat($id,$offset=0,$limit=10)
    {
        $menu = new menu($id);
        
        $menuitem = new menuitem();
        $menuitem->where('menu_id',$id);
        $menuitem->order_by('position','asc');
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
            foreach($_POST as $key =>$value)
            {                                     
                if(substr($key,0,8) == "position")
                {
                    if(trim($this->input->post($key)) != "")
                    {
                        $keylist = explode("_",$key);
                        $mId = $keylist[1];
                        $menuitem = new menuitem($mId);
                        $menuitem->position = $this->input->post($key);
                        $menuitem->save();
                        $menuitem->clear();
                    }
                }
            }
            flash_message('success','Cập nhật thành công.');
            redirect($this->admin.'menuitems/list_by_cat/'.$id);    
        }
        $menuitem->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'menuitems/list_by_cat/'.$id,$menu->paged->total_rows,$limit,5);
        $dis['base_url']=base_url();
        $dis['view']='menuitem/list_by_cat';
        $dis['object']=$menuitem;
        $dis['menu_id']=$id;
        $dis['menu_active']="Menu";
        $dis['title_table']="Trang hiện tại:".$menu->paged->current_page.'/'.$menu->paged->total_pages;
        $dis['title']="Danh sách Menu con của ".$menu->name;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Quay về",
    				"link"=>"{$this->admin_url}menus/list_all",
    				"onclick"=>""		
    			),
                array(
    				"type"=>"add",
    				"text"=>"Thêm Menu Con",
    				"link"=>"{$this->admin_url}menuitems/edit/".$id,
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }

    function edit($menu_id,$id=0)
    {
        $menuitem = new menuitem($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
           $menuitem->name=$this->input->post('name');
           $menuitem->link=$this->input->post('link');
           $menuitem->menu_id = $menu_id;
           $menuitem->active = 1;
           if($menuitem->save())
           {
                flash_message('success','Thêm menu thành công.');
           }
           else
           {
                flash_message('error','Không thêm được menu.');
           }
        }
        
        $dis['base_url'] = base_url();
        $dis['title'] = "Thêm/ Sửa Menu con";
        $dis['menu_active'] = "Menu";
        $dis['view'] = "menuitem/edit";
        $dis['object'] = $menuitem;
        $dis['menu_id'] = $menu_id;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Quay về",
    				"link"=>"{$this->admin_url}menuitems/list_by_cat/".$menu_id,
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    
    function delete($menu_id,$id)
    {
        $menuitem = new menuitem($id);
        //delete bannercat
        if(!$menuitem->exists())
            show_404();
        $menuitem->delete();
        flash_message('success','Menu đã được xóa');
        redirect($this->admin.'menuitems/list_by_cat/'.$menu_id);
    }
    
    function active($menu_id,$id=0,$value)
    {
        $menuitem=new menuitem($id);
        if(!$menuitem->exists())
            show_404();
        $menuitem->active=($menuitem->active+1)%2;
        $menuitem->save();
        flash_message('success',"Kích hoạt thành công.");
        redirect($this->admin.'menuitems/list_by_cat/'.$menu_id);
    }
}
/* End of file menus.php */
/* Location: ./application/controller/menus.php */