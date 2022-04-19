<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM user WHERE id = '$id'";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: dataSiswa?act=success');
}else{
    mysqli_error($confg);
    header('Location: dataSiswa?act=gagal');
}

$confg->close();

?>