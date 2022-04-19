<?php
require_once('../../connection/conf.php');

$sql = "SELECT * FROM history";
$res = $confg->query($sql);

if ($res->num_rows > 0) {
    while ($notifNumber = $res->fetch_assoc()) {
        
    }
}else{
    echo"Tidak ada Notif!!";
}

?>