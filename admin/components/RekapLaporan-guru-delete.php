<?php
require_once('../../connection/conf.php');
$id = $_GET['id'];

$sql = "DELETE FROM tbl_laporan_guru WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: RekapLaporan-guru?act=success');
}else{
    mysqli_error($confg);
    header('Location: RekapLaporan-guru?act=gagal');
}

$confg->close();

?>