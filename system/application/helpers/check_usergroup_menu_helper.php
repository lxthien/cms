<?php 
function check_usergroup_menu($menu_id,$result_role_user)
{
	foreach($result_role_user as $row)
	{
		if($menu_id==$row->menu_id)
			return TRUE;	
	}
	return FALSE;
}