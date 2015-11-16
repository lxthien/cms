<?php
function cut_string($st,$num=0,$lang="vietnamese",$num2=0)
{
    //$num = 0 not cut
     if($num ==0) return trim($st);
    //different beween 2 language
    //if lang is vietnamese (default) choose $num
    // if lang is english (option) choose $num2
   
    if($lang == "english") $num =  $num2;
    //remove useless html tag 
	$st=trim(strip_tags($st));
	$st=str_replace(":",": ",$st);
    //get sub string by num
	if(strlen($st) < $num) return $st;
	$st=trim(substr($st,0,$num));
    //find the last space
	$pos=strrpos($st," ");
    //get sub string from start to space position
	$st=trim(substr($st,0,$pos));
	return $st;
}
function cut_string_without_space($st,$num)
{
	$st=trim(strip_tags($st));
	$st=trim(substr($st,0,$num));
	return $st;
}
function cut_string2($st,$num)
{
	$st=trim(($st));
	if(strlen($st) < $num) return $st;
	$st=trim(substr($st,0,$num));
	$pos=strrpos($st," ");
	$st=trim(substr($st,0,$pos));
	return $st;
}
function showindex()
{
	return "";
}