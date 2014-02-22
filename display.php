<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<?php include('header.php'); ?>
<head>
<title><?php echo $name ?></title>

</head>
<body>

        <div class="jumbotron">
		<div class="container">
                	<h1><?php echo $name ?>: The Home Sensory Network</h1>
        	</div>
	</div>

	<div class="container">

      <div>
        <h2>Data Summary</h2>
        <p class="lead">Below is analysis of data collected by <?php echo $name ?>.
      </div>
      <!-- This section is used to plugin additional data visualization modules -->
	<?php
        include('sleep.php');
        ?>
    </div><!-- /.container -->

  </body>
</html>

