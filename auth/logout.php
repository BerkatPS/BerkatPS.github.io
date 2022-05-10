<?php
require_once('../connection/conf.php');


session_start();
session_unset();
unset($_SESSION['Teacher']);
unset($_SESSION['admin']);
unset($_SESSION['user']);
$updateStatus = $confg->query("UPDATE user,tbl_guru,admin SET status='NOT ACTIVE' WHERE user.id = $_SESSION[userId] , tbl_guru.id_guru = $_SESSION[Teacher]");
session_destroy();


header('Location: login?act=logout');
?>