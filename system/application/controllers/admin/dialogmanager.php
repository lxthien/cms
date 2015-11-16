<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * dialog manager
 *
 * manager product dialog content
 *
 * @package		Controller
 * @author		vuong.nguyen@saigontechnology.vn
 */
class Dialogmanager extends MY_Controller
{
    function __construct(){
        parent::MY_Controller();
        $this->load->library('login_manager');
    }
    
    function productCatDialog()
    {
        $category = new Productcat();
        $dis['searchKey'] = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $category->like("name",$searchKey);
            $category->or_like_related_parentcat('name',$searchKey);
            $dis['searchKey'] = $searchKey;
            $dis['isSearch']  = true;
        }
        $category->order_by("parentcat_id",'asc');
        $category->order_by("name","asc");
        $category->get_iterated();
        $this->firephp->log($category->check_last_query('',true));
        $dis['base_url'] = base_url();
        $dis['category'] = $category;
        $this->load->view("admin/layout/dialogContent/productCategoryDialogContent",$dis);
    }
    
    function productDialog()
    {
        $product = new Product();
        $dis['searchKey'] = "";
        $dis['searchProductCat'] = "";
        $dis['searchProductCatId'] = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $searchProductCat = $this->input->post('searchProductCat');
            $searchProductCatId = $this->input->post('searchProductCatId');
            
            $product->like("name",$searchKey);
            if($searchProductCatId != "")
            {
                $product->where_related_productcat('id',$searchProductCatId);
            }
            
            $dis['searchKey'] = $searchKey;
            $dis['searchProductCat'] = $searchProductCat;
            $dis['searchProductCatId'] = $searchProductCatId;
            $dis['isSearch']  = true;
        }
        
        $product->order_by("name","asc");
        $product->get_iterated(100);
        $dis['base_url'] = base_url();
        $dis['product'] = $product;
        $this->load->view("admin/layout/dialogContent/productDialogContent",$dis);
    }
    
    
    function productMultiDialog($productId = 0)
    {
        $chooseProduct = new Product($productId);
        $product = new Product();
        $dis['searchKey'] = "";
        $dis['searchProductCat'] = "";
        $dis['searchProductCatId'] = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $searchProductCat = $this->input->post('searchProductCat');
            $searchProductCatId = $this->input->post('searchProductCatId');
            $product->like("name",$searchKey);
            if($searchProductCatId != "")
            {
                $product->where_related_productcat('id',$searchProductCatId);
            }
            
            $dis['searchKey'] = $searchKey;
            $dis['searchProductCat'] = $searchProductCat;
            $dis['searchProductCatId'] = $searchProductCatId;
            $dis['isSearch']  = true;
        }
        if($productId != 0 && $chooseProduct->accessory->result_count() > 0)
            $product->where_not_in('id',$chooseProduct->accessory);
        $product->order_by("name","asc");
        $product->get_iterated(100);
        
        $dis['chooseProduct'] = $chooseProduct;
        $dis['base_url'] = base_url();
        $dis['product'] = $product;
        $this->load->view("admin/layout/dialogContent/productMultiSelectDialogContent",$dis);
    }
    
    function productManufactureDialog()
    {
        $manufacture = new Productmanufacture();
        $dis['searchKey'] = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $manufacture->like("name",$searchKey);
            $dis['searchKey'] = $searchKey;
            $dis['isSearch']  = true;
        }
        $manufacture->order_by("name","asc");
        $manufacture->get_iterated();
        $dis['base_url'] = base_url();
        $dis['manufacture'] = $manufacture;
        $this->load->view("admin/layout/dialogContent/productManufactureDialogContent",$dis);
    }
    
    function productSpecGroupdialog()
    {
        $productGenSpec = new productgenspec();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $productGenSpec->like("name",$searchKey);
            $dis['searchKey'] = $searchKey;
            $dis['isSearch']  = true;
        }
        $productGenSpec->order_by("name","asc");
        $productGenSpec->where("isGroup","1");
        $productGenSpec->get_iterated();
        $dis['base_url'] = base_url();
        $dis['productGenSpec'] = $productGenSpec;
        $this->load->view("admin/layout/dialogContent/productSpecGroupdialogContent",$dis);
    }
    //TODO: move co another controller
    function deleteProductGenSpec($id)
    {
        $productGenSpec = new productgenspec($id);
        $productGenSpec->completeDelete();
    }
    
    function productSpecdialog()
    {
        $productGenSpec = new productgenspec();
        $dis['searchKey'] = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $searchKey = $this->input->post('searchName');
            $productGenSpec->like("name",$searchKey);
            $dis['searchKey'] = $searchKey;
            $dis['isSearch']  = true;
        }
        $productGenSpec->order_by("parentcat_id","asc");
        $productGenSpec->order_by("name","asc");
        $productGenSpec->get_iterated();
        $dis['base_url'] = base_url();
        $dis['Spec'] = $productGenSpec;
        $this->load->view("admin/layout/dialogContent/productSpecDialogContent",$dis);
    }
}