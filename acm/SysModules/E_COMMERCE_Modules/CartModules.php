<?php
//function for cart item counts
function CartItems()
{
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
  $CheckCartItems = TOTAL("SELECT * FROM cartitems where CartCustomerId='$LOGIN_CustomerId' and CartDeviceInfo='" . IP_ADDRESS . "'");
 } else {
  $CheckCartItems = TOTAL("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
 }
 if ($CheckCartItems == 0) {
  return 0;
 } else {
  return $CheckCartItems;
 }
}

//no data found View
function NoCartItems($title)
{ ?>
 <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
   <div class="shadow-lg br10">
    <div class="flex-s-b">
     <div class="img-section">
      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/cart.gif" class="w-100">
     </div>
     <div class="item-details p-1">
      <p class="lh-1-2">
       <span class="fs-15 bold"><?php echo $title; ?></span><br>
       <span class="fs-13 text-grey">
        No Items found in the cart. Add some items in the cart.
       </span>
      </p>
      <a href="<?php echo DOMAIN; ?>/web/" class="btn btn-md btn-primary">Visit Store</a>
     </div>
    </div>
   </div>
  </div>
 </div>
<?php }
