<?php


/*
==================================================
== Category Page 
==================================================
*/

ob_start();  // Output Buffering Start

session_start();

$pageTitle = "Categories";

if(isset($_SESSION['username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Mange';

    if($do == 'Mange') 
    {

     $sort = 'DESC';

     $sort_array = array('ASC','DESC');
     if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {

        $sort = $_GET['sort'];

     }
     $stmt2 = $connect->prepare("SELECT * FROM categoriess where parent = 0 ORDER BY ordering $sort");
     $stmt2->execute();
     $cats = $stmt2->fetchAll();

     if(!empty($cats)) {
     
     ?>

 <!-- Code Html -->

 <h1 class="text-center">Mange Categories</h1>
    <div class="container categories">
      <div class="panel panel-default">
        <div class=" panel-heading">
           <i class="fa fa-edit"></i>
              Mange Categories
              <div class="option float-right">
          <i class="fa fa-sort"></i>  Ordering: [
<a class='<?php if($sort == "ASC"){ echo 'active';} ?>'href="?sort=ASC">ASC</a> | 
<a class='<?php if($sort == "DESC"){ echo 'active';} ?>'href="?sort=DESC">DESC</a>]
<i class="fa fa-eye"></i>   View: [
         <span class="active" data-view='full'>Full</span> |
         <span data-view='classic'>Classic</span> ]
     </div>
</div>
        <div class="bas panel-body">
           <?php
            foreach($cats as $cat) {
                    echo "<div class='cat'>";
                    ?>
             <div class="hidden-buttons">
 <a href="categories.php?do=Edit&catid=<?php echo $cat['id']?>" class="btn  btn-primary">
     <i class='fa fa-edit'></i>Edit</a>
 <a href="categories.php?do=Delete&catid=<?php echo $cat['id']?>" class=" confrim btn  btn-danger">
 <i class='fa fa-close'>
 </i>Delete</a>
             </div>
                    <?php
                        echo "<h3>".$cat['name'].'</h3>';
                        echo "<div class='full-view'>";
                            echo "<p>";if($cat['description'] == '') {echo 'This Category Has No Description ';}else{
                                echo $cat['description'];
                            } echo'</p>';
                            if($cat['visibility'] == 1) {
                                echo "<span class='visibility'><i class='fa fa-eye'></i>Hidden</span>";
                            }
                            if($cat['allow_comment'] == 1) {
                                echo "<span class='commenting'>
                                <i class='fa fa-close'></i>comment Disabled</span>";
                            }
                            if($cat['allow_ads'] == 1) {
                                echo "<span class='advertises'>
                                <i class='fa fa-close'></i>Ads Disabled</span>";
                            }
                        echo "</div>";


    // GET Chiled Ctaegory
    $ChilCats=getAll("*","categoriess","where parent = {$cat['id']}","","id",'DESC');
    if(!empty($ChilCats)) {
    echo "<h4 class='chikd-head'>Child Categories</h4>";
    echo "<ul class='list-unstyled child-cats'> ";
                        foreach($ChilCats as $cat) {
    echo "<li class='child-link'>
    <a href='categories.php?do=Edit&catid=". $cat['id']."''>".$cat['name']."</a>
<a href='categories.php?do=Delete&catid=".$cat['id']."'class='show-delete confrim'>Delete</a> 
    
    </li>";
                    } 
                    echo "</ul>";
                        }

                    echo "</div>";
                    echo "<hr>";
       
                }
                  ?>
                </div>
            </div>
            <br>
            <a href="categories.php?do=Add" class="add-category btn btn-primary"><i class="fa fa-plus"></i>Add New Category</a>
 </div>
 <?php } else {
    echo "<div class='container'>";
echo "<div class='nice-message'>Ther's No Category To Show</div>";
echo '<a href=\'categories.php?do=Add\' class="btn btn-primary">
    <i class="fa fa-plus"></i>New Item</a>';
    echo "</div>";
}
     ?>

     <?php
    }
    elseif($do == 'Add') {?>
        <!-- Code Html Here -->

        <h1 class="text-center">Add  New Category</h1>
<div class="container">
    <form action="?do=Insert" method="POST" class="form-horizontal">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Name</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="name" autocomplete="off" placeholder="Name Of The Category">

            </div>
        </div>
        <!-- End Name Field -->
        <!-- Start Description Field -->
        <div class="form-group form-group-lg ">
            <label  class="labell col-sm-2 control-label">Description</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" placeholder=" Describe The Category"name="description">
            </div>
        </div>
        <!-- End Description Field -->
        <!-- Start Ordering Field -->
        <div class="form-group">
            <label  class="labell col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10  ">
                <input type="text" class="form-control" placeholder="Number To Arranger The Categories" name="ordering">
            </div>
        </div>
        <!-- End Ordering Field -->
        <!-- Start Category Type-->


        <div class="form-group">
            <label  class="labell col-sm-2 control-label">Category Type</label>
            <div class="col-sm-10  ">
                <select name="parent" id="">
                    <option value="0">None</option>
                    <?php
$allCatas=getAll("*", "categoriess","where parent = 0","","id","ASC");
foreach($allCatas as $cat) {
    echo "<option value = '".$cat['id']."'>".$cat['name']."</option>";
}
?>
                </select>
            </div>
        </div>

        <!-- End Category Type-->
        <!-- Start Visiblity Field -->
        <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Visible</label>
            <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="visible-yes" type="radio" name="visiblity" value="0" checked>
                    <label for="visible-yes">Yes</label>
                </div>
                <div>
                    <input id="visible-No" type="radio" name="visiblity" value="1" >
                    <label for="visible-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Visiblity Field -->


          <!-- Start Commenting Field -->
          <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="com-yes" type="radio" name="commenting" value="0" checked>
                    <label for="com-yes">Yes</label>
                </div>
                <div>
                    <input id="com-No" type="radio" name="commenting" value="1" >
                    <label for="com-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Commenting Field -->



         <!-- Start Ads Field -->
         <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="ads-yes" type="radio" name="ads" value="0" checked>
                    <label for="ads-yes">Yes</label>
                </div>
                <div>
                    <input id="ads-No" type="radio" name="ads" value="1" >
                    <label for="ads-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Ads Field -->


        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-lg" value="Add Category">
            </div>
        </div>
        <!-- End Submit Field -->
    </form>
</div>

<?php
    }
    elseif($do == 'Insert') {


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<h1 class="text-center">Insert Caegory</h1>';
    echo "<div class=\"container\">";

 // Get Variables Form The Form

    $name      = $_POST['name']; 
    $desc      = $_POST['description'];
    $parent    = $_POST['parent'];
    $order     = $_POST['ordering'];
    $visible   = $_POST['visiblity'];
    $comment   = $_POST['commenting'];
    $ads       = $_POST['ads'];

     //Check If Category Exist In Dtabase
    
     $check =  checkItem("name","categoriess",$name);
     if($check == 1) {
         $theMsg  =  "<div class='alert alert-danger'>" ." Sorry This Category Is Exits</div>";
         redirectHome( $theMsg ,"back");
     }
     else 
     {
     // Insert Category Info In DastaBase
 $stmt = $connect->prepare("INSERT INTO
  categoriess(name, description,parent, ordering, visibility, allow_comment, allow_ads)
 VALUES(:zname, :zdescription,:zparent, :zordering, :zvisiblity, :zcomment, :zads)");

 $stmt->execute(array(
        "zname"         =>  $name,
        "zdescription"  =>  $desc,
        "zparent"       =>  $parent,
        "zordering"     =>  $order,
        "zvisiblity"    =>  $visible,
        "zcomment"      =>  $comment,
        "zads"          =>  $ads
 ));

     //echo Success Message
     $theMsg = "<div class='alert alert-success'>". $stmt->rowCount(). "Record Inserted</div>";
     redirectHome($theMsg);
     }
 } // End Insert
     else {
         $theMsg =  " <div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div> ";
         redirectHome($theMsg);
     }
 echo "</div>";

    }
    elseif($do == 'Edit') 
        { //Start Edit Page
    //Check Id Get Request catid Is Numeric & Get The Integer Value Of It
    $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ?
     intval($_GET['catid']) :0;
     // Select Al  Data Depend On This ID
     $stmt = $connect->prepare("SELECT * FROM categoriess WHERE id = ?");

     //Execute Query
     $stmt->execute(array($catid));

    // Fetch The Data
     $cat = $stmt->fetch();

    //  The Row Count
     $count = $stmt->rowCount();

     // If There's Sucg id show the form 
     if($count > 0) {
            ?>
            <!-- Code Html -->
            <h1 class="text-center">Edit Category</h1>
<div class="container">
    <form action="?do=Update" method="POST" class="form-horizontal">
    <input type="hidden" name="catid" value="<?php echo $catid ?>">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
            <label class="labell col-sm-2  control-label">Name</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" required="required"  name="name" placeholder="Name Of The Category"
                 value="<?php echo $cat['name'] ?>">
            </div>
        </div>
        <!-- End Name Field -->
        <!-- Start Description Field -->
        <div class="form-group form-group-lg ">
            <label  class="labell col-sm-2 control-label">Description</label>
            <div class="col-sm-10 ">
                <input type="text" class="form-control" placeholder=" Describe The Category"  name="description"
                value="<?php echo $cat['description'] ?>" 
                 >
            </div>
        </div>
        <!-- End Description Field -->
        <!-- Start Ordering Field -->
        <div class="form-group">
            <label  class="labell col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10  ">
                <input type="text" class="form-control" placeholder="Number To Arranger The Categories" name="ordering" 
                value="<?php echo $cat['ordering'] ?>" >
            </div>
        </div>
        <!-- End Ordering Field -->


<!-- Start Category Type-->


<div class="form-group">
            <label  class="labell col-sm-2 control-label">Category Type</label>
            <div class="col-sm-10  ">
                <select name="parent" id="">
                    <option value="0">None</option>
                    <?php
$allCatas=getAll("*", "categoriess","where parent = 0","","id","ASC");
foreach($allCatas as $c) {
    echo "<option value = '".$c['id']."'";
    if($cat['parent'] == $c['id'])
    {
        echo 'selected';
    }
    echo ">".$c['name']."</option>";
}
?>
                </select>
            </div>
        </div>

        <!-- End Category Type-->




        <!-- Start Visiblity Field -->
        <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Visible</label>
              <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="visible-yes" type="radio" name="visiblity"
                     value="0"<?php if ($cat['visibility'] == 0) {
                        echo 'checked';}?>
                        >
                    <label for="visible-yes">Yes</label>
                </div>
                <div>
                    <input id="visible-No" type="radio" name="visiblity"
                     value="1"<?php if ($cat['visibility'] == 1) {
                        echo 'checked';}?> >
                    <label for="visible-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Visiblity Field -->

          <!-- Start Commenting Field -->
          <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="com-yes" type="radio" name="commenting" 
                    value="0"
                    <?php if ($cat['allow_comment'] == 0) {
                        echo 'checked';}?> >
                    <label for="com-yes">Yes</label>
                </div>
                <div>
                    <input id="com-No" type="radio" name="commenting"
                     value="1" 
                    <?php if ($cat['allow_comment'] == 1) {
                        echo 'checked';}?>>
                    <label for="com-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Commenting Field -->
         <!-- Start Ads Field -->
         <div class="form-group form-group-lg">
            <label  class="labell col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-6  ">
                <div>
                    <input id="ads-yes" type="radio" name="ads" value="0"
                    <?php if ($cat['allow_ads'] == 0) {
                        echo 'checked';}?> >
                    <label for="ads-yes">Yes</label>
                </div>
                <div>
                    <input id="ads-No" type="radio" name="ads" value="1" 
                    <?php if ($cat['allow_ads'] == 1) {
                        echo 'checked';}?>>
                    <label for="ads-No">No</label>
                </div>
            </div>
        </div>
        <!-- End Ads Field -->


        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
            <div class=" col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-lg" value="Save Category">
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
       
    elseif($do == 'Update') {

        echo '<h1 class="text-center">Update Category</h1>';

        echo "<div class=\"container\">";
     
     if($_SERVER['REQUEST_METHOD'] == 'POST') {
     
     // Get Variables Form The Form

     $id        = $_POST['catid'];
     $name      = $_POST['name'];
     $desc      = $_POST['description'];
     $order     = $_POST['ordering'];
     $parent    = $_POST['parent'];
     $visible   = $_POST['visiblity'];
     $comment   = $_POST['commenting'];
     $ads       = $_POST['ads'];
     
         // Update The DataBase With This Info
         $stmt = $connect->prepare("UPDATE categoriess SET name=?,description=?,ordering=?,parent = ?,visibility=?,allow_comment=?,allow_ads=? WHERE id =?");
     
         $stmt ->execute(array($name,$desc,$order,$parent,$visible,$comment,$ads,$id));
     
         //echo Success Message
         $theMsg ="<div class='alert alert-success'>". $stmt->rowCount(). "Record Update</div>";
         redirectHome($theMsg,'back',4);
     }
         else {
               $themsg = "<div class='alert alert-danger'>Sory You Cant Browse This Page Directly</div>";
               redirectHome($theMsg);
         }
     echo "</div>";

    }
    elseif($do == 'Delete') {

// Start Delete Page

// Delete Category  Page

echo '<h1 class="text-center">Delete Category</h1>';

echo "<div class=\"container\">";
// Check If Get Request Catid Is Numeric & Get The Integer Of It 
$catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ?
 intval($_GET['catid']) :0;

// If There's Sucg id show the form 
$check = checkItem('id','categories',$catid);
// If There's Such id show the form 
if($check>0) {
   $stmt = $connect->prepare("DELETE FROM categoriess WHERE id =:zid");
   $stmt->bindParam(":zid",$catid);
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
  
    include $tpl. 'footer.php';
} // End If
else { // If $_SESSION error
    header('Location: index.php');
    exit();
}
ob_end_flush(); // Relase The Output

?>