<?php 
function getRealIpAddr()

	{
		  if (!empty($_SERVER['HTTP_CLIENT_IP']))
		  //check ip from share internet
		  {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		  }
		  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		  //to check ip is pass from proxy
		  {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		  else
		  {
			$ip=$_SERVER['REMOTE_ADDR'];
		  }
		  return $ip;
	}
function getdatalog($st,$email)
{
	$ip=getRealIpAddr();
	putenv("TZ=Asia/Saigon"); 
	$datetime = date("Y-m-d H:i:s");
	$date= date("Y-m-d");
	$data=array(
				'user'=>$email,
				'ip'=>$ip,
				'event'	=>$st,
				'time'=>$datetime,
				'date'=>$date
	);
	return $data;
	
}


function inmang($data)
{
	foreach($data as $key => $value)
	{
		echo $key.':'.$value.'<br>';
	}
}


?>