<?php
$countData = $confg->query("SELECT * FROM user");
$id = $_SESSION['id_Teacher'];
$countData2 = $confg->query("SELECT * FROM user WHERE id = $id");
$row = mysqli_fetch_assoc($countData2);

$countLaporan = $confg->query("SELECT COUNT(id) AS id_laporan FROM tbl_laporan_guru WHERE id_laporan_guru = $id");
$field = mysqli_fetch_assoc($countLaporan);

$countKehadiran = $confg->query("SELECT COUNT(id_absensi_guru) AS id_absensi FROM tbl_absensi_guru WHERE status='HADIR' AND id_absensi_guru = $id");
$field2 = mysqli_fetch_assoc($countKehadiran);
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
<div class="grid grid-cols-1 pt-7 relative pb-5 gap-5 shadow-xl font-mono md:grid-cols-2 lg:grid-cols-4 lg:text-sm mx-auto">
    <div class="bg-slate-800 h-24 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/group.png" class="h-7 my-5 w-8" alt="user group all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL USER SAAT INI</span>
        <span class="flex flex-row-reverse -my-7 mx-24 text-2xl text-green-500"><?= mysqli_num_rows($countData);?></span>
    </div>
    <div class="bg-slate-800 h-24 w-full rounded-md grid-cols-1">
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
    <div class="bg-slate-800 h-24 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/calendar.png" class="h-7 my-5 w-8" alt="report all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL Kehadiran Anda</span>
        <span class="flex flex-row-reverse -my-7 mx-20 text-2xl">
        <?php
            if($field2['id_absensi'] > 0){
                echo'<span class="text-green-500">'.$field2['id_absensi'].'</span>';
            }else{
                echo'<span class="text-red-600">'.$field2['id_absensi'].'</span>';
            }
        ?>
        </span>
    </div>
    <div class="bg-slate-800 h-24 w-full rounded-md grid-cols-1">
        <div class="absolute p-3 bg-transparent">
            <img src="../icons/timer.png" class="h-9 my-3 w-9" alt="report all">
        </div>
        <span class="flex items-end justify-end py-5 mr-3">TOTAL Keterlambatan</span>
        <span class="flex flex-row-reverse -my-7 mx-24 text-2xl">0</span>
    </div>
</div>
<div class="grid grid-cols-1 gap-5 shadow-xl font-mono md:grid-cols-2 lg:grid-cols-4">
    <div class="bg-slate-800 col-span-1 sm:col-span-2 self-start">
        <canvas id="Chartjs" class="sm:h-20">
        </canvas>
    </div>
    <div class="bg-slate-800 w-full pl-3 col-span-2">
            <span class="p-5 ">Informasi Hari Ini</span>
                <ol class="relative border-l border-gray-200 dark:border-gray-700 px-1 py-7">                  
                    <li class="mb-10 ml-4">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">February 2022</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Application UI code in Tailwind CSS</h3>
                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Get access to over 20+ pages including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce & Marketing pages.</p>
                        <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">Learn more <svg class="ml-2 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
                    </li>
                    <li class="mb-10 ml-4">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">March 2022</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Marketing UI design in Figma</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">All of the pages and components are first designed in Figma and we keep a parity between the two versions even as we update the project.</p>
                    </li>
                    <li class="ml-4">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">April 2022</time>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">E-Commerce UI code in Tailwind CSS</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web components and interactive elements built on top of Tailwind CSS.</p>
                    </li>
                </ol>
    </div>
</div>
    
                <script>
                    const chartjs = document.getElementById('Chartjs').getContext('2d');
                    const myChart = new Chart(chartjs, {
                        type: 'bar',
                        data: {
                            labels: ['USER', 'Laporan', 'Kehadiran'],
                            datasets: [{
                                label: '<?= date('F Y'); ?>',
                                data: [
                                    <?= mysqli_num_rows($countData);?>,
                                    <?= $field['id_laporan']; ?>,
                                    <?= $field2['id_absensi']; ?>

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
</body>
</html>