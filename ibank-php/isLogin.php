<?php

include_once('userDao.php');
$cardId = $_POST['cardid'];
$password = $_POST['password'];
$userDao = UserDao::sharedPlayerDao();
$user = $userDao->getUserByCardId($cardId)[0];
if ($user == NUll) {
	echo '{"isSuccess":"F","returnCode":"none"}';
	die();
}
if ($user->password != $password) {
	echo '{"isSuccess":"F","returnCode":"wrong"}';
} else {
	echo '{"isSuccess":"T"}';
}
?>