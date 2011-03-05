<?php
include("common.php");
include("upload_common.php");

$session_id = check_logged_in();


top("Movie upload!");
?>
<pre>
<?php
print_r($_POST);
?>
</pre>
<?php
class NewMatch {
	public $filename;
	public $new_name;
	public $year;
	
	function __construct($f, $nn = "", $y = "") {
		$this->filename = $f;
		$this->new_name = $nn;
		$this->year = $y;	
	}	
}
$keys = array_keys($_POST);
$new_matches = array();
foreach ($keys as $key) {
	if (strpos($key, ";;;own") === FALSE) {
		$filename = $key;
		$pos = strrpos($filename, "_");
		if ($pos !== FALSE) {
			$filename[$pos] = ".";	
		}
		$new_match = new NewMatch($filename);
		if ($_POST[$key] == "entered_own") {
			$new_match->new_name = $_POST[$key . ";;;own"];
		} else {
			$pieces = explode(";;;", $_POST[$key]);
			$new_match->new_name = $pieces[0];
			$new_match->year = $pieces[1];
		}
		array_push($new_matches, $new_match);
	}
}
print_r($new_matches);
$params = array("uuid" => get_uuid(), "session_id" => $session_id, "new_names" => $new_matches);
$result = post("fix_non_matches", $params);
print_r($result);
bottom();
?>