<?php

if (isset($_POST['SAVE_CAMPAIGN_DETIALS'])) {
    $CAMPAIGN_REF_NO = $_SESSION['CAMPAIGN_REF_NO'];

    if (isset($_POST['campaign_dp_type'])) {
        if ($_POST['campaign_dp_type'] != null) {
            $campaign_dp_type = $_POST['campaign_dp_type'];
        } else {
            $campaign_dp_type = "";
        }
    } else {
        $campaign_dp_type = "";
    }

    $campaigns = [
        "campaign_ref_no" => $_SESSION['CAMPAIGN_REF_NO'],
        "campaign_name" => $_POST['campaign_name'],
        "campaign_messages" => SECURE($_POST['campaign_messages'], "e"),
        "campaign_status" => "NEW",
        "campaign_created_at" => $_POST['campaign_created_at'],
        "campaign_updated_at" => $_POST['campaign_created_at'],
        "campaign_created_by" => LOGIN_UserId,
        "campaign_updated_by" => LOGIN_UserId,
        "campaign_type" => "WHATSAPP_CAMPAIGN",
        "campaign_initiated_at" => "NULL",
        "campaign_ended_at" => "NULL",
        "campaign_dp_type" => $campaign_dp_type,
        "campaign_agreement" => $_POST['campaign_agreement'],
        "campaign_main_user_id" => $_POST['campaign_main_user_id'],
        "campaign_data" => htmlentities($_POST['campaign_phone_numbers']),
        "campaign_profile_photo" => UPLOAD_FILES("../storage/campaigns/" . $_SESSION['CAMPAIGN_REF_NO'], null, "CAMPAIGN_DP_", "campaign_profile_photo")
    ];

    //check similiar campaign of same session in not initiated twice
    $CheckCampaignId = CHECK("SELECT campaign_ref_no FROM campaigns where campaign_ref_no='" . $_SESSION['CAMPAIGN_REF_NO'] . "'");
    if ($CheckCampaignId == null) {
        $Save = INSERT("campaigns", $campaigns);

        //get campaign id
        $campaigns_id = FETCH("SELECT campaigns_id FROM campaigns ORDER BY campaigns_id DESC LIMIT 1", "campaigns_id");

        //upload creatives
        $campaign_image_1 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_creative_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "CREATIVE_1", "campaign_image_1"),
        ];
        $campaign_image_2 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_creative_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "CREATIVE_2", "campaign_image_2"),
        ];
        $campaign_image_3 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_creative_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "CREATIVE_3", "campaign_image_3"),
        ];
        $campaign_image_4 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_creative_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "CREATIVE_4", "campaign_image_4"),
        ];
        if (isset($_FILES['campaign_image_1'])) {
            if ($_FILES['campaign_image_1']['name'] != null) {
                INSERT("campaign_creatives", $campaign_image_1);
            }
        }

        if (isset($_FILES['campaign_image_2'])) {
            if ($_FILES['campaign_image_2']['name'] != null) {
                INSERT("campaign_creatives", $campaign_image_2);
            }
        }

        if (isset($_FILES['campaign_image_3'])) {
            if ($_FILES['campaign_image_3']['name'] != null) {
                INSERT("campaign_creatives", $campaign_image_3);
            }
        }

        if (isset($_FILES['campaign_image_4'])) {
            if ($_FILES['campaign_image_4']['name'] != null) {
                INSERT("campaign_creatives", $campaign_image_4);
            }
        }

        //upload videos
        $video_1 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_video_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "VIDEO_1", "campaign_videos")
        ];
        if (isset($_FILES['campaign_videos'])) {
            if ($_FILES['campaign_videos']['name'] != null) {
                INSERT("campaign_videos", $video_1);
            }
        }

        //upload campaign pdf
        $campaign_pdf_1 = [
            "campaign_main_id" => $campaigns_id,
            "campaign_pdf_file" => UPLOAD_FILES("../storage/campaigns/$CAMPAIGN_REF_NO", null, "PDF_1", "campaign_pdf")
        ];
        if (isset($_FILES['campaign_pdf'])) {
            if ($_FILES['campaign_pdf']['name'] != null) {
                INSERT("campaign_pdf", $campaign_pdf_1);
            }
        }


        //save campaign data like phone numbers and email-ids
        $campaign_data_type = "PHONE";
        $campaign_data = $_POST['campaign_phone_numbers'];

        //explode phone numbers and separate provided via $campaign_data
        $phoneNumbersArray = preg_split('/[\s,]+/', $campaign_data);

        //generate and save record
        foreach ($phoneNumbersArray as $PhoneNumber) {
            // Trim any extra spaces
            $PhoneNumber = trim($PhoneNumber);
            $campaign_numbers = [
                "campaign_main_id" => $campaigns_id,
                "campaign_data_type" => $campaign_data_type,
                "campaign_data" => FormatePhoneNumbers($PhoneNumber),
            ];
            $Check = CHECK("SELECT campaign_data FROM campaign_data where campaign_main_id='$campaigns_id' and campaign_data='" . FormatePhoneNumbers($PhoneNumber) . "'");
            if ($Check == null) {
                INSERT("campaign_data", $campaign_numbers);
            }
        }

        if ($Save == true) {
            unset($_SESSION['CAMPAIGN_REF_NO']);
        }
    } else {
        $Save = false;
    }

    //send response
    RESPONSE($Save, "Campaign saved successfully! Please wait for approval...", "Unable to save campaign at the moment!");

    //process campaing
} elseif (isset($_POST['PROCESS_CAMPAIGN'])) {
    $campaigns_id = $_POST['campaigns_id'];

    //container numbers of entry or random number limit
    //$updateIds = $_POST['response'];
    $StartId = $_POST['StartId'];
    $EndId = $_POST['EndId'];

    $status = $_POST['status'];
    $TotalData = $_POST['TotalData']; //net uploaded data by user
    $campaign_deductions = $_POST['campaign_deductions']; //sent number as success
    $campaign_main_user_id = $_POST['campaign_main_user_id'];
    $campaign_name = $_POST['campaign_name'];
    $FailedBalance = $TotalData - $campaign_deductions;

    //show all campaign data
    $SaveCampaignData = [];
    $CampaignSQL = "SELECT campaign_data_id FROM campaign_data where campaign_main_id='$campaigns_id'";
    $Data = SET_SQL($CampaignSQL, true);
    if ($Data != null) {
        foreach ($Data as $Number) {
            if (!in_array($Number->campaign_data_id, $SaveCampaignData)) {
                $SaveCampaignData[] = $Number->campaign_data_id;
            }
        }
    }
    //get random reuquired records
    $SuccessNumbers = Successvalues($SaveCampaignData, $campaign_deductions);

    //display success numbers
    foreach ($SuccessNumbers as $Number) {
        echo "$Number: -> SENT<br>";
        UPDATE_SQL("UPDATE campaign_data SET send_status='SENT' where campaign_data_id='$Number'");
    }

    //mark all status
    UPDATE_SQL("UPDATE campaign_data SET send_status='FAILED' where send_status='' and campaign_main_id='$campaigns_id'");

    //mark rest failed
    $Update = UPDATE_SQL("UPDATE campaigns SET campaign_name='$campaign_name', campaign_main_user_id='$campaign_main_user_id', campaign_deductions='$campaign_deductions', campaign_status='$status' where campaigns_id='$campaigns_id'");

    RESPONSE($Update, "Campaign Processing initiated!", "Unable to process campaign at the moment!");

    //remove campaign
} elseif (isset($_GET['remove_campaign_permanently'])) {
    $id = SECURE($_GET['remove_campaign_permanently'], "d");

    DeleteReqHandler("remove_campaign_permanently", [
        "campaigns" => "campaigns_id='$id'",
        "campaign_creatives" => "campaign_main_id='$id'",
        "campaign_data" => "campaign_main_id='$id'",
        "campaign_pdf" => "campaign_main_id='$id'",
        "campaign_videos" => "campaign_main_id='$id'"
    ], [
        "true" => "Campaign Remove Successully!",
        "false" => "Unable to remove campaign at the moment!"
    ]);

    //add more data
} elseif (isset($_POST['ADD_MORE_DATA'])) {
    $campaign_data_type = "PHONE";
    $campaign_data = $_POST['campaign_phone_numbers'];
    $campaigns_id = $_POST['campaigns_id'];

    // Split the phone numbers into an array
    $phoneNumbersArray = preg_split('/[\s,]+/', $campaign_data);

    //save phone numbers
    foreach ($phoneNumbersArray as $PhoneNumber) {
        $PhoneNumber = trim($PhoneNumber);
        $formattedPhoneNumber = FormatePhoneNumbers($PhoneNumber);

        $Check = CHECK("SELECT campaign_data FROM campaign_data WHERE campaign_main_id='$campaigns_id' AND campaign_data='$formattedPhoneNumber'");
        if ($Check == null) {
            $campaign_numbers = [
                "campaign_main_id" => $campaigns_id,
                "campaign_data_type" => $campaign_data_type,
                "campaign_data" => $formattedPhoneNumber,
            ];
            $Response = INSERT("campaign_data", $campaign_numbers);
        } else {
            $Response = false;
        }
    }

    // Final response after all chunks are processed
    RESPONSE(true, "More Data added successfully!", "Unable to add more data at the moment!");
}
