<?php
//complaitn status
define("COMPLAINT_STATUS", array("NEW COMPLAINT", "EXECUTIVE ASSIGNED", "IN PROGRESS", "COMPLETED"));


//complaint no
define("COMPLAINT_NO", "COMPLAINT-NO-" . strtoupper(Date("d-M-Y-")) . rand(0000, 9999999));
