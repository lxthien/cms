<?php 
//======================================================
//This function remove the special symbol from input string 
//Copyright(c) Vuong Nguyen The Tran
//Email : mrvuongx@gmail.com
//======================================================
function remove_special_symbol($str)
   	 {
   	 	$str=strip_tags($str);
		//original string
       	$ori=array("\"","!","@","#","$","%","^","&","*","(",")",".",",",";","'","[","]","{","}"
		,":","--",'.','>','<','--','---',"'",'/',"&nbsp;&nbsp;");
		//replace string
		$rep=array(" "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "," "
		," "," ",' ',' ',' ','',''," ",' ',"&nbsp;");
		$count=10;$a=0;
		while($count!=0){                           
			$str=str_replace($ori,$rep,$str,$count);	
		}
		return trim($str);
  }