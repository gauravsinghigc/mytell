<?php

//session data handler
function IfSessionExists($SessionKey, $ValueAssigned)
{
    if (isset($_SESSION["$SessionKey"])) {
        $return = $_SESSION["$SessionKey"];
    } else {
        $_SESSION["$SessionKey"] = $ValueAssigned;
        $return = $_SESSION["$SessionKey"];
    }
    return $return;
}
