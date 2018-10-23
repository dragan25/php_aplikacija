<?php 
session_start();
require "../config.php";
$conn = Database::getInstance();
$selected_username = "";
$selected_email = "";
$selected_password_1 = "";
$selected_id_user = 0;

if(isset($_POST['btn_register'])){
	$selected_username = $_POST['username'];   
	$selected_email = $_POST['email'];
	$selected_password_1 = $_POST['password_1']; 
	$selected_username = str_replace("admin","",$selected_username);
	mysqli_query($conn, "insert into users values (null, '{$selected_username}', '{$selected_email}', 'user', '{$selected_password_1}')");
	$_SESSION['success']  = "New user successfully created!!";
	header('location: ../user_login/index.html');
	$selected_id_user = mysqli_insert_id($conn);
}