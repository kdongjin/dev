<?php
session_start();

if(!isset($_POST['email1']) || !isset($_POST['email2'])){
    echo "<script> alert('접근 제한'); history.back(); </script>";
    exit;
}else{
    $email= $_POST['email1']."@".$_POST['email2'];
}

include './Sendmail.php';
/* + $to : 받는사람 메일주소 ( ex. $to="hong <hgd@example.com>" 으로도 가능) +
 * $from : 보내는사람 이름 +
 *  $subject : 메일 제목 +
 *  $body : 메일 내용 +
 *  $cc_mail : Cc 메일 있을경우 (옵션값으로 생략가능) +
 *  $bcc_mail : Bcc 메일이 있을경우 (옵션값으로 생략가능) */

srand((double)microtime()*1000000); //난수값 초기화
$_SESSION['code']=rand(100000,999999);
$_SESSION['code']=111111;  //랜덤대신해서 111111 값을 입력함. 테스트용임. 안되서 해보았음. 
$code=$_SESSION['code'];

$count=1;
$to=$email;
$from="관리자";
$subject="[MR_Library] 회원 가입 인증번호입니다.";
$body="[MR_Library] 회원가입 인증번호 입니다.\n인증번호 : ".$code."\n정확히 입력해주세요.";
$cc_mail="";
$bcc_mail=""; /* 메일 보내기*/

//$sendmail : 메일객체임. => include './Sendmail.php'에서 객체로 정의됨.
$sendmail->send_mail($to, $from, $subject, $body, $cc_mail, $bcc_mail); 

echo "<script>
        location.href='../source/check_email_conf.php?email=$email';
    </script>";
?>