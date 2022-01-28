<?php
ob_start("ob_gzhandler"); //Output Buffering Start
session_start();

if(isset($_SESSION['username'])) {
    
$pageTitle = "Dashboard";

    include 'init.php';
/**
 * 
 * Start Dahborad page
 */

 
 $numusers = 6;  // Number Of Latest Users

$latestuser = getLatest("*","userss",'userid',$numusers);   // Latest Users Array

$numitem = 6;  // Number Of Latest Item

$latestitem = getLatest("*",'itemss','itemid',$numitem); //  Latest Item Array

$numcomment = 4; //Number Of Latest Comment


?>

<div class="container home-stats text-center">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="stat st-members">
                <i class="fa fa-users"></i>
                <div class="info">
                Total Members
<span><a href="memmbers.php"><?php echo countItems('userid','userss')?></a></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-pending">
                <i class="fa fa-user-plus"></i>
             <div class="info">
             Pending Members
                <span><a href="memmbers.php?do=Mange&page=pending">
                    <?php echo checkItem('regstatus',"userss",0)?>
                </a></span>
             </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-items">
                <i class="fa fa-tag"></i>
               <div class="info">
               Total Items
 <span><a href="items.php"><?php echo countItems('itemid','itemss')?></a></span>
               </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat st-comments">
                <i class="fa fa-comments"></i>
                <div class="info">
                Total Comments
 <span><a href="comments.php"><?php echo countItems('cid','commentss')?></a></span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="latest">
<div class="container ">


    <div class="row"> 
        <!-- Start row -->

        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class=" panel-heading">
                    <i class="fa fa-users"></i>Latest <?php echo $numusers?>
                    Registerd Users
                    <span class="toggle-info float-right">
                        <i class="fa fa-plus fa-lg"></i>
                    </span>
                </div>
                <div class="ooo panel-body">
                    <ul class="list-unstyled latest-users">
                <?php

                if(!empty($latestuser)) {
                                    
                foreach($latestuser as $user) {
         echo"<li>";
            echo $user['username'];
                echo "<a href = memmbers.php?do=Edit&userid=".$user['userid']."'>";
                    echo "<span class='btn btn-success float-right'>";
                      echo "<i class='fa fa-edit'></i>Edit";
                        if($user['regstatus'] == 0){
                         echo "<a href = 'memmbers.php?do=Activate&userid=".$user['userid']."'class='btn btn-info float-right activate '><i class='fa fa-check'></i>
                     Activate</a>";}
               echo "</span>";
             echo "</a>";
           echo "</li>";
                }
            }else {
                echo "Ther's No Member To Show" ;
            }
                ?> 
                </ul>
                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class=" panel-heading">
                    <i class="fa fa-tag"></i>Latest  <?php echo $numitem;?> Items
                    <span class="toggle-info float-right">
                        <i class="fa fa-plus fa-lg"></i>
                    </span>
                </div>
                <div class="ooo panel-body">
                <ul class="list-unstyled latest-users">
                <?php

if(!empty($latestitem)) {
                foreach($latestitem as $item) {
         echo"<li>";
            echo $item['name'];
                echo "<a href = items.php?do=Edit&itemid=".$item['itemid']."'>";
                    echo "<span class='btn btn-success float-right'>";
                      echo "<i class='fa fa-edit'></i>Edit";
                        if($item['approve'] == 0){
                         echo "<a href = 'items.php?do=Approve&itemid=".$item['itemid']."'class='btn btn-info float-right activate '><i class='fa fa-check'></i>
                     Approve</a>";}
               echo "</span>";
             echo "</a>";
           echo "</li>";
                }
            }
            else {
                echo "Ther's No Items To Show";
            }


                ?> 
                </ul>

                </div>
            </div>
        </div> 
    </div>
    <br>
        <!-- End row -->

  <!-- Start Latest Comments -->
  <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class=" panel-heading">
                    <i class="fa fa-comments"></i>
                   Latest <?php echo $numcomment ;?> comments
                    <span class="toggle-info float-right">
                        <i class="fa fa-plus fa-lg"></i>
                    </span>
                </div>
                <div class=" panel-body">
                    <?php
// Select All Users Except Admin
$stmt = $connect->prepare("SELECT commentss.*,userss.username as User_Name FROM commentss  INNER JOIN userss ON userss.userid = commentss.user_id 
ORDER BY cid DESC
LIMIT $numcomment");
//Execute Statement
$stmt->execute();
//Assign To Variable
$comments = $stmt->fetchAll();

if(!empty($comments)) {
foreach($comments as $comment) {
    echo "<div class='comment-box'>";
    echo '<span class="member-n">
    <a href="memmbers.php?do=Edit&userid='.$comment['user_id'].'">
    '.$comment['User_Name'].'</a></span>';
    echo '<p class="member-c">'.$comment['comment'].'</p>';
    echo "</div>";
}
}else {
    echo "Ther's No Comments To Show";
}
                    ?>
                </div>
            </div>
        </div>
</div>
<!-- End Latest Comments -->

    </div>
</div>


<?php
    
/**
 * 
 * End Dahborad page
 */
include $tpl."footer.php";

}else 

{
    // echo "You Are Not Authorized To View This Page";
    header('location:index.php');
    exit();
}
ob_end_flush();
?>