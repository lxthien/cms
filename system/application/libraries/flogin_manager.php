<?php

/**
 * Simple utility class to handle logins.
 */
class Flogin_Manager {
	var $logged_in_user = NULL;
	function __construct($params = array())
	{
		$this->CI =& get_instance(); 
		$this->session =& $this->CI->session;
	}
	
	function check_login()
	{
		// if not logged in, automatically redirect
		$u = $this->get_user();
        $redirect_link = fencode_myuri($this->CI->uri->uri_string());
		if($u === FALSE)
		{
			redirect('fuser/flogin/'.$redirect_link);
		}
        return $u;
	}
    
    function check_login2($redirect_link)
    {
   	    $u = $this->get_user();
		return $u;
    }
    
    
	/**
	 * process_login
	 * Validates that a username and password are correct.
	 * 
	 * @param object $user The user containing the login information.
	 * @return FALSE if invalid, TRUE or a redirect string if valid. 
	 */
	function process_login($user,$redirect_link)
	{
		// attempt the login
		$success = $user->login();
		if($success)
		{
			// store the userid if the login was successful
			$this->session->set_userdata('flogged_in_id', $user->id);
			// store the user for this request
			$this->logged_in_user = $user;
			// if a redirect is necessary, return it.
			if( ! empty($redirect_link))
			{
				$success = $redirect_link;
			}
		}
		return $success;
	}
	
	function logout()
	{
		$this->session->unset_userdata('flogged_in_id');
		$this->logged_in_user = NULL;
	}
	
	function get_user()
	{
		if(is_null($this->logged_in_user))
		{
			$id = $this->session->userdata('flogged_in_id');
			if(is_numeric($id))
			{
				$u = new user();
				$u->get_by_id($id);
				if($u->exists()) {
					$this->logged_in_user = $u;
					return $this->logged_in_user;
				}
			}
			return FALSE;
		}
		else
		{
			return $this->logged_in_user;
		}
	}
	
}
