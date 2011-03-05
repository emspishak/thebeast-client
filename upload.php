<?php
include("common.php");

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
$movies = array();
foreach ($files as $file) {
	$movie = new ffmpeg_movie($dir . $file, false);
	$object = new Movie($file, filesize($dir . $file), $movie->getFrameWidth(),
						$movie->getFrameHeight(), $movie->getBitRate());
	$object->audio = new Audio($movie->getAudioBitRate(), $movie->getAudioCodec(), $movie->getAudioSampleRate());
	$object->video = new Video($movie->getVideoBitRate(), $movie->getVideoCodec());
	array_push($movies, $object);
}

print_r($movies);

top("Upload your movie list");
$post_url = $site_root . "/add_movies";
$uuid = get_uuid();
?>
<script type="text/javascript">
	var url = '<?= $post_url ?>';
	var sessionId = '<?= $session_id ?>';
	var uuid = '<?= $uuid ?>';
</script>
<script src="jquery.js" type="text/javascript"></script>
<script src="upload.js" type="text/javascript"></script>
<h1>Upload your movie list</h1>
<div id="area">
	<img src="images/loading.gif" alt="Loading" />
</div>
<?php
bottom();
?>