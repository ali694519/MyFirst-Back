<?php
/*
==================================================
== Mange Members Page
== You Can Add | Edit | Delete Members From Here
==================================================
*/
ob_start();
session_start();

$pageTitle = "Memmbers";
if(isset($_SESSION['username'])) { // Start Session
    
    include 'init.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
    //Start Mange Page
    if($do == 'Mange') { 

        $query = "";
        if(isset($_GET['page'])&& $_GET['page'] == 'pending') {
            $query = 'AND regstatus = 0';
        }

        // Select All Users Except Admin
        $stmt = $connect->prepare("SELECT * FROM userss WHERE groupid !=1 $query
        ORDER BY userid DESC");
        //Execute Statement
        $stmt->execute();
        //Assign To Variable
        $rows = $stmt->fetchAll();

        if(!empty($rows)) {
        
        ?>


    <!-- //Start Mange -->
        <!-- //Mange Page -->
        <h1 class="text-center">Manage Members</h1>
<div class="container">

<div class="table-responsive">
    <table class=" main-table manage-memmbers text-center table  table-bordered">
        <tr>
            <td>#ID</td>
            <td>Avatar</td>
            <td>Username</td>
            <td>Email</td>
            <td>Full Name</td>
            <td>Registerd Date</td>
            <td>Control</td>
        </tr>
        <?php 
        foreach($rows as $row) {
echo "<tr>";
echo "<td>".$row['userid']."</td>";
echo "<td>";
if(empty($row['avatar'])) {
    echo "No Image";
}else {


echo "<img src='upload/avatar/'".$row['avatar']."'alt=''/>";
}
echo "</td>";
echo "<td>".$row['username']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['fullname']."</td>";
echo "<td>".$row['Daatee']."</td>";
echo "<td>
<a href = 'memmbers.php?do=Edit&userid=".$row['userid']. "'class='btn btn-success'>
<i class='fa fa-edit'></i>
Edit</a>
<a href = 'memmbers.php?do=Delete&userid=".$row['userid']."'class='btn btn-danger confrim'><i class='fa fa-close'></i>
Delete </a>";
if($row['regstatus'] == 0)
 {
     ?>
<a href="memmbers.php?do=Activate&userid=<?php echo $row['userid']?>" class="btn btn-info activate"><i class="fa fa-check"></i>Activate</a>
<?php


}
echo "</td>";
echo "</tr>";
        }
        ?>
    </table>
</div>
<a href='memmbers.php?do=Add' class="btn btn-primary"><i class="fa fa-plus"></i>New Member</a>
</div>

<?php } else {

    echo "<div class='container'>";
echo "<div class='nice-message'>Ther's No Member To Show</div>";
echo '<a href=\'memmbers.php?do=Add\' class="btn btn-primary">
    <i class="fa fa-plus"></i>New Member</a>';
    echo "</div>";
}
     ?>

     <?php
     
     //End Mange

}else if($do == "Add") {  // Start Add
        ?>
        <!-- // Add Member Pages -->
              <!-- Code Html -->
<h1 class="text-center">Add  New Member</h1>
<div class="container">
    <form action="?do=Insert" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <!-- Start Username Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Username</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="username" autocomplete="off" placeholder="Username To Login Into Shop">
            </div>
        </div>
        <!-- End Username Field -->
        <!-- Start Password Field -->
        <div class="form-group form-group-lg ">
            <label  class="labell col-sm-2 control-label">Password</label>
            <div class="col-sm-10 ">
                <input type="password" class="password form-control" autocomplete="new-password" placeholder="Password Must Be Hard & Complex "required="required" name="password">
                <i class="show-pass fa fa-eye fa-2x"></i>
            </div>
        </div>
        <!-- End Password Field -->
        <!-- Start Email Field -->
        <div class="form-group">
            <label  class="labell col-sm-2 control-label">Email</label>
            <div class="col-sm-10  ">
                <input type="email" class="form-control" required="required" placeholder="Email Must Be Vaild" name="email">
            </div>
        </div>
        <!-- End Email Field -->
        <!-- Start Full Name Field -->
        <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10  ">
                <input type="text"class="form-control" required="required" name="fullname" placeholder="Full name Appear In Your Profile Pagge">
            </div>
        </div>
        <!-- End Avatar Field -->
<div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">User Avatar</label>
            <div class="col-sm-10  ">
                <input type="file"class="form-control" required="required" name="avatar">
            </div>
        </div>
        <!-- End Avatar Field -->


        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-lg" value="Add Member">
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>
   <?php 







   } // End Add
   elseif($do == 'Insert') { // Insert Member Page

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<h1 class="text-center">Update Member</h1>';
    echo "<div class=\"container\">";

    // Upload Varibles
    $avatarname = $_FILES['avatar']['name'];
    $avatarsize = $_FILES['avatar']['size'];
    $avatartemp = $_FILES['avatar']['tmp_name'];
    $avatartype = $_FILES['avatar']['type'];

    //List Of Alled File Typed To Upload
    $avatarAllowExtention = array("jpeg","jpg","png","gif");

    // Get Avatar Extentions
    $avatarExtention = strtolower(end(explode(".",$avatarname)));

   



 // Get Variables Form The Form
 $username   = $_POST['username']; 
 $password   = $_POST['password'];
 $email      = $_POST['email'];
 $fullname   = $_POST['fullname'];
 $haspass    = sha1($_POST['password']);

 // Validate The Form
 $formError = array();
 
 if(strlen($username)<2) {
     $formError[]  =" Userame Cant Be Less Than<strong>4 Characters </strong>";
 }
 if(strlen($username)>20) {
     $formError[]  ="Userame Cant Be More Than <strong>4 Characters </strong>";
 }
 if(empty($username)) {
     $formError[] = "Username Cant Be <strong>Empty</strong>";
 }
 if(empty($password)) {
    $formError[] = "password Cant Be <strong>Empty</strong>";
}
 if(empty($email)) {
     $formError[] = "Email Cant Be <strong>Empty</strong>";
 }
 if(empty($fullname)) {
     $formError[] = "Fullname Cant Be <strong>Empty</strong>";
 }
 if(!empty($avatarname) && ! in_array($avatarExtention,$avatarAllowExtention)) {
    $formError[] = "This Extention Is Not <strong>Allowed</strong>";

}
if(empty($avatarname)) {
    $formError[] = "Avatar Is <strong>Required</strong>";
}
// if(empty($avatarsize>4194304)) {
//     $formError[] = "Avatar Cant Be Larger Than <strong>4MB</strong>";
// }
 // Loop Into Errors Array And Echo It
 foreach($formError as $error) {
 echo "<div class='alert alert-danger'>".$error."</div>";
 }
 
 // If There's No Error Proced The Update Operation
 if(empty($formError)) {
    $avatar = rand(0,100000000)."_".$avatarname;
    move_uploaded_file($avatartemp,"upload\avatar\\".$avatar);

    
     $check =  checkItem("username","userss",$username);
     if($check == 1) {
$theMsg  =  "<div class='alert alert-danger'>Sorry This User Is Exits</div>";
         redirectHome( $theMsg ,"back");
     }else {
     // Insert User Info In DastaBase
 $stmt = $connect->prepare("INSERT INTO userss(username,password,email,fullname,regstatus,Daatee,avatar)
 values(:zuser,:zpass,:zmail,:zname,1,now(),:zavatar)");

 $stmt->execute(array(
"zuser"   =>  $username ,
"zpass"   => $haspass ,
"zmail"   => $email,
"zname"   =>  $fullname,
"zavatar" => $avatar,
 ));
     //echo Success Message
     $theMsg = "<div class='alert alert-success'>". $stmt->rowCount(). "Record Inserted</div>";
     redirectHome($theMsg);
}
     }
 } // End Insert
     else {
         $theMsg =  " <div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div> ";
         redirectHome($theMsg);
     }
 echo "</div>";
   }// End Insert Member Page





    elseif($do == 'Edit')  
     { //Start Edit Page
        //Check Id Get Request Userid Is Numeric & Get The Integer Value Of It
$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?
 intval($_GET['userid']) :0;
 // Select Al  Data Depend On This ID
 $stmt = $connect->prepare("SELECT * FROM userss WHERE userid = ? LIMIT 1");
 //Execute Query
 $stmt->execute(array($userid));
// Fetch The Data
 $row = $stmt->fetch();
//  The Row Count
 $count = $stmt->rowCount();
 // If There's Sucg id show the form 
 if($count > 0) {
        ?>

<h1 class="text-center">Edit Member</h1>

<div class="container">
    <form action="?do=update" method="POST" class="form-horizontal">
        <input type="hidden" name="userid" value="<?php echo $userid ?>">
        <!-- Start Username Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Username</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="username" autocomplete="off" value="<?php echo $row['username'] ?>">
            </div>
        </div>
        <!-- End Username Field -->
        <!-- Start Password Field -->
        <div class="form-group form-group-lg ">
            <label  class="labell col-sm-2 control-label">Password</label>
            <div class="col-sm-10 ">
            <input type="hidden" name="oldpassword"  value="<?php echo $row['password'] ?>">
                <input type="password" class="form-control" autocomplete="new-password" placeholder="Leav Blank If You Want To Change " name="newpassword">
            </div>
        </div>
        <!-- End Password Field -->
        <!-- Start Email Field -->
        <div class="form-group">
            <label  class="labell col-sm-2 control-label">Email</label>
            <div class="col-sm-10  ">
                <input type="email" class="form-control" required="required"  value=<?php echo $row['email'] ?> name="email">
            </div>
        </div>
        <!-- End Email Field -->
        <!-- Start Full Name Field -->
        <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Full Name</label>
            <div class="col-sm-10  ">
                <input type="text"   class="form-control" required="required" value=<?php echo $row['fullname'] ?> name="fullname">
            </div>
        </div>
        <!-- End Full Name Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-lg" value="save">
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>


    <?php } 
     else
     {
        // If There's No Such id Show Error Message
        echo "<div class='container'>";

        $themsg = "<div class='alert alert-danger'>Thers No Such ID</div>";
        redirectHome($themsg);

        echo "</div>";
    }

    } // End elsif(Edit)





    elseif($do == 'update') {  // Update Page

   echo '<h1 class="text-center">Update Member</h1>';

   echo "<div class=\"container\">";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

// Get Variables Form The Form

$userid     = $_POST['userid'];
$username   = $_POST['username'];
$email   = $_POST['email'];
$fullname   = $_POST['fullname'];

//Password Trick

// Condtion ? true : flase;
$pass = empty($_POST['newpassword']) ?$_POST['oldpassword']:sha1($_POST['newpassword']);
// $pass = "";
// if(empty($_POST['newpassword'])) 
// {
//     $pass = $_POST['oldpassword'];

// }else {
//     $pass = sha1($_POST['newpassword']);
// }

// Validate The Form
$formError = array();

if(strlen($username)<2) {
    $formError[]  ="<div class='alert alert-danger'> Userame Cant Be Less Than<strong>4 Characters </strong> </div>";
}
if(strlen($username)>20) {
    $formError[]  =" <div class='alert alert-danger'>Userame Cant Be More Than <strong>4 Characters </strong> </div>";
}
if(empty($username)) {
    $formError[] = "<div class='alert alert-danger'>Username Cant Be <strong>Empty</strong> </div>";
}
if(empty($email)) {
    $formError[] = "<div class='alert alert-danger'>Email Cant Be <strong>Empty</strong> </div>";
}
if(empty($fullname)) {
    $formError[] = "<div class='alert alert-danger'>Fullname Cant Be <strong>Empty</strong></div>";
}
// Loop Into Errors Array And Echo It
foreach($formError as $error) {
echo $error;
}

// If There's No Error Proced The Update Operation

if(empty($formError)) {

   

$stmt2 = $connect->prepare("SELECT * FROM userss WHERE 
username = ? AND userid!=? ");

$stmt2->execute(array($username,$userid));

$row = $stmt2->rowCount();

if($row ==1) {
    $theMsg ="<div class='alert alert-danger'>Sory This User Is Exist</div>";
 redirectHome($theMsg,'back',4);
}else {

 // Update The DataBase With This Info
 $stmt = $connect->prepare("UPDATE userss SET username=?,email = ?,fullname=?,password=? WHERE userid =?");

 $stmt ->execute(array($username,$email,$fullname,$pass,$userid));

 //echo Success Message
 $theMsg ="<div class='alert alert-success'>". $stmt->rowCount(). "Record Update</div>";
 redirectHome($theMsg,'back',4);

}






    }
}
    else {
        $themsg = "<div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div>";
        redirectHome($theMsg);
    }
echo "</div>";
    }// End Update Page
    






elseif($do = 'Delete') { // Start Delete Page

// Delete member  Page

echo '<h1 class="text-center">Delete Member</h1>';

echo "<div class=\"container\">";

$userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?
 intval($_GET['userid']) :0;
 // Select Al  Data Depend On This ID
 $stmt = $connect->prepare("SELECT * FROM userss WHERE userid = ? LIMIT 1");
 //Execute Query
 $stmt->execute(array($userid));
// Fetch The Data
 $row = $stmt->fetch();
//  The Row Count
 $count = $stmt->rowCount();
 // If There's Sucg id show the form 
 $check = checkItem('userid','userss',$userid);
 // If There's Such id show the form 
 if($check>0) {
    $stmt = $connect->prepare("DELETE FROM userss WHERE userid =:zuser");
    $stmt->bindParam(":zuser",$userid);
    $stmt->execute();
    $theMsg = "<div class='alert alert-success'>".$stmt->rowCount().'Record Deleted</div>';
        redirectHome($theMsg,'back');
 }
 else {
     $theMsg= "<div class=
     'alert alert-danger'>This Id Is Not Exist</div>";
     redirectHome($theMsg);
 }

echo "</div>";

} // End Delete Page



elseif($do=='Activate')  { // Start Activate
   
    // echo "Activate";
    echo '<h1 class="text-center">Activate Member</h1>';

    echo "<div class=\"container\">";
    
    $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ?
     intval($_GET['userid']) : 0;
     // Select Al  Data Depend On This ID
     $check = checkItem('userid','userss',$userid);
     // If There's Such id show the form 
     if($check>0) { 
        $stmt = $connect->prepare("UPDATE userss SET regstatus =1 WHERE userid = ?");
        $stmt->execute(array($userid));
        $theMsg = "<div class='alert alert-success'>".$stmt->rowCount()."Record Activated</div>";
        redirectHome($theMsg);
     }
     else {
         $theMsg =  "<div class=
         'alert alert-danger'>This Id Is Not Exist</div>";
         redirectHome($theMsg);
     }
    
    echo "</div>";



}// End Activate

include $tpl."footer.php";

    } // End Session
    else
     {
    // echo "You Are Not Authorized To View This Page";
    header('location:index.php');
    exit();
}
ob_end_flush();
?>
  