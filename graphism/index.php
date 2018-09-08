
<!DOCTYPE html>
<html>
<?php
include("functions.php");


 ?>
 <link rel="stylesheet" type="text/css" href="chosen.min.css">
 <link rel="stylesheet" type="text/css" href='../node_modules/lightgallery.js/dist/css/lightgallery.min.css'>
<link rel="stylesheet" type="text/css" href="gallery_js/styles.css">
<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">

<body>
	<section id="graphism">

			<div class="sublinks">
				<?php
					printSublinks();
				 ?>
			</div>


		<div id="creation_content">

	<script src="gallery_js/jquery-3.1.1.min.js"></script>
	<script src="chosen.jquery.min.js"></script>
	<script type="text/javascript" src="../node_modules/lightgallery.js/dist/js/lightgallery.min.js"></script>
	<script src="gallery_js/main.js"></script>
	<script src="gallery_js/graphism.js"></script>
	<script type="text/javascript" src="gallery_js/popper.min.js"></script>
	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

			<?php include("gallery.php"); ?>


		</div>


	</section>

</body>
</html>
