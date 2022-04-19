<?php
require_once('../connection/conf.php');

if(isset($_POST['submit'])){
    $nama = stripslashes(trim(htmlspecialchars(htmlentities($_POST['nama']))));
    $kelas = $_POST['kelas'];
    $nisn = stripslashes(htmlspecialchars(htmlentities($_POST['nisn'])));
    $email = stripslashes(htmlspecialchars(htmlentities($_POST['email'])));
    $pass = stripslashes(htmlspecialchars(htmlentities($_POST['password'])));
    $no_hp = stripslashes(htmlspecialchars(htmlentities($_POST['no_hp'])));
    $walas = $_POST['walas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = stripslashes(htmlspecialchars(htmlentities($_POST['alamat'])));
    $agama = $_POST['agama'];
    $date = date('Y-m-d H:i:s');

    // cek data yang sama dengan yang di database //
    $checkSameInput = "SELECT NIS,email,no_hp FROM user WHERE NIS='$nisn',email='$email',no_hp='$no_hp'";
    $checkQuery = mysqli_query($confg,$checkSameInput);
    if($checkQuery > 1){
        header('location: register?act=duplikat');
        exit();
    }else if(strlen($pass) < 6){
        header('Location: register?act=passnotsix');
    }
    else{
        if(is_numeric($nisn) AND is_numeric($no_hp)) {
                $stmt = mysqli_stmt_init($confg);
                $sql = "INSERT INTO user(name,KELAS,NIS,email,password,no_hp,wali_kelas,jenis_kelamin,alamat,agama,waktu) VALUES(?,?,?,?,?,?,?,?,?,?,?)" OR die(mysqli_error());
                if(!mysqli_stmt_prepare($stmt,$sql)){   
                    echo'<script type="text/javascript">
                        document.querySelector("#submit").addEventListener("click", function() {
                        swal({
                        title: "Gagal Registerasi Silahkan Periksa kembali inputan anda",
                        type: "danger",
                        showCancelButton: true,
                        confirmButtonText: "Delete It",
                        confirmButtonColor: "#ff0055",
                        cancelButtonColor: "#999999",
                        reverseButtons: true,
                        focusConfirm: false,
                        focusCancel: true
                        });
                    });
                    </script>';
                    header('Location: register?act=gagal');
                }else{
                    $password = password_hash($pass,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sssssisssss",$nama,$kelas,$nisn,$email,$password,$no_hp,$walas,$jenis_kelamin,$alamat,$agama,$date);
                    mysqli_stmt_execute($stmt);
                    session_start();
                    $_SESSION['user'] = $nama;
                    $_SESSION['nis'] = $nisn;
                    $_SESSION['kelas'] = $kelas;
                    echo"<script type='text/javascript'>
                    document.querySelector('#submit').addEventListener('click', function() {
                    Swal({
                        icon: 'success',
                        title: 'Berhasil Membuat User',
                        showConfirmButton: false,
                        timer: 1500
                    });
                })'</script>";
                header('Location: register?act=success');
                }
        }else{
            header('Location: register?act=notvalidint');
            echo"
            <script type='text/javascript'>Swal({
                icon: 'warning',
                title: 'Periksa No hp atau Nis anda',
                showConfirmButton: false,
                timer: 1500
            })'</script>";
        }
        mysqli_stmt_close($stmt);
    }
}


?>