<?php
class Products extends MY_Controller{
    function __construct(){
        parent::MY_Controller();
        $this->session->set_userdata(array(config_item('session_admin').'menu_current'=>196));
        $this->load->library('login_manager');
    }

    function index(){
        $this->listAll();
    }

    function listAll($offset=0,$limit=20){      
        $products=new Product();
        $products->order_by('id','desc');
        $searchKey = "";
        if($_SERVER['REQUEST_METHOD']=="GET"){
                
        }
        else{
            $searchKey = $this->input->post("search_name");
            $products->distinct();
            $products->group_start();
            $products->like('name',$searchKey);
            $products->or_like('seo_keyword',$searchKey);
            $products->group_end();         
        }
        $products->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'products/listAll/',$products->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='products/list';
        $dis['products']=$products;
        $dis['menu_active']="Sản phẩm";
        $dis['title_table']="Trang hiện tại:".$products->paged->current_page.'/'.$products->paged->total_pages;
        $dis['title']="Tất cả sản phẩm";
        $dis['searchKey'] = $searchKey;
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}products/edit",
    				"onclick"=>""		
    			) ,
                array(
    				"type"=>"edit",
    				"text"=>"Copy sản phẩm",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"copyProductSpec()"		
    			)
                
         );
        $this->viewadmin($dis);
    }

    function listHot($offset=0,$limit=20){
        $products=new Product();
        $products->where('isHot',1);
        $products->order_by('hotPosition','asc');
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
                
                if( $this->input->post('submit') == "Cập nhật")
                {
                    foreach($_POST as $key =>$value)
                    {                                     
                        if(substr($key,0,11) == "hotPosition")
                        {
                            if(trim($this->input->post($key)) != "")
                            {
                                $keylist = explode("_",$key);
                                $pId = $keylist[1];
                                $product = new Product($pId);;
                                $product->hotPosition = $this->input->post($key);
                                $product->save();
                                $product->clear();
                            }
                        }
                    }
                    redirect('admin/products/listHot');
                }
                if($this->input->post('submit') == "Xóa chọn")
                {
                    
                    
                    $arr = $this->input->post('checkinput');
                    $this->firephp->log($arr);
                    
                    foreach($arr as $row)
                    {
                        $product = new Product($row);
                        $product->isHot = 0;
                        $product->save();
                        $product->clear();
                    }
                    redirect('admin/products/listHot');
                }
        }
        $products->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'products/listHot/',$products->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='products/listHot';
        $dis['products']=$products;
        $dis['menu_active']="Sản phẩm Hot";
        $dis['title_table']="Trang hiện tại:".$products->paged->current_page.'/'.$products->paged->total_pages;
        $dis['title']="Danh sách sản phẩm hot";
        
        
        $this->viewadmin($dis);
    }
    
    function listNew($offset=0,$limit=20){
        $products=new Product();
        $products->where('isNew',1);
        $products->order_by('newPosition','asc');
       
        if($_SERVER['REQUEST_METHOD']=="POST"){
                if( $this->input->post('submit') == "Cập nhật")
                {
                    foreach($_POST as $key =>$value)
                    {                                     
                        if(substr($key,0,11) == "newPosition")
                        {
                            if(trim($this->input->post($key)) != "")
                            {
                                $keylist = explode("_",$key);
                                $pId = $keylist[1];
                                $product = new Product($pId);;
                                $product->newPosition = $this->input->post($key);
                                $product->save();
                                $product->clear();
                            }
                        }
                    }
                    redirect('admin/products/listNew');
                }
                
                
                if($this->input->post('submit') == "Xóa chọn")
                {
                    
                    
                    $arr = $this->input->post('checkinput');
                    $this->firephp->log($arr);
                    
                    foreach($arr as $row)
                    {
                        $product = new Product($row);
                        $product->isNew = 0;
                        $product->save();
                        $product->clear();
                    }
                    redirect('admin/products/listNew');
                }
        }
        $products->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'products/listNew/',$products->paged->total_rows,$limit,4);
        $dis['base_url']=base_url();
        $dis['view']='products/listNew';
        $dis['products']=$products;
        $dis['menu_active']="Sản phẩm Mới";
        $dis['title_table']="Trang hiện tại:".$products->paged->current_page.'/'.$products->paged->total_pages;
        $dis['title']="Danh sách sản phẩm mới";
        
        
        $this->viewadmin($dis);
    }
    
    
    function checkUrlUnique($productId = 0)
    {
        $product = new Product();
        $url = $this->input->post('url');
        if($productId != 0){
            $product->where('id !=',$productId);
        }
        $product->where('url',$url);
        $product->get();
        if($product->result_count() > 0)
        {
            echo "false";
            exit;
        }
        
        $productcat = new Productcat();
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
    
    function checkNameUnique($productId = 0)
    {
        $product = new Product();
        $name = $this->input->post('name');
        if($productId != 0){
            $product->where('id !=',$productId);
        }
        $product->where('name',$name);
        $product->get();
        if($product->result_count() > 0)
        {
            echo "false";
            exit;
        }
        
        
        echo "true";
        exit;
    
    }

    function copyProduct()
    {
        $sourceProduct = new Product($this->input->post('productId'));
        if(!$sourceProduct->exists())
        {
            show_404();
        }
        else
        {
            //copy product first
            $product = $sourceProduct->get_copy();
            
           
            $i = 0;
            do{
                $i++;
                $name = "COPY ".$i." OF - ". $sourceProduct->name;
                $checkName = new Product();
                $checkName->where('name', $name);
                $checkName->get();
            }while ($checkName->result_count() > 0 );
            
            $product->name = $name;
            $product->productCode = "";
            $product->save();
            
            
            
            //copy category
            $sourceCategory = $sourceProduct->productcat;
            $product->save($sourceCategory->all);
            
            
            //copy spec 
            
            $sourceSpec = $sourceProduct->productspec;
            foreach($sourceSpec as $row)
            {
                $specItem = $row->get_copy();
                $specItem->product_id = $product->id;
                $specItem->save();
                $specItem->clear();
            }
            
            //photo copy 
            
            $photo = new Productphoto();
            $photo->where('product_id',$sourceProduct->id);
            $photo->get();
            foreach($photo as $row)
            {
                $photoitem = $row->get_copy();
                $photoitem->product_id = $product->id;
                $photoitem->save();
                $photoitem->clear();
            }
            //store copy 
            $store  = $sourceProduct->store;
            $product->save($store->all);
            
            
            //accessory 
            
            $acces = $sourceProduct->accessory;
            foreach($acces as $row){
               $accessory=new Product($row->id);
               $product->save(array('accessories'=>$accessory));
               $accessory->clear();    
            } 
            
            
            
            redirect("admin/products/edit/".$product->id);
        }
    }
    
    function saveNewProductSpec($id)
    {
        $product = new product($id);
        $productGenSpec = new productgenspec($this->input->post('newProductSpecId'));
        
        $ps = new productspec();
        $ps->where('productgenspec_id', $productGenSpec->id);
        $ps->where('product_id',$id);
        $ps->get();
        
        if($ps->result_count() == 0)
        {
            $productSpec = new productspec();
            $productSpec->product_id = $id;
            $productSpec->save(array('productgenspec'=>$productGenSpec));
        }      
    }

    function listByParent($id, $offset=0,$limit=20){
        $products=new Product();
        $products->where_related_productcat('id',$id);
        
        $products->get_paged($offset,$limit,TRUE);
        setPagination($this->admin.'products/listByParent/'.$id.'/',$products->paged->total_rows,$limit,5);
        $dis['base_url']=base_url();
        $dis['title_table']="Trang hiện tại:".$products->paged->current_page.'/'.$products->paged->total_pages;
        $dis['products']=$products;
        $dis['view']='products/list';
        $dis['menu_active']="Sản phẩm";
        $dis['searchKey'] = "";
        $dis['title']="";
        $dis['nav_menu']=array(
    		
                array(
    				"type"=>"add",
    				"text"=>"Thêm",
    				"link"=>"{$this->admin_url}products/edit/0/".$id,
    				"onclick"=>""		
    			)
         );
        $this->viewadmin($dis);
    }
    
    
    function isSpec($key)
    {
        if(substr($key,0,4) == "spec")
            return true;
        else
            return false;
    }

    function getSpecId($key)
    {
        return substr($key,5,strlen($key));
    }

    function edit($id=0,$productCatId = 0)
    {
        $product=new Product($id);
        if(!$product->exists())
        {
            $product->isAutoGenerateUrl = 1;
            $product->active = 1;
        }
        /**
         * get list store
         */
        $stores = new Store();
        $stores->order_by('position','asc');
        $stores->get_iterated();
        $dis['stores'] = $stores;
        
        
        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $this->load->library('file_lib');  
            
            //save any param   
            $product->name = $this->input->post('productName');
            $product->productstatu_id = $this->input->post('productstatu_id');
            $product->productmanufacture_id = $this->input->post('productManufactureId');
            $product->isSale = $this->input->post('isSale');
            $product->saleOffPrice = $this->input->post('saleOffPrice');
            $product->saleOffPriceText = $this->input->post('saleOffPriceText');
            $product->price = $this->input->post('price');
            $product->priceText = $this->input->post('priceText');
            $product->isUsed = $this->input->post('isUsed');
            $product->isGift = $this->input->post('isGift');
            $product->isHot = $this->input->post('isHot');
            $product->isNew = $this->input->post('isNew');
            $product->seo_title = $this->input->post('seo_title');
            $product->seo_description = $this->input->post('seo_description');
            $product->seo_keyword = $this->input->post('seo_keyword');
            //$product->searchKey = $this->input->post('searchKey');
            $product->txtDescription = $this->input->post('txtDescription');
            $product->txtGift = $this->input->post('txtGift');
            $product->txtSumary = $this->input->post('txtSumary');
            $product->txtVideo = $this->input->post('txtVideo');
            $product->url = $this->input->post('url');
            $product->origin = $this->input->post('origin');
            $product->warranty = $this->input->post('warranty');
            $product->active = $this->input->post('isActive');
            $product->promotion = $this->input->post('promotion');
            $product->status = $this->input->post('productstatus');
            $product->inBox = $this->input->post('inBox');
            $product->isLinePrice = $this->input->post('isLinePrice');
            $product->isLinePriceSaleOff = $this->input->post('isLinePriceSaleOff');
            $product->isHighlightPriceSaleOff = $this->input->post('isHighlightPriceSaleOff');
            $product->priceColor = $this->input->post('priceColor');
            $product->saleOffPriceColor = $this->input->post('saleOffPriceColor');
            $product->color = $this->input->post('color');
            if(trim($product->saleOffPrice) == "")
            {
                $product->finalPrice = $product->price;
            }else
            {
                $product->finalPrice = $product->saleOffPrice;
            }
            
            
            if($product->exists())
                $product->updator  = $this->logged_in_user->username;
            else
                $product->creator  = $this->logged_in_user->username;
            //check product representive image is available inside post request
            if($_FILES['logo']['name'] != "")
           {
                $dataupload=$this->file_lib->upload('logo', 'img/products/');   
                if(is_array($dataupload)){    
                    $product->image = 'img/products/' . $dataupload['file_name'];
                } else{
                     flash_message('error',$dataupload);
                }
           }
            //first save
            if($product->save())
            {
                //get and update accessories list
                //TODO: refactor for ajax request dont't need to delete and recreate it
                $accessories = new Product();
                $arrAcc = $this->input->post('checkinput');
                if(count($arrAcc > 0))
                {
                    $accessories->where_in('id',$arrAcc);
                }
                $accessories->get();
                $product->delete_accessory($accessories);
                
                
                
                /**
                 * get all product spec in the post data
                 *                 post Array spec Key
                 */
                $postArraySpecKey = array();
                $productArraySpecKey = $product->getArrayGenSpec();
                $productCatIdList = array();
                $storeIdList = array();
                
                foreach($_POST as $key =>$value)
                {
                    if($this->isSpec($key))
                    {
                        
                        $genSpecId = $this->getSpecId($key);
                        array_push($postArraySpecKey,$genSpecId);
                    }
                    
                    
                    if(substr($key,0,17) == "productCategoryId")
                    {
                        if(trim($this->input->post($key)) != "")
                        {
                            $productCatItem = new Productcat($this->input->post($key));
                            array_push($productCatIdList,$productCatItem->id);
                            $productCatItem->clear();
                        }
                    }
                    
                    if(substr($key,0,5) == "store")
                    {
                        if(trim($this->input->post($key)) != "")
                        {
                            array_push($storeIdList,$this->input->post($key));
                        }
                    }
                    
                    
                    
                    
                }
                
                //update store
                foreach($stores as $row)
                {
                    if( !in_array($row->id,$storeIdList) && $row->is_related_to($product) )
                    {
                        $row->delete($product);
                    }
                    else
                    {
                        if(in_array($row->id,$storeIdList) && !$row->is_related_to($product) )
                        {
                            $product->save($row);
                        }
                    }
                }
                
                
                
                //TODO: refator the authentication and role permission,put it to global variable for fast change in the future
                $usedProductCategoryId = 287;
                //$usedproductCat = new Productcat($usedProductCategoryId);
                if($product->isUsed == 1)
                {
                    if(!in_array($usedProductCategoryId,$productCatIdList))
                    {
                        array_push($productCatIdList,$usedProductCategoryId);
                    }
                } 
                /**
                 * update the product cat list
                 */
                //add 0 to list to ensure that everything is good
                array_push($productCatIdList,0);
                $productCatList = new Productcat();
                $productCatList->where_in('id',$productCatIdList);
                $productCatList->get();
                $oldProductCat  = $product->productcat;
                $product->delete($oldProductCat->all);
                $product->save(array($productCatList->all));
                /**
                 * check product is checked as used product. add used category to it if not available
                 */
                 
                
                
                
                 
                //get the spec that product has but post array is not , delete it for asynocho
                $array_diff = array_diff($productArraySpecKey,$postArraySpecKey);
            
                //delete missed product
                foreach($array_diff as $row)
                {
                    $productMissedSpec = $product->getProductSpec($row);
                    if($productMissedSpec)
                    {
                        $productMissedSpec->delete();
                    }
                    $productMissedSpec->clear();
                }
                //insert new spec to product or edit the exists spec
                
                
                foreach($postArraySpecKey as $row)
                {
                    //read the post value 
                    //by my convention that post key of spec have form "spec_[productGenSpecId]"
                    $value = $this->input->post('spec_'.$row);        
                    $position = $this->input->post('position_'.$row);    
                    $productGenSpecItem = new productgenspec($row);
                    $productSpecItem = $product->getProductSpec($row);
                    
                    
                    
                    //check if the product spect is available
                    if($productSpecItem && $productSpecItem->exists())
                    {
                        $productSpecItem->value = $value;
                        $productSpecItem->position = $position;
                        $productSpecItem->save();
                    }
                    else
                    {
                        //create new productSpec item if it not available
                        $productSpecItem = new productspec();
                        $productSpecItem->value =  $value;
                        $productSpecItem->position = $position;
                        if(!$productSpecItem->save(array('product'=>$product,'productgenspec'=>$productGenSpecItem)))
                        {
                            flash_message('error',"Saving error at item" + $productGenSpecItem->name);
                        }   
                    }
                    
                    $productGenSpecItem->clear();
                    $productSpecItem->clear();
                    
                    
                    
                }
                
                
                
                /**
                 * update product photo position
                 */
                 
                $productPhotoList = $product->productPhoto;
    
               
                foreach($productPhotoList as $row)
                {
                    $row->position = $this->input->post('positionPhoto_'.$row->id);
                    $row->save();
                    $row->clear();
                }
                redirect("admin/products/edit/".$product->id);
            }
                  
            //specific load 
            
        }
        
        
        //create list product status
        $productstatus = new Productstatu();
        $productstatus->order_by('id', 'asc');
        $productstatus->get()->all;
        //create list productcomment.
        $productcomments = new Productcomment();
        $productcomments->order_by('id', 'desc');
        $productcomments->where('product_id', $id);
        $productcomments->get()->all;
        //create list productphotos
        $productphotos= new Productphoto();
        
        $productphotos->where('product_id', $id);
        $productphotos->order_by('position','asc');
        $productphotos->order_by('id', 'desc');
        $productphotos->get_iterated();
        
        
        $accessories = $product->accessory;
        $dis['accessories'] = $accessories;
        
        
        $productSpec = new productspec();
        $productSpec->where('product_id',$product->id);
        $productSpec->order_by('position','asc');
        $productSpec->get_iterated();
        
        
        
        $productCat = $product->productcat;
        
        
        $allSpec = new productspec();
        if($product->exists())
            $allSpec->where('product_id',$product->id);
        else
            $allSpec->where('product_id',0);
        $allSpec->order_by('position','asc');
        $allSpec->get_iterated();
        //if create new product with productcat
        if(!$product->exists())
        {
            if($productCatId != 0)
            {
                $productCat = new Productcat($productCatId);
                $productSpec = $productCat->getSpec();
                $allSpec = $productCat->getSpec();
            }
        }
        $dis['productSpec'] = $productSpec;
        $dis['productCat'] = $productCat;
        $dis['allSpec'] = $allSpec;
        //setPagination($this->admin.'productphoto/listAll/',$productphotos->paged->total_rows,$limit,4);
        $dis['title_table']="Trang hiện tại:";
        $dis['productphotos']=$productphotos;
        
        $dis['base_url']=base_url();
        $dis['object']=$product;
        $dis['productcomments'] = $productcomments;
        $dis['productstatus'] = $productstatus;
       
        $dis['title']="Thêm/ Sửa sản phẩm";
        $dis['menu_active']="Sản phẩm";
        $dis['view']="products/edit";
        $dis['nav_menu']=array(
    			array(
    				"type"=>"add",
    				"text"=>"Thêm sp khác",
    				"link"=>"{$this->admin_url}products/edit",
    				"onclick"=>""		
    			) ,
                array(
    				"type"=>"edit",
    				"text"=>"Copy sản phẩm",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"copyProductSpec()"		
    			)
        );
        if($product->exists())
        {
            
            array_push($dis['nav_menu'],
                array(
    				"type"=>"add",
    				"text"=>"Thêm hình ảnh",
    				"link"=>"{$this->admin_url}productphotos/edit/".$product->id,
    				"onclick"=>""		
    			)/*,
                array(
    				"type"=>"add",
    				"text"=>"Thêm bình luận",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"addComent()"		
    			),
                array(
    				"type"=>"edit",
    				"text"=>"Thêm thuộc tính",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"addNewProductSpec()"		
    			),
                array(
    				"type"=>"edit",
    				"text"=>"Thêm phụ kiện",
    				"link"=>"javascript:void(0)",
    				"onclick"=>"showProductMultiDialog(".$product->id.")"		
    			)*/
            );
        }else
        {
            $product->isAutoGenerateUrl = 1;
            $product->isActive = 1;
        }
        $this->viewadmin($dis);
    }
    
    
    function copySpec()
    {
        $productId = trim($this->input->post('productId'));
        $sourceProduct = new product($productId);
        
        $dis['video'] = $sourceProduct->txtVideo;
        $dis['description'] = $sourceProduct->txtDescription;
        $dis['sumary'] = $sourceProduct->txtSumary;
        $dis['gift'] = $sourceProduct->txtGift;;
        $dis['spec'] = $this->loadProductSpec($sourceProduct->id);
        header('Content-type: application/json');
        echo json_encode($dis);
        exit;
    }
    function loadProductSpec($id)
    {
        $product = new product($id);
        $dis['productSpec'] = $product->productSpec;
        $dis['object'] = $product;
        $dis['base_url'] = base_url();
        $allSpec = new productspec();
        $allSpec->where('product_id',$product->id);
        $allSpec->order_by('position','asc');
        $allSpec->get_iterated();
       
        $dis['allSpec'] = $allSpec;
       return $this->load->view('admin/products/loadProductSpec',$dis,TRUE);
    }
    
    
    function loadProductComment($id)
    {
        $product = new product($id);
        $dis['productcomments'] = $product->productcomment->order_by("creationDate",'desc');
        $dis['object'] = $product;
        $dis['base_url'] = base_url();
        return $this->load->view('admin/products/loadComment',$dis);
    }
    
    function loadAccessories($id)
    {
        $product = new product($id);
        $dis['accessories'] = $product->accessory;
        $dis['base_url'] = base_url();
        $dis['object'] = $product;
        $this->load->view('admin/products/loadAccessories',$dis);
    }
    function loadNewProductSpec($id)
    {
        $product = new product($id);
        $dis['productSpec'] = $product->productSpec;
        $dis['object'] = $product;
        $dis['base_url'] = base_url();
        $allSpec = new productspec();
        $allSpec->where('product_id',$product->id);
        $allSpec->order_by('position','asc');
        $allSpec->get_iterated();
        $dis['allSpec'] = $allSpec;
       
       return $this->load->view('admin/products/loadProductSpec',$dis);
    }
    function addAccessories($productId)
    {
        $product = new product($productId);
        $arr=$this->input->post('productCheck');
        if($arr != "")
        {
            foreach($arr as $row){
               $accessory=new Product($row);
               $product->save(array('accessories'=>$accessory));
               $accessory->clear();    
            } 
        }
        
    }
    function deleteAccessories($productId){
        $sentData = $this->input->post('sendData');
        $sentData = trim($sentData,'-');
        $sentData = explode("-",$sentData);
        array_push($sentData,"0");
        $acc = new product();
        $acc->where_in('id',$sentData);
        $acc->get();
        $product = new Product($productId);
        $product->delete($acc->all,'accessory');
    }
    function active($id=0,$value){
        if($id!=0){
            $products=new Product($id);
            if(!$products->exists())
                show_404();
            $products->active=($products->active+1)%2;
            $products->save();
        }
        else{
            $arr=$this->input->post('checkinput');
            foreach($arr as $row)            {
               $products=new Product($row);
               $products->active = $value;
               $products->save();
               $products->clear();    
            }
        }
        flash_message('success',"Kích hoạt thành công.");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete($id)
    {
        $this->checkRole(array(1));
        $product = new Product($id);
        $product->deep_delete();
        
        redirect($_SERVER['HTTP_REFERER']);
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
        $config['width'] = 70;
        $config['height'] = 110;
        $config['quality'] = '100%';
        $config['thumb_marker'] = "_70x110";
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
}
?>