<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getTitle()?></title>
    <link rel="stylesheet" href="layout/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $css;?>jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo $css;?>jquery.selectBoxIt.css" />
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.css" />
   
    <style>
        /* Start Main Rulez*/
body {
    background-color: #f4f4f4;
}
.asterisk {
    font-size: 40px;
    position: absolute;
    right: 30px;
    top: -5px;
    color: #d20707;
}

/* End Main Rulez*/

/* Start Login Form*/

.login {
    width: 300px;
    margin: 100px auto;
}
.login input {
    margin-bottom: 10px;
}
.login h4 {
    color: #888;
}
.login .form-control {
    background-color: #eaeaea;
}
.login .btn {
    background-color: #008dde;
}
/* End Login Form*/

/* Start Navbar*/
a {
    text-decoration: none;
    color: rgba(34,54,69,.7);
    font-weight: 400;
}
a:hover {
    color: #0a3d62;
}
ul {
    list-style-type: none;
}
.navbar {
    background:cornsilk;
    /* padding: 1rem 0.5rem;
    height: 0rem;
    min-height: 12vh; */
}
.navbar .navbar-brand a {
    padding: 1rem 0;
    display: block;
    text-decoration: none;
}
.navbar .navbar-brand {
   font-family: 'pacifico',cursive;
   font-size: 2.1rem;
   color: #0a3d62;
}
.navbar-toggler {
   background:#0a3d62;
   border: none;
   padding: 10px 6px;
   outline: none;
}
.navbar .icon {
    background-color: #0a3d62;
}
.navbar-toggler span  {
    display: block;
    width: 22px;
    height: 2px;
    border: 1px;
    background:#fff;
}
.navbar-toggler span +span {
margin-top: 4px;
width: 18px;
margin-left: 4px;
}
.navbar-toggler span + span + span {
    width: 10px;
    margin-left: 10px;
}
.navbar-expand-lg .navbar-nav .nav-link {
    /* padding: 1rem 1.0rem; */
    font-size: 1.2rem;
    font-weight: bold;
    position: relative;
}
.navbar-expand-lg .navbar-nav .nav-link:hover {
border-bottom: 2px solid #0a3d62;
}
.navbar-expand-lg .navbar-nav .nav-link.active  {
border-bottom: 2px solid #0a3d62;
color: #0a3d62;
}
.navbar-nav .dropdown-item:hover {
    color: #0a3d62;
} 
.nav-item .dropdown-menu .dropdown-item {
    font-weight: 800;
    color:#0a3d62 ;
    background-color: mintcream;
}
.nav-item .dropdown-menu .dropdown-item:hover {
    background-color:darkgrey ;
}
/* End Navbar*/
/* Start Dashboard Page*/
.home-stats .stat {
   border-radius: 10px;
    padding: 20px;
    font-size: 15px;
    color: #fff;
    position: relative;
    overflow:hidden;
}
.home-stats i {
    position: absolute;
    font-size: 80px;
    top: 35px;
    left: 30px;
}
.home-stats .info {
    float: right;
}
.home-stats .stat a {
    color: #fff;
}
.home-stats .stat a:hover {
   text-decoration: none;
   color:lightsteelblue;
}
.home-stats .stat span {
    display: block;
    font-size: 60px;
}
.latest {
    margin-top: 30px;
}
.latest .toggle-info  {
color: #0a3d62;
cursor: pointer;
}
.latest .toggle-info:hover {
color: #444;
} 
.latest .ooo {
    background-color: #4caf504d;
    padding: 8px;
}
.home-stats .st-members {
    background-color: #3498db;
}
.home-stats .st-pending {
    background-color: #c0392b;
}

.home-stats .st-items {
    background-color: #d35400;
}

.home-stats .st-comments {
    background-color: #8d44ed;
}
.activate {
    margin-left: 5px;
}
.latest-users {
    margin-bottom: 0;
}
.latest-users li {
    padding: 10px;
    overflow: hidden;
}
.latest-users li:nth-child(odd) {
background-color: #EEE;
}
.latest-users .btn-success,
.latest-users .btn-info {
    padding: 2px 8px;
}
.latest-users .btn-info  {
    margin-right: 5px;
}
.nice-message {
    padding: 10px;
    background-color: #fff;
    margin: 10px 0;
    border-left: 5px solid #080;

}
/**Start Comment Dasborad */

