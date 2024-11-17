<?php
//ProductImages
function ProductImages($sql, $productid, $productimage)
{
 if ($productimage == null) {
  $ProductImage = STORAGE_URL . "/products/pro-img/default.jpg";
 } else {
  $ProductImage = STORAGE_URL . "/products/pro-img/$productid/$productimage";
 }

 return $ProductImage;
}
