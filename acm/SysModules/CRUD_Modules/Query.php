<?php
function QUERY($SQL, $die = false)
{
  $QUERY = "$SQL";

  if ($die == true) {
    die($QUERY);
  }

  $QUERY = mysqli_query(DBConnection, $QUERY);
  if ($QUERY == true) {
    return $QUERY;
  } else {
    return false;
  }
}
