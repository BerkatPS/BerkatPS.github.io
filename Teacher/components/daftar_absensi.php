<?php
require_once('../../connection/conf.php');

if(!isset($_SESSION['Teacher'])){
    header('Location: ../../auth/login?act=notlogin');
}

$id = $_SESSION['id_Teacher'];
$tbl_absensi_guru = $confg->query("SELECT tbl_absensi_guru.id AS id_guru_absensi , tbl_guru.id_guru , tbl_absensi_guru.tanggal, tbl_absensi_guru.waktu , tbl_guru.nuptk_guru , tbl_guru.nama_guru , tbl_absensi_guru.status , tbl_absensi_guru.keterangan FROM tbl_absensi_guru JOIN tbl_guru ON (tbl_absensi_guru.id_absensi_guru = tbl_guru.id_guru) WHERE tbl_guru.id_guru = $_SESSION[id_Teacher] ORDER BY id_guru_absensi DESC");

$countKehadiran = $confg->query("SELECT COUNT(id_absensi_guru) AS id_absensi FROM tbl_absensi_guru WHERE status='HADIR' AND id_absensi_guru = $id");
$field2 = mysqli_fetch_assoc($countKehadiran);

$countTerlambat = $confg->query("SELECT COUNT(id_absensi_guru) AS id_absensi2 FROM tbl_absensi_guru WHERE status='TERLAMBAT' AND id_absensi_guru = $id");
$field3 = mysqli_fetch_assoc($countTerlambat);

$countIzin = $confg->query("SELECT COUNT(id_absensi_guru) AS id_absensi4 FROM tbl_absensi_guru WHERE status='IZIN' OR status='SAKIT' AND id_absensi_guru = $id");
$field4 = mysqli_fetch_assoc($countIzin);

$countAlpha = $confg->query("SELECT COUNT(id_absensi_guru) AS id_absensi3 FROM tbl_absensi_guru WHERE status='ALPHA' AND id_absensi_guru = $id ");
$field8 = mysqli_fetch_assoc($countAlpha);

if(isset($_POST['submitabsen'])){
    $time = localtime(time(), true);
    $tanggal = date('d F Y');
    $waktu = date('H:i:s');
    if($time['tm_hour'] == 5 || $time['tm_hour'] == 8){
        $checkNis = $confg->query("SELECT * FROM tbl_guru WHERE nuptk_guru = $_SESSION[Teacher_nuptk]");
        $countNis = mysqli_num_rows($checkNis);
        if($countNis > 0){
            $cekAbsensiTerbaru = $confg->query("SELECT * FROM tbl_absensi_guru WHERE id_absensi_guru = $_SESSION[id_Teacher] AND tanggal = '$tanggal'");
            $countAbsensiTerbaru = mysqli_num_rows($cekAbsensiTerbaru);
            if($countAbsensiTerbaru == 0){
                if($time['tm_hour'] == 5 OR $time['tm_hour'] == 7){
                    $insertHadir = $confg->query("INSERT INTO tbl_absensi_guru(id_absensi_guru,tanggal,waktu,nuptk_guru,nama,status,keterangan) VALUES('$_SESSION[id_Teacher]','$tanggal','$waktu','$_SESSION[Teacher_nuptk]','$_SESSION[Teacher]','HADIR','TIDAK ADA')");
                    header('Location: daftar_absensi?act=successAbsen');
                }else if($time['tm_hour'] > 8 OR $time['tm_min'] < 30 ){
                    $insertTerlambat = $confg->query("INSERT INTO tbl_absensi_guru(id_absensi_guru,tanggal,waktu,nuptk_guru,nama,status,keterangan) VALUES('$_SESSION[id_Teacher]','$tanggal','$waktu','$_SESSION[Teacher_nuptk]','$_SESSION[Teacher]','TERLAMBAT','TERLAMBAT $time[tm_min] MENIT')");
                    header('Location: daftar_absensi?act=successAbsen');
                }else{
                    header('Location: daftar_absensi?act=failAbsen');
                }
            }else{
                header('Location: daftar_absensi?act=forbiddenSubmit');
            }
        }else{
            header('Location: daftar_absensi?act=notFoundAccount');
        }
    }else{
        header('Location: daftar_absensi?act=closed');
    }

}
$time = localtime(time(), true);
$tanggal = date('d F Y');
$waktu = date('H:i:s');
$date_create = date('d F Y H:i:s');

