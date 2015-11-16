<?php
class Cauhinh extends DataMapper
{
     public $table = "cauhinhs";
     public $has_one=array('configgroup');
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    public $validation = array(
        'name' => array(
                    'label' => 'Name', 
                    'rules' =>array('required', 'trim')),
        'value' => array(
                    'label' => 'Value', 
                    'rules' =>array( 'trim')),
        'fieldname' => array(
                    'label' => 'Fieldname', 
                    'rules' =>array('required', 'trim'))        
        );
    function getconfig($key)
    {
        $c=new cauhinh();
        $c->where('fieldname',$key);
        $c->get();
        if(!$c->exists())
            show_error('Could not find config field '.$key);
        return $c->value;       
    }
    function setconfig($key,$value)
    {
        $c=new cauhinh();
        $c->where('fieldname',$key);
        $c->get();
        if(!$c->exists())
            show_error('Could not find config field '.$key);
        $c->value = $value;
        $c->save();
    }
    function __construct($id = null)
    {
        parent::__construct($id);
    }
    
}
/* End of file cauhinh.php */
/* Location: ./application/models/cauhinh.php */
