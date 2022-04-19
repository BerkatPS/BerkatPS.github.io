<?php
require_once('../connection/conf.php');

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="icons/world-book-day.png"/>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="../public/css/output.css">
    <script src="js/eyes.js"></script>
    <title>APP KESISWAAN - Register</title>
    <link rel="stylesheet" href="assets/sweetalert/sweetalert2.min.css">
</head>
<body class="bg-slate-900">
    <div class="lg:w-1/2 xl:w-1/3 md:w-1/2 sm:w-1/2 mx-auto h-screen flex items-center justify-center">
        <form method="POST" class="w-full bg-slate-800 rounded-md text-zinc-400 pt-5" action="ValidRegister">
            <div class="flex font-bold justify-center mt-2">
                <img class="h-20 w-20"
                    src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
            </div>
                    <h2 class="font-extrabold text-lg text-gray-400 text-center py-3">Register Form</h2>                      
                    <?php 
            if(isset($_GET['act'])){
                if($_GET['act'] == "success"){
            ?>
                <div class='p-4 mb-4 text-base text-center text-green-700 bg-green-300 rounded-lg dark:bg-green-200 dark:text-green-800' role='alert' id="success">
                <span class='font-bold'>SUCCESS DAFTAR!!</span>  Anda Akan Diarahkan ke Dashboard <span class="text-lg" id='waktu'>5</span>
                </div>
                <script type="text/javascript">
                    var waktu = 5;
                    setInterval(function() {
                    waktu--;
                    if(waktu < 0) {
                    document.getElementById("success").innerHTML = 'Redirecting...';        
                    window.location = 'login';
                    }else{
                    document.getElementById("waktu").innerHTML = waktu;
                    }
                    }, 1000);
                    </script>
            <?php
            }elseif($_GET['act'] == "duplikat"){
            ?>
                <div class="p-4 mb-4  text-base text-center text-red-800 bg-red-400 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-bold">GAGAL REGISTER!!</span> Data yang anda Input sudah ada
                </div>
            <?php
            }elseif($_GET['act'] == "notvalidint"){
            ?>
                <div class="p-4 mb-4 text-base text-center text-red-800 bg-red-400 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-bold">GAGAL REGISTER!!</span> Input Nomor Hp atau Nis dengan Benar
                </div>
            <?php
            }
        }
        ?> 
            <div class="px-10 pb-10">
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <input type='text' placeholder="Masukan nama lengkap"
                            class="px-8 w-full py-2 text-zinc-400 border-b bg-transparent outline-none focus:border-purple-700 focus:transition duration-200" name="nama" required/>          
                    </div>
                    </div>
                    <div class="w-full mb-2">
                        <div class="flex items-center">
                            <input type="email" name="email" class="px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" placeholder="Masukan Email anda" required>       
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <input type="password" name="password" id="input" class="px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" placeholder="Masukan Password anda" required>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center bg-transparent">
                        <?php
                            $sql = "SHOW columns FROM user LIKE 'KELAS'";
                            $query = $confg->query($sql);
                            $row = mysqli_fetch_assoc($query);
                            
                            $values = array_map('trim', explode(',', trim(substr($row['Type'], 4), '()')));
                            $del = str_replace(array("'","\"","&quot;"),"",$values);
                        ?>
                        <select name="kelas" class="px-8 w-full appearance-none py-2 bg-transparent text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 outline-none" id="kelas" placeholder="Pilih Kelas Anda" required>
                        <option class="bg-slate-800 hover:bg-indigo-500">Pilih Kelas</option>
                        <?php
                        foreach($del as $color):
                            echo '<option class="bg-slate-800 hover:bg-indigo-500" value="' . $color . '">' . $color . '</option>' . "\r\n";
                        endforeach; 
                        ?>
                        </select>  
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <input type="text" name="nisn" class="px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" maxlength="8" placeholder="Masukan Nisn anda" required>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <input type="text" name="no_hp" class="px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" maxlength="15" placeholder="+62123456789" required>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <?php
                            $sql = "SHOW columns FROM user LIKE 'jenis_kelamin'";
                            $query = $confg->query($sql);
                            $row = mysqli_fetch_assoc($query);
                            
                            $values = array_map('trim', explode(',', trim(substr($row['Type'], 4), '()')));
                            $del = str_replace(array("'","\"","&quot;"),"",$values);
                        ?>
                        <select name="jenis_kelamin" id="" class="appearance-none px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" data-mdb-clear-button="true" required>
                        <option class="bg-slate-800 hover:bg-indigo-500">Pilih Jenis Kelamin</option>
                        <?php
                        foreach($del as $color):?>
                             <option class="bg-slate-800 hover:bg-indigo-500"value=<?= $color?>><?= $color ?></option> <?php. "\r\n"; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <?php
                            $sql = "SHOW columns FROM user LIKE 'wali_kelas'";
                            $query = $confg->query($sql);
                            $row = mysqli_fetch_assoc($query);
                            
                            $values = array_map('trim', explode(',', trim(substr($row['Type'], 4), '()')));
                            $del = str_replace(array("'","\"","&quot;"),"",$values);
                        ?>
                        <select name="walas" id="" class="appearance-none px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" required>
                        <option class="bg-slate-800 hover:bg-indigo-500">Pilih Wali Kelas</option>
                        <?php
                        foreach($del as $color):
                            echo '<option class="bg-slate-800 hover:bg-indigo-500" value="' . $color . '">' . $color . '</option>' . "\r\n";
                        endforeach; 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <?php
                            $sql = "SHOW columns FROM user LIKE 'agama'";
                            $query = $confg->query($sql);
                            $row = mysqli_fetch_assoc($query);
                            
                            $values = array_map('trim', explode(',', trim(substr($row['Type'], 4), '()')));
                            $del = str_replace(array("'","\"","&quot;"),"",$values);
                        ?>
                        <select name="agama" id="" class="appearance-none px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" required>
                        <option class="bg-slate-800 hover:bg-indigo-500">Pilih Agama</option>
                        <?php
                        foreach($del as $color):
                            echo '<option class="bg-slate-800 hover:bg-indigo-500" value="' . $color . '">' . $color . '</option>' . "\r\n";
                        endforeach; 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center pb-5">
                        <input name="alamat" class="px-8 w-full py-2 text-zinc-400 border-b focus:border-purple-700 focus:transition duration-200 bg-transparent outline-none" placeholder="Masukan Alamat anda" required></input>
                    </div>
                </div>
                    <button type="submit" id="submit" name="submit" class="w-full py-2 rounded-full text-white bg-indigo-500 focus:outline-none hover:bg-indigo-700 transition duration-200">KIRIM</button>
            </form>
        </div>
    </div>
    <script src="assets/sweetalert/sweetalert2.min.js"></script>
</body>
</html>