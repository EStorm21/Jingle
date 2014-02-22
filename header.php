<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

<!-- Optional bootstrap theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<!-- jqplot -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/jqplot.canvasAxisLabelRenderer.js"></script>


<?php
$projectNames = ['Jingle', 'Symphony', 'Prometheus', 'Artemis', 'Roger', 'Apollo', 'Darwin', 'Mercury', 'Ironwell', 'Stratos', 'Dirac'];

include_once 'headerFunctions.php';

//$name = $projectNames[array_rand($projectNames)];
$name = 'Jingle';

include_once 'navbar.php';
?>
<style>
body {
    padding-top: 50px;
}
</style>

