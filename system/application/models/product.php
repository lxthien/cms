<?php
class Product extends DataMapper
{
    public $table = "products";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one=array(
        'productmanufacture',
        'product'=>array(
            'class'=>'product',
            'other_field' => 'product'
        )
    );
    public $has_many=array(
        'productcat',
        'productcomment',
        'productspec',
        'productphoto',
        'accessory'=>array(
            'class'=>'product',
            'other_field'=>'product',
            'reciprocal' => TRUE
        ),
        'product'=>array(
            'other_field'=>'accessory'
        ),
        "store",
        'cartdetail',
        'producthome'
    );
    
    public $validation = array(
         'name'=>array(
            'label'=>'Tên sản phẩm',
            'rules'=>array('required'))
         
    );
    
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }
    
    function increase_view()
    {
        $this->view_count  += 1 ;
        $this->save();
    }
    function getName(){
        return $this->name;
    }
    
    function getRealPrice()
    {
        return trim($this->saleOffPrice) != ""?number_format($this->saleOffPrice):$this->getPrice();
    }
    
    function getPriceText()
    {
        return trim($this->priceText) == ""?"":number_format(trim($this->priceText));
    }
    
    function getPriceSaleOffText()
    {
        return trim($this->saleOffPriceText) == ""?"Didongviet.vn giảm còn":trim($this->saleOffPriceText);
    }
    
    function getRealPriceNum()
    {
        return trim($this->saleOffPrice) != ""?$this->saleOffPrice:$this->price;
    }
    
    /**
     * Product::getSpec()
     * 
     * @return list of product spec order by position
     */
    function getSpec()
    {
        $productSpec = new productspec();
        $productSpec->where('product_id',$this->id);
        $productSpec->order_by('position','asc');
        $productSpec->include_related("productgenspec","*",TRUE, TRUE);
        $productSpec->get_iterated();
        return $productSpec;
    }
    
    function getPrice()
    {
        return trim($this->price) != ""?number_format($this->price):"";
    }
    
    function getSalePrice()
    {
        return trim($this->saleOffPrice) != ""?number_format($this->saleOffPrice):"";
    }
    
    /**
     * Product::getArrayGenSpec()
     * 
     * @return array of product general spec
     */
    function getArrayGenSpec()
    {
        $arraySpec = array();
        if($this->exists())
        {
            foreach($this->productspec as $row)
            {
                array_push($arraySpec,$row->productgenspec->id);
            }
        }
        return $arraySpec;
    }
    
    
    function getProductSpec($productGenSpecId)
    {
        $productSpec = new productspec();
        $productSpec->where('product_id',$this->id);
        $productSpec->where('productgenspec_id',$productGenSpecId);
        $productSpec->get();
        if(!$productSpec->exists())
            return false;
        else
            return $productSpec;
    }
    
    


    function max_id(){
        $max = new Product();
        $max->select_max('id');
        $max->get();
        return $max->id;
    }
    /********************************
    * Override the save method
    * check if new insert the position property
    **********************************/
    function save($object = '', $related_field = '')
    {
        if (!$this->exists() ||  empty($this->productCode)) {
            $o = new Product();
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
            $position=(string)$this->position;
            $l=6-strlen($position);
            $st="";
            for($i=0;$i<$l;$i++)
            {
                $st.="0";
            }
            $position=$st.$position;
            $this->productCode = $position;
        }
        return parent::save($object, $related_field);
    }
    function deep_delete()
    {
        $this->productspec->delete_all();
        $this->productphoto->delete_all();
        parent::delete();
    }
}
/* End of file news.php */
/* Location: ./application/models/news.php */