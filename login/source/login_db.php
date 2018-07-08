  <?php 
  session_start();
  include "../../common_lib/common.php";
    
  $sql="select * from membership_withdrawal where id='$id' ";
  $result=mysqli_query($con, $sql);
  $row=mysqli_fetch_array($result);
  $id2=$row['id'];
  if($id==$id2){
     echo"<script> 
      alert('회원탈퇴 승인용청중입니다. 로그인 할 수 없습니다.');
      window.close();
     </script>";
     exit();
  }  
    
  $sql = "select * from membership where id='$id'";
  $result = mysqli_query($con,$sql) or die("실패원인1:".mysqli_error($con));
  $num = mysqli_num_rows($result); 
  if(!$num){
    echo "<script>
      alert('등록되지 않은 회원입니다.');
      history.go(-1);
    </script>";
    exit();
  }else{
    $row = mysqli_fetch_array($result);
    
    if($pw!==$row['pass']){
      echo "<script>
        alert('비밀번호가 틀립니다.');
        history.go(-1);
      </script>";
      exit();
    }else{
      //세션등록함.
      $_SESSION['name'] = $row['name'];
      $_SESSION['id'] = $row['id'];
      
      $id = $row['id'];
      
      //쿠키등록함.  isset($save_id)는 무슨의미인가?
      //setcookie("cookie_id","",time()-3600,"/"); 무슨의미인가?
      if(isset($save_id)){
        setcookie('cookie_id', $id, time()+(86400*30),"/");
      }else{
        setcookie("cookie_id","",time()-3600,"/");
      }
      
      $sql = "update membership set login='yes' where id='$id'";
      mysqli_query($con, $sql) or die("실패원인 : ".mysqli_error($con));
      echo "<script>
        opener.location.href='../../index.php';
        window.close();
      </script>";
    }
  }
?>