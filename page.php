<?php

/*
Categories => [Mange | Edit | Update | Add | Insert | Delete | Stats]

Condtion ? True : False
*/

// $do = '';
//     if(isset($_GET['do'])) {
//     $do =  $_GET['do'];
//     }else {
//         $do = 'Mange';
// }

$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
 // If The Page Is Main Page

 if($do == 'Mange') {
    echo "Welcome You Are In Mange Category Page";
    echo "<a href=page.php?do=Add>ADdd New Category +</a>";
    }
    else if($do == 'Add') 
 {
     echo "Welcome You Are In Add Category Page";
 }
 else if($do == 'Insert') 
 {
     echo "Welcome You Are In Insert Category Page";
 }
     else {
    echo "Error There\s No Page With This Name";
    }
?>