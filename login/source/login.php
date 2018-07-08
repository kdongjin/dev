<?php
  if(isset($_POST['id'])){
    $id = $_POST['id'];
  }
  if(isset($_POST['pw'])){
    $pw = $_POST['pw'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>로그인</title>
    <link rel="stylesheet" href="../css/login.css">
    <script>
      function input_check(){
        if(!document.login_form.id.value){
          alert('아이디를 입력해주세요!');
          document.login_form.id.focus();
          return;
        }
        if(!document.login_form.pw.value){
          alert('비밀번호를 입력해주세요!');
          document.login_form.pw.focus();
          return;
        }
        document.login_form.submit();
      }

      /* 회원가입창으로 돌아가기 */
      function mem(){
        opener.location.href='../../membership/source/join_form.php';
        window.close();
      }
    
    </script>
  </head>
  <body>
    <table width="700">
      <tr height="20"></tr>
      <tr>
        <td width="200" ></td>
        <td id="main">
<form name="login_form" action="login_db.php" method="post">
          <table>
            <tr>
              <td colspan="5"><img src="../image/login_top.gif" width="800"></td>
            </tr>
            <tr height="8"></tr>
            <tr>
              <td border-top width="120" id="first"></td>
              <td><label for="id">아이디</label></td>
              <?php
                if(isset($_COOKIE['cookie_id'])){
                  echo "<td><input type='text' name='id' size='30' value=".$_COOKIE['cookie_id']."></td>";
                  //아이디 찾기에서 아이디를 찾아서 다시 올경우 
                }else if(isset($id)){    
                  echo "<td><input type='text' name='id' size='30' value=$id readonly></td>";
                }else{
                  echo "<td><input type='text' name='id' size='30'></td>";
                }
                
                if(isset($_COOKIE['cookie_id'])){
                  echo "<td width='80'><input type='checkbox' name='save_id' value='1' checked>아이디저장</td>";                
                }else{
                  echo "<td width='80'><input type='checkbox' name='save_id' value='1'>아이디저장</td>";                
                }
              ?>
              <td width="120"></td>
            </tr>
            <tr>
              <td width="120"></td>
              <td align="left" width="80"><label for="pw">비밀번호</label></td>
              <?php  
              //비밀번호 찾기에서 비밀번호를 찾아서 다시 올경우 
                if(isset($pw)){
                  echo "<td width=180><input type='password' name='pw' size='30' value=$pw readonly></td>";
                }else{
                  echo "<td width='180'><input type='password' name='pw' size='30'></td>";
                }
              ?>
              <td><a href="#"><img src="../image/btn_login.gif" onclick="input_check()"></a></td>
              <td width="120"></td>
            </tr>
            <tr height="20"></tr>
            <tr height="20"></tr>
            <tr>
              <td colspan="5" align="center">
                <a href="id_find.php">▷아이디찾기</a>&nbsp;&nbsp;&nbsp;
                <a href="pw_find.php">▷비밀번호찾기</a>&nbsp;&nbsp;&nbsp;
                <a href="#" onclick="mem()">▷회원가입</a>
              </td>
            </tr>
            <tr height="20"></tr>
          </table>
</form>
        </td>
      </tr>
      <tr height="20">
        <td></td>
        <td></td>
      </tr>
      <tr height="20">
        <td></td>
        <td align="center"></td>
      </tr>
      <tr height="20">
        <td></td>
        <td></td>
      </tr>
      <tr height="20">
        <td></td>
        <td><img src="../image/img_footer_new.png"></td>
      </tr>
    </table>
  </body>
</html>