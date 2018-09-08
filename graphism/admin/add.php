<?php
require_once('../bd.php');
require_once('../token.php');

if(!isset($_POST)) {
	echo '<script>document.location = "' .SITE_URL. "/admin/index.php" . '";</script>';
}
else {
	$code = htmlspecialchars($_POST['code']);
	if($code != $CODE_REQUIRED) {
		echo '<script>document.location = "' .SITE_URL. "/admin/index.php" . '";</script>';
	}
}


/*if(!isLogged($con)) {
	header("Location: ".SITE_URL."admin/login.php");

	die();

	echo '<script type="text/javascript">window.location = "http://creaphy.royalwebhosting.net/admin/login.php"</script>';
}*/
?>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="chosen.min.css">

<style type="text/css">
div.col-sm-4 {
	height:450px;
}
</style>


<div class="col-sm-4"></div>

<div class="col-sm-5">
<br><br><br>
	<h2>Creations</h2>
	<form action="addProcess.php" method="post">
		<input type="checkbox" name="creation" checked style="display:none">
		<table style="text-align:left;margin:auto;">
			<tr>
				<td width="150">Catégorie</td>
				<td width="200"><select name="category" required>


					<?php

					$tables = $con->query('SELECT * FROM categories ORDER BY name ASC');
					foreach ($tables as $table) {
						$name = $table['name'];
						echo '<option value="'. $table['id'] .'">' . $name . '</option>';
					}

					?>

				</select>
				<input type="checkbox" name="request" value="commande"> Commande

			</td>
		</tr>
		<tr>
			<td>Nom Prénom</td>
			<td><input type="text" name="celeb" size="35">

				<select class="add" multiple="true" name="celeb">
					<?php
					$query = "SELECT * FROM celebrities ORDER BY name ASC";
					foreach ($con->query($query) as $celebrity) {
						echo '<option value="' . $celebrity['name'] . '">' . $celebrity['name'] . '</option>';
					}

					?>
				</select>

			</td>
		</tr>
		<tr>
			<td>Nom de la commande</td>
			<td><input type="text" name="name" size="35">

				<select class="add" multiple="true" name="name">
					<?php
					$query = "SELECT * FROM creations ORDER BY title ASC";
					foreach ($con->query($query) as $name) {
						echo '<option value="'.$name['title'].'">' . $name['title'] . '</option>';
					}

					?>
					<!-- <option>Vide! disisisisisii</option> -->
				</select>

			</td>
		</tr>
		<tr>
			<td>HTML</td><td><textarea cols="45" rows="10" type="text" name="desc" required></textarea></td>
		</tr></table>
		<input type="submit">
	</form>
</div>



<script src="jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
<script type="text/javascript" src="chosen.jquery.min.js"></script>
<script type="text/javascript">

	/*ADD*/
	$('.add').chosen({
		search_contains : true
	});
	$('.add_1').chosen({
		search_contains : true,
		max_shown_results: 3

	});
</script>
