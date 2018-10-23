<?php
include "config.php";

// $t = new Test();                              // test klase Test


// $conn = Database::getInstance();              // test klase Database
// print_r($conn);


// for($i=0;$i<1000;$i++){                       // test klase Database (testiranje singletona - stranica se treba brzo otvoriti, ako je sve ok)
	// $conn = Database::getInstance();
// }


// class Category extends ActiveRecord {         // test izbacivanja svih kategorija ili samo zeljenih kategorija
	// public static $table = "categories";
// }
// $allCategories = Category::getAll("where id_category in (1,2,5)");
// print_r($allCategories);


// class Category extends ActiveRecord {         // test izbacivanja samo jedne kategorije
	// public static $table = "categories";
	// public static $key = "id_category";
// }
// $allCategories = Category::get(5);
// print_r($allCategories);


// class Category extends ActiveRecord {         // test updatea podataka u bazi 
	// public static $table = "categories";
	// public static $key = "id_category";
// }
// $cat = Category::get(5);   // ovo je neinstancni metod                 
// $cat->name = "MLS";
// $cat->save();
// print_r($cat);


// class Category extends ActiveRecord {         // test inserta u bazu podataka
	// public static $table = "categories";
	// public static $key = "id_category";
// }
// $cat = new Category;      // ovo je instancni metod
// $cat->name = "NBDL";
// $cat->description = "Minor Basketbal League";
// $cat->insert();


// class Category extends ActiveRecord {         // test brisanja iz baze podataka
	// public static $table = "categories";
	// public static $key = "id_category";
// }
// $cat = Category::delete(6);    // ovo je neinstancni metod
























