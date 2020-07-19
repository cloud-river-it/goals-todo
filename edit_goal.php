<?php
error_reporting(-1); 
ini_set('display_errors', true);
require 'connect.php';

//updating data from the form below
if(isset($_POST['save'])){

    //set the variables
    $id = $_POST['id'];
    $cat = $_POST['cat'];
    $text = $_POST['text'];
    $goaldate = $_POST['goaldate'];

    //update the database
    $sql = "UPDATE goals SET goal_category='$cat', goal_text='$text', goal_date='$goaldate' WHERE goal_id=$id";
    $result = $conn->query($sql) or die(mysqli_error($conn));
    header('location: index.php');
}
?>
<?php

//getting id from url
$id = $_GET['id'];
//selecting data associated with this particular id
$sql = "SELECT goal_id, goal_category, goal_text, goal_date FROM goals WHERE goal_id=$id";
$result = $conn->query($sql) or die(mysqli_error($conn));
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
    
?>
<!--<script src="https://kit.fontawesome.com/d0441b147e.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">-->
<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
<form style="padding:10px; width:400px;" action="edit_goal.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['goal_id']; ?>"/> 
    <label style="padding:10px;" class="label" for="text">Edit Goal :</label>             
    <label class="label" for="cat" >Category</label>
        <select name="cat" id="cat" value="<?php echo  $row['goal_category']; ?>">
            <option value="0">Personal</option>
            <option value="1">Professional</option>
            <option value="2">Other</option>
        </select>
    <label class="label" for="text">Goal :</label>
    <input style="padding:10px;" name="text" id="text" value="<?php echo  $row['goal_text']; ?>" style="color:black;">
    <label class="label" for="goaldate">Target Date :</label>
    <input type="date" id="goaldate" name="goaldate" value="<?php echo  $row['goal_date']; ?>">
    <button title="save" name="save" type="submit" class="fas fa-save"></button>
</form>
<?php
    }
}   else {
    echo "0 results";
}
?>