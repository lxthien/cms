<?php
class util extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>153));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->list_all();
    }
    function uploadTop()
    {
        $this->load->library('file_lib');
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>1));
        $cauhinh = new Cauhinh();
        $cauhinh->where('fieldname',"topBanner");
        $cauhinh->get();
        if(!$cauhinh->exists())
            show_404();
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $dataupload=$this->file_lib->upload('image',"img/banner");
            $this->resize_image("img/banner/".$dataupload['file_name'],1015,267);
            if(!is_array($dataupload))
            {
                    flash_message('error',"Hình ảnh :".$dataupload);
                    $flag_error= true;
            }
            else
            {
                    
                    
                    $cauhinh->value = $dataupload['file_name'];
                    $cauhinh->save();
            }
        }
        $dis['cauhinh']  = $cauhinh;
        $dis['view']='util/topBanner';
        $dis['menu_active']='Banner top';
        $dis['title']="Thay đổi hình đại diện trang web";
        $dis['base_url'] = base_url();
        $this->viewadmin($dis);
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
        $config['thumb_marker'] = "_gia_pha_ho_tran";
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();          
      //  return null;
    }
}
/* End of file albums.php */
/* Location: ./application/controller/albums.php */