<?php
class Productphoto extends DataMapper {
    public $table = 'productphotos';
    public $has_one = array('product');
    public function __construct($id=NULL){
        parent::__construct($id);
    }
    
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new Productphoto();
            $o->where('product_id',$this->product_id);
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
?>