<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM tbl_absensi_guru WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: RekapAbsensi-guru?act=success');
}else{
    mysqli_error($confg);
    header('Location: RekapAbsensi-guru?act=gagal');
}

$confg->close();

?>