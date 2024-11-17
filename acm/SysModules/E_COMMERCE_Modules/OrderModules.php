<?php

//order status option
function OrderStatus($orderStatus)
{
 if ($orderStatus == "1") {
  echo "<span class='text-info'><i class='fa fa-star fa-spin'></i> Fresh</span>";
 } else if ($orderStatus == "2") {
  echo "<span class='text-success'><i class='fa fa-check'></i> Accepted</span>";
 } else if ($orderStatus == "3") {
  echo "<span class='text-warning'><i class='fa fa-barcode'></i> Shipped</span>";
 } else if ($orderStatus == "4") {
  echo "<span class='text-danger'><i class='fa fa-motorcycle'></i> Out of Delivery</span>";
 } else if ($orderStatus == "5") {
  echo "<span class='text-primary'><i class='fa fa-truck'></i> Delivered</span>";
 } else if ($orderStatus == "6") {
  echo "<span class='text-danger'><i class='fa fa-times'></i> Cancelled</span>";
 } ?>

<?php }
