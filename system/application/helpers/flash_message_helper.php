<?php 
function show_flash_message()
{
    $CI =& get_instance();
    $flash_message=$CI->session->userdata('flash_message');
    
    if($flash_message!= FALSE )
    {
        $arr_flash=explode("(*)",$flash_message);
        
        foreach($arr_flash as $row)
        {
            $flash_content=explode("%%%",$row);
            show_message_admin($flash_content[0],$flash_content[1]);
        }
       
    }
    $CI->session->unset_userdata('flash_message');
}

function show_message_admin($type="success",$text="")
{
    $text = strip_tags($text);
         echo  "<p class='info' id='{$type}'><span class='info_inner'>{$text}</span></p>";   
}
/** 
*   flash_message
*   @access     public
*   @param      string   success, info, error, warning
*   @param      string 
*      
*/
function flash_message($type,$text)
{
    $CI =& get_instance();
    $content=$type."%%%".$text;
    $current_flash=trim($CI->session->userdata('flash_message'));
    if(strlen($current_flash)>0)
        $content=$current_flash."(*)".$content;
    $CI->session->set_userdata('flash_message',$content);
   
}
