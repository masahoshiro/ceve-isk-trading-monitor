<?php
header("Content-type: text/html; charset=utf-8");
require_once('./lib/db.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ISK 比率监测系统</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<script src="./static/js/Chart.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="./static/css/main.css">

	</head>
	<body>
		<div class="header">
			<h1>ISK 比率监测系统</h1>
			<h2>数据取自 秋枫ISK,采集时间为每日 18 点</h2>
		</div>
		<div class="chart" style="width:66%">
			<div>
					<canvas id="canvas" height="350" width="600"></canvas>
			</div>
		</div>
	<div class="footer">
		<p>默认显示近期 30 天的走势,查看其它时段变化情况的功能正在开发 // Copyright © 2015 雅白</p>
	
	</div>
	<script>
	
	<?php
	$db = db::getInstance();
	$db->createcon();
	$query_string = 'SELECT time,price FROM `monitor-data-isk-trade` ORDER BY id LIMIT 30';
	$result = $db->query($query_string);
	$str_time = '';
	$str_price = '';
	while ($row = mysql_fetch_array($result)) {
    	//printf("time: %s  price: %s", $row[0], $row[1]); 
    	$str_time = $str_time . '"' .  $row[0] . '",';
    	$str_price =  $str_price . $row[1] . ',';
	}
	$str_time = substr($str_time,0,-1);	
	$str_price = substr($str_price,0,-1);
	$db->close();

	?>
		//var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [<?php echo $str_time; ?>],
			datasets : [
				{
					label: "ISK",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [<?php echo $str_price; ?>]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>

	</body>
</html>
