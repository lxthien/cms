<?php
class Banner extends DataMapper
{
    public $table = "banners";
    // --------------------------------------------------------------------
    // Relationships
    // --------------------------------------------------------------------   
    //public $has_one=array('bannercustomer');
    //public $has_many= array('bannerset');
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    //public $validation = array();
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    /********************************
    * Up the position 
    * swap position with object that have higher position
    **********************************/
    /*function up_position()
    {
        $max = new banner();
        $max->select_max('position');
        $max->where('position <', $this->position);
        $max->get();
        $o = new banner();
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
    /*function down_position()
    {
        $min = new banner();
        $min->select_min('position');
        $min->where('position >', $this->position);
        $min->get();
        $o = new banner();
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
    }*/
    /********************************
    * Override the save method
    * check if new insert the position property
    **********************************/
    /*function save($object = '', $related_field = '')
    {
        if (!$this->exists()) {
            $o = new banner();
            $o->select_max('position');
            $o->get();
            if (count($o->all) != 0) {
                $max = $o->position + 1;
                $this->position = $max;
            } else {
                $this->postion = 1;
            }
            $this->code=md5('banner'.$this->position).md5($this->position.date('Y'));
        }
        return parent::save($object, $related_field);
    }*/
}
/* End of file banner.php */
/* Location: ./application/models/banner.php */
