<?php
require_once('../../connection/conf.php');

if(!isset($_SESSION['user'])){
    header('Location: ../../auth/login?act=notlogin');
    exit();
}
$dataLaporan = $confg->query("SELECT tbl_laporan.id , user.id AS id_siswa_laporan, user.name , user.NIS , tbl_laporan.jenis_pelanggaran , user.poin AS poin_siswa , tbl_laporan.date ,tbl_guru.nama_guru AS guru_pelapor , tbl_laporan.keterangan FROM tbl_laporan JOIN user ON (tbl_laporan.id_laporan_siswa = user.id) JOIN tbl_guru ON ( tbl_laporan.id_guru_pelapor = tbl_guru.id_guru ) WHERE user.id = $_SESSION[userId] ")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../icons/world-book-day.png"/>
    <script src="../../js/timer.js"></script>
    <script src="../../js/sideToggle.js"></script>
    <link rel="stylesheet" type="text/css" href="../../admin/css/dataTable.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <?php require '../../assets/header.php';?>
    <title>APP KESISWAAN - DAFTAR LAPORAN</title>
</head>
<body class="bg-slate-900" onload="startTime();">
<div class="md:flex md:flex-row md:min-h-screen top-0 left-0 h-screen ">
        <!-- Mobile Menu -->
        <!--  -->
        <div class="bg-slate-800 w-72 text-purple-600 font-mono z-20 px-6 py-9 absolute inset-y-0 left-0 transform -translate-x-full transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar" x-data="{open : false}">
            <a href="" title="meta icons" class="mb-[rem] font-extrabold text-2xl text-indigo-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" cli p-rule="evenodd" />
                </svg>
             <span class="">Kesiswaan</span>
             <div class="hidden lg:bg-black opacity-70 p-2 -right-5 rounded-full"id="row" onclick="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H6M12 5l-7 7 7 7"/></svg>
             </div>
            </a>
            <nav class="text-slate-400 font-mono text-[1.3rem] pt-7 relative gap-3 md:text-lg">
                <a href="../" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <div class="flex items-center">
                        <img src="../../icons/layout.png" class="h-6 w-6"alt="">
                    </div>
                Dashboard
                </a>
                <a href="../components/absensi" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/calendar.png" class="h-6 w-6" alt="" srcset="">
                Absensi
                </a>
                <a href="../components/laporan" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 bg-slate-900 rounded-md transition duration-200">
                    <img src="../../icons/report.png" class="h-6 w-6" alt=""> 
                Laporan
                </a>
                <a href="../pages/User" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/user.png" class="h-6 w-6" alt="">
                User Profile
                </a>
                <a href="mata-pelajaran" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/online-learning.png" class="h-6 w-6" alt="">
                Pelajaran
                </a>
                <a href="forum-chat" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                Forum Chat
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
        <div class="w-full h-[4rem] m-6 p-4 rounded-lg bg-slate-800 text-zinc-300">
        <div class="container flex justify-end items-center mx-auto">
                    <ul class="flex space-x-5 bottom-0">
                        <div class="relative cursor-pointer =">
                            <div class="absolute flex items-center justify-center top-0 right-0 h-5 w-5 bg-red-600 rounded-full">
                                <span class="flex pb-1">1</span>
                            </div>
                            <img src="../../icons/notification-bell.png" class="h-8 w-9" alt="" srcset="">
                        </div>
                        <div class="relative">
                        <span id="ct" class="p-1 flex   border-green-500 border-[0.5px] text-green-500"></span>
                        </div>
                        <div class="relative" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class="flex items-center pb-2 focus:outline-none ">
                                <div class="gap-3 relative flex ">
                                    <span class="flex space-y-2"><?= strtoupper($_SESSION['user']) .'&nbsp&nbsp'. strtoupper($_SESSION['kelas']);?> </span> 
                                   <span class="absolute pt-5 pl-1 text-xs items-center">Siswa</span>
                                   <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg" class="rounded-full flex h-10 w-10 gap-2 pl-2" alt="image" srcset="">
                                </div>
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}"
                                    class="inline w-6 h-6 pt-1 transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="relative">
                                <ul
                                x-show="isOpen"
                                @click.away="isOpen = false"
                                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute overflow-hidden rounded-md font-normal right-0 z-10 w-40 bg-slate-800 shadow-lg text-zinc-400 shadow-black space-y-4 divide-y-2 divide-indigo-800 gap-2">
                                    <li class="">
                                            <a href="./Profile" class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                                </svg>Settings</a>
                                            <a href=""class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>Account</a>
                                            <a href="../../auth/logout" class="hover:bg-blue-600 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                <script>
                    const btn = document.querySelector("button.mobile-button");
                    const side = document.querySelector("#sidebar");

                    btn.addEventListener("click",() =>{
                    side.classList.toggle("-translate-x-full");
                    })
                </script>
                <div class="py-5"></div>
                <div class="relative overflow-x-auto bg-slate-800  rounded-lg text-gray-400 pt-7">
                    <table class="w-full text-sm text-gray-500 dark:text-gray-400 rounded-lg"
                        id="example"
                    >
                        <thead class="text-xs text-center text-gray-700 uppercase  dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Siswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NIS
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jenis Pelanggaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Poin
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD PESERTA DIDIK    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAMA GURU PELAPOR    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD GURU PIKET    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD WALI KELAS   
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KETERANGAN   
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD GURU BK   
                                </th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($dataLaporan)){
                        ?>
                            <tr class="text-center">
                                <td class="px-6 py-4 bg-slate-800 font-medium"><?= $row['id'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium text-indigo-500"><?= $row['name'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium text-indigo-500"><?= $row['NIS'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "><?= $row['jenis_pelanggaran'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium ">
                                <?php
                                    if($row['poin_siswa'] > 0){
                                        echo'<span class="text-red-600 p-2">+'.$row['poin_siswa'].'</span>';
                                    }else{
                                        echo'<span class="text-green-500 p-2">'.$row['poin_siswa'].'</span>';
                                    }
                                ?>
                                </td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "><?= $row['date'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium text-indigo-500"><?= $row['guru_pelapor'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "><?= $row['keterangan'] ?></td>
                                <td class="px-6 py-4 bg-slate-800 font-medium "></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                        <tfoot class="text-xs text-gray-700 uppercase  dark:bg-gray-700 dark:text-gray-400">
                                 <tr>
                                 <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Siswa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NIS
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jenis Pelanggaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Poin
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD PESERTA DIDIK    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAMA GURU PELAPOR    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD GURU PIKET    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD WALI KELAS   
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KETERANGAN   
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TTD GURU BK   
                                </th>
                                </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
    </div>
    <script>
$(document).ready(function(){
$('#example').DataTable({
    autoFill: true
});
})

</script>
</body>
</html>