<?php

include_once('userDao.php');
$cardId = $_POST['cardid'];
$password = $_POST['password'];
$userDao = UserDao::sharedUserDao();
$user = $userDao->getUserByCardId($cardId)[0];
if ($user == NUll) {
	echo '{"isSuccess":"F","returnCode":"none"}';
	exit();
}
if ($user->password != $password) {
	echo '{"isSuccess":"F","returnCode":"wrong"}';
} else {
	echo '{"isSuccess":"T"}';
}
?>