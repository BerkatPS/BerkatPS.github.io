<?php
require_once('../connection/conf.php');

if(!isset($_SESSION['userId'])){
    header('Location: ../auth/login?act=notlogin');
    $confg->query("UPDATE user SET status = 'Offline' WHERE id = $_SESSION[userId]");
    exit();
}
$time = localtime(time(), true);
$tanggal = date('d F Y');
$waktu = date('H:i:s');
$date_create = date('d F Y H:i:s');

if($time['tm_hour'] > 8){
    $cekAbsensiTerbaru = $confg->query("SELECT * FROM tbl_absensi_siswa WHERE nis = $_SESSION[nis] AND tanggal = '$tanggal'");
    $countAbsensiTerbaru = mysqli_num_rows($cekAbsensiTerbaru);
    if($countAbsensiTerbaru === 0){
        $insertAlpha = $confg->query("INSERT INTO tbl_absensi_siswa(id_absensi_siswa,tanggal,waktu,nis,nama,kelas,status,poin) VALUES('$_SESSION[userId]','$tanggal','$waktu','$_SESSION[nis]','$_SESSION[user]','$_SESSION[kelas]','ALPHA',10)");

        $updatePoin = $confg->query("UPDATE user SET poin = poin + 10 WHERE id = $_SESSION[userId]");

        $insertHistory = $confg->query("INSERT INTO history_siswa(id_siswa,id_kelas,msgnotif,username,action,information,date_create,status) VALUES('$_SESSION[userId]','$_SESSION[kelas]','Kamu Punya Pesan Baru Dari : ','ADMIN','ABSENSI','ANDA TIDAK MELAKUKAN ABSENSI DAN DINYATAKAN ALPHA','$date_create',0)");
    }else{
    }
}
if(isset($_SESSION['user'])){
    $confg->query("UPDATE user SET status ='Online' WHERE id= $_SESSION[userId]");

}
$countData2 = $confg->query("SELECT * FROM user WHERE id = $_SESSION[userId]");
$row = mysqli_fetch_assoc($countData2);

if($row['poin'] >= 50){
    $confg->query("UPDATE user SET banned = banned + 1 WHERE id = $_SESSION[userId]");
    header('Location: ../auth/logout');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="../js/sideToggle.js"></script>
    <link rel="icon" type="image/png" href="../icons/world-book-day.png"/>
    <title>APP KESISWAAN - Dashboard</title>
</head>
<body class="bg-slate-900">
    <?php require_once('pages/sidebar.php');?>
</body>
</html>