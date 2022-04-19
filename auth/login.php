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
    <title>APP KESISWAAN - Login</title>
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
         bg-slate-800 rounded-lg" action="ValidateLogin" method="POST">
            <div class="flex font-bold justify-center mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
            </div>
            <h2 class="text-3xl text-center text-gray-400 font-extrabold mb-4">Login Form</h2>
            <?php 
            if(isset($_GET['act'])){
                if($_GET['act'] == "success"){
            ?>
                <div class='p-4 mb-4 text-base text-center text-slate-200 bg-green-600 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert' id="success">
                <span class='font-bold'>SUCCESS LOGIN!!</span>  Anda Akan Diarahkan ke Dashboard User <span class="text-lg" id='waktu'>3</span>
                </div>
                <script type="text/javascript">
                    var waktu = 3;
                    setInterval(function() {
                    waktu--;
                    if(waktu < 0) {
                        document.getElementById("success").innerHTML = 'Redirecting...';
                        window.location = '../public';
                    }else{
                    document.getElementById("waktu").innerHTML = waktu;
                    }
                    }, 1000);
                    </script>
            <?php
            }elseif($_GET['act'] == "notlogin"){
            ?>
                <div class="p-4 mb-4  text-base text-center text-slate-200 bg-red-500 rounded-lg " role="alert">
                            <span class="font-bold">GAGAL LOGIN!!</span> Anda Harus Login Terlebih Dahulu
                </div>
            <?php
            }elseif($_GET['act'] == "sessionExpire"){
                ?>
                    <div class="p-4 mb-4 flex items-center justify-center text-base text-center text-slate-200 bg-yellow-dark rounded-lg " role="alert">
                                <span class="font-medium text-yellow-400 flex gap-3"><img src="../icons/danger.png" alt="Warning" class="h-6 w-6 ">Sesi Anda Telah Berakhir Silahkan Login Kembali !!</span>
                    </div>
                <?php
            }elseif($_GET['act'] == "bannedAccount"){
                ?>
                    <div class="p-4 mb-4  text-base text-center text-slate-200 bg-red-500 rounded-lg " role="alert">
                                <span class="font-medium">GAGAL LOGIN!! AKUN ANDA TELAH DI BANNED UNTUK BEBERAPA SAAT SILAHKAN HUBUNGI ADMIN!!  https://t.me/HyungUdin</span>
                    </div>
                <?php
                }elseif($_GET['act'] == "administrator"){  
            ?>
                    <div class='p-4 mb-4 text-base text-center text-green-700 bg-green-300 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert' id="success">
                <span class='font-bold'>SUCCESS LOGIN!!</span> Anda Akan Diarahkan Dashboard Admin <span class="text-lg" id='waktu'>3</span>
                </div>
                <script type="text/javascript">
                    var waktu = 3;
                    setInterval(function() {
                    waktu--;
                    if(waktu < 0) {
                        document.getElementById("success").innerHTML = 'Redirecting...';
                        window.location.href = '../admin';
                    }else{
                    document.getElementById("waktu").innerHTML = waktu;
                    }
                    }, 1000);
                    </script>
            <?php 
            }elseif($_GET['act'] == "Teacher"){  
                ?>
                        <div class='p-4 mb-4 text-base text-center text-green-700 bg-green-300 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert' id="success">
                    <span class='font-bold'>SUCCESS LOGIN!!</span> Anda Akan Diarahkan Dashboard GURU <span class="text-lg" id='waktu'>3</span>
                    </div>
                    <script type="text/javascript">
                        var waktu = 3;
                        setInterval(function() {
                        waktu--;
                        if(waktu < 0) {
                            document.getElementById("success").innerHTML = 'Redirecting...';
                            window.location.href = '../Teacher';
                        }else{
                        document.getElementById("waktu").innerHTML = waktu;
                        }
                        }, 1000);
                        </script>
                <?php 
                }elseif($_GET['act'] == "passnotvalid"){
            ?>
                <div class="p-4 mb-4 text-base text-center text-slate-200 bg-red-500" role="alert">
                            <span class="font-bold">GAGAL LOGIN!!</span> Periksa Kembali Password Anda 
                </div>
            <?php
            }elseif($_GET['act'] == "notfound"){
            ?>
                <div class="p-4 mb-4 text-base text-center text-slate-200 bg-red-500" role="alert">
                            <span class="font-bold">GAGAL LOGIN!!</span> Data yang Anda Input Tidak ada.. 
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
                <div class="w-full mb-4 ">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-600 text-xs z-10 fas fa-lock'></i>
                        <input type='password' placeholder="Password"
                            class="-mx-6 px-8 w-full py-2 border-b-2 focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none text-gray-400 focus:outline-none" id="myInput" name="password"required/>
                    </div>
                    <div class="text-right mt-5">
                        <a href="javascript:void(0)" onclick="window.location.href ='lupa-password'"class="text-md text-gray-500 float-right hover:text-blue-500 hover:transition duration-200" onMouseOver="window.status=''; return true;">Lupa Password?</a>
                    </div>
                <div class="w-1/2 mt-3 pb-2">
                    <div class="flex items-center ">
                        <input type="checkbox" onclick="myFunction()" class="bg-transparent text-gray-400">
                        <label for="checkbox" class="font-medium text-gray-500 ml-1">Show Password</label>
                    </div>
                    
                </div>              
                <input type="submit" name="submit"
                    class="w-full py-2 cursor-pointer rounded-full text-white bg-indigo-500 focus:outline-none hover:bg-indigo-700 transition duration-200" placeholder="kirim">
                
                    <div class="relative pt-5"></div>
                    <a href="javascript:void(0)" onclick="window.location.href ='register'"class="text-md text-gray-500 flex items-center justify-center hover:text-blue-500 hover:transition duration-200" onMouseOver="window.status=''; return true;">Tidak Punya Account?</a>
        </form>
      </div>
    </div>

</body>
</html>