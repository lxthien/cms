<?php
class Question extends DataMapper
{
     public $table = "questions";
     
    // --------------------------------------------------------------------
    // Validation
    // --------------------------------------------------------------------
    
    
    function __construct($id = null)
    {
        parent::__construct($id);
    }
    
}
/* End of file question.php */
/* Location: ./application/models/question.php */
