<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edison Ways</title>
	<link rel="icon" type="image/png" href="images/favicon.png" />

	<link href="jquery-ui.css" rel="stylesheet">
	<link href="icones-salles.css" rel="stylesheet">
	<link href="hover.css" rel="stylesheet">
	<script src="external/jquery/jquery.js"></script>

	<script src="jquery.menu-aim.js"></script>
<script src="main.js"></script> <!-- Resource jQuery -->
<script src="jquery-ui.js"></script>

<link rel="stylesheet" href="reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

<link rel="stylesheet" type="text/css" href="tinytools.css">


<script src="tinytools.js"></script>

<script src="graphs.js"></script>
	<style>
	
	select {
		width: 200px;
	}
	
	</style>
	</head>
<body>
	 <div id="legendDiv">Consommation en KWatt</div>
	<canvas id="myChart" width="400" height="400"></canvas>
	
	<script type="text/javascript">
	var ctx = document.getElementById("myChart").getContext("2d");
	
var data = {
    labels: ["0h00","0h15","0h30","0h45","1h00","1h15","1h30","1h45","2h00","2h15","2h30","2h45","3h00","3h15","3h30","3h45","4h00","4h15","4h30","4h45","5h00","5h15","5h30","5h45","6h00","6h15","6h30","6h45","7h00","7h15","7h30","7h45","8h00","8h15","8h30","8h45","9h00","9h15","9h30","9h45","10h00","10h15","10h30","10h45","11h00","11h15","11h30","11h45","12h00","12h15","12h30","12h45","13h00","13h15","13h30","13h45","14h00","14h15","14h30","14h45","15h00","15h15","15h30","15h45","16h00","16h15","16h30","16h45","17h00","17h15","17h30","17h45","18h00","18h15","18h30","18h45","19h00","19h15","19h30","19h45","20h00","20h15","20h30","20h45","21h00","21h15","21h30","21h45","22h00","22h15","22h30","22h45","23h00","23h15","23h30","23h45","24h00","24h15","24h30","24h45",],
 datasets: [
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 0, 27, 2,58,2,3,6,8,46,8,59,54,96,4,96,2,59,63,5,45,6,59,46,4,4,84,61,54,65,65,84,61,6,64,4,61,58,15,15,49,46,16,49,45,15,94,16,84,28, 48, 40, 19, 0, 27, 2,58,2,3,6,8,46,8,59,24,96,4,96,2,59,63,5,95,6,59,46,4,4,84,1,54,65,15,84,61,64,64,4,61,58,15,15,49,46,16,49,45,15,4,16,84]
        }
    ]
};
var myLineChart = new Chart(ctx).Line(data,{   pointDotRadius : 0,pointHitDetectionRadius : 2,scaleFontSize: 12.5});

 /*document.getElementById("legendDiv").innerHTML = myBarChart.generateLegend();*/
function newgraph(str)
{
	var ctx = document.getElementById("myChart").getContext("2d");
	
var data = {
    labels: ["0h00","0h15","0h30","0h45","1h00","1h15","1h30","1h45","2h00","2h15","2h30","2h45","3h00","3h15","3h30","3h45","4h00","4h15","4h30","4h45","5h00","5h15","5h30","5h45","6h00","6h15","6h30","6h45","7h00","7h15","7h30","7h45","8h00","8h15","8h30","8h45","9h00","9h15","9h30","9h45","10h00","10h15","10h30","10h45","11h00","11h15","11h30","11h45","12h00","12h15","12h30","12h45","13h00","13h15","13h30","13h45","14h00","14h15","14h30","14h45","15h00","15h15","15h30","15h45","16h00","16h15","16h30","16h45","17h00","17h15","17h30","17h45","18h00","18h15","18h30","18h45","19h00","19h15","19h30","19h45","20h00","20h15","20h30","20h45","21h00","21h15","21h30","21h45","22h00","22h15","22h30","22h45","23h00","23h15","23h30","23h45","24h00","24h15","24h30","24h45",],
 datasets: [
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 0, 27, 2,58,2,3,6,8,46,8,59,54,96,4,96,2,59,63,5,45,6,59,46,4,4,84,61,54,65,65,84,61,6,64,4,61,58,15,15,49,46,16,49,45,15,94,16,84,28, 48, 40, 19, 0, 27, 2,58,2,3,6,8,46,8,59,24,96,4,96,2,59,63,5,95,6,59,46,4,4,84,1,54,65,15,84,61,64,64,4,61,58,15,15,49,46,16,49,45,15,4,16,84]
        }
    ]
};
var myLineChart = new Chart(ctx).Line(data,{   pointDotRadius : 0,pointHitDetectionRadius : 2,scaleFontSize: 12.5});
document.getElementById('legendDiv').innerHTML=str.value;
 
}
</script>
<select name="select" id="selectmenu" >
	 <option value="Aujourd'hui" selected>Aujourd'hui</option>
  <option value="30/11/2015">J-1</option> 
  <option value="29/11/2015">J-2</option>
  <option value="28/11/2015">J-3</option>
   <option value="27/11/2015">J-4</option> 
  <option value="26/11/2015">J-5</option>
  <option value="25/11/2015">J-6</option>
   
</select>

<script type="text/javascript">
$( "#selectmenu" ).selectmenu({
change: function( mouseup, ui ) {newgraph(this);}
});
</script>