<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * productcatspec
 *
 * product category specification
 *
 * @package		Model
 * @author		vuong.nguyen@saigontechnology.vn
 */
class productcatspec extends DataMapper{
    
    public $table = 'productcatspecs';
    
    public $has_one=array(
                            "productcat",
                            "productgenspec"
                        );
    public $has_many=array();
    
    function __construct($id = NULL){
        parent::__construct($id);
    }
    
    public $validation = array();
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new productcatspec();
            $o->where("productcat_id",$this->productcat_id);
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
/* End of file productcatspec.php */
/* Location: ./application/models/productcatspec.php */
?>