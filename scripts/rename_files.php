<?php
/*
This renames all of our movies and replaces anything that's not a letter, number,
space or dash with an underscore.
*/
$directories = array("/home/movies/Videos/1/movies",
                     "/mnt/movies2/movies",
                     "/mnt/movies3/movies",
                     "/mnt/movies4/movies");

foreach ($directories as $dir) {
	$files = scandir($dir);
	array_shift($files);
	array_shift($files);
	foreach ($files as $file) {
		//echo $file . "\n";
		$movie = pathinfo($file, PATHINFO_FILENAME);
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$new = preg_replace("/[^a-zA-Z0-9\\- ]/", "_", $movie) . "." . $ext;
		//echo "changing " . $file . " to " . $new . "\n";
		rename($dir . "/" . $file, $dir . "/" . $new);
	}	
}
?>