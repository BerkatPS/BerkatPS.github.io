
<?php 
$flag = file_get_contents('https://api.ipdata.co?api-key=9916a94f1122bee04b931704d39e27c96518ac194582e4d4ec2c9385');


foreach($flag as $flags){
    $test = $flags['flag'];
}
var_dump($flags);
?>

