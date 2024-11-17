<?php

// Set PHP script execution time to infinite
set_time_limit(0); // 0 means no time limit

// DB configurations
if (CONTROL_DATABASE == true) {
    $DBConnection = new mysqli(DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME);
    define("DBConnection", $DBConnection);

    // Check if the connection is successful
    if ($DBConnection->connect_error) {
        $DBStatus = "<i class='fa fa-warning text-danger'></i> Offline";
    } else {

        // Optionally enable automatic reconnection (if needed)
        if ($DBConnection->errno == 2006) {
            $DBConnection = new mysqli(DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME);
            define("DBConnection", $DBConnection);

            //make again connection if disconnected
            if ($DBConnection->errno ==  2006) {
                $DBConnection = new mysqli(DB_SERVER_HOST, DB_SERVER_USER, DB_SERVER_PASS, DB_SERVER_DB_NAME);
                define("DBConnection", $DBConnection);
            }
        }

        $DBStatus = "<i class='fa fa-check-circle text-success'></i> Online";
    }
} else {
    $DBStatus = "<i class='fa fa-times text-warning'></i> DB Not Used!";
}

//display Database Status
if (CONTROL_DB_STATUS == true) {
    echo $DBStatus;
}
