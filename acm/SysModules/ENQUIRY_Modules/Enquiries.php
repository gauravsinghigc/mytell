<?php
//enquiry status
function EnquiryStatus($enquiryno)
{
 if ($enquiryno == "0") {
  echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
 } elseif ($enquiryno == "1") {
  echo "<span class='text-warning'><i>Read</i></span>";
 } elseif ($enquiryno == "2") {
  echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Replied</span>";
 } elseif ($enquiryno == "3") {
  echo "<span class='text-info'><i class='fa fa-info-circle'></i> Closed</span>";
 } else {
  echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
 }
}
