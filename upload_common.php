<?php
function display_non_matches($result) {
	?>
	<div id="results">
		<h2>I couldn't figure out what movie you meant with the following files. Please select the correct movie or enter a better movie name (you might want to find the exact name from IMDB.)</h2>
		<form method="post" action="upload_again.php">
			<?php
			foreach ($result->non_matches as $non_match) {
				?>
				<div class="nonmatch">
					Filename: <?= $non_match->filename ?><br />
					<?php
					foreach ($non_match->matches as $match) {
						$filename = preg_replace("/ /", "%%%", $non_match->filename);
						?>
						<label><input type="radio" name="<?= $filename ?>" value="<?= $match->name ?>;;;<?= $match->year ?>" />Possible match: <?= $match->name ?> (<?= $match->year ?>)</label><br />
						<?php	
					}
					?>
					<label><input type="radio" name="<?= $filename ?>" value="entered_own" />Or, Enter your own name</label><input type="text" name="<?= $filename ?>;;;own" />
				</div>
				<?php
			}
			?>
			<input type="submit" />
		</form>
	</div>
	<?php
}
?>