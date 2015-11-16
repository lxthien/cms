<?php
class Productmanufacture extends DataMapper{
    public $table = 'productmanufactures';
    
    public $has_many = array(
                    'product');
    function __construct($id = NULL){
        parent::__construct($id);
    }
}
?>