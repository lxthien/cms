<?php
class Productstatu extends DataMapper{
    public $table = "productstatus";
    // Relationships
    public $has_many = array('product');
    // Construction
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }
    function up_position()
    {
            $max = new Productstatu();
            $max->select_max('position');
            $max->where('position <', $this->position);
            $max->get();
            $o = new Productstatu();
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
    function down_position()
    {
        $min = new Productstatu();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->get();
        $o = new Productstatu();
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
    function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new Productstatu();
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