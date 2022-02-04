<?php

$hostname = 'dydgh'; 
$username = 'dydgh';  
$password = 'dydgh';  
$dbname = 'mini';      

require_once "../util/utility.php"; 


$conn = new mysqli($hostname, $username, $password, $dbname);


if ($conn->connect_error) {
  echo outmsg(DBCONN_FAIL);
  die("연결실패 :".$conn->connect_error);
} else {
  if (DBG) echo outmsg(DBCONN_SUCCESS);
}
?>