<?php
require "../util/utility.php";
require "../util/dbconfig_remind2.php";


$upload_path = "./uploadfiles/";
$c_name = $_POST['c_name'];
$c_size = $_POST['c_size'];
$c_date = $_POST['c_date'];
$c_energy= $_POST['c_energy'];
$c_price = $_POST['c_price'];
$c_model = $_POST['c_model'];
if(is_uploaded_file($_FILES['uploadfile']['tmp_name'])){
    $filename = time()."_".$_FILES['uploadfile']['name'];
    if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upload_path.$filename)){
      
      if(DBG) echo outmsg(UPLOAD_SUCCESS);
      
      $stmt = $conn->prepare( "INSERT INTO car(c_name, c_energy, c_size, c_date, c_price , c_model , uploadfile) VALUES (?,?,?,?,?,?,?)");

    $stmt->bind_param("sssssss", $c_name, $c_energy, $c_size, $c_date, $c_price, $c_model, $filename);
    }else { 
      
      if(DBG) echo outmsg(UPLOAD_ERROR);   
    }
    }else {
        $stmt = $conn->prepare( "INSERT INTO car(c_name, c_energy, c_size, c_date, c_price , c_model) VALUES (?,?,?,?,?,?)");

        $stmt->bind_param("ssssss", $c_name, $c_energy, $c_size, $c_date, $c_price, $c_model);
    }
    $stmt->execute();
    $stmt->close();
    $conn->close();

header('Location:./list.php');


?>