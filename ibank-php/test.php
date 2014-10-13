<!DOCTYPE html>
<html>
<head>
	<title>找回密码</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<style type="text/css">
		.paypw-err {
			color: #DB2929;
			font-size: 0.95em;
		}
	</style>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" data-theme="b">
	<div data-role="header" data-theme="a">
		<h1>找回密码</h1>
	</div>
	<div data-role="content">
		<form method="post" action="" name="form_fillAccountName" id="form_fillAccountName">
			<div>
				<label for="username">用户名：</label>
				<input type="text" placeholder="用户名" name="userInput" id="userInput" />
				<p id="username_error" class="paypw-err"></p>
			</div>
			<button type="submit" name="submit" id="btnFillAccountName" value="submit-value">下一步</button>
		</form>
	</div>
	<div data-role="footer" data-theme="d">
		<h4>Copyright © lixiphp.com 版权所有</h4>
	</div>
</div>
<script type="text/javascript">
	var sid = '';

	var formSubmit = function(){
		if(userInputBlur()){
			var param;
			if(sid == ''){
				param = {userInput:$("#userInput").val()};
			}else{
				param = {userInput:$("#userInput").val(),sid:sid};
			}
			jQuery.post('/request_api/forgetpass',
				param,
				function(data){
					if(data.isSuccess=="T" ){
						$('#form_fillAccountName').attr('action', '/request_api/findloginpassword/'+data.uid);
						$('#form_fillAccountName').submit();
					}
					else{
						if(data.returnCode=="none"){
							$("#username_error").show();
							$("#username_error").html("用户名 不存在");
						}
						else{
							$("#username_error").show();
							$("#username_error").html("系统异常");
						}
					}
				}, 'json');
		}
		return false;
	}
	var userInputBlur = function(){
		if($("#userInput").val()==''){
			$("#username_error").show();
			$("#username_error").html("输入不能为空");
			return false;
		}
		return true;
	}
	var userInputFocus = function(){
		$("#username_error").hide();
	}
	$(document).ready(function(){
		$('#userInput').blur(userInputBlur);
		$('#userInput').focus(userInputFocus);
		$('#btnFillAccountName').click(formSubmit);
	});
</script>
</body>
</html>
