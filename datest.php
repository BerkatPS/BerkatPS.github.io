<?php
require_once('connection/conf.php');


if(isset($_POST['submit'])){
    $name = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg,$_POST['name'])));
    $nis = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg,$_POST['nis'])));
    $kelas = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg,$_POST['kelas'])));
    $jenis_pelanggaran = htmlspecialchars(htmlentities(mysqli_real_escape_string($confg,$_POST['jenis_pelanggaran'])));

    echo $name;
    echo $nis;
    echo $kelas;
    echo $jenis_pelanggaran;
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
    <div class="relative">
        <label for="">Nama</label>
            <select name="name" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">
                <option class="absolute flex items-center p-2 w-full bg-slate-800 border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">Pilih Nama Siswa</option>
                <?php
                    $selectUser = $confg->query("SELECT name FROM user");
                    while($row = mysqli_fetch_assoc($selectUser)){
                ?>
                <option class="absolute flex items-center p-2 w-full bg-slate-800 border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">
                <?= $row['name'] ?>
                    </option>
                <?php } ?>
            </select>
        
    </div>
    <div class="relative">
        <label for="">Nomor Induk Siswa</label>
        <select name="nis" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">
            <option class="absolute flex items-center p-2 w-full bg-slate-800 border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">Pilih Nis Siswa</option>
            <?php
                $selectUser = $confg->query("SELECT NIS FROM user");
                while($row = mysqli_fetch_assoc($selectUser)){
            ?>
            <option class="absolute flex items-center p-2 w-full bg-slate-800 border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Nama SISWA">
            <?= $row['NIS'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="relative">
        <label for="">KELAS</label>
        <?php
        $sql = "SHOW columns FROM user LIKE 'KELAS'";
        $query = $confg->query($sql);
        $row = mysqli_fetch_assoc($query);
        
        $values = array_map('trim', explode(',', trim(substr($row['Type'], 4), '()')));
        $del = str_replace(array("'","\"","&quot;"),"",$values);
        ?>
        <select name="kelas" id="" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" data-mdb-clear-button="true" required>
        <option class="bg-slate-800 hover:bg-indigo-500">Pilih KELAS</option>
        <?php
        foreach($del as $color):?>
            <option class="bg-slate-800 hover:bg-indigo-500"><?= $color ?></option> <?php. "\r\n"; ?>
        <?php endforeach; ?>
    </select>
    </div>
    <div class="relative">
        <label for="">JENIS PELANGGARAN</label>
        <select name="jenis_pelanggaran" id="" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Kelas Anda" data-mdb-clear-button="true" required>
            <option value="1"class="bg-slate-800 hover:bg-indigo-500 hover:text-white">PIlih Jenis Pelanggaran</option>
            <option value="RAMBUT MELEBIHI 2 CM"class="bg-slate-800 hover:bg-indigo-500 hover:text-white">RAMBUT MELEBIHI 2 CM</option>
            <option value="TERLAMBAT MASUK KELAS"class="bg-slate-800 hover:bg-indigo-500 hover:text-white">TERLAMBAT MASUK KELAS</option>
            <option value="ALPHA (TIDAK ADA KETERANGAN)"class="bg-slate-800 hover:bg-indigo-500 hover:text-white">ALPHA (TIDAK ADA KETERANGAN)</option>
        </select>
    </div>
    <div class="relative">
        <label for="">POIN</label>
        <input type="text" name="poin" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan POIN">
    </div>
    <div class="relative">
        <label for="">KETERANGAN</label>
        <textarea name="keterangan" id="keterangan" class="absolute flex items-center p-2 w-full bg-transparent border border-gray-600 text-left text-zinc-400 focus:outline-none focus:border-indigo-500 transform translate duration-500" placeholder="Masukkan Keterangan">
        </textarea>
    </div>
    <div class=""></div>
        <button type="submit" name="submit" class="bg-blue-dark text-blue-600 p-2 hover:bg-blue-600 hover:text-white hover:transform duration-300">Simpan Data</button>
</form>


</body>
</html>
