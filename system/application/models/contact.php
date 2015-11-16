<?php
class Contact extends DataMapper
{
    public $table = "contact";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
   
    public $has_many=array(    
    );
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'title'=>array(
            'label'=>'Tiêu đề',
            'rules'=>array('trim','required')),
         'name'=>array(
            'label'=>'Tên',
            'rules'=>array('trim','max_length'=>200,'required')),
         'phone'=>array(
            'label'=>'Điện thoại',
            'rules'=>array('trim','required','max_length'=>200)),
         'email'=>array(
            'label'=>'Địa chỉ email',
            'rules'=>array('trim','required','email'))
    );
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }

}
/* End of file album.php */
/* Location: ./application/models/album.php */