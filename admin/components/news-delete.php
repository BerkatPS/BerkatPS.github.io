<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM news WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: ../?act=success');
}else{
    mysqli_error($confg);
    header('Location: ../?act=gagal');
}

$confg->close();

?>
