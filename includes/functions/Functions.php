<?php 





function getAll($field,$table,$where = NULL,$and = NULL,$orderfield,$ordering='DESC') {
  global $connect;
  $getAll = $connect->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");
  $getAll->execute();
  $all = $getAll->fetchAll();
  return $all;
}








// echo "Function Is Here";

/***
 * GetTitle Function v1.0
 * Title Function That Echo The Page Title In Case Page
 * Has The Variable $page And Echo Defult Title For Other Pages
 */

 function getTitle() {

    global $pageTitle;

    if(isset($pageTitle)) {
        echo $pageTitle;
    }else {
        echo "Default";
    }
 }

 /* Home Redirect Function v2.0
  *  [This Function Accept Parameters]
  * $theMsg = Ecvho The  Message[Error | Success | Warning]
  $url = The Link You Want To Redirect To 
  * $second = Seconds Befor Redirecting
  */

  function redirectHome($theMsg, $url = null, $seconds = 3)
    {
      if($url === null) 
      {
        $url = 'index.php';
        $link = "Homepage";
      } 
      else 
      {
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ) {
          $url = $_SERVER['HTTP_REFERER'];
          $link = "Previous page";
        }
        else{
        $url = 'index.php';
        $link = "Previous";
      }
    }
      echo $theMsg;
echo "<div class='alert alert-info'> You Will Be Redirected to $link After $seconds Seconds.</div>";
 header("refresh:$seconds;url=$url");
    exit();
    
  }

  /**
   * CheckItems Function v1.0
   * Function To Check Item In Database [Function Accept Parameters]
   * $select = the Item Select [Example: user,item,category]
   * $from = the Table To Select From[ Example : users, items, categories]
   * $value = The Value Of Select [ Example : ali, box, Electronics ]
   */

   function checkItem($select, $from, $value) {
     global $connect;
     $statement = $connect->prepare("SELECT $select FROM $from WHERE $select = ?" );
     $statement->execute(array($value));
     $count = $statement->rowCount();
     return $count;
   }

   /**
    * Count Number Of Items Function v1.0
    *Function To Count Of Items Rows
    *$item = The Item To Count
    *$table = The Table To Choose From
    */

    function countItems($item,$table) {
    global $connect;
    $stmt = $connect->prepare("SELECT COUNT($item) FROM $table");
    $stmt->execute();
   return $stmt->fetchColumn();
    }

    /**
     * Get Latest Records Function v1.0
     * Function To Get Items From Database [Users,Item,Comments]
     * $select = Field To Select
     * $table = The Table To Chosse From
     * $limit = Number Of Records To Gets
     */

     function getLatest($select,$table,$order,$limit = 5) {
       global $connect;
       $getstmt = $connect->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
       $getstmt->execute();
       $rows =  $getstmt->fetchAll();
       return $rows;
     }



?>