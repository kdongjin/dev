<?php  
  session_start();
  include  "../../common_lib/common.php";
  
  $id = $_SESSION['id'];
  $sql = "update membership set login='no' where id='$id'";
  mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
  
  //세션값 해제함.
  unset($_SESSION['id']);
  unset($_SESSION['name']);
  
  echo "<script>
    alert('로그아웃되었습니다.');
    location.href='../../index.php';
  </script>";
?>