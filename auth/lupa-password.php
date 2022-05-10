<?php
require_once('../connection/conf.php');

if(isset($_SESSION['user'])){
    header('Location: ../public');
    exit();
}else if(isset($_SESSION['Teacher'])){
    header('Location: ../Teacher');
    exit();
}else if(isset($_SESSION['admin'])){
    header('Location: ../admin');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>APP KESISWAAN - Lupa Password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto@100;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/css/output.css">
    <link rel="stylesheet" href="assets/sweetalert/sweetalert2.min.css">
    <script src="assets/sweetalert/sweetalert2.min.css"></script>
    <link rel="icon" type="image/png" href="../icons/world-book-day.png"/>
    <script src="../js/eyesToggle.js"></script>
</head>

<body class="bg-slate-900" style="font-family:Roboto">
    <div class="h-screen flex items-center justify-center">
        <form class="lg:w-1/3 md:w-1/2 
         bg-slate-800 rounded-lg" action="ValidateLupaPassword" method="POST">
            <div class="flex font-bold justify-center mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
            </div>
            <h2 class="text-3xl text-center text-gray-400 font-extrabold mb-4">Form Lupa Password</h2>
            <?php 
            if(isset($_GET['act'])){
                if($_GET['act'] == "send"){
            ?>
                <div class='p-4 mb-4 text-base text-center text-slate-200 bg-green-600 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert' id="success">
                <span class='font-bold'>SUCCESS!! </span>Silahkan Cek Email Anda di Inbox Atau Spam
                </div>
            <?php
            }elseif($_GET['act'] == "notfound"){
            ?>
                <div class="p-4 mb-4 text-base text-center font-medium text-white bg-red-500" role="alert">
                            <span class="font-bold">GAGAL!!</span> Data yang Anda Input Tidak ada.. 
                </div>
            <?php
            }
        }
        
        ?>
            <div class="px-12 pb-10">
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 text-gray-600 text-xs z-20 fas fa-user'></i>
                        <input type='text' placeholder="Input Username atau Email"
                            class="-mx-6 px-8  w-full py-2 border-b-2 focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none text-gray-400 focus:outline-none" name="user"required />
                        
                    </div>
                </div>
                
                <div class="w-1/2 mt-3 pb-2">
                    
                    
                </div>              
                <input type="submit" name="submit"
                    class="w-full py-2 cursor-pointer rounded-full text-white bg-indigo-500 focus:outline-none hover:bg-indigo-700 transition duration-200" placeholder="kirim">
                
                    <div class="relative pt-5"></div>
                    <a href="javascript:void(0)" onclick="window.location.href ='login'"class="text-md flex items-center justify-center text-blue-500 hover:underline hover:transition duration-200" onMouseOver="window.status=''; return true;"><span class="text-sm"><&nbsp&nbsp</span>  Kembali Ke Login</a>
                    
        </form>
      </div>
    </div>

</body>
</html>