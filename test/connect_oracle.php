<?php
$conn= oci_connect('scott', 'tiger','127.0.0.1/music');
if($conn) {
  echo"连接oracle成功！";
  exit;
}else{
  echo"连接oracle失败！";exit;
}
?>