<?php

/**
 * @author mrKing
 * @copyright 2008
 */
class File_lib 
  {
  	var $ci;
	function File_lib()
	{
		$this->ci=& get_instance();
	}
  	function upload($name,$path,$allow_type='gif|jpg|png|bmp|jpeg|flv|swf')
  	{
  		//ini_set("max_execution_time","120");
  		$this->ci->load->library('upload');
  		$config['upload_path'] = $path;
		//$config['encrypt_name']=true;
		$config['remove_spaces']=true;
		$config['allowed_types']=$allow_type;
		$this->ci->upload->initialize($config);
		if($this->ci->upload->do_upload($name))
		{	
			$data=$this->ci->upload->data();
			return $data;
		}
		else
		{ 
			return $this->ci->upload->display_errors("<span class='upload_error'>","</span>");
		}	
  	}
  	
	
	
}