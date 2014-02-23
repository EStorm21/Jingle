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

$maxSleep = 0;
$maxSleepTime = 0;
$sleepStart = 0;
$sleepEnd = 0;
$maxAwake = 0;
$maxAwakeTime = 0;
$awakeStart = 0;
$awakeEnd = 0;
foreach($sleepListFilt as $key => $val) {
	if ($val) {//if asleep
		$sleepEnd = $key;
		if ($sleepStart == 0) {
			$sleepStart = $key;
		}
		$awakeStart = 0;
		$awakeEnd = 0;
	} else {
		$awakeEnd = $key;
		if ($awakeStart == 0) {
			$awakeStart = $key;
		}
                $sleepStart = 0;
                $sleepEnd = 0;
        }

	if ($sleepStart) {//if there is a streak running
		$streak = strtotime($sleepEnd)- strtotime($sleepStart);
		if ($streak > $maxSleep) {
			$maxSleep = $streak;
			$maxSleepTime = $sleepStart;
		}
	}
	if ($awakeStart) {//if there is a streak running
                $streakAwake = strtotime($awakeEnd)- strtotime($awakeStart);
                if ($streakAwake > $maxAwake) {
                        $maxAwake = $streakAwake;
                        $maxAwakeTime = $awakeStart;
                }
        }

}

$last_key = strtotime(key( array_slice( $sleepListFilt, -1, 1, TRUE ) ));
$first_key = strtotime(key( array_slice( $sleepListFilt, 0, 1, TRUE ) ));

$days = ceil(($last_key-$first_key)/(3600*24));
$sampleTotal = $days*24*60/10;
$averageSleep = array_sum($sleepListFilt)/$sampleTotal*24;
$hours = floor($averageSleep);
echo "<p>Average sleep per night: " . $hours . " hours " . floor(($averageSleep-$hours)*60) . " minutes" . "<br>";

$hours = floor($maxAwake/3600);
echo "Your longest contiguous period awake is: " . $hours . " hours " . floor(($maxAwake-$hours*3600)/60) . " minutes starting " . $maxAwakeTime;

$hours = floor($maxSleep/3600);
echo "<br>Your longest sleep is: " . $hours . " hours " . floor(($maxSleep-$hours*3600)/60) . " minutes on " . $maxSleepTime . "</p>";

?>



<script type="text/javascript">

$(document).ready(function(){
  plot1 = $.jqplot('chart1', <?php echo plotString($sleepListFilt) ?>, {
    title:'Sleep History',
    axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer, tickOptions:{formatString:'%#m/%e %#I:%M %p'}}, 
	 },
    seriesColors:["#491057"],
    series:[{lineWidth:4, markerOptions:{style:'circle',size:2}}],
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
    title:'Raw Sleep History',
    axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer, tickOptions:{formatString:'%#m/%e %#I:%M %p'}},
         },
    seriesColors:["#491057"],
    series:[{lineWidth:4, markerOptions:{style:'circle',size:2}}],
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
<p>Here is a summary of  when you have been sleeping, or at least when someone has been in your bed. <?php echo $name ?> filters the raw data to provide a more accurate prediction.</p>
<div id="chart1"></div>
<br><p>This is the unfiltered data collected from <?php echo $name ?>'s sensors. Early analysis suggests that this information will be able to be used to estimate quality of sleep. Eventually this view will be discontinued, but it sure is cool to look at as a comparison, isn't it?</p>
<div id="chart2"></div>
<!-- <button value="reset" onclick="plot1.resetZoom();">Reset</button> -->


</body>

</html>
