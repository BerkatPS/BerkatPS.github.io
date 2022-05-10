<?php
require_once('../../connection/conf.php');
$id = abs(uniqid(htmlentities(htmlspecialchars($_GET['id']))));

$sql = "DELETE FROM tbl_laporan WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: RekapLaporan?act=success');
}else{
    mysqli_error($confg);
    header('Location: RekapLaporan?act=gagal');
}

$confg->close();

?>