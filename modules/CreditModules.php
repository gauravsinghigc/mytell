<?php
function CreditStatus($data)
{

    if ($data == "FRESH") {
        $result =  "<span class='btn btn-success btn-xs'><i class='fa fa-star fa-spin'></i> FRESH</span>";
    } elseif ($data == "USED") {
        $result = "<span class='btn-dark btn btn-xs btn-black text-white'><i class='fa fa-check'></i> USED</span>";
    } else {
        $result = "<span class='btn-danger btn-xs btn text-white'><i class='fa fa-warning'></i> EXPIRED</span>";
    }

    return $result;
}
