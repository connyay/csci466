<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
<div class="sixteen columns">

<?php

if ( isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] == 'true' ) {
    $loggedin = 'true';
    include HOME . DS . 'views' . DS . 'layout' . DS . 'admin_menu.php';
} else {
    $loggedin = false;
    include HOME . DS . 'views' . DS . 'layout' . DS . 'menu.php';
} ?>

</div>
<div class="twelve columns">
