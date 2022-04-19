<?php
require_once('../../connection/conf.php');
$id = abs(htmlentities(htmlspecialchars($_GET['id'])));

$sql = "DELETE FROM tbl_daftar_pelajaran WHERE id = $id";

$query =  mysqli_query($confg,$sql);
if($query) {
    header('Location: listPelajaran?act=success');
}else{
    mysqli_error($confg);
    header('Location: listPelajaran?act=gagal');
}

$confg->close();

?>