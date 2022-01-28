<?php
/*
==================================================
== Mange Comments Page
== You Can  Edit | Delete | Approve Comments From Here
==================================================
*/
ob_start();
session_start();

$pageTitle = "Comments";
if(isset($_SESSION['username'])) { // Start Session
    
    include 'init.php';
$do = isset($_GET['do']) ? $_GET['do'] : 'Mange';
    //Start Mange Page
    if($do == 'Mange') { 

        // Select All Users Except Admin
        $stmt = $connect->prepare("SELECT commentss.*,itemss.name as Item_Name,userss.username as User_Nmae FROM commentss INNER JOIN itemss ON itemss.itemid = commentss.item_id INNER JOIN userss ON userss.userid = commentss.user_id
        ORDER BY cid DESC
        ");
        //Execute Statement
        $stmt->execute();
        //Assign To Variable
        $comments = $stmt->fetchAll();

        if(!empty($comments)){

        
        ?>
    <!-- //Start Mange -->
        <!-- //Mange Page -->
        <h1 class="text-center">Manage Comments</h1>
<div class="container">

<div class="table-responsive">
    <table class=" main-table text-center table  table-bordered">
        <tr>
            <td>#ID</td>
            <td>Comment</td>
            <td>Item Name</td>
            <td>User Name</td>
            <td>Added Date</td>
            <td>Control</td>
        </tr>
        <?php 
        foreach($comments as $comment) {
echo "<tr>";
echo "<td>".$comment['cid']."</td>";
echo "<td>".$comment['comment']."</td>";
echo "<td>".$comment['Item_Name']."</td>";
echo "<td>".$comment['User_Nmae']."</td>";
echo "<td>".$comment['commentdate']."</td>";
echo "<td>
<a href = 'comments.php?do=Edit&comid=".$comment['cid']. "'class='btn btn-success'>
<i class='fa fa-edit'></i>
Edit</a>
<a href = 'comments.php?do=Delete&comid=".$comment['cid']."'class='btn btn-danger confrim'><i class='fa fa-close'></i>
Delete </a>";
if($comment['status'] == 0)
 {
     ?>
<a href="comments.php?do=Approve&comid=<?php echo $comment['cid']?>" class="btn btn-info activate"><i class="fa fa-check"></i>Approve</a>
<?php
}
echo "</td>";
echo "</tr>";
        }
        ?>
    </table>
</div>

</div>

<?php } else {
    echo "<div class='container'>";
echo "<div class='nice-message'>Ther's No Comments To Show</div>";
    echo "</div>";
}
     ?>

     <?php
    }//End Mange




    elseif($do == 'Edit')  
     { //Start Edit Page
        //Check Id Get Request comid Is Numeric & Get The Integer Value Of It
$comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?
 intval($_GET['comid']) :0;
 // Select Al  Data Depend On This ID
 $stmt = $connect->prepare("SELECT * FROM comments WHERE cid = ?");
 //Execute Query
 $stmt->execute(array($comid));
// Fetch The Data
 $row = $stmt->fetch();
//  The Row Count
 $count = $stmt->rowCount();
 // If There's Sucg id show the form 
 if($count > 0) {
        ?>

<h1 class="text-center">Edit Comment</h1>

<div class="container">
    <form action="?do=update" method="POST" class="form-horizontal">
        <input type="hidden" name="comid" value="<?php echo $comid ?>">
        <!-- Start Comment Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Comment</label>
            <div class="col-sm-10 ">
                <textarea class="form-control" name="comment" required="required" 
                >

                <?php
                echo $row['comment'];
                ?>
                </textarea>
            </div>
        </div>
        <!-- End Comment Field -->
        
       
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

   echo '<h1 class="text-center">Update Comment</h1>';

   echo "<div class=\"container\">";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

// Get Variables Form The Form

$comid     = $_POST['comid'];
$comment   = $_POST['comment'];

// If There's No Error Proced The Update Operation

    // Update The DataBase With This Info
    $stmt = $connect->prepare("UPDATE comments SET comment=? WHERE cid =?");

    $stmt ->execute(array($comment,$comid));

    //echo Success Message
    $theMsg ="<div class='alert alert-success'>". $stmt->rowCount(). "Record Update</div>";
    redirectHome($theMsg,'back',4);
}
    else {
        $themsg = "<div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div>";
        redirectHome($theMsg);
    }
echo "</div>";
    }// End Update Page
    






elseif($do = 'Delete') { // Start Delete Page

// Delete member  Page

echo '<h1 class="text-center">Delete Comment</h1>';

echo "<div class=\"container\">";

$comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?
 intval($_GET['comid']) :0;
 // Select Al  Data Depend On This ID
 $check = checkItem('cid','comments',$comid);
 // If There's Such id show the form 
 if($check>0) {
    $stmt = $connect->prepare("DELETE FROM comments WHERE cid =:zcid");
    $stmt->bindParam(":zcid",$comid);
    $stmt->execute();
    $theMsg = "<div class='alert alert-success'>".$stmt->rowCount().'Record Deleted</div>';
        redirectHome($theMsg);
 }
 else {
     $theMsg= "<div class=
     'alert alert-danger'>This Id Is Not Exist</div>";
     redirectHome($theMsg);
 }

echo "</div>";

} // End Delete Page

elseif($do=='Approve')  { 
   // Start Activate
   echo '<h1 class="text-center">Approve Comment</h1>';
    
   echo "<div class=\"container\">";
   
$comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ?
intval($_GET['comid']) : 0;
// Select Al  Data Depend On This ID
$check = checkItem('cid','comments',$comid);
// If There's Such id show the form 
if($check>0) { 
$stmt = $connect->prepare("UPDATE comments SET status =1 WHERE cid = ?");
$stmt->execute(array($comid));
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