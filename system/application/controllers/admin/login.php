<?php 
class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('login_manager', array('autologin' => FALSE));
	}
	
	function index()
	{
        $user = $this->login_manager->get_user();
		if($user !== FALSE)
		{
			// already logged in, redirect to welcome page
			redirect('admin/dashboard');
		}
		// Create a user to store the login validation
		$user = new adminuser();
		if($this->input->post('username') !== FALSE)
		{
		 
			// A login was attempted, load the user data
			$user->from_array($_POST, array('username', 'password'));
			// get the result of the login request
			$login_redirect = $this->login_manager->process_login($user);
			if($login_redirect)
			{
				if($login_redirect === TRUE)
				{
					// if the result was simply TRUE, redirect to the welcome page.
				    	redirect('admin/navi/index/11');
				}
				else
				{
					// otherwise, redirect to the stored page that was last accessed. 
                        $login_redirect = getrealuri($login_redirect);
				    	redirect($login_redirect);
				}
			} 
		}
		$data['base_url']=base_url();
		$data['msg']=$user->error->string;
		$this->load->view('admin/login/login',$data);
	}
 
	
}