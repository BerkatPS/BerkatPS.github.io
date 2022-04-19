<?php
require_once('../connection/conf.php');

if(!isset($_SESSION['user'])){
    header('Location: ../auth/login?act=notlogin');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="../js/sideToggle.js"></script>
    <link rel="icon" type="image/png" href="../icons/world-book-day.png"/>
    <title>APP KESISWAAN - Dashboard</title>
</head>
<body class="bg-slate-900">
    <?php require_once('pages/sidebar.php');?>
</body>
</html>