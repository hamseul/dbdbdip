<?php
  include_once("db_config.php");

$id = $_GET['name'];
$move = $_GET['p'];

if($move == 1)//아래 이동
{
  $count = "SELECT count(position) FROM product";
  $countResult = $mysqli->query($count);
  $temp = mysqli_fetch_array($countResult);
  $totalsCount = $temp[0];

  if($id != $totalsCount)
  {
    $id2= $id+1;
    $tmp = 0;

    $name1 = "SELECT product_id FROM product where position = '$id'";
    $name1Result = $mysqli->query($name1);
    $name11  = mysqli_fetch_array($name1Result);
//    echo "$name11[0]";

    $name2 = "SELECT product_id  FROM product where position = '$id2'";
    $name2Result = $mysqli->query($name2);
    $name22  = mysqli_fetch_array($name2Result);
//    echo"$name22[0]";

    $query1 = "UPDATE product set product_id =  '$name22[0]' where position = '$id'";
    $query2 = "UPDATE product set product_id =  '$name11[0]' where position = '$id2'";
    $result = $mysqli->query($query1);
    $result = $mysqli->query($query2);

    // $query1 = "UPDATE product set position =  '$tmp' where position = '$id2'";
    // $query2 = "UPDATE product set position =  '$id2' where position = '$id'";
    // $query3 = "UPDATE product set position =  '$id' where position = '$tmp'";
    // $result = $mysqli->query($query1);
    // $result = $mysqli->query($query2);
    // $result = $mysqli->query($query3);
  }
}
else {
    if($id !=1){
      $id2= $id-1;
      $tmp = 0;

      $name1 = "SELECT product_id FROM product where position = '$id'";
      $name1Result = $mysqli->query($name1);
      $name11  = mysqli_fetch_array($name1Result);
  //    echo "$name11[0]";

      $name2 = "SELECT product_id  FROM product where position = '$id2'";
      $name2Result = $mysqli->query($name2);
      $name22  = mysqli_fetch_array($name2Result);
  //    echo"$name22[0]";

      $query1 = "UPDATE product set product_id =  '$name22[0]' where position = '$id'";
      $query2 = "UPDATE product set product_id =  '$name11[0]' where position = '$id2'";
      $result = $mysqli->query($query1);
      $result = $mysqli->query($query2);
      // $query1 = "UPDATE product set position =  '0' where position = '$id-1'";
      // $query2 = "UPDATE product set position =  '$id-1' where position = '$id'";
      // $query3 = "UPDATE product set position =  '$id' where position = '0'";
      // $result1 = $mysqli->query($query1);
      // $result2 = $mysqli->query($query2);
      // $result3 = $mysqli->query($query3);
    }
}
echo "<script> opener.location.reload();</script>";
echo "<script>location.replace('editProduct.php')</script>";

?>