if($time['tm_hour'] > 8){
    $cekAbsensiTerbaru = $confg->query("SELECT * FROM tbl_absensi_guru WHERE nuptk_guru = $_SESSION[Teacher_nuptk] AND tanggal = '$tanggal'");
    $countAbsensiTerbaru = mysqli_num_rows($cekAbsensiTerbaru);
    if($countAbsensiTerbaru === 0){
        $insertAlpha = $confg->query("INSERT INTO tbl_absensi_guru(id_absensi_guru,tanggal,waktu,nuptk_guru,nama,status,keterangan) VALUES('$_SESSION[id_Teacher]','$tanggal','$waktu','$_SESSION[Teacher_nuptk]','$_SESSION[Teacher]','ALPHA','TIDAK MELAKUKAN ABSENSI')");

        $insertHistory = $confg->query("INSERT INTO history_guru(id_guru,id_admin,username,action,information,date_create,status) VALUES('$_SESSION[id_Teacher]',1,'ADMIN','ABSENSI','ANDA TIDAK MELAKUKAN ABSENSI DAN DINYATAKAN ALPHA','$date_create',0)");
    }else{
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/output.css">
    <link rel="icon" type="image/png" href="../../icons/world-book-day.png"/>
    <script src="../../js/timer.js"></script>
    <link rel="stylesheet" type="text/css" href="../../admin/css/dataTable.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <?php require '../../assets/header.php'; ?>
    <title>APP KESISWAAN - REKAPITULASI ABSENSI</title>
</head>
<body class="bg-slate-900 " onload="startTime();">
<div class="md:flex md:flex-row">
        <!-- Mobile Menu -->
        <div class="bg-slate-800 w-72 text-purple-600 font-mono focus:outline-none z-20 px-6 py-9 absolute inset-y-0 overflow-auto left-0 transform -translate-x-full transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar">
            <button href="" title="meta icons" class="font-extrabold text-2xl text-indigo-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3  3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" cli p-rule="evenodd" />
                </svg>
             <span class="">Kesiswaan</span>
             </button>
            <div class="relative">
            <nav class="text-slate-400 min-h-screen font-mono text-[1.3rem] relative pt-7 gap-3 md:text-lg">
                <a href="../" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <div class="flex items-center">
                        <img src="../../icons/layout.png" class="h-6 w-6"alt="">
                    </div>
                Dashboard
                </a>
                <a href="./daftar_absensi" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 bg-slate-900 rounded-md transition duration-200">
                    <img src="../../icons/calendar.png" class="h-6 w-6" alt="" srcset="">
                Absensi
                </a>
                <a href="./daftar_laporan" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5  rounded-md hover:bg-indigo-500 transition duration-200">
                    <img src="../../icons/report.png" class="h-6 w-6" alt=""> 
                Laporan
                </a>
                <a href="./Data-Siswa" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/Data.png" alt="" class="h-6 w-6" srcset="">
                Data Siswa
                </a>
                <a href="../pages/MyProfile" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/user.png" class="h-6 w-6" alt="">
                My Profile
                </a>
                <a href="./jadwal_mengajar" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5  rounded-md hover:bg-indigo-500 transition duration-200 ">
                    <img src="../../icons/online-learning.png" class="h-6 w-6" alt="">
                Pelajaran
                </a>
                <a href="../pages/semester" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/statistics.png" class="h-6 w-6" alt="">
                Semester
                </a>
                <a href="./forum-chat" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                Forum Chat
                </a>
                <a href="../App/Development" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/software-development.png" alt="" class="h-6 w-6" srcset="">
                Development
                </a>
                <a href="../history" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/history.png" alt="" class="h-6 w-6" srcset="">
                History
                </a>
                <a href="./terms" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/audit.png" alt="Terms" class="h-6 w-6" srcset="">
                Ketentuan
                </a>
                <a href="../../auth/Logout" class="flex items-center text-zinc-300 gap-2  py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition-all duration-200 ease-in">
                    <img src="../../icons/logout.png" class="h-6 w-6" alt="" srcset="">
                Logout
                </a>
                </nav>
            </div>
        </div>
            <div class="w-full h-[4rem] m-6 p-4 rounded-lg bg-slate-800 text-zinc-300">
                <div class="container flex justify-end items-center mx-auto">
                    <ul class="flex space-x-5 bottom-0">
                        <div class="relative">
                            <img src="../../icons/notification-bell.png"class="h-8 w-9" alt="" srcset="">
                        </div>
                        <div class="flex justify-start items-start content-start">
                            <?php 
                            $cekGuruOnline = $confg->query("SELECT * FROM tbl_guru WHERE status = 'Online'");
                            $countGuruOnline = mysqli_num_rows($cekGuruOnline);
                            ?>
                            <span class="p-1 flex border-green-500 border-[0.5px] text-green-500">Guru Online : <?= $countGuruOnline ?></span>
                        </div>
                        <div class="relative">
                        <span id="ct" class="p-1 flex border-green-500 border-[0.5px] text-green-500"></span>
                        </div>
                        <div class="relative" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class="flex items-center pb-2 focus:outline-none ">
                                <div class="gap-3 relative flex md:text-base">
                                    <span class="flex space-y-2"><?= $_SESSION['Teacher']; ?></span> 
                                   <span class="absolute pt-5 pl-1 text-xs items-center">TEACHER</span>
                                   <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg" class="rounded-full flex h-10 w-10 gap-2 pl-2" alt="image" srcset="">
                                </div>
                                <div class="relative">
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}"
                                    class="inline w-6 h-6 pt-1 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="relative">
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute overflow-hidden rounded-md font-normal right-0 z-10 w-40 bg-slate-800 shadow-lg text-zinc-400 shadow-black space-y-4 divide-y-2 divide-indigo-800 gap-2">
                                    <li class="">
                                        <a href="./Profile" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                            </svg>Settings</a>
                                        <a href=""class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>Account</a>
                                        <a href="../../auth/logout" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 text-red-600 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>Logout</a>
                                    </li>
                                </ul>
                                </div>
                            <!-- End Dropdown -->
                        </div>
                        <div class="relative">
                        <button class="mobile-button bg-blue-dark p-1 focus:outline-none lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                        </div>
                    </ul>
                </div>
                <div class="py-2"></div>
                <div class="relative overflow-x-auto bg-slate-800 shadow-md rounded-lg text-gray-400 pt-5">
                    <div class="px-6 py-4  border-0 flex relative mb-4 bg-yellow-dark text-yellow-500">
                        <span class="text-xl flex items-center mr-5 align-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-center" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </span>
                        <span class="inline-block font-bold align-middle mr-8">
                            FORM ABSENSI HANYA BISA DISUBMIT 1 KALI DALAM SEHARI PADA PUKUL 5 PAGI SAMPAI PUKUL 7 PAGI
                        </span>
                        <button class="absolute  bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                            <span class="flex items-center">×</span>
                        </button>
                    </div>
                    <div class="relative px-4 pb-5">
                        <h1 class="font-bold text-lg">TABLE ABSENSI (&nbsp<?= strtoupper($_SESSION['Teacher']) ?>&nbsp)</h1>
                        <h1 class="font-medium text-sm">Kamu Bisa Melihat Absensi Terbaru Milikmu</h1>
                    </div>
                    <div class="relative px-4 pb-5">
                     <form action=""method="POST">
                            <button type="submit" name="submitabsen" class="flex font-semibold gap-2 text-white rounded-md p-2 bg-indigo-500 focus:outline-none hover:shadow-lg shadow-indigo-300/100"><img src="../../icons/plus.png"class="h-6 w-6" alt="" srcset="">Silahkan Absensi</button>
                        </form>
                    </div>
                    <div class="px-4 pb-5 gap-5 grid md:grid-cols-4 sm:grid-cols-2 font-bold ">
                        <div class="w-full bg-red-600 grid grid-cols-1 sm:grid-cols-2 text-white rounded-lg">
                            <div class="block">
                                <h2 class="p-4">ALPHA</h2>
                                <h2 class="px-4"><?= $field8['id_absensi3'] ?></h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><style>.b{fill:#e7c930}.c{fill:#864e20}</style></defs><rect x="1" y="1" width="22" height="22" rx="7.656" style="fill:#f8de40"/><path class="b" d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z"/><ellipse class="c" cx="12" cy="13.375" rx="5.479" ry=".297"/><ellipse class="c" cx="7.054" cy="9.059" rx="2.157" ry=".309"/><ellipse class="c" cx="16.957" cy="9.059" rx="2.157" ry=".309"/><ellipse class="b" cx="12" cy="14.646" rx="1.969" ry=".229"/></svg>
                    </div>
                        <div class="w-full bg-yellow-dark grid grid-cols-1 sm:grid-cols-2 text-yellow-500 rounded-lg">
                            <div class="block">
                                <h2 class="p-4">TERLAMBAT</h2>
                                <h2 class="px-4"><?= $field3['id_absensi2'] ?></h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><style>.b{fill:#e7c930}.c{fill:#864e20}</style></defs><rect x="1" y="1" width="22" height="22" rx="7.656" style="fill:#f8de40"/><path class="b" d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z"/><path class="c" d="M9.3 7.173a3.027 3.027 0 0 0-.447.006 4.392 4.392 0 0 0-.873.163c-.142.043-.285.086-.425.138s-.271.123-.407.185a3.642 3.642 0 0 0-.391.218c-.125.084-.256.158-.373.251a4.837 4.837 0 0 0-1.217 1.31 3.714 3.714 0 0 0-.512 1.245.173.173 0 0 0 .286.157c.324-.283.626-.545.933-.8.406-.336.8-.66 1.218-.962.1-.083.209-.149.312-.226l.155-.116c.051-.04.108-.07.16-.108.1-.074.212-.144.315-.224l.003-.01c.108-.069.217-.14.325-.215.215-.162.449-.291.675-.46.115-.081.234-.159.353-.242a.173.173 0 0 0-.09-.31zM14.744 7.173h.005a3.029 3.029 0 0 1 .447.006 4.405 4.405 0 0 1 .873.163c.142.043.285.086.424.138s.272.123.408.185a3.642 3.642 0 0 1 .391.218c.124.084.255.158.373.251a4.837 4.837 0 0 1 1.217 1.31 3.735 3.735 0 0 1 .512 1.245.173.173 0 0 1-.286.157 49.394 49.394 0 0 0-.933-.8c-.406-.336-.8-.66-1.218-.962-.1-.083-.209-.149-.312-.226l-.155-.116c-.051-.04-.108-.07-.161-.108-.1-.074-.211-.144-.314-.224l-.009-.01a9.111 9.111 0 0 1-.325-.215c-.215-.162-.449-.291-.675-.46-.115-.081-.234-.159-.353-.242a.173.173 0 0 1 .091-.31zM14.512 13.366a5.943 5.943 0 0 0-5.024 0c-.592.369-.557-.694.753-.974A7.35 7.35 0 0 1 12 12.078a7.35 7.35 0 0 1 1.759.314c1.31.28 1.341 1.343.753.974z"/><path class="b" d="M13.074 14.269a2.542 2.542 0 0 0-2.148 0c-.253.158-.238-.3.322-.416a3.144 3.144 0 0 1 .752-.134 3.144 3.144 0 0 1 .752.134c.56.12.575.574.322.416z"/></svg>
                        </div>
                        <div class="w-full bg-green-800 grid grid-cols-1 sm:grid-cols-2 text-green-400 rounded-lg">
                            <div class="block">
                                <h2 class="p-4">KEHADIRAN</h2>
                                <h2 class="px-4"><?= $field2['id_absensi'] ?></h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="1" y="1" width="22" height="22" rx="7.656" style="fill:#f8de40"/><path d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z" style="fill:#e7c930"/><path d="M16.53 12.324a8.617 8.617 0 0 1-.494.726 5.59 5.59 0 0 1-1.029 1.058 4.794 4.794 0 0 1-.6.412 1.6 1.6 0 0 1-.162.091c-.055.028-.109.061-.164.09-.115.051-.226.115-.346.163-.26.119-.533.223-.819.329a.231.231 0 0 0 .055.446 3.783 3.783 0 0 0 .979-.022 3.484 3.484 0 0 0 .878-.25 3.718 3.718 0 0 0 .409-.205l.012-.007a4.1 4.1 0 0 0 .379-.26 3.51 3.51 0 0 0 1.1-1.465 3.381 3.381 0 0 0 .222-.871c0-.031.006-.061.009-.092a.231.231 0 0 0-.429-.143z" style="fill:#864e20"/><path d="M21.554 5.693c-.063-.289-2.888-.829-4.871-.829a5.584 5.584 0 0 0-3.3.7A3.125 3.125 0 0 1 12 5.919a3.125 3.125 0 0 1-1.381-.352 5.584 5.584 0 0 0-3.3-.7c-1.983 0-4.808.54-4.871.829s-.113 1.217.088 1.381.439.025.477.6.477 2.976 1.808 3.767 3.741.163 4.6-.365A4.3 4.3 0 0 0 11.3 8.568c.138-.892.351-1.507.7-1.507s.565.615.7 1.507a4.3 4.3 0 0 0 1.883 2.51c.854.528 3.264 1.155 4.6.365s1.77-3.189 1.808-3.767.276-.439.477-.6.149-1.095.086-1.383z" style="fill:#101820"/></svg>
                        </div>
                        <div class="w-full bg-blue-dark grid grid-cols-1 sm:grid-cols-2 text-sky-600 rounded-lg">
                             <div class="block">
                                <h2 class="p-4">IZIN / SAKIT</h2>
                                <h2 class="px-4"><?= $field4['id_absensi4'] ?></h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><style>.b{fill:#e7c930}.c{fill:#864e20}.d{fill:#26a9e0}</style></defs><rect x="1" y="1" width="22" height="22" rx="7.656" style="fill:#f8de40"/><path class="b" d="M23 13.938a14.688 14.688 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z"/><path class="c" d="M17.2 12.746c-1.221-1.647-3.789-2.231-5.2-2.231s-3.984.584-5.2 2.231-.188 3.4 1.128 3.293 3.546-.364 4.077-.364 2.762.258 4.077.364 2.345-1.647 1.118-3.293z"/><path class="b" d="M14.505 17.022A12.492 12.492 0 0 0 12 16.638a12.457 12.457 0 0 0-2.5.384c-.376.076-.39.384 0 .332s2.5-.166 2.5-.166 2.119.115 2.505.166.375-.254 0-.332z"/><path class="c" d="M8.907 9.844a.182.182 0 0 1-.331.1 2.016 2.016 0 0 0-.569-.567 1.731 1.731 0 0 0-1.915 0 2.016 2.016 0 0 0-.571.569.182.182 0 0 1-.331-.1 1.632 1.632 0 0 1 .346-1.023 1.927 1.927 0 0 1 3.026 0 1.64 1.64 0 0 1 .345 1.021zM18.81 9.844a.182.182 0 0 1-.331.1 2.026 2.026 0 0 0-.568-.567 1.732 1.732 0 0 0-1.916 0 2.016 2.016 0 0 0-.571.569.182.182 0 0 1-.331-.1 1.632 1.632 0 0 1 .346-1.023 1.927 1.927 0 0 1 3.026 0 1.64 1.64 0 0 1 .345 1.021z"/><path class="d" d="M8.576 9.946a2.016 2.016 0 0 0-.569-.567 1.731 1.731 0 0 0-1.915 0 2.016 2.016 0 0 0-.571.569.175.175 0 0 1-.214.063v11.24A1.747 1.747 0 0 0 7.054 23 1.748 1.748 0 0 0 8.8 21.253V10.005a.176.176 0 0 1-.224-.059zM18.473 9.946a2.026 2.026 0 0 0-.568-.567 1.732 1.732 0 0 0-1.916 0 2.016 2.016 0 0 0-.571.569.175.175 0 0 1-.214.063v11.24A1.748 1.748 0 0 0 16.952 23a1.747 1.747 0 0 0 1.748-1.747V10.005a.176.176 0 0 1-.227-.059z"/></svg>
                        </div>
                    </div>
                    <table class="table-auto w-full text-sm text-center bg-slate-800 text-gray-500 dark:text-gray-400 " id="example">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Waktu Kehadiran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NUPTK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAMA GURU
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KETERANGAN    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($tbl_absensi_guru)){
                        ?>
                            <tr class="text-center relative ">
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['id_guru_absensi'] ?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['tanggal'] ?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['waktu'] ?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['nuptk_guru'] ?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium text-indigo-500"><?= $row['nama_guru'] ?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium">
                                <?php
                                    if($row['status'] == 'HADIR'){
                                    echo'<span class="bg-green-800 text-center text-green-400 p-2">'.$row['status'].'</span>';    
                                    }else if($row['status'] == 'TERLAMBAT'){
                                    echo'<span class="bg-yellow-dark text-center text-yellow-500 p-2">'.$row['status'].'</span>';    
                                    }else if($row['status'] == "ALPHA"){
                                    echo'<span class="bg-red-700 text-center p-2">'.$row['status'].'</span>';
                                    }else{
                                        echo'<span class="bg-purple-dark text-center text-indigo-500 p-2">'.$row['status'].'</span>';
                                    }
                                ?>
                                </td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium">
                                    <?= $row['keterangan']; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <script>
                    const btn = document.querySelector("button.mobile-button");
                    const side = document.querySelector("#sidebar");

                    btn.addEventListener("click",() =>{
                    side.classList.toggle("-translate-x-full");
                    })
                </script>
            </div>
    </div>
</div>
<script>
$(document).ready(function(){
$('#example').DataTable({
});
})

</script>
</body>
</html> 


