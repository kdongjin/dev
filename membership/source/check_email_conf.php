<?php 
session_start();

if(isset($_GET['mode']) && $_GET['mode']=="unset"){
    unset($_SESSION['code']);
    echo "<script> window.close(); </script>";
    exit ;
}

if(!isset($_SESSION['code'])){
    echo "<script> alert('접근 제한'); history.back(); </script>";
    exit;
}else{
    $code= $_SESSION['code'];
}


$email= $_GET['email'];
$email_ex= explode("@", $email);
$email1= $email_ex[0];
$email2= $email_ex[1];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<link href=../css/join.css rel=stylesheet>
	<script>
    	var myVar;
    	var count=180;

    	function check_email_conf(a,b,c){
			if(document.getElementById("code").value!=a){
				alert("인증번호가 틀립니다.\n 다시 입력해주세요!");
				return ;
			}
			alert("인증 되었습니다.");
			opener.join_form.email1.value=b;
			opener.join_form.email2.value=c;
			
			window.close();
		}
		
    	function closer(){
    		window.close();
    	}

    	function myFunction() {
    	    var min= parseInt(count/60);
    	    var sec= count%60;
 	   	    count--;
			document.getElementById('conf_time').innerHTML="("+min+":"+sec+")";
    	    
    	    if(!count){
    	       alert('시간초과');
    	       location.href="check_email_conf.php?mode=unset";
    	       return ;
    	    }
    	    myVar = setTimeout(myFunction, 1000);
    	}
	</script>
</head>
<body>
	<div id=wrap>
		<div id=id_check_title>
			<div id=id_check_title1><img src="../image/email_conf_title.jpg"></div>
			<div id=id_check_title2><a href="#"><img src="../image/pop_login_close.gif" onclick="closer()"></a></div>
		</div>
		<div class=clear></div>
		<div id=hr_line></div>
		<br>
		<div id=text1 align=center>
			<b style="coler : blue"><?=$email?></b> 로 인증번호를 보냈습니다.<br>
			정확히 입력해 주세요.
		</div>
		<br>
		<div align=center>
			<input type="text" id="code" size="10"> 
			<a href="#">
				<img src="../image/email_conf.jpg" onclick="check_email_conf(<?=$code?>,'<?=$email1?>', '<?=$email2?>')"></a>
    		<div id="conf_time" style="color : blue"></div>
    		<script>
    			myFunction()
    		</script>
		</div>
		<br>
		<div id=hr_line_middle></div>
		<br>
	</div>
</body>
</html>