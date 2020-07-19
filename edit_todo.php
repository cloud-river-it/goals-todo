<?php
error_reporting(-1); 
ini_set('display_errors', true);
require 'connect.php';

//updating data from the form below
if(isset($_POST['save'])){

    //set the variables
    $id = $_POST['id'];
    $text = $_POST['text'];

    //update the database
    $sql = "UPDATE todo SET todo_text='$text' WHERE id=$id";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    header('location: index.php');
}
?>
<?php

//getting id from url
$id = $_GET['id'];
//selecting data associated with this particular id
$sql = "SELECT id, todo_text FROM todo WHERE id=$id";
$result = $conn->query($sql) or die(mysqli_error($conn));
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
    
?>
<!--<script src="https://kit.fontawesome.com/d0441b147e.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">-->
<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
<form style="padding:10px; width:400px;" action="edit_todo.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
    <label style="padding:10px;" class="label" for="text">Edit To-Do :</label>
    <input style="padding:10px;" name="text" id="text" value="<?php echo  $row['todo_text']; ?>" style="color:black;">
    <button title="save" name="save" type="submit" class="fas fa-save"></button>
</form>
<?php
    }
}   else {
    echo "0 results";
}
?>