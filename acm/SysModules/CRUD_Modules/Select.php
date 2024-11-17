<?php

//Select Data
function SELECT($SQL, $die = false)
{
    $SELECT = "$SQL";

    if ($die == true) {
        die($SELECT);
    }
    $DBConnection = new mysqli(DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME);
    $QUERY = mysqli_query($DBConnection, $SELECT);
    if ($QUERY == true) {
        return $QUERY;
    } else {
        return false;
    }
}

//fetch values 
function FETCH($SQL, $data, $die = false)
{
    if ($die == true) {
        SELECT($SQL, true);
    } else {
        $Query = SELECT($SQL);
        $CountData = mysqli_num_rows($Query);
        if ($CountData == null) {
            $results = 0;
        } else {
            $FetchDATA = mysqli_fetch_array($Query);
            $ReturnData = $FetchDATA["$data"];
            $results = $ReturnData;
        }
        return $results;
    }
}

//fetch all in array / json formate
function SET_SQL($sql, $array = false)
{
    $Data = SELECT("$sql");
    $Count = CHECK("$sql");
    if ($Count == 0) {
        return null;
    } else {
        while ($FetchAllData = mysqli_fetch_assoc($Data)) {
            $FetchedColumns[] = $FetchAllData;
        }

        if ($array == true) {
            return json_decode(json_encode($FetchedColumns));
        } else {
            return json_encode($FetchedColumns);
            die();
        }
    }
}
