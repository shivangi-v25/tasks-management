<?php 
include 'db.php';
session_start();

if (isset($_GET["id"])) {
  $id=$_GET["id"];
$result=$conn->prepare("delete from  task where id=?");
$result->bind_param("i",$id);
$result->execute();
header("location:index.php");

}

?>