<?php 
class Category extends ActiveRecord {
	public $id_category,$name,$description;
	public static $table = "categories";
	public static $key = "id_category";
	public static $value = "null";
	public static $q_part1 = "";
	public static $q_part2 = "";
	public static $q_part3 = "";
	public static $key1 = "name";
}