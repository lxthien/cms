<?php
class menu extends DataMapper
{
    public $table = "menus";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
   
    public $has_many=array(
        'menuitem'
        
        
    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'name'=>array(
            'label'=>'Tên menu cha',
            'rules'=>array('trim','required')),
         'link'=>array(
            'label'=>'Liên kết Menu cha',
            'rules'=>array('trim','required'))
    );
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }


      /********************************
    * Up the position 
    * swap position with object that have higher position
    **********************************/
    function up_position()
    {
            $max = new menu();
            $max->select_max('position');
            $max->where('position <', $this->position);
           
            $max->get();
            $o = new menu();
            $o->where('position', $max->position);
           
            $o->get();
            if ($o->result_count() > 0) {
                $tg = $this->position;
                $this->position = $o->position;
                $o->position = $tg;
                $o->save();
                $this->save();
                return TRUE;
            } else 
                return FALSE;
    }
    /********************************
    * Down the position 
    * swap position with object that have lower position
    **********************************/
    function down_position()
    {
        $min = new menu();
        $min->select_min('position');
        $min->where('position >', $this->position);
        
        $min->get();
        $o = new menu();
        $o->where('position', $min->position);
        
        $o->get();
        if ($o->result_count() > 0) {
            $tg = $this->position;
            $this->position = $o->position;
            $o->position = $tg;
            $o->save();
            $this->save();
            return true;
        } else {
            return false;
        }
    }
    /********************************
    * Override the save method
    * check if new insert the position property
    **********************************/
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new menu();
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
/* End of file menu.php */
/* Location: ./application/models/menu.php */