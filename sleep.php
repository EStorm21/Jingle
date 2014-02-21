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
$sleepListFilt = [];
$bridge = 0;
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
				$sleepListFilt[$date] = $coords[1];
				if ($coords[1]) {
					$bridge = $coords[0];
				} else {
					if ( $coords[0] - $bridge < 3600) { //one hour
				//echo "in";
						$sleepListFilt[$date] = 1;
						//echo $sleepListFilt[$date];
						echo $sleepListFilt[$date+1];
					}
				}
			}
		}
	}
	$keys = [];
	$sleepListFilt = $sleepList;
	$count = 0;
	$start = 0;
	foreach($sleepList as $key => $val) {
		if($val) {
			foreach($keys as $i) {
				$sleepListFilt[$i] = 1;
			}
			$keys = [];
			$count = 0;
			$start = 1;
		} else {
			++$count;
			if ($start) {
				array_push($keys, $key);
			}
		}
		if ($count >= 7) {
			$start = 0;
			$count = 0;
			$keys = [];
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
  plot1 = $.jqplot('chart1', <?php echo plotString($sleepListFilt) ?>, {
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

  plot2 = $.jqplot('chart2', <?php echo plotString($sleepList) ?>, {
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

//$('#button-reset').click(function() { alert('clicked'); plot1.resetZoom() });



</script>

<div id="chart1"></div>
<div id="chart2"></div>
<!-- <button value="reset" onclick="plot1.resetZoom();">Reset</button> -->


</body>

</html>
