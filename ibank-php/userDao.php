<?php
ini_set('memory_limit', '56M');
include_once('database.php');
include_once('user.php');

class UserDao {
	private static $_sharedUserDao = null;

	function __construct() {
	}

	public static function sharedPlayerDao() {
		if (self::$_sharedUserDao == null) {
			self::$_sharedUserDao = new UserDao();
		}
		return self::$_sharedUserDao;
	}

	function setPlayerWithRow($row) {
		$user = new User();
		$user->id = $row['id'];
		$user->name = $row['name'];
		$user->cardId = $row['cardid'];
		$user->password = $row['password'];
		$user->balance = $row['balance'];
		return $user;
	}

	function getUserByCardId($cardId) {
		$database = Database::sharedDatabase();
		$database->connectDatabase();
		$sql = "SELECT * FROM `user` WHERE `cardid` = '$cardId'";
		$result = mysql_query($sql);
		$database->closeDatabase();

		$users = array();
		while ($row = mysql_fetch_array($result)) {
			$user = $this->setPlayerWithRow($row);
			array_push($users, $user);
		}

		return $users;
	}
}