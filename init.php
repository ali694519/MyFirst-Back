<?php

include 'connect.php';
// Routes

$tpl = "includes/templates/"; //Templat Directory
$css = 'layout/css/'; //Css Directory
$js = 'layout/js/'; //Js Directory
$func = 'includes/functions/'; //Functions Directory
$lang = 'includes/languages/'; // Language Directory

// Include The Important Fiels
include $func."Functions.php";

// include 'includes/languages/ar.php';
include $lang.'en.php';

include $tpl."header.php";
// Include Navbar On All Pages Except The One With $nonavbar Vairable

if(!isset($nonavbar)){include $tpl.'navbar.php';}


?>