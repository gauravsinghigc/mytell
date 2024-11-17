<?php
//amount total
function AMOUNT($SQL, $T)
{
 global $DBConnection;
 $TotalAmountPaid = SELECT("$SQL");
 $TotalAmount = 0;
 while ($fetchtotalpayment = mysqli_fetch_array($TotalAmountPaid)) {
  $TotalAmount += (int)$fetchtotalpayment["$T"];
 }
 if ($TotalAmount == 0 or $TotalAmount == null) {
  $TotalAmount = 0;
 } else {
  $TotalAmount = $TotalAmount;
 }
 return (int)$TotalAmount;
}

//product price in cart
function TotalCartPrice()
{
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
  $CheckCartItems = SELECT("SELECT * FROM cartitems where CartCustomerId='$LOGIN_CustomerId' and CartDeviceInfo='" . IP_ADDRESS . "'");
 } else {
  $CheckCartItems = SELECT("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
 }
 $CartFinalPrice = 0;
 while ($fetchcarts = mysqli_fetch_array($CheckCartItems)) {
  $CartFinalPrice += (int)$fetchcarts['CartFinalPrice'];
 }

 if ($CartFinalPrice == 0) {
  return 0;
 } else {
  return $CartFinalPrice;
 }
}

//TaxAmount
function TaxAmount($tax, $productprice)
{
 if ($tax == null || $tax == 0) {
  $taxAmount = $productprice;
 } else {
  $getamount = round((int)$tax / (int)$productprice * 100);
  $taxAmount = (int)$productprice - (int)$getamount;
 }

 return $taxAmount;
}

//cart charges amount
function ChargesCartAmount($dccartamount, $dcchargeamount)
{
 if ($dccartamount >= TotalCartPrice()) {
  $TotalCartPrice = "Rs." . (int)$dcchargeamount;
 } else {
  $TotalCartPrice = "Free";
 }
 return $TotalCartPrice;
}

//final order amount or net payable amount 
function FinalCartAmount()
{
 global $dccartamount;
 global $dcchargeamount;

 if (ChargesCartAmount($dccartamount, $dcchargeamount) == "Free") {
  $TotalCartPrice =  TotalCartPrice();
 } else {
  $TotalCartPrice = TotalCartPrice() + (int)$dcchargeamount;
 }

 return $TotalCartPrice;
}

//charge finction
function ChargeDisplay($checkcharge, $compare)
{
 if ($_SESSION["$checkcharge"] == "$compare") {
  echo "Free";
 } else {
  echo "Rs." . $_SESSION["$checkcharge"];
 }
}

//tax display
function TaxDisplay($tax, $productprice)
{
 if ($tax == null | $tax == 0) {
  $TaxDisplay = 0 . " %";
 } else {
  $TaxDisplay = round((int)$tax / (int)$productprice * 100);
 }

 return $TaxDisplay;
}
