<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'goals';


// connect to database
$conn = mysqli_connect("localhost", "root", "", "goals");

if (!$conn) {
	die("Error connecting to database: " . mysqli_connect_error());
}
?>
