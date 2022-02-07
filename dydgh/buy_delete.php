<?php

require "../util/dbconfig_dydgh.php";

$c_id=$_GET['c_id'];
$m_id=$_GET['m_id'];
$id=$_GET['id'];

$sql="DELETE FROM tbl_order WHERE id=".$id;
$conn->query($sql);
$conn->close();

header("Location:purchasehistory.php?m_id=$m_id&c_id=$c_id");

?>