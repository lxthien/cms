<?php
function get_date_from_sql($MySqlDate = "")
{
        /*
                Take a date in yyyy-mm-dd format and return it to the user
                in a PHP timestamp
                Robin 06/10/1999
        */
        if($MySqlDate == "") return "";
        $date = new DateTime($MySqlDate);
        return $date->format('d/m/Y');
}
function get_from_datetime($datatime = "")
{
    if($datatime == "") return "";
        $date = new DateTime($datatime);
        return $date->format('d/m/Y H:i:s');
}
function date_to_sql($data)
{
    $dt=explode('/',trim($data));
    if(strlen($dt[1])==1)
        $dt[1]="0".$dt[1];
    if(strlen($dt[0])==1)
        $dt[1]="0".$dt[0];
    return $dt[2].'-'.$dt[1].'-'.$dt[0];
}
function getday($date)
{
	 $date_array = explode("-",$date); // split the array
     $day = $date_array[2];
	 return $day;
}
function getmonth($date)
{
	 $date_array = explode("-",$date); // split the array
     $month = $date_array[1];
	 return $month;
}
function getyear($date)
{
	 $date_array = explode("-",$date); // split the array
     $year = $date_array[0];
	 return $year;
}
function get_current_date()
{
	return date('Y-m-d');
}
function get_current_time()
{
	return date('H:m:s');
}
function get_yesterday()
{
    $yday=strtotime("-1day");
    $newdate=date("Y-m-d", $yday);
    return  $newdate;
}
function getweekday($lang = 'vietnamese')
{   
    if($lang == "vietnamese")
    {
    $d= date('N');
    switch($d)
    {
        case 7 : echo "Chủ nhật";break;
        default: echo "Thứ ".($d+1);break;
    }
    }
    else
    {
        echo date('l');
    }
}
function getlastmonth()
{
    $lastmonth = mktime(0, 0, 0, date("m")-2, date("d"),   date("Y"));
    return date('Y-m-d',$lastmonth);
}