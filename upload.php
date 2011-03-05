<?php
include("common.php");
include("upload_common.php");

$session_id = check_logged_in();

if (!isset($_POST["directory"]) || strlen($_POST["directory"]) == 0) {
	die("You didn't give me a directory");	
}

class Movie {
	public $filename;
	public $size;
	public $width;
	public $height;
	public $bitrate;
	public $audio;
	public $video;
	
	public function __construct($f, $s, $w, $h, $br) {
		$this->filename = $f;
		$this->size = $s;
		$this->width = $w;
		$this->height = $h;
		$this->bitrate = $br;	
	}
}

class Audio {
	public $bitrate;
	public $codec;
	public $samplerate;
	
	public function __construct($br, $c, $sr) {
		$this->bitrate = $br;
		$this->codec = $c;
		$this->samplerate = $sr;
	}
}

class Video {
	public $bitrate;
	public $codec;
	
	public function __construct($br, $c) {
		$this->bitrate = $br;
		$this->codec = $c;	
	}
}

$dir = $_POST["directory"];
$files = scandir($dir);
array_shift($files);
array_shift($files);
if ($dir[strlen($dir) - 1] != "/") {
	$dir .= "/";
}

function handleError($errno, $errstr) {
	
}

$movies = array();
set_error_handler("handleError");
foreach ($files as $file) {
	$movie = new ffmpeg_movie($dir . $file, false);
	$filesize = (int) exec("du -D \"" . $dir . $file . "\"");
	$object = new Movie($file, $filesize, $movie->getFrameWidth(),
						$movie->getFrameHeight(), $movie->getBitRate());
	$object->audio = new Audio($movie->getAudioBitRate(), $movie->getAudioCodec(), $movie->getAudioSampleRate());
	$object->video = new Video($movie->getVideoBitRate(), $movie->getVideoCodec());
	array_push($movies, $object);
}

$uuid = get_uuid();

$params = array("uuid" => $uuid, "session_id" => $session_id, "movies" => json_encode($movies));

top("Upload your movie list");

?>
<h1>Upload your movie list</h1>
<div id="loading">
	<img src="images/loading.gif" alt="Loading" />
	Please wait. This could take a very long time. I'm talking ten minutes or more.
</div>
<?php
flush();
$result = post("/add_movies", $params);
print_r($result);
?>
<script type="text/javascript">
	document.getElementById('loading').innerHTML = '';
</script>
<?php
display_non_matches($result);

bottom();
?>