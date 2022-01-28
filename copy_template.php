<?php

/*
==================================================
== Template Page
==================================================
*/

ob_start();  // Output Buffering Start

session_start();

$pageTitle = "";

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

    if($do == 'Mange') 
    {
echo "Welecome";
    }
    elseif($do == 'Add') {

    }
    elseif($do == 'Insert') {

    }
    elseif($do == 'Edit') {

    }
    elseif($do == 'Update') {

    }
    elseif($do == 'Delete') {

    }
    elseif($do == 'Activate') {
        
    }
    include $tpl. 'footer.php';
} // End If
else { // If $_SESSION error
    header('Location: index.php');
    exit();
}


ob_end_flush(); // Relase The Output

?>
