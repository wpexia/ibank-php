<?php
session_start();
include_once('userDao.php');
if (!isset($_SESSION['cardId'])) {
	$cardId = $_POST['cardid'];

	$password = $_POST['password'];
	$userDao = UserDao::sharedUserDao();
	$user = $userDao->getUserByCardId($cardId)[0];
	if (!$user) {
		header("Location: login.php");
	}
	$_SESSION['cardId'] = $user->cardId;
	$_SESSION['balance'] = $user->balance;
	$_SESSION['id'] = $user->id;
	$_SESSION['name'] = $user->name;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
	<link rel="stylesheet" href="lib/jmobile/jquery.mobile-1.3.2.min.css"/>
	<script src="lib/jqurey/jquery-1.11.1.min.js"></script>
	<script src="lib/jmobile/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>

<div data-role="page" data-theme="b">
	<div data-role="header" data-theme="a">
		<h1>iBank手机银行</h1>
	</div>

	<div data-role="content">
		<div style="text-align: center">
			<h3>基本信息</h3>
		</div>
		<div>
			<label>卡号</label>

			<p>
				<?php
				echo $_SESSION['cardId'];
				?>
			</p>
			<label>姓名</label>

			<p>
				<?php
				echo $_SESSION['name'];
				?>
			</p>
			<label>余额</label>

			<p>
				<?php
				echo $_SESSION['balance'];
				?>
			</p>

			<form action="transfer.php">
				<input type="submit" value="转账"></input>
			</form>
			<form action="transfer.php">
				<input type="submit" value="预约排队"></input>
			</form>
			<form action="transfer.php">
				<input type="submit" value="挂失"></input>
			</form>
		</div>

	</div>


</div>

</body>
</html>
