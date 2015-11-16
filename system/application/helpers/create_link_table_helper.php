<?php
/** 
*   Create link action for per record in the table
*   @access     public
*   @param      string $class 
*   @param      string $link
*   @param      string $title
*   @param      string $onclick
*   @param      string $text    
*/
function create_link_table($class="",$link="",$title="",$onclick="",$text="",$target="")
{
    $st="<a href='{$link}' class='{$class}' title='{$title}' onclick='{$onclick}' target='{$target}' >{$text}</a>";
    return $st;
}
/** 
*   Create the button for form
*   @access     public
*   @param      string $class  type of button  value: button, button_grey,button_ok,button_notok,_button_grey_round
*   @param      string $onclick
*   @param      string $text     
*/
function create_form_button($class="button_ok",$text="",$onclick="")
{
    echo  "<a class='{$class}' onclick='{$onclick}' ><span>{$text}</span></a>";
    return ;
}
