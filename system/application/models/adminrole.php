<?php
class Adminrole extends DataMapper
{
    public $table = "adminroles";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_many=array(
        'adminuser',
        'adminmenu'
    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'name'=>array(
            'label'=>'Tên nhóm',
            'rules'=>array('trim','max_length'=>100))    ,
         'level'=>array(
            'label'=>'Cấp',
            'rules'=>array('trim','numeric'))           
    );
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }
}