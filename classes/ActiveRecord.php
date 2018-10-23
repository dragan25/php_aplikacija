<?php
abstract class ActiveRecord {
	public static function getAll($filter=""){
		$q = mysqli_query(Database::getInstance(), "select * from ". static::$table." ".static::$q_part1." ".$filter." ".static::$q_part2);
		$res = array();
		while($rw=mysqli_fetch_object($q, get_called_class())) $res[] = $rw;
			return $res;
	}
	public static function getOneN($id_news){
		$query = "select * from ". static::$table." ".static::$q_part3." where ".static::$key. " = " .$id_news." ".static::$q_part2;
		$q = mysqli_query(Database::getInstance(), $query); 
		return mysqli_fetch_object($q, get_called_class());                  
	}
	public static function getOneC($id_category){
		$query = "select * from ". static::$table." ".static::$q_part3." where ".static::$key. " = " .$id_category." ".static::$q_part2;
		$q = mysqli_query(Database::getInstance(), $query); 
		return mysqli_fetch_object($q, get_called_class());                  
	}
	public function save(){
		$q = "update ".static::$table. " set ";   
		foreach($this as $k=>$v){                 
			if($k==static::$key) continue;
			$q.= $k."='".$v."',";
		}
		$q = rtrim($q, ",");
		$keyField = static::$key;
		$q.= " where ".$keyField. " = ". $this->$keyField;
		mysqli_query(Database::getInstance(), $q); 
	}
	public function insert(){
		$fields = get_object_vars($this);
		$keys = array_keys($fields);
		$values = array_values($fields);
		$q = "insert into " . static::$table . " (";
		foreach($this as $k=>$v){
			$q.= $k.",";
		}
		$q = rtrim($q,",");
		$q.= ") values (".static::$value.",";
		foreach($this as $k=>$v){
			if($k==static::$key) continue;
			$q.= "'".$v."',";
		}
		$q = rtrim($q,",");
		$q.= ")";
		$conn = Database::getInstance();
		mysqli_query($conn, $q); 
		$keyField = static::$key;
		$this->$keyField = mysqli_insert_id($conn);
	}
	public function deleteC($name){
		$q = "delete from " . static::$table . " where " .static::$key1 . " = '" . $name."'";
		mysqli_query(Database::getInstance(), $q); 
	}
}