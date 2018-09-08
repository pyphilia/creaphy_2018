<?php
require("token.php");
require("Db.php");
$db = new Db($dbhost, $dbuser, $dbpw, $dbname);

if (is_ajax()) {
	if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists

		$action = htmlspecialchars($_POST["action"]);
		switch($action) {
			case "getNames": getAllNames(htmlspecialchars($_POST["cat"])); break;
			case "getImg":
			getImg(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["cat"]), htmlspecialchars($_POST["incr"]),htmlspecialchars($_POST["nb"]));
			break;
			case "lastCrea":
			lastCrea(htmlspecialchars($_POST["nb"]));
			break;
			case "crea": crea(htmlspecialchars($_POST["cat"]),htmlspecialchars($_POST["incr"]), htmlspecialchars($_POST["nb"])); break;
		}
	}
}

/*Function to check if the request is an AJAX request*/
function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}



function getAllNames($cat){
	global $db, $CATEGORIES;
	$cat_id = $CATEGORIES[$cat];

	$db_creations = array_column($db->leftJoin("creations", "celebrities", array("celebrities_id" => "id"), array("celebrities.name"), array("categories_id" => $cat_id), "last_modified DESC")->fetchAll(),"name");
	$names = array_unique($db_creations);
	natcasesort($names);
	array_shift($names);
	$html = "";
	foreach ($names as $name) {
		$html .= '<option>' . $name . '</option>';
	}
	echo $html /*. '<option>Stop</option>' . '<option>More</option>'*/;
}

/*getImg("Baek Su Min", "avatar", 3);*/
function getImg($name, $cat, $incr, $nb) {
	global $db, $CATEGORIES;
	$currentCategory = $CATEGORIES[$cat]["id"];

	// if there is sth
	/*DB*/
	$cond = NULL;
	$limit = $nb;
	$offset = $nb*$incr;
	$images;
	// category process
	if($currentCategory){
		$conditions = array("categories_id" => array($currentCategory));
		$conditions["celebrities.name"] = array($name);

		/*DB*/
		$db_images = array();
		$db_creations = $db->leftJoin("creations", "celebrities", array("celebrities_id" => "id"), array("creations.url"), $conditions, "last_modified DESC", $limit, $offset)->fetchAll();
		$db_images = array_column($db_creations, "url");

		/*all images*/
		$images = $db_images;
	}
	else {
		var_dump("ERROR");
	}
	// echo
	$string = '';

	foreach($images as $crea) {
		$string .= '<a href="' .  $crea .  '"><img src="' .  $crea .  '"/></a>';

	}
	echo $string;

}


function lastCrea($nb){
	global $db;
	$db_creations = array_column($db->select("creations", array("url"), NULL, "id DESC", $nb*2)->fetchAll(),"url");
	$creations = array_unique($db_creations);
	$string = '';
	foreach($creations as $crea) {
		$string .= '<a href="' .  $crea .  '"><img src="' .  $crea .  '"/></a>';

	}
	echo $string;
}


function crea($cat, $incr, $limit){

	global $db, $CATEGORIES;
	$conditions = array("categories_id" => array($CATEGORIES[$cat]["id"]));

	$db_creations = array_column($db->select("creations", array("url"), $conditions, "id DESC", $limit, $incr*$limit)->fetchAll(),"url");
	$string = '';
	foreach($db_creations as $crea) {
		$string .= '<a href="' .  $crea .  '"><img src="' .  $crea .  '"/></a>';

	}
	echo $string;
}


// old gallery functions
function printSublinks(){
	global $CATEGORIES;
	foreach ($CATEGORIES as $key => $value) {
		echo '<a href="?category=' . $key . '"><span>' . $key . '</span></a>';
	}
}

function isCelebrityDepending($id){
	return ($id == 15 || $id == 16 || $id == 17 || $id == 18);
}

function displayGridImages(array $images) {
	foreach($images as $img) {
		echo '<img class="gridImg" src="'.$img.'"/>';
		break;
	}

}

function isCategory($s){
	$s = htmlspecialchars($s);
	global $CATEGORIES;
	$cat_names = array_keys($CATEGORIES);
	if(array_key_exists($s, $CATEGORIES)){
		return $CATEGORIES[$s];
	}
	else false;
}
