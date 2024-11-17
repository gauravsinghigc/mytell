<?php
function UserByDetails($UserId)
{
    $UserSQL = "SELECT UserFullName, UserCompanyName FROM users where UserId='$UserId'";
    $Details = "<b class='text-primary'><i class='fa fa-user'></i> " . FETCH($UserSQL, "UserFullName") . "</b>" . "<br>";
    $Details .= "<span class='text-secondary font-italic'>" . FETCH($UserSQL, "UserCompanyName") . "</span>";

    return $Details;
}
