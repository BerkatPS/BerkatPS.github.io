<?php
require_once('connection/conf.php');


if(isset($_POST['kirim'])){
    $jam_mulai = $_POST['jam_mulai'];
    $jam_akhir = $_POST['jam_akhir'];

    $query = mysqli_query($confg,"INSERT INTO tbl_pelajaran VALUES($jam_mulai,$jam_akhir)");
    if($query == TRUE){
        echo"Data Berhasil di input";
    }

    var_dump($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="" method="POST">
        <input type="time" name="jam_mulai" required/>
        <input type="time" name="jam_akhir" required/>
        <button type="submit" name="kirim">kirim</button>
    </form>


</body>
</html>