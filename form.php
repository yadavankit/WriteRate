<!DOCTYPE html>
<html>
<head>
	<title>HR | Home</title>
	<!-- Compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
  	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

  	<!-- Compiled and minified JavaScript -->
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</head>
<body>

<style type="text/css">
	body{
		font-family: 'Open Sans', sans-serif;
	}
</style>

	<nav class="teal">
    <div class="nav-wrapper" style="margin-left: 20px;">
      <a href="#" class="brand-logo">Handwriting Rater</a>
    </div>
  </nav>
	<form action="photoupload.php" enctype="multipart/form-data" method="post">
		<div class="row container">
			<div class="col s4">
				<input type="text" name="alphabet1" class="validate" id="alphabet1">
				<label for="alphabet1">Enter The alphabets:</label>
				<div class="file-field input-field">
      				<div class="btn">
        				<span>File</span>
		        		<input type="file" name="photo1">
		    		</div>
				</div>
			</div>
			<div class="col s4">
				<input type="text" name="alphabet2" class="validate" id="alphabet2">
				<label for="alphabet2">Enter The alphabets:</label>
				<div class="file-field input-field">
      				<div class="btn">
        				<span>File</span>
		        		<input type="file" name="photo2">
		    		</div>
				</div>
			</div>
			<div class="col s4">
				<input type="text" name="alphabet3" class="validate" id="alphabet3">
				<label for="alphabet3">Enter The alphabets:</label>
				<div class="file-field input-field">
      				<div class="btn">
        				<span>File</span>
		        		<input type="file" name="photo3">
		    		</div>
				</div>
			</div>
		</div>

		<div class="row container">
			<div class="col s6">
				<input type="text" name="alphabet4" class="validate" id="alphabet4">
				<label for="alphabet4">Enter The alphabets:</label>
				<div class="file-field input-field">
      				<div class="btn">
        				<span>File</span>
		        		<input type="file" name="photo4">
		    		</div>
				</div>
			</div>
			<div class="col s6">
				<input type="text" name="alphabet5" class="validate" id="alphabet5">
				<label for="alphabet1">Enter The alphabets:</label>
				<div class="file-field input-field">
      				<div class="btn">
        				<span>File</span>
		        		<input type="file" name="photo5">
		    		</div>
				</div>
			</div>
		</div>
			
			<div class="container">
				<input class="btn" type="submit">
			</div>
	</form>
	</div>
	
</body>
</html>