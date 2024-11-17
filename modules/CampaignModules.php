<?php
function CampaignStatus($status)
{
    if ($status == "NEW") {
        $results = "<span class='btn btn-xs btn-default'><i class='fa fa-star text-warning fa-spin'></i> FRESH</span>";
    } elseif ($status == "ACTIVE") {
        $results = "<span class='btn btn-xs btn-dark'><i class='fa fa-refresh fa-spin'></i> ACTIVE</span>";
    } elseif ($status == "COMPLETED") {
        $results = "<span class='btn btn-xs btn-success'><i class='fa fa-check fa-spin'></i> COMPLETED</span>";
    } elseif ($status = "PROCESSING") {
        $results = "<span class='btn btn-xs btn-warning'><i class='fa fa-spinner fa-spin blink'></i> PROCESSING</span>";
    } elseif ($status == "APPROVED") {
        $results = "<span class='btn btn-xs btn-info'><i class='fa fa-check'></i> APPROVED</span>";
    } else {
        $results = "<span class='btn btn-xs btn-warning'><i class='fa fa-exclamation-triangle'></i> REJECTED</span>";
    }
    return $results;
}

//get success record
function Successvalues($array, $num)
{
    if (count($array) <= $num) {
        return $array; // Return all values if the array is smaller than requested
    }

    // Shuffle the array and get the first $num elements
    shuffle($array);
    return array_slice($array, 0, $num);
}
