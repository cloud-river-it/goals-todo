<?php
error_reporting(-1); 
ini_set('display_errors', true);
require_once 'connect.php';

// Prepare an insert statement
$sql = "INSERT INTO goals (goal_category, goal_text, goal_date, goal_complete) VALUES (?, ?, ?, ?)";
 
if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "issi", $category, $text, $date, $complete);
    
    // Set parameters
    $category = $_REQUEST['cat'];
    $text = $_REQUEST['text'];
    $date = $_REQUEST['goaldate'];
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