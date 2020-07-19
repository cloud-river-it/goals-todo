<?php
error_reporting(-1); 
ini_set('display_errors', true);
require_once 'connect.php';

// Prepare an insert statement
$sql = "INSERT INTO todo (todo_text, todo_complete) VALUES (?, ?)";
 
if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "si", $text, $complete);
    
    // Set parameters
    $text = $_REQUEST['text'];
    $complete = $_REQUEST['complete']; 
      
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}
echo "<script>location.href='index.php'</script>";
// Close statement
mysqli_stmt_close($stmt);
?>