<?php
class Stores extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function list_all()
    {
        $dis['base_url']=base_url();
        $store =new store();
        $store->order_by('position','asc');
        $store->get_iterated();
        $dis['view']='stores/list';
        $dis['menu_active']='Cửa hàng';
        $dis['title']="Danh sách cửa hàng";
        $dis['store']=$store;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}stores/edit/",
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    function edit($id=0)
    {
        $store=new store($id);
        if($_SERVER['REQUEST_METHOD']=="GET")
        {
        }
        else
        {
               $store->name=$this->input->post('name');
               $store->address=$this->input->post('address');
               $store->phone=$this->input->post('phone');
               $store->map=$this->input->post('map');
               if($store->save())
               {
                    redirect($this->admin.'stores/list_all/');
               }
        }
       
        $dis['base_url']=base_url();
        $dis['title']="Menu";
        $dis['menu_active']="Cửa hàng";
        $dis['view']="stores/edit";
        $dis['object']=$store;
    
        $this->viewadmin($dis);
    }
   
    function up_position($id,$step=1)
    {
        $o=new store();
        $o->get_by_id($id);
        if(!$o->exists())
        {
            show_404("Không tìm thấy");
        }
        for($i=0;$i<$step;$i++)
        {
            $o->up_position();
        }
      redirect($this->admin.'stores/list_all/');
    }
    function down_position($id,$step=1)
    {
        $o=new store();
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
       redirect($this->admin.'stores/list_all/');
    }
    function delete($id)
    {
        
        $store=new store($id);
        //delete city
        $store->delete($store->product);
        $store->delete();
         
        //redirect to city
        redirect($this->admin.'stores/list_all/');
    }
    
}
/* End of file stores.php */
/* Location: ./application/controller/stores.php */