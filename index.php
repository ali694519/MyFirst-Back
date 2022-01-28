<?php
ob_start();
session_start();
$nonavbar ="";
$pageTitle ="Login";
if(isset( $_SESSION['username'])) 
{
    header('location:dashoard.php'); // Redirect To Dashboard Page
}

include 'init.php';

// Check If User Coming From HTTP Post Request
if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $username = $_POST['user'];
     $password = $_POST['pass'];
     $hashedpass = sha1($password);

     // Check If The User Exist In Database
     $stmt = $connect->prepare("SELECT userid , username , password 
        FROM userss
        WHERE username = ?
        AND password = ?
        AND  groupid = 1
        LIMIT 1"
        );
        $stmt->execute(array($username,$hashedpass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
     // If Count > 0 This Mean The Dtabase Contain Record About This Username
     if($count > 0) {
        $_SESSION['username'] = $username; // Register Session Name
        $_SESSION['ID'] = $row['userid'];  // Register Session Id
    header('location:dashoard.php'); // Redirect To Dashboard Page
       
    ?>
    <!-- <script>window.location.reload()</script> -->
<?php
     // Redirect To Dashboard Page
exit();
     }
 }
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h4 class="text-center">Admin login</h4>
    <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="login">
</form>
<?php
include $tpl."footer.php";
ob_end_flush();
?>