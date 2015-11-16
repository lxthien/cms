<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Productgenspect
 *
 * Product general specific
 *
 * @package		Model
 * @author		vuong.nguyen@saigontechnology.vn
 */
class productgenspec extends DataMapper{    
    public $table = 'productgenspecs';
    
    public $has_one=array(
        //group
        'parentcat'=>array(
            'class'=>'productgenspec',
            'other_field' => 'child'
        )
    );
    public $has_many=array(
        'child'=>array(
            'class'=>'productgenspec',
            'other_field'=>'parentcat'
        ),
        'productcatspec',
        'productspec'
    );

    function __construct($id = NULL){
        parent::__construct($id);
    }

    public $validation = array(
         'name'=>array(
            'label'=>'Tên thu?c tính',
            'rules'=>array('trim','max_length'=>200))
    );
    
    function completeDelete()
    {
        //TODO : add all relative to delete
        $this->productcatspec->delete_all();
        $this->delete();
        //$productGenSpec->product
    }
    
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new productgenspec();
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
/* End of file productgenspec.php */
/* Location: ./application/models/productgenspec.php */
?>