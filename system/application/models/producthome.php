<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * producthome
 *
 * product category specification
 *
 * @package		Model
 * @author		vuong.nguyen@saigontechnology.vn
 */
class producthome extends DataMapper{
    
    public $table = 'producthomes';
    
    public $has_one=array(
                            "productcat",
                            "product"
                        );
    public $has_many=array();
    
    function __construct($id = NULL){
        parent::__construct($id);
    }
    
    public $validation = array();
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new producthome();
            $o->where("productcat_id",$this->productcat_id);
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
            $o->clear();
            $o = new producthome();
            $o->where('productcat_id',$this->productcat_id);
            $o->where('product_id',$this->product_id);
            $o->get();
            if($o->exists())
                return true;
            
        }
        
        return parent::save($object, $related_field);
    }
}
/* End of file producthome.php */
/* Location: ./application/models/producthome.php */
?>