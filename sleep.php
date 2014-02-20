<?php include('header.php'); ?>
<html>
<head>

<title>Testing plots functions</title>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jqplot/1.0.8/plugins/jqplot.canvasAxisTickRenderer.js"></script>


</head>

<body>
<h3>Sleep History</h3>
<?php
date_default_timezone_set('America/Los_Angeles');
$file = fopen("8414.sleep","r");
$sleepList = [];
if ($file) {
    	while (($line = fgets($file)) !== false) {
		$data = explode("|", $line);
		foreach($data as $datum) {
			$coords = explode(":", $datum);
			$date = date('m/d/Y h:i:s A', $coords[0]);
			$asleep = $coords[1] ? "Asleep" : "Awake";
			if ($date) {
				//echo $date . " " . $asleep  . "<br>";
				$sleepList[$date]= $coords[1];
			}
		}
	}
} else {
    echo "Failed to open file.";
}

function plotString($data) 
{
	$string = "[[";
	foreach( $data as $key => $val) {
		$string .= "['" . $key . "', " . $val . "], ";
	}
	$string .= "]]";
	return $string;
}
//echo plotString($sleepList); 
?>



<script type="text/javascript">

$(document).ready(function(){
  var line1=[['2008-09-30 4:00PM',4], ['2008-10-30 4:00PM',6.5], ['2008-11-30 4:00PM',5.7], ['2008-12-30 4:00PM',9], ['2009-01-30 4:00PM',8.2]];
  plot1 = $.jqplot('chart1', <?php echo plotString($sleepList) ?>, {
    title:'Sleep History',
    axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer, tickOptions:{formatString:'%#m/%e %#I:%M %p'}}, 
	 },
    series:[{lineWidth:4, markerOptions:{style:'square'}}],
    cursor:{
	show:true,
	zoom:true,
	showTooltip:true,
	showTooltipOutsideZoom:true,
	followMouse:true,
	constrainZoomTo:'x',
	dblClickReset:true
    }, 
    axesDefaults: {
	tickRenderer: $.jqplot.CanvasAxisTickRenderer,
	tickOptions: {
	  angle:-30,
	}
    }
  });
});
$('#button-reset').click(function() { alert('clicked'); plot1.resetZoom() });



</script>

<div id="chart1"></div>
<button value="reset" onclick="plot1.resetZoom();">Reset</button>


</body>

</html>
