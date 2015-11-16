<?php
class newscomment extends DataMapper
{
    public $table = "newscomments";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one=array(
        'article'
    );

    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
         'name'=>array(
            'label'=>'Tên của bạn ',
            'rules'=>array('trim','max_length'=>200))
         ,'title'=>array(
            'label'=>'Tiêu đề',
            'rules'=>array('trim','required','max_length'=>200)),
         'email'=>array(
            'label'=>'Địa chỉ email',
            'rules'=>array('required','valid_email')),
         'content'=>array(
            'label'=>'Nội dung',
            'rules'=>array('trim','required')
         )
         ,'news'=>array(
            'label'=>'Tin',
            'rules'=>array('required')
         )
    );
    function __construct($id=NULL)
    {
        parent::__construct($id);
    }


    
}
/* End of file newscomment.php */
/* Location: ./application/models/newscomment.php */