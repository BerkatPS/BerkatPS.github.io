<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['idMengajar'])));

$sql = "DELETE FROM tbl_pelajaran WHERE id = '$id'";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: jadwalMengajar?act=success');
}else{
    mysqli_error($confg);
    header('Location: jadwalMengajar?act=gagal');
}

$confg->close();

?>