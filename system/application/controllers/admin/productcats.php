<?php
class Productcats extends MY_Controller {
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }
    function index()
    {
        $this->listAll();
    }
    
    function listAll($parent_cat = 0){
        
        $dis['base_url']=base_url();
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm danh mục",
    				"link"=>"{$this->admin_url}productcats/edit/",
    				"onclick"=>""		
    			)
         );
        
        //create productCat object
        $productcat =new Productcat();
        $productcat->order_by('position','asc');
        //if search 
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $productcat->like("name",$searchKey);
            $dis['title']="Kết quả tìm kiếm";
            $dis['searchKey'] = $searchKey;
            $dis['isSearch']  = true;
        }
        else
        {
            $dis['searchKey'] = "";
            $dis['isSearch']  = false;
            //if list all sub category
            if($parent_cat != 0)
            {
                $parentCat = new Productcat($parent_cat);
                $productcat->where("parentcat_id",$parent_cat);
                $dis['title']="Danh mục con của '".$parentCat->name."'";
                array_push($dis['nav_menu'],
                            array(
                				"type"=>"back",
                				"text"=>"Quay lại",
                				"link"=>"{$this->admin_url}productcats/listAll/".$parentCat->parentcat->id,
                				"onclick"=>""		
                			));
           
            }
            else
            {
                $productcat->where("parentcat_id",NULL);
                $dis['title']="Danh mục sản phẩm";
            }
        }
        $productcat->get_iterated();
        $dis['view']='productcats/list';
        $dis['menu_active']='Danh mục sản phẩm';
        
        $dis['productcat']=$productcat;
        $dis['base_url'] = base_url();
        
        $this->viewadmin($dis);
    }
    
    
    function checkUrlUnique($productCatId = 0)
    {
        $product = new Product();
        $url = $this->input->post('url');
        $product->where('url',$url);
        $product->get();
        if($product->result_count() > 0)
        {
            echo "false";
            exit;
        }
        
        $productcat = new Productcat();
        if($productCatId != 0){
            $productcat->where('id !=',$productCatId);
        }
        $productcat->where('url',$url);
        $productcat->get();
        if($productcat->result_count() > 0)
        {
            echo "false";
            exit;
        }
        echo "true";
        exit;
    
    }
    
    function edit($id=0){
        
        $productcat=new productcat($id);
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
                //echo $this->input->post('txtAbout');; die;
                $this->load->library('file_lib');
                //get the object parameter
                $productcat->name=$this->input->post('name');          
                $parentcat = new productcat(trim($this->input->post('productCategoryId')));
                $productcat->seo_title = $this->input->post('seo_title');
                $productcat->isShowInHot = $this->input->post('isShowInHot');
                $productcat->isShowInNew = $this->input->post('isShowInNew');
                $productcat->isShowInParentHot = $this->input->post('isShowInParentHot');
                $productcat->isHide = $this->input->post('isHide');
                $productcat->isShowLogo = $this->input->post('isShowLogo');
                $productcat->seo_keyword = $this->input->post('seo_keyword');
                $productcat->seo_description = $this->input->post('seo_description');
                $productcat->numProductHomepage = $this->input->post('numProductHomepage');
                $productcat->tag = $this->input->post('tag');
                $productcat->txtAbout = $this->input->post('txtAbout');
                $productcat->txtExterior = $this->input->post('txtExterior');
                $productcat->txtInterior = $this->input->post('txtInterior');
                $productcat->txtOperation = $this->input->post('txtOperation');
                $productcat->txtColor = $this->input->post('txtColor');
                $productcat->txtVideo = $this->input->post('txtVideo');
                $productcat->txtSpecification = $this->input->post('txtSpecification');
                $productcat->txtAccessories = $this->input->post('txtAccessories');

                if($_FILES['logo']['name'] != "")
                {
                    $dataupload=$this->file_lib->upload('logo', 'img/category/');   
                    if(is_array($dataupload)){    
                        $productcat->image = 'img/category/' . $dataupload['file_name'];
                    } else{
                         flash_message('error',$dataupload);
                    }
                }
                $this->load->helper('remove_vn_helper');
                if(!$productcat->exists())
                    $productcat->url = remove_vn($productcat->name);
                else
                    $productcat->url = $this->input->post('url');
                if($productcat->save(array('parentcat'=>$parentcat)))
                {
                    flash_message('success', 'Thành công. Thao tác đã được thực hiện.');
                    redirect($this->admin.'productcats/edit/'.$productcat->id);
                }
        }

        $dis['base_url']=base_url();
        
        $dis['nav_menu']=array(
    			array(
    				"type"=>"back",
    				"text"=>"Back",
    				"link"=>"{$this->admin_url}productcats/listAll/".$productcat->parentcat->id,
    				"onclick"=>""		
    			),
                array(
    				"type"=>"add",
    				"text"=>"Thêm danh mục khác",
    				"link"=>"{$this->admin_url}productcats/edit/",
    				"onclick"=>""		
    			)
                
        );
        //load any resource if the product category is exist
        if($productcat->exists())
        {
            //title depend on category name
            $dis['title'] = $productcat->name;
            $dis['productcatspec'] = $productcat->getSpec();
            /*$dis['nav_menu'] = array_merge($dis['nav_menu'],array(
                array(
    				"type"=>"add",
    				"text"=>"Thêm thông số",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"addSpecDialog_show()"		
    			),
                array(
    				"type"=>"edit",
    				"text"=>"Copy thông số",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"copySpecDialog_show()"		
    			),
                array(
    				"type"=>"edit",
    				"text"=>"Thêm sp homepage",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"showProductMultiDialog(0)"		
    			)
            ));*/
            $productHome = new producthome();
            $productHome->where('productcat_id',$productcat->id);
            $productHome->order_by('position','asc');
            $productHome->get_iterated();
            $dis['productHome'] = $productHome;
        }
        else
        {
            $dis['title']="Thêm/ Sửa danh mục sản phẩm";
        }

        $dis['menu_active']="Danh mục sản phẩm";
        $dis['view']="productcats/edit";
        $dis['object']=$productcat;
        $this->viewadmin($dis);
    }

    function addProductHome($productCatId)
    {
        $productCat = new productcat($productCatId);
        $arr=$this->input->post('productCheck');
        if($arr != "")
        {
            foreach($arr as $row){
               $productHomeItem = new producthome();
               $productHomeItem->productcat_id = $productCatId;
               $productHomeItem->product_id = $row;
               $productHomeItem->save();
               $productHomeItem->clear();
            } 
        }
        $productHome = new producthome();
        $productHome->where('productcat_id',$productCatId);
        $productHome->order_by('position','asc');
        $productHome->get_iterated();
        $dis['object']= $productCat;
        $dis['productHome'] = $productHome;
        $dis['base_url'] = base_url();
        echo $this->load->view('admin/productcats/tabs/productHome',$dis,true);
        exit;
    }
    
   function updateCatSpecPosition($cat_id){
        $allPost = array_keys($_POST);
        foreach($allPost as $row)
        {
            if(substr($row,0,12) == "specPosition")
            {
                $catSpecId = explode("_",$row);
                
                $productCatSpec = new productcatspec($catSpecId[1]);
                $productCatSpec->position = $this->input->post($row);
                $productCatSpec->save();
                $productCatSpec->clear();
            }
        }
        redirect("admin/productcats/edit/".$cat_id);
   }
   
   
   
   function updateProductHomePosition($cat_id){
        $allPost = array_keys($_POST);
        foreach($allPost as $row)
        {
            if(substr($row,0,19) == "productHomePosition")
            {
                $productHomeId = explode("_",$row);
                
                $productHome = new producthome($productHomeId[1]);
                $productHome->position = $this->input->post($row);
                $productHome->save();
                $productHome->clear();
            }
        }
        redirect("admin/productcats/edit/".$cat_id);
   }
    
    //TODO: refactor this method must move to spec controller and change name
    function loadSpec($cat_id)
    {
        $productcat = new Productcat($cat_id); 
        $dis['productcatspec'] = $productcat->getSpec();
        $dis['base_url'] = base_url();
        $dis['object']= $productcat;
        $this->load->view('admin/productcats/tabs/productSpec',$dis);
    }
    
    
    
    function loadSpecForProduct($cat_id)
    {
        $productcat = new Productcat($cat_id); 
        $dis['productSpec'] = $productcat->getSpec();
        
        $dis['allSpec'] = $productcat->getSpec();
        $dis['base_url'] = base_url();
        $dis['object']= $productcat;
        $this->load->view('admin/products/loadProductSpec',$dis);
    }
    function updatePosition()
    {
        $positionList = $this->input->post('positionList');
        $idList = $this->input->post('idList');
        $productCat = new productCat();
        for($i= 0; $i < count($idList) ; $i++)
        {
            $productCat->where("id",$idList[$i]);
            $productCat->get();
        
            $productCat->position = $positionList[$i];
            $productCat->save();
            $productCat->clear();
        }
        redirect("admin/productcats/listAll/".$this->input->post('parentId'));
    }
    
    function copySpec($cat_id)
    {
        $sourceCatId = $this->input->post("productCategoryCopyId");
        
        $ok = $this->input->post("OK");
        if($ok == "OK")
        {
            $sourceCat = new productcat($sourceCatId);
            
            $catSpecList = $sourceCat->productcatspec;
    
            foreach($catSpecList as $row)
            {
                $catSpecItem = $row->get_copy();
                $catSpecItem->productcat_id = $cat_id;
                $catSpecItem->save();
                $catSpecItem->clear();
            }
        }
    }
    
    function addSpec($cat_id)
    {
        $productcat = new Productcat($cat_id);
        
        //check the product GenSpecID 
        
        $specNewType = $this->input->post("specNewType");
   
        if($specNewType == "1")
        {
            $productCatSpecId = $this->input->post("productSpecId");
            $catSpecCheck = new productcatspec();
            $catSpecCheck->where_related_productgenspec("id",$productCatSpecId);
            $catSpecCheck->where_related_productcat("id",$cat_id);
            $catSpecCheck->get();
            if(!$catSpecCheck->exists())
            {
                $productGenSpec = new productgenspec($productCatSpecId);
                $productCatSpec = new productcatspec();
                $productCatSpec->productcat_id = $cat_id;
                if(!$productCatSpec->save(array("productgenspec"=>$productGenSpec)))
                    return "Có lỗi khi lưu productcatspec";
            }
        }
        else
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
            if($productGenSpec->save())
            {
               $productCatSpec = new productcatspec();
               $productCatSpec->productcat_id = $cat_id;
               if(!$productCatSpec->save(array("productgenspec"=>$productGenSpec)))
                    return "Có lỗi khi lưu productcatspec";
            }
            else
            {
                return "Lỗi khi lưu product general spect";
            }
        }
        
        
        
    }
    
    
    
    function editSpec($catSpecId)
    {
        $productCatSpec = new productcatspec($catSpecId);
        $productGenSpec = $productCatSpec->productgenspec;
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
        if($productGenSpec->save())
        {
           
        }
        else
        {
            return "Lỗi khi lưu product general spect";
        }
    }
    
    function deleteSpec($catSpecId)
    {
        $productCatSpec = new productcatspec($catSpecId);
        if($productCatSpec->productgenspec->isGroup != "1")
        {
            if($productCatSpec->delete())
                return "OK";
            //TODO: check the product that have this spec
        }
        else
        {
            $listSubspec = new productcatspec();
            $listSubspec->where_related_productgenspec("parentcat_id",$productCatSpec->productgenspec->id);
            $listSubspec->get();
            if($listSubspec->delete_all() && $productCatSpec->delete())
                return "OK";
        }
        return "FAIL";
    }
    
    function deleteAllSpec($cat_id)
    {
        $productCatSpec = new productcatspec();
        $productCatSpec->where('productcat_id',$cat_id);
        $productCatSpec->get();
        $productCatSpec->delete_all();
    }
    
    function deleteProductHome($id)
    {
        $productHome = new producthome($id);
        $productHome->delete();
    }
   
    function loadSpecInfo($specId)
    {
        $productCatSpec = new productcatspec();
        $productCatSpec->where("id",$specId);
        $productCatSpec->include_related("productgenspec","*",TRUE, TRUE);
        $productCatSpec->get();
        $dis['name'] = $productCatSpec->productgenspec->name;
        $dis['description'] = $productCatSpec->productgenspec->description;
        $dis['isGroup'] = $productCatSpec->productgenspec->isGroup;
        $dis['parentcat_id'] = $productCatSpec->productgenspec->parentcat_id;
        $dis['parentcatName'] = $productCatSpec->productgenspec->parentcat->name;
        $dis['id'] = $productCatSpec->id;
        $dis['specElementType'] = $productCatSpec->productgenspec->type;
        header('Content-type: application/json');
        echo json_encode($dis);
        exit;
    }
    
    
    function delete($id)
    {
        $this->checkRole(array(1));
        $productcat = new Productcat($id);
        $parent_id  = $productcat->parentcat->id;
        if($productcat->childCount() > 0)
        {
            show_message_admin("error","Vui lòng xóa hết danh mục con");
            redirect("admin/productcats/listAll/".$productcat->parentcat->id);
        }
        $productcat->delete();
        redirect("admin/productcats/listAll/".$parent_id);
        //TODO: check product
        
    }
    

}
?>