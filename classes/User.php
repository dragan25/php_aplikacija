<?php
class User extends ActiveRecord {
	public static $table = "users";
	public static $key = "id_user";
	public static $q_part1 = "";
	public static $q_part2 = "";
	public static $q_part3 = "";
	public function setSession() {
		Session::set("username",$this->username);  // this se odnosi na setSession() nestaticki metod;
	}
	public static function logout() {
		Session::stop();
	}
	public static function login($username,$password) {
		$users = self::getAll(" where username = '{$username}' and password = '{$password}' limit 1");
		if(count($users)==1) {
			$users[0]->setSession();
			return $users[0];
		} else {
			return null;
		}
	}
}