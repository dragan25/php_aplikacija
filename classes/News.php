<?php 
class News extends ActiveRecord {
	public $id_news,$date,$headline,$content,$id_category,$id_image,$title,$image,$author,$category;
	public static $table = "news";
	public static $key = "id_news";
	public static $value = "null";
	public static $table1 = "images";
	public static $key1 = "title";
	public static $q_part1 = "join categories on news.id_category = categories.id_category join images on news.id_image = images.id_image";
	public static $q_part2 = "ORDER BY date DESC";
	public static $q_part3 = "join images on news.id_image = images.id_image";
}