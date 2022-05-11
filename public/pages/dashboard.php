<?php
$countData = $confg->query("SELECT * FROM user");
$id = $_SESSION['userId'];
$countData2 = $confg->query("SELECT * FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($countData2);



$countLaporan = $confg->query("SELECT COUNT(id) AS id_laporan FROM tbl_laporan WHERE id_laporan_siswa = $id");
$field = mysqli_fetch_assoc($countLaporan);

$countKehadiran = $confg->query("SELECT COUNT(id_absensi_siswa) AS id_absensi FROM tbl_absensi_siswa WHERE status='HADIR' AND id_absensi_siswa = $id");
$field2 = mysqli_fetch_assoc($countKehadiran);

$countTerlambat = $confg->query("SELECT COUNT(id_absensi_siswa) AS id_absensi2 FROM tbl_absensi_siswa WHERE status='TERLAMBAT' AND id_absensi_siswa = $id");
$field3 = mysqli_fetch_assoc($countTerlambat);

$countAlpha = $confg->query("SELECT COUNT(id_absensi_siswa) AS id_absensi3 FROM tbl_absensi_siswa WHERE status='ALPHA' AND id_absensi_siswa = $id");
$field4 = mysqli_fetch_assoc($countAlpha);

$countPelajaranMenunggu = $confg->query("SELECT COUNT(id) AS id_Pelajaran1 FROM tbl_pelajaran WHERE status ='MENUNGGU' AND kelas_mengajar = '$_SESSION[kelas]'");
$field5 = mysqli_fetch_assoc($countPelajaranMenunggu);

$countPelajaranBerlangsung = $confg->query("SELECT COUNT(id) AS id_Pelajaran FROM tbl_pelajaran WHERE status ='BERLANGSUNG' AND kelas_mengajar = '$_SESSION[kelas]'");
$field6 = mysqli_fetch_assoc($countPelajaranBerlangsung);

$countPelajaranSelesai = $confg->query("SELECT COUNT(id) AS id_Pelajaran2 FROM tbl_pelajaran WHERE status ='SELESAI' AND kelas_mengajar = '$_SESSION[kelas]'");
$field7 = mysqli_fetch_assoc($countPelajaranSelesai);


$selectNews = $confg->query("SELECT * FROM news ORDER BY id DESC LIMIT 3");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <title></title>
</head>
<body>
<div class="grid grid-cols-1 pt-4 relative pb-5 gap-5 shadow-xl font-mono md:grid-cols-2 text-slate-300  lg:text-sm mx-auto">
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/group.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL SISWA SAAT INI</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500"><?= mysqli_num_rows($countData);?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/report.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end pt-5 mr-3">TOTAL Laporan Anda</span>
        <span class="flex flex-row-reverse -my-2 mx-20 text-2xl">
        <?php
            if($field['id_laporan'] > 0){
                echo'<span class="text-red-600">'.$field['id_laporan'].'</span>';
            }else{
                echo'<span class="text-green-500">'.$field['id_laporan'].'</span>';
            }
        ?>
        </span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/online-learning.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end pt-5 mr-3">TOTAL Pelajaran Pending</span>
        <span class="flex flex-row-reverse -my-2 mx-20 text-2xl">
        <?php
            if($field5['id_Pelajaran1'] > 0){
                echo'<span class="text-yellow-600">'.$field5['id_Pelajaran1'].'</span>';
            }else{
                echo'<span class="text-green-500">'.$field5['id_Pelajaran1'].'</span>';
            }
        ?>
        </span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/online-learning.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end pt-5 mr-3">TOTAL Pelajaran Berlangsung</span>
        <span class="flex flex-row-reverse -my-2 mx-20 text-2xl">
        <?php
            if($field6['id_Pelajaran'] > 0){
                echo'<span class="text-yellow-600">'.$field6['id_Pelajaran'].'</span>';
            }else{
                echo'<span class="text-green-500">'.$field6['id_Pelajaran'].'</span>';
            }
        ?>
        </span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/point.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL Poin Anda</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl">
        <?php
            if($row['poin'] > 0){
                echo'<span class="text-red-600">'.$row['poin'].'</span>';
            }else{
                echo'<span class="text-green-500">'.$row['poin'].'</span>';
            }
        ?>
        </span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/timer.png" class="h-9 my-3 w-9" alt="report all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL Pelajaran Selesai</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl">
        <?php
            if($field7['id_Pelajaran2'] > 0){
                echo'<span class="text-green-500">'.$field7['id_Pelajaran2'].'</span>';
            }else{
                echo'<span class="text-red-600">'.$field7['id_Pelajaran2'].'</span>';
            }
        ?>
        </span>
    </div>
</div>
<div class="grid grid-cols-1 gap-5 shadow-xl font-mono ">
    <div class="bg-slate-800 w-full pl-3 col-span-2">
    <span class="p-5 text-slate-400">Mendapatkan 3 Informasi Terbaru</span>
            <?php
                while($news = mysqli_fetch_array($selectNews)){
            ?>
                <ol class="relative border-l border-gray-200 dark:border-gray-700 px-1 py-7">                  
                    <li class="mb-10 ml-4 border border-rose-600 p-2">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border  dark:bg-gray-700"></div>
                        <div class="">
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-slate-300">Publish At <?= $news['tanggal'] ?></time>
                        <h3 class="text-lg font-semibold text-slate-300"><?= $news['title'] ?></h3>
                        <p class="mb-4 text-base font-normal text-slate-300 dark:text-gray-400"><?= $news['news'] ?></p>
                        </div>
                    </li>
                </ol>
            <?php
                }
            ?>
    </div>
</div>

</body>
</html>