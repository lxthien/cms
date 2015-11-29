<?php
function gettitlenonefromlink($url)
{
    $arrTitle = explode('.', $url);
    if($arrTitle[1] == '' || $arrTitle[1] != 'html'){
        redirect('');
    }
    return $arrTitle[0];
}

function create_url($id){
    $CI =& get_instance();
    $object = new Article($id);
    $cat_01 = new Newscatalogue($object->newscatalogue_id);
    if($cat_01->parentcat_id != Null){
        $cat_02 = new Newscatalogue($cat_01->parentcat_id);
        return base_url().$cat_02->name_none.'/'.$cat_01->name_none.'/'.$object->title_none.'.html';
    }else{
        if ($cat_01->isSystem == false)
            return base_url().$cat_01->name_none.'/'.$object->title_none.'.html';
        else
            return base_url().$object->title_none.'.html';
    }
}

function get_url($url_string){
    $array_url = explode('/', $url_string);
    if (strpos($url_string, '.html')) {
        return $array_url[count($array_url) - 1];
    } else {
        $url = $array_url[count($array_url) - 1];
        if (is_numeric($url)){
            return $array_url[count($array_url) - 2];
        } else {
            return $array_url[count($array_url) - 1];
        }
    }
}

function get_offset($url_string){
    $array_url = explode('/', $url_string);
    if (strpos($url_string, '.html')) {
        return $array_url[count($array_url) - 1];
    } else {
        $url = $array_url[count($array_url) - 1];
        if (is_numeric($url)){
            return $array_url[count($array_url) - 1];
        } else {
            return 1;
        }
    }
}

function redirect_admin()
{
    $CI =& get_instance();
    $redirect_link=$CI->session->flashdata('redirect_link');
    if($redirect_link==FALSE)
        redirect('admin');
    $l=strlen($redirect_link);
    $redirect_link=substr($redirect_link,1,$l-1);
    redirect($redirect_link);
}

function getrealuri($st)
{
    $l=strlen($st);
    $st=substr($st,1,$l-1);
    return $st;
}

function encode_myuri($myuri)
{
    $l=strlen($myuri);
    $myuri=substr($myuri,1,$l-1);
    return str_replace('/',"&",$myuri);
}
function fencode_myuri($myuri)
{
    $l=strlen($myuri);
    $myuri=substr($myuri,1,$l-1);
    $myuri = str_replace('vietnamese/',"",$myuri);
    $myuri = str_replace('english/',"",$myuri);
    return str_replace('/',"&",$myuri);
}
function decode_myuri($myuri)
{
    return str_replace('&',"/",$myuri);
}
function back_admin()
{
    $CI =& get_instance();
    $redirect_link=$CI->session->flashdata('back_redirect_link');
    if($redirect_link==FALSE)
        redirect('admin');
    $l=strlen($redirect_link);
    $redirect_link=substr($redirect_link,1,$l-1);
    redirect($redirect_link);
}
function getconfigkey($key)
{
    $cauhinh = new Cauhinh();
    return $cauhinh->getconfig($key);
}

function setconfigkey($key,$value)
{
    $cauhinh = new Cauhinh();
    $cauhinh->setconfig($key,$value);
}
function filenameplus($st = NULL,$str)
{
    if($st == NULL) return "";
    $s=explode(".",$st);
    //echo $s;
    return $s[0]."_".$str.'.'.$s[1];
}
function getlanguage()
{
    $CI =& get_instance();
 	$l['en'] = "english";
	$l['vi'] = 'vietnamese';
	return $l[$CI->lang->lang()];
}

function gen_seo_url($val = NULL) {	
    $val = strtolower(convert_accented_characters($val));	
    $val = url_title($val);	
    return $val ;
}

function preview_text($text =NULL, $limit = NULL) {
	// TRIM TEXT
	$text = trim($text);

	// STRIP TAGS IF PREVIEW IS WITHOUT HTML
	//if ($TAGS == 0) $text = preg_replace('/\s\s+/', ' ', strip_tags($TEXT));

	// IF STRLEN IS SMALLER THAN LIMIT RETURN
	if (strlen(utf8_decode($text)) < $limit) return $text;
	else return substr($text, 0, $limit) . " ...";
	
}


function selectIt($in1,$in2)
{
    if($in1 == $in2)
        echo "selected='selected'";
}


function checkIt($in1,$in2)
{
    if($in1 == $in2)
        echo "checked='checked'";
}



function showIt($in1,$in2)
{
    if($in1 == $in2)
        echo "style='display:block'";
    else
        echo "style='display:none'";
}

function br2nl($html)
{
    return preg_replace('#<br\s*/?>#i', "\n", $html);
}