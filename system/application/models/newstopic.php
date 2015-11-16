<?php
class Newstopic extends DataMapper
{
    public $table = "newstopics";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_many= array(
       'article'
    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
	     'name'=>array(
            'label'=>'Tên dòng sự kiện',
            'rules'=>array('trim','max_length'=>200))
         ,'name_none'=>array(
            'label'=>'Tên không dấu',
            'rules'=>array('required'))
    );
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }
}