<?php
//get user address 
function UserFullAddress($CustomerId)
{
    $SQL = "SELECT * FROM user_addresses where UserAddressUserId='$CustomerId'";
    $UserStreetAddress = FETCH($SQL, "UserStreetAddress");
    $UserLocality = FETCH($SQL, "UserLocality");
    $UserCity = FETCH($SQL, "UserCity");
    $UserState = FETCH($SQL, "UserState");
    $UserCountry = FETCH($SQL, "UserCountry");
    $UserPincode = FETCH($SQL, "UserPincode");
    $UserAddressType = FETCH($SQL, "UserAddressType");

    $CompleteAddress = "($UserAddressType) <br> $UserStreetAddress $UserLocality $UserCity $UserState $UserCountry $UserPincode";

    return $CompleteAddress;
}
