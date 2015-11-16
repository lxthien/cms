<?php
class Cartitem extends DataMapper{
    
    public $table = "cartitems";
    // Relationships
    public $has_one = array('customer');
    public $has_many = array('cartdetail');
    //construction object cart.
    function __construct($id=NULL){
        parent::__construct($id);
    }
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists() ||  empty($this->code)) {
            $o = new Cartitem();
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
            $this->code = $position;
        }
        return parent::save($object, $related_field);
    }
}
?>