.latest .comment-box {
    margin: 5px 0 10px;
}
.latest .comment-box  .member-n,
.latest .comment-box  .member-c {
   float: left;
}
.latest .comment-box  .member-n {
    width: 80px;
    text-align: center;
    margin-right: 20px;
    position: relative;
    top: 10px;

}
.latest .comment-box  .member-c {
    width: calc(100% - 100px);
    background-color: #d9cdcd;
    padding: 10px;
    position: relative;
}
.latest .comment-box  .member-c::before {
content: "";
display: block;
position: absolute;
left: -28px;
top: 5px;
width: 0;
height: 0;
border-style: solid;
border-color: transparent #d9cdcd transparent transparent;
border-width: 15px;

}

/**End Comment Dasborad */


/* End Dashboard Page*/

/* Start Member Edits*/

h1 {
    font-size: 40px;
    margin: 25px 0;
    font-weight: bold;
    color:black;
}
.labell {
    color: black;
    font-weight: 700;
}
.show-pass {
    position: absolute;
    top: 6px;
    right: -30px;
}
.main-table td {
    background-color: #fff;
    vertical-align: middle !important;
}
.main-table tr:first-child td { 
background-color: #0a3d62;
color: #fff;
text-align: center;
}
.main-table .btn {
padding: 3px 10px;
}
.main-table {
    -webkit-box-shadow:0 3px 10px #ccc;
    -moz-box-shadow:0 3px 10px #ccc;
    box-shadow:0 3px 10px #ccc;
}
.manage-memmbers img {
    width: 50px;
    height: 50px;
}
/* End Member Edits*/

/**Start Category Page */

.container .panel .bas {
    background-color: floralwhite;
}
.categories .panel-body {
    padding: 0;
}
.categories .panel-heading {
color: #0a3d62;
font-weight: bold;
}
.container .panel .panel-heading {
    background-color:rosybrown;
    padding: 10px;
}
/* .container .panel-heading i{
/* position: relative;
top: 1px; */
.categories hr {
    margin-top: 0;
    margin-bottom: 0;
}
.categories .cat {
    padding: 15px;
    position: relative;
    overflow: hidden;
}
.categories .cat .hidden-buttons {
    /* */
    -webkit-transition: all .5s ease-in-out;
    -moz-transition: all .5s ease-in-out;
    transition: all .5s ease-in-out;
    position: absolute;
    top: 15px;
    right: -160px;
}
.categories .cat:hover {
    background-color: #EEE;
}
.categories .cat:hover .hidden-buttons {
    right: 10px;
} 
.categories .cat .hidden-buttons a {
    margin-right: 5px;
}
.categories .cat h3 {
margin: 0;
cursor: pointer;
font-weight: bold;
color: #2c3e50;
}
.categories .cat .full-view p {
    margin: 10px 0;
    color: #707070;
}

.categories .cat:last-of-type ~ hr {
    display: none;
}
.categories .cat .visibility {
    background-color: #d35400;
    color: #fff;
    padding: 4px 6px;
    margin-right: 6px;
    border-radius: 6px;
}
.categories .cat .commenting {
    background-color: #2c3e50;
    color: #fff;
    padding: 4px 6px;
    margin-right: 6px;
    border-radius: 6px;
}
.categories .cat .advertises {
    background-color: #c0392b;
    color: #fff;
    padding: 4px 6px;
    margin-right: 6px;
    border-radius: 6px;
}
.categories .option a{
    color: black;
    text-decoration: none;
}
.categories .option span{
    color: black;
   cursor: pointer;
}
.categories .option .active {
    color: #F00;
    font-weight: bold;
}

.categories .add-category {
    margin-top: 10px;
    margin-bottom: 60px;
}
.categories .child-cats {
    margin: 0;

}
.categories .chikd-head {
    margin: 15px 0 10px;
    font-weight: bold;
    color: #22ab79;
    font-size: 16px;
    
}
.categories .child-cats li {
    margin-left: 15px;
}
.categories .child-cats li:before {
    content: "-";
}
.categories .show-delete {
    color: #f00;
    display: none;
}

/**End Category Page */




    </style>
</head>

<body>