<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php 
//$projectNames = ['Jingle', 'Crash', 'Symphony', 'Prometheus', 'Artemis', 'Roger', 'Apollo', 'Darwin', 'Mercury', 'Ironwell', 'Stratos', 'Dirac'];
//$name = $projectNames[array_rand($projectNames)];
?>
<html>
<head>
<?php include('header.php'); ?>
<title><?php echo $name ?></title>

</head>
<body>

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $name ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="sleep.php">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

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
	<?php
        include('sleep.php');
        ?>
    </div><!-- /.container -->

  </body>
</html>

