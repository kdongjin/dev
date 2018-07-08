<?php  
  session_start();
  include "./common_lib/common.php";
  $auto="on";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>메인 | 국립중앙도서관</title>
  <link rel="stylesheet" href="./common_css/common.css">
  <link rel="stylesheet" href="./slide/css/slide.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>           <!--이거 추가하신분-->
  <script src="./slide/js/slide.js"></script>
    <script>
    	var auto = "on";
    	function btn_auto_action(){
    		if(auto=="on"){
    			auto= "off";
    			$("#src_rst").hide();
    		}else if(auto=="off"){
    			auto= "on";
    		}
    	}
      function check_search(){
    		if(!document.search_form.search.value){
    			alert("검색어를 입력하세요");
    			document.search_form.search.focus();
    			return ;
    		}
    		document.search_form.submit();
    	}
        
      $(document).ready(function(){
        $("#src_rst").hide();
    		$("#asearch").keyup(function(){
    			if(auto=="on"){
        			var search= $("#asearch").val();
        			var type= $("#type_key").val();
        			var kind= $("#kind_key").val();
        			if(search.length <= 0){
        				$("#s_r_l").html("");
        				$("#src_rst").hide();
        			}else{
        				$.ajax({
        					type : "post",
        					url : "./list/source/search_result.php",
        					data : "search="+search+"&kind="+kind+"&type="+type+"&index=ok",
        					success : function(data){
        						$("#src_rst").show();
        						$("#s_r_l").html(data);
        					}
        				});
        			}
    			}
    		});
		
    		$("#type_key").mouseup(function(){
    			if(auto=="on"){
        			var search= $("#asearch").val();
        			var type= $("#type_key").val();
        			var kind= $("#kind_key").val();
        			if(search.length <= 0){
        				$("#s_r_l").html("");
        				$("#src_rst").hide();
        			}else{
        				$.ajax({
        					type : "post",
        					url : "./list/source/search_result.php",
        					data : "search="+search+"&type="+type+"&kind="+kind+"&index=ok",
        					success : function(data){
        						$("#src_rst").show();
        						$("#s_r_l").html(data);
        					}
        				});
        			}
    			}
    		});
    		
		    $("#kind_key").mouseup(function(){
			    if(auto=="on"){
        		var search= $("#asearch").val();
      			var type= $("#type_key").val();
      			var kind= $("#kind_key").val();
      			if(search.length <= 0){
      				$("#s_r_l").html("");
      				$("#src_rst").hide();
      			}else{
      				$.ajax({
      					type : "post",
      					url : "./list/source/search_result.php",
      					data : "search="+search+"&type="+type+"&kind="+kind+"&index=ok",
      					success : function(data){
      						$("#src_rst").show();
      						$("#s_r_l").html(data);
      					}
      				});
      			}
			    }
    		});

	      $("asearch").focusin(function(){ 
          $("asearch").css("border-color","#ddaa88");
		    });
    	});
    </script>
</head>

<body>
  <header>
    <?php include "./common_lib/top_login1.php"; ?>
  </header>
  <nav id="top">
    <?php include "./common_lib/menu1_1.php"; ?>
  </nav>
  <section>
    <article class="art1">
      <div class="slide">
        <div id="search_box"></div>
      	<div id="search_text">자료검색</div>
    		<div id="search_box1">
    			<form name="search_form" method="get" action="./list/source/book_list.php">
    				<input type="hidden" name="mode" value="search" autocomplete="off">
      			<select name="book_type" id="type_key">
      				<option value="">선택</option>
      				<option value="국내도서">국내도서</option>
      				<option value="외국도서">외국도서</option>
      				<option value="음반">음반</option>
      				<option value="DVD">DVD</option>
      			</select> &nbsp;
      			<select name="kind" id="kind_key">
      				<option value="book_name">책이름</option>
      				<option value="book_writer">저자</option>
      				<option value="book_publisher">출판사</option>
      				<option value="book_number">청구번호</option>
      				<option value="book_introduce">책소개</option>
      			</select> &nbsp;
        		<input type="text" name="search" id="asearch" size="50" placeholder="검색어를 입력하세요" autofocus autocomplete="off">    <!-- autocomplete 기능--> 
    		    <a href="#"><div id="btn_auto" style="display: inline; color : #ddaa88;" onclick="btn_auto_action()"> ▼ </div></a>
    		    <a href="#"><img src="./list/image/btn_search.png" width="20" height="20" onclick="check_search()"></a>
    			</form>
    		</div>
    		<div id="src_rst">
    			<div id="s_r_l"></div>
        	<div id="btn_auto2" style="width : 378px; text-align: right;" onclick="btn_auto_action()"><a href='#'>자동완성 끄기</a></div>
    		</div>
        <button class="prev" type="button"><img id="img1" src="./slide/images/btnL.png"></button>
        <ul class="images">
          <li><img src="./slide/images/slide1.jpg"></li>
          <li><img src="./slide/images/slide2.png"></li>
          <li><img src="./slide/images/slide3.png"></li>
          <li><img src="./slide/images/slide4.png"></li>
        </ul>
        <button class="next" type="button"><img id="img2" src="./slide/images/btnR.png"></button>
      </div>
    </article>
    <!-- <article class="art2">
    
    </article>
    <article class="art3">

    </article>
    <article class="art4">

    </article> -->
  </section>
  <footer>
    <?php include "./common_lib/footer1.php"; ?>
  </footer>
</body>

</html>