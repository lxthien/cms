<?php 
//======================================================================
//= Insert new log to admin log
//= $type: type of the log "insert,update,delete,login,logout,orther"
//= $content : content of the log
//= $object : object has been loged
//= $user : id of the user loged
//======================================================================
function add_log($type="",$object="",$user="",$content="")
{
    $ci =& get_instance();
    $ci->common->insert("admin_log",array("type"=>$type,
                                        "object"=>$object,
                                        "user_id"=>$user,
                                        "content"=>$content,
                                        "datetime_create" =>date('Y-m-d h:i:s'))) ;
}