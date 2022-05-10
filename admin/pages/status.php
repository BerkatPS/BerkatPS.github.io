<?php
require_once('../../connection/conf.php');

$id_user= $_GET['e_id'];
$status = $_GET['status'];

$confg->query("UPDATE user SET status_account = '$status' WHERE id = $id_user");

header('Location: dataSiswa');
?>