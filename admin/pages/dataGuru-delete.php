<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM tbl_guru WHERE id_guru = '$id'";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: dataGuru?act=success');
}else{
    mysqli_error($confg);
    header('Location: dataGuru?act=gagal');
}

$confg->close();

?>