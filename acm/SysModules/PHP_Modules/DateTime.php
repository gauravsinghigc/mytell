<?php
//date formates
function DATE_FORMATES($format, $date)
{
    $newdateformate = $date;
    if ($date == null  || $date == "" || $date == "0000-00-00" || $date == " " || $date == NULL) {
        $newdateformate = "No Update";
    } else {
        $newdateformate = date("$format", strtotime($date));
    }

    $Date = date("Y-m-d", strtotime($newdateformate));
    if ($Date == "1970-01-01") {
        $newdateformate = "No Update!";
    } else {
        $newdateformate = $newdateformate;
    }
    return $newdateformate;
}

/**
 * Current Date time 
 * You can call any of these date, time, or both at same time via CONSTANT DECLARATION METHOD
 */

DEFINE("CURRENT_DATE_TIME", date('Y-m-d h:i:s A'));
DEFINE("CURRENT_DATE", date('Y-m-d'));
DEFINE("CURRENT_TIME", date('h:i:s A'));

//function get minutes from two time
function GetMinutes($time2, $time1)
{
    if (strtotime($time1) > strtotime($time2)) {
        list($time1, $time2) = array($time2, $time1);
    }

    $diff_seconds = strtotime($time2) - strtotime($time1);
    $diff_minutes = round($diff_seconds / 60);

    // Example value
    $hours = floor($diff_minutes / 60);
    $remaining_minutes = $diff_minutes % 60;

    if ($diff_minutes == 0) {
        $diff_minute = "Time Over";
    } elseif ($diff_minutes > 0) {
        $hours = abs($hours);
        $remaining_minutes = abs($remaining_minutes);

        $diff_minute = $hours . " hr " . $remaining_minutes . " min over";
    } elseif ($diff_minutes < 0) {
        $diff_minute = $hours . " hr " . $remaining_minutes . " min left";
    }

    return $diff_minute;
}


//converts seconds into hours, minute and seconds
function GetDurations($second)
{

    if ($second == 0 || $second == null) {
        $results = "0 sec";
    } else {
        $hours = gmdate('H', $second);
        $minutes = gmdate('i', $second);
        $seconds = gmdate('s', $second);

        $results = $hours . "hr " . $minutes . "min " . $seconds . "sec";
    }
    return $results;
}
