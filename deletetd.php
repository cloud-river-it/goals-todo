<?php
error_reporting(-1); 
ini_set('display_errors', true);
require_once 'connect.php';

$id = $_REQUEST['id'];

$sql = "DELETE FROM todo WHERE id = '" . $id . "'";
if(mysqli_query($conn, $sql)){
  print ("Stored");
} else {
  print("Failed");
}

echo "<script>location.href='index.php'</script>";


?>