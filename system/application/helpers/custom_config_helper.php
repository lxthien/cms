<?php
function custom_config($config_item,$role = 2)
{
    echo "<tr><td><label>{$config_item->name}</label>";
	echo "<span style= 'color:red'>(".$config_item->fieldname.")</span>";
	echo "</td><td>";
    switch($config_item->type)
    {
        case "text": {
                echo "<input type='text' name='{$config_item->fieldname}' class='smallInput medium' value='{$config_item->value}' >";
            break;
        }
        case "image": {
                if($config_item->value != "")
                {
                    echo "<a href='".base_url()."{$config_item->value}' target='_blank'  />";
                    echo "<img src='".image($config_item->value,'adminConfigImage')."' />";
                    echo "</a><br />";
                }
                echo "<input type='file' name='{$config_item->fieldname}'   name='{$config_item->fieldname}' class='smallInput medium' ";
            break;
        }
        case "file": {
                if($config_item->value != "")
                {
                    echo "<a href='".base_url()."{$config_item->value}'  />download file</a><br />";
                }
                echo "<input type='file' name='{$config_item->fieldname}'  name='{$config_item->fieldname}' class='smallInput medium' ";
            break;
        }
        case "button": {
                echo "<a href='{$config_item->choice_list}' target='_blank' ><input type='button'  value='{$config_item->name}' ></a>";
            break;
        }
        case "password": {
                echo "<input style='{$config_item->style}' type='password' name='{$config_item->fieldname}' class='smallInput medium' value='{$config_item->value}' >";
            break;
        }
        case "textarea":{
            echo "<textarea style='{$config_item->style}' name='{$config_item->fieldname}' class='smallInput medium' >{$config_item->value}</textarea>";
            break;
        }
        case "radio":{
            $arrlist = explode(";",$config_item->choice_list);
            
            foreach($arrlist as $row)
            {
                
                $st="";
                $radio_item = explode(":",$row); 
                $st= "<input type='radio' name='{$config_item->fieldname}' value='{$radio_item[1]}'";
                if($config_item->value == $radio_item[1]) $st.=" checked='checked'";
                $st.=">".$radio_item[0];
                echo $st;
            }
            break;
        }
        case "select":{
            $arrlist = explode(";",$config_item->choice_list);
            echo "<select name='{$config_item->fieldname}'>";
            foreach($arrlist as $row)
            {
                $st="";
                $radio_item = explode(":",$row);
                //$st= "<option value='{$radio_item[1]}'";
                //if($config_item->value == $radio_item[1]) $st.=" selected='selected'";
               // $st.=">".$radio_item[0]."</option>";
                echo $st;
            }
            echo "</select>";
            break;
        }
        
    }
    echo "</td>
            </tr>";
}