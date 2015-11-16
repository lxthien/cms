<?php
class Customer extends DataMapper{
    
    public $table = "customers";
    // Relationships
    public $has_many = array('cartitem');
    //construction object customer.
    function __construct($id=NULL){
        parent::__construct($id);
    }
}
?>