<?php

$countData = mysqli_num_rows($confg->query("SELECT * FROM user"));
$countData2 = mysqli_num_rows($confg->query("SELECT * FROM tbl_guru"));
$countData3 = $confg->query("SELECT count(id) as id_list FROM tbl_daftar_pelajaran");
$fetchListPelajaran = mysqli_fetch_assoc($countData3);

$countData4 = mysqli_num_rows($confg->query("SELECT * FROM tbl_pelajaran WHERE STATUS = 'BERLANGSUNG'"));
$countData5 = mysqli_num_rows($confg->query("SELECT * FROM tbl_pelajaran WHERE STATUS = 'MENUNGGU'"));
$countData6 = mysqli_num_rows($confg->query("SELECT * FROM tbl_pelajaran WHERE STATUS = 'SELESAI'"));

$countLaporan = $confg->query("SELECT * FROM tbl_laporan");
$countLaporan2 = $confg->query("SELECT * FROM tbl_laporan_guru");   

$selectNews = $confg->query("SELECT * FROM news ORDER BY id DESC");
if(!isset($_SESSION['admin'])){
    header('Location: ../../auth/login?act=notlogin');
    exit();
}
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
<div class="grid grid-cols-1 pt-7 relative pb-5 gap-5 shadow-xl font-mono md:grid-cols-2 lg:grid-cols-3 lg:text-sm mx-auto">
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/group.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL SISWA SAAT INI</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500 "><?= $countData;?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/group.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL SISWA SAAT INI</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500 "><?= $countData2;?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/online-learning.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">PELAJARAN SEDANG BERLANGSUNG</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500 "><?= $countData4;?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/online-learning.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">PELAJARAN PENDING</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500 "><?= $countData5;?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/online-learning.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">PELAJARAN SELESAI</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500 "><?= $countData6;?></span>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/report.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end pt-5 mr-3">TOTAL Laporan Siswa</span>
        <?php
        if(mysqli_num_rows($countLaporan) > 0 ){
            echo'<span class="flex flex-row-reverse -my-2 mx-20 text-2xl text-red-600">'.mysqli_num_rows($countLaporan).'</span>';
        }else{
            echo'<span class="flex flex-row-reverse -my-2 mx-20 text-2xl text-green-500">'.mysqli_num_rows($countLaporan).'</span>';
            
        }
        ?>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/report.png" class="h-8 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL Laporan Guru</span>
        <?php
        if(mysqli_num_rows($countLaporan2) > 0 ){
            echo'<span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-red-600">'.mysqli_num_rows($countLaporan2).'</span>';
        }else{
            echo'<span class="flex flex-row-reverse -my-7 mx-20 text-2xl text-green-500">'.mysqli_num_rows($countLaporan2).'</span>';
            
        }
        ?>
    </div>
    <div class="bg-slate-800 h-20 w-full rounded-md grid-cols-1">
            <div class="absolute p-3 bg-transparent hover:shadow-none">
                <img src="../icons/statistics.png" class="h-8 my-5 w-8 space-x-4" alt="statistics">
            </div>
            <span class="flex items-end justify-end py-5 mr-3">TOTAL PENGUNJUNG</span>
            <span class="flex flex-row-reverse -my-7 mx-20 text-2xl">0</span>
    </div>
    </div>
    <div class="grid grid-cols-1 gap-5 shadow-xl font-mono md:grid-cols-2 ">
        <div class="bg-slate-800 col-span-2 md:col-span-1 sm:col-span-2 self-start row-span-2">
            <canvas id="Chartjs" class="sm:h-20">
            </canvas>
        </div>
        <div class="bg-slate-800 col-span-2 md:col-span-1 sm:col-span-2 self-start row-span-1">
            <canvas id="Chartjs2" class="sm:h-20">
            </canvas>
        </div>
        <div class="bg-slate-800 w-full col-span-3 row-start-1 md:col-span-3">
            <span class="p-5">Mendapatkan 3 Informasi Terbaru</span>
            <?php
                while($news = mysqli_fetch_array($selectNews)){
            ?>
                <ol class="relative border-l border-gray-200 dark:border-gray-700 px-1 py-7">                  
                    <li class="mb-10 ml-4 border border-rose-600 p-2">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border  dark:bg-gray-700"></div>
                        <div class="border-2 border-l-blue-600">
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Publish At <?= $news['tanggal'] ?></time>
                        <a href="components/news-edit?NewsId=<?= $news['id'] ?>" class="text-blue-600 hover:underline cursor-pointer">Update</a>
                        <a href="components/news-delete?id=<?= $news['id'] ?>" class="text-red-600 hover:underline cursor-pointer" onclick="return confirm('Anda Yakin Ingin Menghapus News ini !!??')">Delete</a>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= $news['title'] ?></h3>
                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400"><?= $news['news'] ?></p>
                        </div>
                    </li>
                </ol>
            <?php
                }
            ?>
    </div>
</div>
    
                <script>
                    
                    const chartjs = document.getElementById('Chartjs').getContext('2d');
                    const myChart = new Chart(chartjs, {
                        type: 'bar',
                        data: {
                            labels: ['Total User','Total Guru','Laporan Siswa', 'Laporan Guru','Total Pelajaran'],
                            datasets: [{
                                label: 'Total Data Bulan <?= date('F Y'); ?>',
                                data: [
                                    <?= $countData;?>,
                                    <?= $countData2; ?>,
                                    <?= mysqli_num_rows($countLaporan); ?>,
                                    <?= mysqli_num_rows($countLaporan2); ?>,
                                    <?= $fetchListPelajaran['id_list']; ?>
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
                <script>
                    
                    const labels = [
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'

                        ];

                        const data = {
                            labels: labels,
                            datasets: [{
                            label: 'Total Pengunjung Bulan Ini',
                            backgroundColor: 'rgb(79 70 229)',
                            borderColor: 'rgb(79 70 229)',
                            data: [0, 10, 5, 2, 20, 30, 45, 30, 20, 20 , 50 , 30],
                            }]
                        };

                        const config = {
                            type: 'line',
                            data: data,
                            options: {}
                        };
                    const newChart = new Chart(
                        document.getElementById('Chartjs2'),config
                    );
                </script>
</body>
</html>