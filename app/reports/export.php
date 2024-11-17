<?php
$Dir = "../..";
require $Dir . '/acm/SysFileAutoLoader.php';
require $Dir . '/handler/AuthController/AuthAccessController.php';

if (isset($_GET['eid'])) {
    $campaigns_id = SECURE($_GET['eid'], "d");
    $CampSQL = "SELECT campaign_created_at,campaign_ref_no FROM campaigns where campaigns_id='$campaigns_id'";
    $DataSQL = "SELECT campaign_data_id, campaign_data, send_status FROM campaign_data where campaign_main_id='$campaigns_id'";

    //start processing export csv module
    $filename = FETCH($CampSQL, "campaign_ref_no") . "_" . 'campaign_' . date("d_m_Y") . "_report.csv";
    $path = __DIR__ . '/../../exports/' . $filename;

    // Open the file for writing
    $file = fopen($path, 'w');

    $header_row = [
        'Sno',
        'DataId',
        'Data',
        'SendDate',
        'Response',
    ];
    fputcsv($file, $header_row);

    //get data
    $AllData = SET_SQL($DataSQL, true);
    $DATA_ROW = [];
    if ($AllData != null) {
        $SerialNo = 0;
        foreach ($AllData as $Data) {
            $SerialNo++;
            $row = [
                $SerialNo,
                $Data->campaign_data_id,
                $Data->campaign_data,
                DATE_FORMATES("d M, Y", FETCH($CampSQL, "campaign_created_at")),
                $Data->send_status,
            ];
            array_push($DATA_ROW, $row);
        }
    }

    foreach ($DATA_ROW as $data_row) {
        fputcsv($file, $data_row);
    }

    fclose($file);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    readfile($path);
} else {
    header("location: index.php");
}
