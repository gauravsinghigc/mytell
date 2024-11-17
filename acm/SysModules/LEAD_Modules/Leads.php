<?php
//lead stage
DEFINE("LEAD_STAGES", array(
  "FRESH_LEAD" => "Fresh Lead",
  "REQ_ANALYSIS" => "Required Analysis",
  "MEETING" => "Meeting",
  "QUOTATION_AND_PROPOSAL" => "Quotation and Proposal",
  "WAITING_FOR_APPROVAL" => "Waiting For Approval",
  "APPROVED_WON" => "Approved Won",
  "REJECTED_LOST" => "Rejected Lost"
));


//function for lead call reminders
function DisplayReminder($REQ_LeadsId)
{
  $CurrentData = date("Y-m-d");
  $FetchCalls = SET_SQL("SELECT * FROM leads_calls where DATE(LeadCallingReminderDate)<='$CurrentData' and LeadCallStatus='FollowUp' and LeadMainId='$REQ_LeadsId' ORDER BY LeadCallId DESC limit 1", true);
  if ($FetchCalls != null) {
    foreach ($FetchCalls as $Calls) {
      return Reminder();
    }
  }
}

//function display lead id
function LEADID($id)
{
  echo "LEADID00" . $id;
}

//lead priority level
function LeadStatus($level)
{
  if ($level == "UPLOADED") {
    echo "<span class='bg-info btn btn-xs rounded fs-10'>$level</span>";
  } elseif ($level == "TRANSFFERED") {
    echo "<span class='bg-success btn btn-xs rounded fs-10'>$level</span>";
  } else {
    echo "<span class='lead-status btn btn-xs'>$level</span>";
  }
}


//lead stage
function LeadStage($stage)
{
  $stage = str_replace("_", " ", $stage);
  $stage = ucwords($stage);
  return "<span class='text-primary lead-stage'><i class='fa fa-hashtag text-primary'></i> $stage</span>";
}

//remindr gif
function Reminder()
{
  echo "<span><img src='" . STORAGE_URL_D . "/tool-img/alert-gif-8.gif' class='reminder-img'></span>";
}

//function for cal records
function CallTypes($calltype)
{
  if ($calltype == "Incoming") {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/incoming.png'></span>";
  } elseif ($calltype == "Outgoing") {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/outgoing.png'></span>";
  } else {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/missed.png'></span>";
  }
}
