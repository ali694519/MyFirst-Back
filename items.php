<?php

/*
==================================================
==  Items Page
==================================================
*/

ob_start();  // Output Buffering Start

session_start();

$pageTitle = "Items";

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

    if($do == 'Mange') 
    {

        // Select All Users Except Admin
        $stmt = $connect->prepare("SELECT itemss.*,categoriess.name as Category_Name,userss.username as User_Name FROM itemss INNER JOIN categoriess ON categoriess.id = itemss.cat_id INNER JOIN userss ON userss.userid = itemss.member_id
        ORDER BY itemid DESC
        ");
        //Execute Statement
        $stmt->execute();
        //Assign To Variable
        $items = $stmt->fetchAll();

        if(!empty($items)){
                    
        ?>

    <!-- //Start Mange -->
        <!-- //Mange Page -->
        <h1 class="text-center">Manage Items</h1>
<div class="container">

<div class="table-responsive">
    <table class=" main-table text-center table  table-bordered">
        <tr>
            <td>#ID</td>
            <td>Nmae</td>
            <td>Description</td>
            <td>Price</td>
            <td>Adding Date</td>
            <td>Category</td>
            <td>usernam</td>
            <td>Control</td>
        </tr>
        <?php 
        foreach($items as $item) {
echo "<tr>";
echo "<td>".$item['itemid']."</td>";
echo "<td>".$item['name']."</td>";
echo "<td>".$item['description']."</td>";
echo "<td>".$item['price']."</td>";
echo "<td>".$item['adddate']."</td>";
echo "<td>".$item['Category_Name']."</td>";
echo "<td>".$item['User_Name']."</td>";
echo "<td>
<a href = 'items.php?do=Edit&itemid=".$item['itemid']. "'class='btn btn-success'>
<i class='fa fa-edit'></i>
Edit</a>
<a href = 'items.php?do=Delete&itemid=".$item['itemid']."'class='btn btn-danger confrim'><i class='fa fa-close'></i>
Delete </a>";
if($item['approve'] == 0)
 {
     ?>
<a href="items.php?do=Approve&itemid=<?php echo $item['itemid']?>" class="btn btn-info activate"><i class="fa fa-check"></i>Approve</a>
<?php
}
echo "</td>";
echo "</tr>";
        }
        ?>
    </table>
</div>
<a href='items.php?do=Add' class="btn btn-primary">
    <i class="fa fa-plus"></i>New Item</a>
</div>
    
<?php } else {
    echo "<div class='container'>";
echo "<div class='nice-message'>Ther's No Items To Show</div>";
echo '
<a href=\'items.php?do=Add\' class="btn btn-primary">
    <i class="fa fa-plus"></i>New Item</a>';
    echo "</div>";
}
     ?>

     <?php
     
     //End Mange

}
    elseif($do == 'Add') {

        ?>
        <!-- Code Html Here -->

        <h1 class="text-center">Add  New Item</h1>
<div class="container">
    <form action="?do=Insert" method="POST" class="form-horizontal">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Name</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="name" placeholder="Name Of The Item">
            </div>
        </div>
        <!-- End Name Field -->

        <!-- Start Description Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Description</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="description" placeholder="Description Of The Item">
                    </div>
                </div>
                <!-- End Description Field -->

                <!-- Start Price Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Price</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="price" placeholder="Price Of The Item">
                    </div>
                </div>
                <!-- End Price Field -->


                <!-- Start Country Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Country</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="country" placeholder="Country Of Made">
                    </div>
                </div>
                <!-- End Country Field -->
                

                <!-- Start Status Field -->
                <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Status</label>
                    <div class="col-sm-10 ">
                        <select name="status" id="">
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Very Old</option>
                        </select>
                    </div>
                </div>
                <!-- End Status Field -->


                 <!-- Start Members Field -->
                 <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Members</label>
                    <div class="col-sm-10 ">
                        <select name="member" id="">
                            <option value="0">...</option>
                            <?php
    $allmembers = getAll("*","userss","","","userid","");

                          foreach($allmembers as $user) {
      echo "<option value ='".$user['userid']."'>".$user['username']."</option>";
                          }
                          ?>
                        </select>
                    </div>
                </div>
                <!-- End Members Field -->


                <!-- Start Categories Field -->
                <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Categories</label>
                    <div class="col-sm-10 ">
                        <select name="category" id="">
                            <option value="0">...</option>
                            <?php
    $allCat = getAll("*","categoriess","where parent = 0","","id","");

                          foreach($allCat as $cat) {
      echo "<option value ='".$cat['id']."'>".$cat['name']."</option>";
$childCats = getAll("*","categoriess","where parent = {$cat['id']}","","id","");
foreach($childCats as $child) {
        echo "<option value='".$child['id']."'>---".$child['name']."</option>";
}

                          }
                          ?>
                        </select>
                    </div>
                </div>
                <!-- End Categories Field -->

<!-- Start Tags Field -->
<div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Tags</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control"  name="tags" placeholder="Separte Tags With Comma (,)">
                    </div>
                </div>
                <!-- End Tags Field -->



        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-sm" value="Add Item">
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>

<?php

    }
    elseif($do == 'Insert') {
      // Insert Items Page

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center">Insert Item</h1>';
            echo "<div class=\"container\">";

        // Get Variables Form The Form
        $name      =$_POST['name']; 
        $desc      =$_POST['description'];
        $price     =$_POST['price'];
        $country   =$_POST['country'];
        $status    =$_POST['status'];
        $member    =$_POST['member'];
        $cate      =$_POST['category'];
        $tags      =$_POST['tags'];

        // Validate The Form
        $formError = array();
        
        if(empty($name)) {
            $formError[]  =" Name Can't be<strong>Empty</strong>";
        }
        if(empty($desc)) {
            $formError[]  ="Description Can't be<strong>Empty</strong>";
        }
        if(empty($price)) {
            $formError[] = "Price Can't be<strong>Empty</strong>";
        }
        if(empty($country)) {
            $formError[] = "Country Can't be<strong>Empty</strong>";
        }
        if($status == 0) {
            $formError[] = "Yoy Must Be The<strong>Status</strong>";
        }
        if($member == 0) {
            $formError[] = "Yoy Must Be The<strong>Mmbers</strong>";
        }
        if($cate == 0) {
            $formError[] = "Yoy Must Be The<strong>Category</strong>";
        }
        // Loop Into Errors Array And Echo It
        foreach($formError as $error) {
        echo "<div class='alert alert-danger'>".$error."</div>";
        }
        
        // If There's No Error Proced The Update Operation
        if(empty($formError)) {
            // Insert User Info In DastaBase
        $stmt = $connect->prepare("INSERT INTO itemss(name,description,price,countrymade,status,adddate, cat_id, member_id,tags)
values(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember,:ztags)");

            $stmt->execute(array(
            "zname"     =>$name ,
            "zdesc"     =>$desc ,
            "zprice"    =>$price,
            "zcountry"  =>$country,
            "zstatus"   =>$status,
            "zcat"      =>$cate,
            "zmember"   =>$member,
            "ztags"     =>$tags,
            ));
            //echo Success Message
            $theMsg ="<div class='alert alert-success'>". $stmt->rowCount(). "Record Inserted</div>";
            redirectHome($theMsg,'back');
            }
        } // End Insert
            else {
                $theMsg =  " <div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div> ";
                redirectHome($theMsg);
            }
        echo "</div>";
        }// End Insert Member Page
    elseif($do == 'Edit') {
//Start Edit Page
        //Check Id Get Request itemid Is Numeric & Get The Integer Value Of It
        $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
        intval($_GET['itemid']) :0;
        // Select Al  Data Depend On This ID
        $stmt = $connect->prepare("SELECT * FROM itemss WHERE itemid = ?");
        //Execute Query
        $stmt->execute(array($itemid));

       // Fetch The Data
        $item = $stmt->fetch();

       //  The Row Count
        $count = $stmt->rowCount();

        // If There's Sucg id show the form 
        if($count > 0) {
               ?>

<!-- Code Html Here -->

<h1 class="text-center">Edit Item</h1>
<div class="container">
    <form action="?do=Update" method="POST" class="form-horizontal">
    <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Name</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="name" placeholder="Name Of The Item"
                value="<?php echo $item['name']?>">
            </div>
        </div>
        <!-- End Name Field -->

        <!-- Start Description Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Description</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="description" placeholder="Description Of The Item"
                        value="<?php echo $item['description']?>">
                    </div>
                </div>
                <!-- End Description Field -->

                <!-- Start Price Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Price</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="price" placeholder="Price Of The Item"
                        value="<?php echo $item['price']?>">
                    </div>
                </div>
                <!-- End Price Field -->


                <!-- Start Country Field -->
        <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Country</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control" required="required"  name="country" placeholder="Country Of Made"
                        value="<?php echo $item['countrymade']?>">
                    </div>
                </div>
                <!-- End Country Field -->
                

                <!-- Start Status Field -->
                <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Status</label>
                    <div class="col-sm-10 ">
                        <select name="status" id="">
                            <option value="1" <?php if($item['status']==1){ echo'selected'; }  ?>>New</option>
                            <option value="2"<?php if($item['status']==2){ echo'selected'; }  ?>>Like New</option>
                            <option value="3"<?php if($item['status']==3){ echo'selected'; }  ?>>Used</option>
                            <option value="4"<?php if($item['status']==4){ echo'selected'; }  ?>>Very Old</option>
                        </select>
                    </div>
                </div>
                <!-- End Status Field -->


                 <!-- Start Members Field -->
                 <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Members</label>
                    <div class="col-sm-10 ">
                        <select name="member" id="">
                            <?php
                          $stmt = $connect->prepare("SELECT * FROM userss");
                          $stmt->execute();
                          $users = $stmt->fetchAll();
                          foreach($users as $user) {
      echo "<option value ='".$user['userid']."'";if($item['itemid']==4){ echo'selected'; }echo">".$user['username']."</option>";
                          }
                          ?>
                        </select>
                    </div>
                </div>
                <!-- End Members Field -->


                <!-- Start Categories Field -->
                <div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Categories</label>
                    <div class="col-sm-10 ">
                        <select name="category" id="">
                            <?php
                          $stmt2 = $connect->prepare("SELECT * FROM categoriess");
                          $stmt2->execute();
                          $cats = $stmt2->fetchAll();
                          foreach($cats as $cat) {
                            echo "<option value ='".$cat['id']."'";if($item['cat_id']==$cat['id']){ echo'selected'; }echo">".$cat['name']."</option>";
                          }
                          ?>
                        </select>
                    </div>
                </div>
                <!-- End Categories Field -->


<!-- Start Tags Field -->
<div class="form-group form-group-lg">
                    <label class="labell col-sm-2  control-label">Tags</label>
                    <div class="col-sm-10 ">
                        <input type="text" class="form-control"  name="tags" placeholder="Separte Tags With Comma (,)"
                        value="<?php echo $item['tags'];?>">
                    </div>
                </div>
                <!-- End Tags Field -->



        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-sm" value="Save Item">
            </div>
        </div>
        <!-- End Submit Field -->
    </form>

    <?php
    // Select All Users Except Admin
        $stmt = $connect->prepare("SELECT commentss.*,userss.username as User_Nmae FROM commentss  INNER JOIN userss ON userss.userid = commentss.user_id
        WHERE item_id = ?;
        ");
        //Execute Statement
        $stmt->execute(array($itemid));
        //Assign To Variable
        $rows = $stmt->fetchAll();

        if(!empty($rows)) {
        ?>
    <!-- //Start Mange -->
        <!-- //Mange Page -->
        <h1 class="text-center">Mange [<?php echo $item['name'];?>] Comments</h1>

<div class="table-responsive">
    <table class=" main-table text-center table  table-bordered">
        <tr>
            <td>Comment</td>
            <td>User Name</td>
            <td>Added Date</td>
            <td>Control</td>
        </tr>
        <?php 
        foreach($rows as $row) {
echo "<tr>";
echo "<td>".$row['comment']."</td>";
echo "<td>".$row['User_Nmae']."</td>";
echo "<td>".$row['commentdate']."</td>";
echo "<td>
<a href = 'comments.php?do=Edit&comid=".$row['cid']. "'class='btn btn-success'>
<i class='fa fa-edit'></i>
Edit</a>
<a href = 'comments.php?do=Delete&comid=".$row['cid']."'class='btn btn-danger confrim'><i class='fa fa-close'></i>
Delete </a>";
if($row['status'] == 0)
 {
     ?>
<a href="comments.php?do=Approve&comid=<?php echo $row['cid']?>" class="btn btn-info activate"><i class="fa fa-check"></i>Approve</a>
<?php
}
echo "</td>";
echo "</tr>";
        }
        ?>
    </table>
</div>
<?php } ?>
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



    elseif($do == 'Update') {

// Update Page

echo '<h1 class="text-center">Update Item</h1>';

echo "<div class=\"container\">";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

// Get Variables Form The Form

$id        = $_POST['itemid'];
$name      = $_POST['name'];
$desc      = $_POST['description'];
$price     = $_POST['price'];
$country   = $_POST['country'];
$status    = $_POST['status'];
$cate       = $_POST['category'];
$member    = $_POST['member'];
$tags      = $_POST['tags'];


// Validate The Form
$formError = array();
        
if(empty($name)) {
    $formError[]  =" Name Can't be<strong>Empty</strong>";
}
if(empty($desc)) {
    $formError[]  ="Description Can't be<strong>Empty</strong>";
}
if(empty($price)) {
    $formError[] = "Price Can't be<strong>Empty</strong>";
}
if(empty($country)) {
    $formError[] = "Country Can't be<strong>Empty</strong>";
}
if($status == 0) {
    $formError[] = "Yoy Must Be The<strong>Status</strong>";
}
if($member == 0) {
    $formError[] = "Yoy Must Be The<strong>Mmbers</strong>";
}
if($cate == 0) {
    $formError[] = "Yoy Must Be The<strong>Category</strong>";
}
// Loop Into Errors Array And Echo It
foreach($formError as $error) {
echo "<div class='alert alert-danger'>".$error."</div>";
}

// If There's No Error Proced The Update Operation
if(empty($formError)) {

 // Update The DataBase With This Info
 $stmt = $connect->prepare("UPDATE itemss SET name=?,description=?,price=?,countrymade=?,status=?,cat_id=?, member_id=?,tags = ?  WHERE itemid=?");

 $stmt ->execute(array($name,$desc,$price,$country,$status,$cate,$member,$tags,$id));

 //echo Success Message
 $theMsg ="<div class='alert alert-success'>". $stmt->rowCount(). "Record Update</div>";
 redirectHome($theMsg,'back',4);
 }
}
 else {
     $themsg = "<div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div>";
     redirectHome($theMsg);
 }
echo "</div>";


    }
    elseif($do == 'Delete') {// Start Delete Page
// Delete member  Page
echo '<h1 class="text-center">Delete Items</h1>';
echo "<div class=\"container\">";
// Check If Get Request Item Id Is Numeric And Get Integer Value Of It
$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
 intval($_GET['itemid']) :0;
 // Select Al  Data Depend On This ID
 $check = checkItem('itemid','itemss',$itemid);
 // If There's Such id show the form 
 if($check>0) {
    $stmt = $connect->prepare("DELETE FROM itemss WHERE itemid =:zitem");
    $stmt->bindParam(":zitem",$itemid);
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
    elseif($do == 'Approve') 
    { // Start Activate
        echo '<h1 class="text-center">Approve Item</h1>';
    
        echo "<div class=\"container\">";
        
$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?
    intval($_GET['itemid']) : 0;
    // Select Al  Data Depend On This ID
    $check = checkItem('itemid','itemss',$itemid);
    // If There's Such id show the form 
    if($check>0) { 
$stmt = $connect->prepare("UPDATE itemss SET approve =1 WHERE itemid = ?");
$stmt->execute(array($itemid));
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

    include $tpl. 'footer.php';
} // End If
else { // If $_SESSION error
    header('Location: index.php');
    exit();
}


ob_end_flush(); // Relase The Output

?>
