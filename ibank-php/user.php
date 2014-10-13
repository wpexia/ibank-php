<?php

class User {
	public $id;
	public $cardId;
	public $name;
	public $password;
	public $balance;

	public function toJson(){
		return urldecode (json_encode(array("id"=>$this->id,"cardId"=>$this->cardId,"name"=>$this->name,"password"=>$this->password,"balance"=>$this->balance)));
	}

	public static function arrayToJson($users){
		$result='[';
		$arrayCount=(count($users));
		for ($i=0; $i<$arrayCount; $i++)
		{
			$item=$users[$i];
			$result=$result.$item->toJson();
			if ($i<$arrayCount-1)
			{
				$result=$result.',';
			}
		}
		$result=$result.']';
		return $result;
	}
}