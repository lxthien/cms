<?php
class productgenspecs extends MY_Controller {
    function __construct(){
        parent::MY_Controller();
      // $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function addGenSpec()
    { 
        $productGenSpec = new productgenspec();
        $productGenSpec->name = $this->input->post("specName");
        $productGenSpec->description = $this->input->post("specDescription");
        $productGenSpec->type = $this->input->post('specElementType');
        if($this->input->post("specType") == "1")
        {
            $productGenSpec->parentcat_id = $this->input->post("specGroupId");
            $productGenSpec->isGroup = 0;         
        }
        else
        {
            $productGenSpec->isGroup = 1;      
        }
        if(!$productGenSpec->save())
        {
          return "Lỗi khi lưu product general spect";
        }
    }
    
    
    function editGenSpec($id)
    {
      
        $productGenSpec = new productgenspec($id);
        $productGenSpec->name = $this->input->post("specName");
        $productGenSpec->description = $this->input->post("specDescription");
        $productGenSpec->type = $this->input->post('specElementType');
        if($this->input->post("specType") == "1")
        {
            $productGenSpec->parentcat_id = $this->input->post("specGroupId");
            $productGenSpec->isGroup = 0;         
        }
        else
        {
            $productGenSpec->parentcat_id = "";
            $productGenSpec->isGroup = 1;      
        }
        if(!$productGenSpec->save())
        {
           return "Lỗi khi lưu product general spect";
        }
    }
    
    
    function loadSpecInfo($specId)
    {
        $productGenSpec = new productgenspec($specId);
        
        $dis['name'] = $productGenSpec->name;
        $dis['description'] = $productGenSpec->description;
        $dis['isGroup'] = $productGenSpec->isGroup;
        $dis['parentcat_id'] = $productGenSpec->parentcat_id;
        $dis['parentcatName'] = $productGenSpec->parentcat->name;
        $dis['id'] = $productGenSpec->id;
        $dis['specElementType'] = $productGenSpec->type;
        header('Content-type: application/json');
        echo json_encode($dis);
        exit;
    }
}