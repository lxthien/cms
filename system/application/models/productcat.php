<?php
class Productcat extends DataMapper{
    
    public $table = 'productcats';
    
    public $has_one=array(
        'parentcat'=>array(
            'class'=>'productcat',
            'other_field' => 'child'
        )
    );
    public $has_many=array(
        'product',
        'child'=>array(
            'class'=>'productcat',
            'other_field'=>'parentcat'
        ),
        'productcatspec',
        'producthome'
    );
    
    function __construct($id = NULL){
        parent::__construct($id);
    }

    public $validation = array(
         'name'=>array(
            'label'=>'Tên danh mục',
            'rules'=>array('trim','max_length'=>200)),
         'url'=>array(
            'label'=>"url",
            'rules'=>array("trim","unique")
            )
    );
    
    
    
    /**
     * Productcat::getSpec()
     * 
     * get all the productCategory's specification (group include)
     * @return void
     */
    function getSpec()
    {
        $productCatSpec = new productcatspec();
        $productCatSpec->where("productcat_id",$this->id);
        $productCatSpec->order_by("position",'asc');
        $productCatSpec->include_related("productgenspec","*",TRUE, TRUE);
        $productCatSpec->get_iterated();
        return $productCatSpec;
    }
    
    
    function buildUrl()
    {
        $url = $this->url;
        $productCat = $this;
        while($productCat->parentcat_id != null)
        {
            $productCat = new productcat($productCat->parentcat_id);
            $url = $productCat->url."/".$url;
        }
        
        return $url;
    }
    
    
    function getProductHome(){
        $productHome = new producthome();
        $productHome->where_related_product('active',1);
        $productHome->where('productcat_id',$this->id);
        $productHome->order_by('position','asc');
        $productHome->get_iterated($this->numProductHomepage);
        return $productHome;
    }
    
    
    function buildBreadCum(){
        $url = '<a href="'.$this->url.'"> '.$this->name.' </a>';
        $productCat = $this;
        while($productCat->parentcat_id != null)
        {
            $productCat = new productcat($productCat->parentcat_id);
            $url = '<a href="'.$productCat->url.'"> '.$productCat->name.' </a> &raquo; '.$url;
        }
        
        return $url;
    }

    function getRootId()
    {
        
        $productCat = $this;
        while($productCat->parentcat_id != null)
        {
            $productCat = new productcat($productCat->parentcat_id);
        }
        
        return $productCat->id;
    }
    
    /**
     * Productcat::childCount()
     * 
     * @return the number of sub productcategory
     */
    function childCount()
    {
        $child = new Productcat();
        $child->where('parentCat_id',$this->id);
        $child->get_iterated();
        return $child->result_count();
    }


    /**
     * Productscat::getAllChildCat()
     * get all child category in tree
     * @param mixed $parentCat
     * @return
     */
    function getAllChildCat($parentCat = NULL,$listProductCat = NULL)
    {
        if($listProductCat == NULL)
        {
            $listProductCat = array();
        }
        if($parentCat == NULL)
        {
            $parentCat = $this;
        }
        else
        {
            array_push($listProductCat,$parentCat->get_clone());
        }
       
        $child = new Productcat();
        $child->where('parentcat_id',$parentCat->id);
        $child->get_iterated();
        
        if($child->result_count() > 0)
        {
            foreach($child as $row)
            {    
                $listProductCat = $this->getAllChildCat($row,$listProductCat);  
            }
        }
        
        return $listProductCat;
    }
    
    
    
    
    
    function printListName($list,$text)
    {
        $CI =& get_instance();
         $listNameChildCat = array();
        foreach($list as $row)
        {
            array_push($listNameChildCat,$row->name);
        } 
        $CI->firephp->log($listNameChildCat,$text);
    }
    
    /**
     * Productscat::getAllProduct()
     * get all the product belong to a category ,direct or indirect).
     * @param mixed $condition
     * @param mixed $offset
     * @param mixed $limit
     * @return
     */
    function getAllProduct($condition = array(),$orderBy  = "id",$orderDirection = "desc",$offset = null,$limit = null)
    {
        $listChildCat = $this->getAllChildCat();
        $listIntChildCat = array();
       
        foreach($listChildCat as $row)
        {
            array_push($listIntChildCat,$row->id);
       //     array_push($listNameChildCat,$row->name);
        } 
        array_push($listIntChildCat,$this->id);
        //$CI =& get_instance();
        //$CI->firephp->log("child",$listNameChildCat);
        $product = new product();
        $product->where_in_related_productcat('id',$listIntChildCat);
        $product->order_by($orderBy,$orderDirection);
        if(count($condition) > 0)
        {
            $product->where($condition);
        }
        $product->distinct();
        $product->get_iterated($limit,$offset);
        
        
        return $product;
    }
    
    
    
    
    
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new productcat();
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
        }
        return parent::save($object, $related_field);
    }
}
/* End of file productcat.php */
/* Location: ./application/models/productcat.php */
?>