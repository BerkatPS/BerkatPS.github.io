<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM tbl_absensi_siswa WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: RekapAbsensi?act=success');
}else{
    mysqli_error($confg);
    header('Location: RekapAbsensi?act=gagal');
}

$confg->close();

?>