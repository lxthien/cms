<?php
class Adminmenu extends DataMapper
{
    public $table = "adminmenus";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one=array(
        'parentmenu'=>array(
            'class'=>'adminmenu',
            'other_field' => 'child'
        )
    );
    public $has_many=array(
        'child'=>array(
            'class'=>'adminmenu',
            'other_field'=>'parentmenu'
        ),
        'adminrole'

    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'name'=>array(
            'label'=>'Tên nhóm',
            'rules'=>array('trim','max_length'=>100))
         ,'link'=>array(
            'label'=>'Liên kết đến',
            'rules'=>array('trim'))
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
       
            $max = new adminmenu();
            $max->select_max('position');
            $max->where('position <', $this->position);
            $max->where('parentmenu_id', $this->parentmenu->id);
            $max->get();
            $o = new adminmenu();
            $o->where('position', $max->position);
            $o->where('parentmenu_id', $this->parentmenu->id);
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
        $min = new adminmenu();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->where('parentmenu_id', $this->parentmenu->id);
        $min->get();
        $o = new adminmenu();
        $o->where('position', $min->position);
        $o->where('parentmenu_id', $this->parentmenu->id);
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
            $o = new adminmenu();
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
/* End of file city.php */
/* Location: ./application/models/city.php */