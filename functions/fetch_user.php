<?php

require_once('../connection/conf.php');

$query = $confg->prepare("SELECT * FROM user");

while($data = mysqli_fetch_assoc($query)){
    
}

?>