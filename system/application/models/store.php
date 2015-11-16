<?php
class Store extends DataMapper
{
    public $table = "stores";
    
    public $has_many=array("product");
    // --------------------------------------------------------------------
    // Relationships
    // --------------------------------------------------------------------   
    
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    public $validation = array(	
    );
    function __construct($id = null)
    {
        parent::__construct($id);
    }
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new Store();
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
/* End of file metro.php */
/* Location: ./application/models/metro.php */
