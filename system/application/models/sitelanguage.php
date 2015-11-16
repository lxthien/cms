<?php
class Sitelanguage extends DataMapper
{
    public $table = "sitelanguages";
    // --------------------------------------------------------------------
    // Relationships
    // --------------------------------------------------------------------   
    
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    public $validation = array(
            'name' => array(
                'label' => 'Tên ngôn ngữ', 
                'rules' =>array('required', 'trim')),
            'short'=>array(
                'label' => 'shorthand',
                'rules' => array('trim')           
            )
    );
    function __construct($id = null)
    {
        parent::__construct($id);
    }
    /********************************
    * Up the position 
    * swap position with object that have higher position
    **********************************/
    function up_position()
    {
        $max = new sitelanguage();
        $max->select_max('position');
        $max->where('position <', $this->position);
        $max->get();
        $o = new sitelanguage();
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
        $min = new sitelanguage();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->get();
        $o = new sitelanguage();
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
            $o = new sitelanguage();
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
/* End of file sitelanguage.php */
/* Location: ./application/models/sitelanguage.php */
