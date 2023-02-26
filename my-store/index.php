<?php 
session_start();
//Database Connection using PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();
//Page set home.php as default page
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';
?>