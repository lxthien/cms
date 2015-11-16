<?php
class Cartdetail extends DataMapper{
    
    public $table = "cartdetails";
    // Relationships
    public $has_one = array(
                        'cartitem',
                        'product');
    //construction object cartdetail.    
    function __construct($id=NULL){
        parent::__construct($id);
    }
}
?>