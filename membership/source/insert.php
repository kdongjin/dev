<meta charset=utf-8>
<?php
//extract 선언, db 접속 => $con
include '../../common_lib/common.php';    

// 아이디, 암호, 이름, 생년월일, 
$id= $_POST['id'];
$pass= $_POST['pass'];
$name= $_POST['name'];
$year= $_POST['year'];
$month= $_POST['month'];
$day= $_POST['day'];

if($month<10){
    $month="0".$month;
}
if($day){
    $day= "0".$day;
}
$birth= $year."-".$month."-".$day;

// 성별, 우편번호, 주소, 연락처, 이메일, 문자수신여부, 
$gender= $_POST['gender'];
$zip= $_POST['zip'];
$address= $_POST['address1']." ".$_POST['address2'];
$hp= $_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
$email=$_POST['email1']."@".$_POST['email2'];

// isset($_POST['sms_ok'])변수가 설정되었는지 검사합니다. null 지정한변수를 확인하면 false 반환합니다. 
if(isset($_POST['sms_ok'])){
    $sms_ok= $_POST['sms_ok'];
}else{
    $sms_ok="";
}

$sql= "select * from membership where id='$id'";
$result= mysqli_query($con, $sql);
//mysqli_num_rows($result)결과값에 해당되는 행의수를 리턴함.  
$exist_id=mysqli_num_rows($result);


if($exist_id){
    echo "<script> window.alert('해당 아이디가 존재합니다.'); history.go(-1); </script>";
    exit();
}else{
    $sql= "insert into membership(id, pass, name, birth, gender, zip, address, phone, email, sms_ok) ";
    $sql.= "values ('$id', '$pass', '$name', '$birth', '$gender', '$zip', '$address', '$hp', '$email', '$sms_ok')";
    mysqli_query($con, $sql) or die(mysqli_error($con));
}

mysqli_close($con);

echo "<script>alert('회원가입이 완료되었습니다.')</script>";
echo "<script> location.href='../../index.php'; </script>";
?>