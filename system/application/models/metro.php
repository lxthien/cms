<?php
class Metro extends DataMapper
{
    public $table = "metros";
    // --------------------------------------------------------------------
    // Relationships
    // --------------------------------------------------------------------   
    
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    public $validation = array(
		'title' => array(
			'label' => 'Tiêu đề', 
			'rules' =>array('required', 'trim')),
		'link' => array(
			'label' => 'Link', 
			'rules' =>array('required', 'trim'))		
    );
    function __construct($id = null)
    {
        parent::__construct($id);
    }
    
}
/* End of file metro.php */
/* Location: ./application/models/metro.php */
