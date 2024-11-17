<?php
//user per missions
define("USER_PERMISSIONS", array(
    "CREATE", "UPDATE", "DELETE", "IMPORT", "EXPORT", "PRINT", "VIEW", "REPORTS"
));

//user roles
define("USER_ROLES", array("Admin", "USER"));
define("RESELLER_USER_ROLES", array("RESELLER", "USER"));

//user genders
define("USER_GENDER", array("Male", "Female", "Others"));

//user salutation 
define("SALUTATION", array("Mr.", "Mrs.", "Miss", "M/s", "Prof", "Dr."));

define("USER_DASHBOARDS", [
    "Admin" => "admin-dash.php",
    "Reseller" => "reseller-dash.php",
    "User" => "user-dash.php"
]);
