<?php
error_reporting(-1); 
ini_set('display_errors', true);
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/d0441b147e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
        })
    })
    </script>
</head>
<body>
<!-- Container -->
<div id="container">
    <h1>Assistant</h1>
    <!-- container-top -->
    <div class="container-top">
    <!-- form -->
    <form action="insert_goal.php" method="post">
    <h2>New Goal</h2>
        <label class="label" for="cat">Category</label>
        <select name="cat" id="cat">
            <option value="0">Personal</option>
            <option value="1">Professional</option>
            <option value="2">Other</option>
        </select>
        <label class="label" for="text">Goal :</label>
        <textarea name="text" id="text" placeholder="text..."></textarea>
        <label class="label" for="goaldate">Target Date :</label>
        <input type="date" id="goaldate" name="goaldate">
        <label class="label" for="complete">Acheived ?</label><br>
        <input type="hidden" id="complete" name="complete" value="0">
        <input title="yes" type="checkbox" id="complete" name="complete" value="1"><br><br>
        <button title="save" type="submit" class="fas fa-save"></button>
    </form>
    <!-- form end -->
    <?php
    //Get all columns from table named "goals"
    $sql = "SELECT * FROM goals";
    //Incomplete Goals
    print("<h3>Goals</h3>");
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result)){
        if($row['goal_complete'] == 0){
            if($row['goal_category'] == 0){
                $cat = "Personal";
              } elseif ($row['goal_category' == 1]){
                $cat = "Professional";
              } else {
                $cat = "Other";
              }
              echo "<div class='goal'>";
              echo "<a rel='facebox' href='edit_goal.php?id=" . $row['goal_id'] . "'><button title='edit' id='btn' class='btnEdit fas fa-edit'></button></a><a href='complete.php?id=" . $row['goal_id'] . "'><button title='done' id='btn' class='btnComplete fas fa-check-circle'></button></a><p style='color: black; font-size: 0.8em;'>";
              echo $cat . "</p><p class='ptext'>" . $row['goal_text'] . "</p>" . "<p style='font-size: 0.7em; color: #2d545e;'>Target date : " . $row['goal_date'];
              echo "</p></div>";
        }
    }
    //Complete Goals
    print("<h3>Acheived</h3>");
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result)){
        if($row['goal_complete'] != 0){
            if($row['goal_category'] == 0){
                $cat = "Personal";
              } elseif ($row['goal_category' == 1]){
                $cat = "Professional";
              } else {
                $cat = "Other";
              }
              echo "<div class='goalx'>";
              echo "<a href='delete.php?id=" . $row['goal_id'] . "'><button title='delete' id='btn' class='btnDelete fas fa-trash'></button></a><p style='color: black; font-size: 0.8em;'>";
              echo $cat . "</p><p class='ptext'>" . $row['goal_text'] . "</p>" . "<p style='font-size: 0.7em; color: #2d545e;'>" . $row['goal_date'];
              echo "</p></div>";
        }
    }    
    ?>
    </div>
    <!-- container-top end -->
    <!-- container-bottom -->
    <div class="container-bottom">
    <!-- Form To-Do -->
    <form action="insert_todo.php" method="post">
    <h2>Add To-Do</h2>
        <label class="label" for="text">To-Do :</label>
        <textarea name="text" id="text" placeholder="text..."></textarea> 
        <label class="label" for="complete">Done ?</label><br>
        <input type="hidden" id="complete" name="complete" value="0">
        <input title="yes" type="checkbox" id="complete" name="complete" value="1"><br><br>
        <button title="save" type="submit" class="fas fa-save"></button>  
    </form>
    <!-- form end -->
    <?php
    //Get all columns from table named "todo"
    $sql = "SELECT * FROM todo";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    print("<h3>To-Do</h3>");

    //Incomplete ToDos
    while($row = mysqli_fetch_array($result)){
        if($row['todo_complete'] == 0){

            echo "<div class='todo'>";
            echo "<a rel='facebox' href='edit_todo.php?id=" . $row['id'] . "'><button title='edit' id='btn' class='btnEdit fas fa-edit'></button></a><a href='completetd.php?id=" . $row['id'] . "'><button title='done' id='btn' class='btnComplete fas fa-check-circle'></button></a><p class='ptext'>";
            echo $row['todo_text'] . "</p>" . "<p style='font-size: 0.7em; color: #2d545e;'>" . $row['todo_date'];
            echo "</p></div>";
              
        }
    }
    ?>

    <?php
    //Complete ToDos
    print("<h3>Done</h3>");
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_array($result)){
        if($row['todo_complete'] != 0){
            
            echo "<div class='todox'>";
            echo "<a href='deletetd.php?id=" . $row['id'] . "'><button title='delete' id='btn' class='btnDelete fas fa-trash'></button></a><p class='ptext'>";
            echo $row['todo_text'] . "</p>" . "<p style='font-size: 0.7em; color: #2d545e;'>" . $row['todo_date'];
            echo "</p></div>";
        }
    }    
    ?> 
    </div>
    <!-- container-bottom end -->
</div>
<!-- // Container -->
</body>
</html>