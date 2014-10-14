<!DOCTYPE html>
<html>
<head>
	<title>找回密码</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="lib/jmobile/jquery.mobile-1.3.2.min.css"/>
	<style type="text/css">
		.paypw-err {
			color: #DB2929;
			font-size: 0.95em;
		}
	</style>
	<script src="lib/jqurey/jquery-1.11.1.min.js"></script>
	<script src="lib/jmobile/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" data-theme="b">
	<div data-role="header" data-theme="a">
		<h1>iBank手机银行</h1>
	</div>
	<div data-role="content">
		<div style="">
			<h3>卡号登陆</h3>
		</div>
		<form method="post" action="" name="form_fillAccountName" id="form_fillAccountName">
			<div data-role="fieldcontain">
				<input type="text" placeholder="请输入卡号" name="cardid" id="userInput"/>

				<p id="username_error" class="paypw-err"></p>
				<br/>
				<input type="password" placeholder="请输入密码" name="password" id="passwordInput"/>

				<p id="password_error" class="paypw-err"></p>
			</div>
			<button type="submit" name="submit" id="btnFillAccountName" value="submit-value">登陆</button>

		</form>
	</div>
	<div data-role="footer" data-theme="d">
		<h4></h4>
	</div>
</div>
<script type="text/javascript">
	var sid = '';

	var formSubmit = function () {
		if (userInputBlur() && passwordInputBlur()) {
			var param;
			param = {cardid: $("#userInput").val(), password: $("#passwordInput").val()};
			jQuery.post('isLogin.php',
				param,
				function (data) {
					if (data.isSuccess == "T") {
						$('#form_fillAccountName').attr('action', 'info.php');
						$('#form_fillAccountName').submit();
					}
					else {
						if (data.returnCode == "none") {
							$("#username_error").show();
							$("#username_error").html("用户名不存在");
						} else if (data.returnCode == "wrong") {
							$("#password_error").show();
							$("#password_error").html("密码错误");
						}
					}
				}, 'json');
		}
		return false;
	}
	var userInputBlur = function () {
		if ($("#userInput").val() == '') {
			$("#username_error").show();
			$("#username_error").html("卡号不能为空");
			return false;
		}
		return true;
	}
	var passwordInputBlur = function () {
		if ($("#passwordInput").val() == '') {
			$("#password_error").show();
			$("#password_error").html("密码不能为空");
			return false;
		}
		return true;
	}
	var userInputFocus = function () {
		$("#username_error").hide();
	}
	var passwordInputFocus = function () {
		$("#password_error").hide();
	}
	$(document).ready(function () {
		$('#userInput').blur(userInputBlur);
		$('#userInput').focus(userInputFocus);
		$('#passwordInput').blur(passwordInputBlur);
		$('#passwordInput').focus(passwordInputFocus);
		$('#btnFillAccountName').click(formSubmit);
	});
</script>
</body>
</html>
