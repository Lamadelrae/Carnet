<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
include "frameworks/navbar.inc.php";
include "backend/view.inc.php";

$username = $_SESSION['username'];
$validatesesh = new usersController();
$validatesesh->validatesesh($username);
?>
<?php
$GetDataPoint = new cliView();
$arr1 = $GetDataPoint->GetDataPoint1();
$arr2 = $GetDataPoint->GetDataPoint2();

$dataPoints = array( array("label"=>"Parcelas Pagas", "y"=>$arr1), array("label"=>"Parcelas em abertas","y"=>$arr2)); 
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>DashBoard</title>
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<div class="container float-left">
 <div class="card" style="width:500px;">
    <div class="card-body">
      <div id="chartContainer" style="width:400px; height:400px;"></div>
    </div>
 </div>
 <br>
 <br>
 <br>
 <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>{"symbol": "FX_IDC:USDBRL", "width": 350, "height": 220, "locale": "br", "dateRange": "12m", "colorTheme": "light", "trendLineColor": "#37a6ef", "underLineColor": "#E3F2FD", "isTransparent": false, "autosize": false, "largeChartUrl": ""}</script>
</div>
</body>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Parcelas Pagas X Parcelas Pendentes"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

