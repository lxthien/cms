<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * productspec
 *
 * product  specification
 *
 * @package		Model
 * @author		vuong.nguyen@saigontechnology.vn
 */
class productspec extends DataMapper{
    
    public $table = 'productspecs';
    
    public $has_one=array(
            "product",
            "productgenspec"
    );
    public $has_many=array();
    
    function __construct($id = NULL){
        parent::__construct($id);
    }
    
    public $validation = array();
    
    function save($object = '', $related_field = '')
    {
        
        if ( $this->position == NULL || $this->position == 0) {
            $o = new productspec();
            $o->where("product_id",$this->product_id);
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
/* End of file productspec.php */
/* Location: ./application/models/productspec.php */
?>