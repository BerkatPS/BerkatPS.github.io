<?php
require_once('../../connection/conf.php');


$dataUser = $confg->query("SELECT * FROM history");
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
    <script src="../../js/ajax-notif.js"></script>
    <?php require '../../assets/header.php'; ?>
    <title>APP KESISWAAN - HISTORY GURU - </title>
</head>
<body class="bg-slate-900 " onload="startTime();">
<div class="md:flex md:flex-row">
        <!-- Mobile Menu -->
        <div class="bg-slate-800 w-72 text-purple-600 font-mono focus:outline-none z-20 px-6 py-9 absolute inset-y-0 left-0 transform -translate-x-full transition duration-500 ease-in-out lg:relative lg:translate-x-0" id="sidebar">
            <button href="" title="meta icons" class="font-extrabold text-2xl text-indigo-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3  3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" cli p-rule="evenodd" />
                </svg>
             <span class="">Kesiswaan</span>
             </button>
             <nav class="text-slate-400 min-h-screen overflow-y-hidden font-mono text-[1.3rem] relative pt-7 gap-3 md:text-lg">
                <a href="../" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <div class="flex items-center">
                        <img src="../../icons/layout.png" class="h-6 w-6"alt="">
                    </div>
                Dashboard
                </a>
                <a href="../components/daftar_absensi" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/calendar.png" class="h-6 w-6" alt="" srcset="">
                Absensi
                </a>
                <a href="../components/daftar_laporan" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/report.png" class="h-6 w-6" alt=""> 
                Laporan
                </a>
                <a href="../components/Data-Siswa" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/Data.png" class="h-6 w-6" alt=""> 
                Data Siswa
                </a>
                <a href="../pages/Teacher" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/user.png" class="h-6 w-6" alt="">
                My Profile
                </a>
                <a href="../components/jadwal_mengajar" class="flex items-center gap-2 text-zinc-300 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200 ">
                    <img src="../../icons/online-learning.png" class="h-6 w-6" alt="">
                Pelajaran
                </a>
                <a href="../components/forum-chat" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 hover:bg-indigo-500 rounded-md transition duration-200">
                    <img src="../../icons/chat.png" alt="" class="h-6 w-6" srcset="">
                Forum Chat
                </a>
                <a href="" class="flex items-center text-zinc-300 gap-2 py-2 px-3 my-5 bg-slate-900 rounded-md transition duration-200">
                    <img src="../../icons/history.png" alt="" class="h-6 w-6" srcset="">
                History
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
                        <div class="relative cursor-pointer" x-data="{ isOpen : false }">
                            <?php
                            $sql = "SELECT * FROM history WHERE status ='0'";
                            $query = $confg->query($sql);
                            ?>
                            <button
                            @click= "isOpen = !isOpen"
                            >
                                <div class="absolute flex items-center justify-center top-0 right-0 h-5 w-5 bg-red-700 rounded-full">
                                    <span class="flex pb-1" id="notif-number"><?= mysqli_num_rows($query)?></span>
                                </div>
                                <img src="../../icons/notification-bell.png" class="h-8 w-9" alt="" srcset="">
                            </button>
                            <script>
                                function loadNotif() {
                                    setInterval(function() {
                                        var xml = new XMLHttpRequest();
                                        xml.onreadystatechange() = function(){
                                            if(this.readyState == 4 && this.status == 200){
                                            document.getElementById("notif-number").innerHTML = this.responseText;
                                            }
                                        };

                                        xml.open("GET","notif.php",true);
                                        xml.send();
                                    },1000)
                                    }
                                    loadNotif();
                            </script>
                            <ul
                            x-show="isOpen"
                            @click.away="isOpen = false"
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute overflow-hidden rounded-md font-normal right-5 z-10 w-60 bg-slate-800 shadow-lg text-zinc-400 shadow-black gap-2">
                                <span class="px-4 py-4 text-sm">Notification</span>
                                <li class="font-sans text-sm relative hover:bg-slate-900">
                                    <div class="px-4 py-4 relative flex justify-center items-center gap-3">
                                        <img src="../../icons/danger.png" class="h-5 w-5" alt="Warning">
                                        <span>Selamat datang di Website baru Kami!!</span>
                                        <span class="absolute pt-12 right-0">2022-04-06</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="relative">
                        <span id="ct" class="p-1 flex border-green-500 border-[0.5px] text-green-500"></span>
                        </div>
                        <div class="relative" x-data="{ isOpen : false }">
                            <button
                            @click= "isOpen = !isOpen"
                            class="flex items-center pb-2 focus:outline-none ">
                                <div class="gap-3 relative flex md:text-base">
                                    <span class="flex space-y-2">EKO DIANTORO</span> 
                                   <span class="absolute pt-5 pl-1 text-xs items-center">TEACHER</span>
                                   <img src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg" class="rounded-full flex h-10 w-10 gap-2 pl-2" alt="image" srcset="">
                                </div>
                                <div class="relative">
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                    :class="{'rotate-180': isOpen, 'rotate-0': !isOpen}"
                                    class="inline w-6 h-6 pt-1 text-read transition-transform duration-200 transform"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </div>
                            </button>
                            <!-- Dropdown Menu -->
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
                                    <a href=""class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2 hover:bg-purple-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>Account</a>
                                    <a href="../../auth/logout" class="hover:bg-indigo-500 hover:text-white hover:transition duration-200 flex items-center px-4 py-3 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>Logout</a>
                                </li>
                            </ul>
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
                <div class="relative overflow-x-auto shadow-md  rounded-lg text-gray-400 pt-7">
                    <table class="cell-border w-full text-sm text-gray-500 dark:text-gray-400 rounded-lg"
                        id="example"
                    >
                        <thead class="text-xs text-center text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACTION
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        NAMA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        INFORMASI
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TANGGAL DIBUAT  
                                    </th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($dataUser)){
                        ?>
                            <tr class="text-center">
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium "><?= $row['id']?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['action']?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium text-blue-600"><?= $row['Nama']?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['information']?></td>
                                <td class="px-6 py-4 dark:bg-gray-800 font-medium"><?= $row['date_create']?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                        <tfoot class="text-xs text-gray-700 uppercase  dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ACTION
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        NAMA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        INFORMASI
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        TANGGAL DIBUAT  
                                    </th>
                                </tr>
                        </tfoot>
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
</body>
</html> 