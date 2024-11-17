<?php

function CREATE_NOTIFICATION($Name, $SentTo, $Message, $Module)
{
    $notifications = [
        "NotificationRefNo" => "#ALERT" . AUTO_GENERATED_REF_NO,
        "NotificationName" => $Name,
        "NotificationSenderId" => LOGIN_UserId,
        "NotificationReceiverId" => $SentTo,
        "NotificationDetails" => SECURE($Message, "e"),
        "NotificationSendDateTime" => CURRENT_DATE_TIME,
        "NotificationStatus" => "NEW",
        "NotificationResponseModule" => $Module
    ];
    $Response = INSERT("notifications", $notifications);

    return $Response;
}
