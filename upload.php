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
set_time_limit(1000);
flush();
$result = post("/add_movies", $params);
print_r($result);
?>
<script type="text/javascript">
	document.getElementById('loading').innerHTML = '';
</script>
<div id="results">
	<h2>I couldn't figure out what movie you meant with the following files. Please select the correct movie or enter a better movie name (you might want to find the exact name from IMDB.)</h2>
	<?php
	foreach ($result->non_matches as $non_match) {
		?>
		<div class="nonmatch">
			Filename: <?= $non_match->filename ?><br />
			<?php
			foreach ($non_match->matches as $match) {
				?>
				<label><input type="radio" name="<?= $non_match->filename ?>" />Possible match: <?= $match->name ?> (<?= $match->year ?>)</label><br />
				Or, <label>Enter your own name<input type="text" /></label>
				<?php	
			}
			?>
		</div>
		<?php
	}
	?>
</div>
<?php
bottom();
?>