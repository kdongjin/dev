<?php 
//extract 선언, db 접속 => $con
include '../../common_lib/common.php'; 

if(isset($_GET['id'])){
    $id= $_GET['id'];
}else{
    $id="";
}

$sql="select * from membership where id='$id'";

$result= mysqli_query($con, $sql);

//mysqli_fetch_array()함수는 한 번에 하나의 데이터row를 테이블에서 얻어내서  
//칼럼명을 배열의 인덱스로 하여 각각 $row 배열에 저장한다.
$row= mysqli_fetch_array($result);

//mysqli_num_rows() 쿼리문에서 반환된 row의 개수,총 몇 개의 행을 가졌는지 그 개수를 반환하는 함수
//$id 글자가 6글자이상 12이하 글자가 아니면   $num_record=1 로 셋팅해서 다시입력하도록 요청함.
// 해당된 $id가 있다면 해당되는 행이 1이상이 저장되고 , 없다면 0 행으로 저장될것임. 
if(strlen($id) >= 6 && strlen($id) <= 12){
    $num_record= mysqli_num_rows($result);
}else{
    $num_record=1;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href=../css/join.css rel=stylesheet>
</head>
<script>
	// 요소 검사 함수
	function check_exp(elem, exp, msg){
		if(!elem.value.match(exp)){
			alert(msg);
			return true;
		}
	}
	//아이디 검사
	function id_check(){
    	var exp_id= /^[0-9a-zA-Z]{6,12}$/;
    	var id_val= document.id_check_form.id.value;
		if(!id_val){
			alert("ID를 입력해주세요");
			return ;
		}
    	if(check_exp(document.id_check_form.id, exp_id, "ID는 6~12자리 영문 또는 숫자만 입력해주세요!")){
    		document.id_check_form.id.focus();
    		document.id_check_form.id.select();
    		return ;
    	}
    	document.id_check_form.submit();
	}
	
	function id_use(a){
		opener.join_form.id.value=a;
		window.close();
	}
	
	function closer(){
		window.close();
	}

</script>
<body>
	<div id=wrap>
		<div id=id_check_title>
			<div id=id_check_title1><img src=../image/pop_idcomf.gif></div>
			<div id=id_check_title2><a href="#"><img src=../image/pop_login_close.gif onclick="closer()"></a></div>
		</div>
		
		<div class=clear></div>
		<div id=hr_line></div>
		<br>
		<div id=text1 align=center>
			사용하고자 하는 아이디를 입력하신 후 중복검색 버튼을 눌러주세요.<br>
			(6자 이상 12자 이내의 영문 또는 영문과 숫자를 조합, 한글 및 특수문자 제외)
		</div>
		<br>
		<form name=id_check_form method=get action="check_id.php">
		<div align=center>
			<input type="text" name="id" value="<?=$id?>"> 
				<a href="#"><img src="../image/idComF.gif" onclick="id_check()"></a>
		</div>
		</form>
		<br>
		<div id=hr_line_middle></div>
		<br>
		<?php 
		//$num_record가 1행 이상이면 해당된 $id가 있다면 사용할수 없음 
		if($num_record){
		?>
		<div id=text2 align=center>
			<b>입력하신 '<font color=red><?=$id?></font>'는 <font color=red>사용할 수 없는</font>
				 아이디입니다.<br>새로운 아이디로 선택해 주십시오.</b>
		</div>
		<?php 
		}else{
		?>
		<div id=text2 align=center>
			<b>입력하신 '<font color=red><?=$id?></font>'는 사용하실 수 있습니다.<br>
				이 아이디를 사용하시겠습니까?</b><br><br>
			<a href="#"><img src="../image/use.gif" onclick="id_use('<?=$id?>')"></a>
		</div>
		<?php
		}
		?>
	
	</div>
</body>
</html>

<?php
mysqli_close($con);
?>


