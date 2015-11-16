<?php
class Adminuser extends DataMapper
{
    public $table = "adminusers";
    // --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
    public $has_one= array(
        //company for job
       'adminrole'
    );
	public $has_many = array(
	);
 
    // --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
    public $validation = array(
        'username'  =>  array(
			'label' => 'Ðịa chỉ email',
			'rules' => array( 'trim','unique','max_length'=>255),
		),
        'password'=>array(
			'label' => 'Mật khẩu',
			'rules' => array('required', 'trim','min_length'=>6,'max_length'=>100,'encrypt')
		),
        'confirm_password'=>array(
            'label'=>'Nhập lại mật khẩu',
            'rules'=>array('encrypt','trim','matches'=>'password',)
            )
        ,
         'fullname'=>array(
            'label'=>'Tên người dùng',
            'rules'=>array('trim','max_length'=>100))
         ,'address'=>array(
            'label'=>'Địa chỉ',
            'rules'=>array('trim'))
         ,'phone'=>array(
            'label'=>'Điện thoại',
            'rules'=>array('trim'))     
        ,'adminrole'=>array(
            'label'=>"Nhóm",
            'rules'=>array('required')
        )     
    );
    /**
	 * Returns an array list of all users that can have bugs assigned
	 * to them.
	 * 
	 * @return $this for chaining
	 */
	function get_assignable()
	{
		return $this->where_in_related_role('id', array(1, 2))->get();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Login
	 *
	 * Authenticates a user for logging in.
	 *
	 * @access	public
	 * @return	bool
	 */
	function login()
	{
		
       
       
        $this->where(array('username'=>$this->username,'password'=>md5($this->password)))->get();
      
		// If the username and encrypted password matched a record in the database,
		// this user object would be fully populated, complete with their ID.
        
		// If there was no matching record, this user would be completely cleared so their id would be empty.
		if ($this->exists())
		{
			// Login succeeded
			return TRUE;
		}
		else
		{
			// Login failed, so set a custom error message
			$this->error_message('login',"Vui lòng nhập đúng username & password");
			// restore username for login field
			//$this->username = $uname;

			return FALSE;
		}
	}
	 
     
     
    function _encrypt($field)
    {
        // Don't encrypt an empty string
        if (!empty($this->{$field}))
        {
            $this->{$field} = md5($this->{$field});
        }
    }

    function __construct($id=NULL)
    {
        parent::__construct($id);
    }
}