<?php

include "regresi.php";

$dataset = read_CSV("dataset.csv");
$regresi = regresiLinier(array_slice($dataset, 1));
?>


<!DOCTYPE html>
<html>
<head>
	<title>Analisis Linear Regresi</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="grid-semantic/grid.min.css">
	<script src="plotly-latest.min.js"></script>
</head>
<body>
	<h1>Analisa Regresi Linear Sederhana</h1>
	<br><br>
	<div class="ui grid">
		<div class="four wide column">
			<table>
				<thead>
					<?php foreach($dataset[0] as $title){  ?>
					<th><?php echo $title ?></th>
					<?php } ?>
				</thead>
				<tbody>
					<?php  for($i=1; $i < sizeof($dataset); $i++) { ?>
					<tr>
						<?php foreach($dataset[$i] as $value){  ?>
						<td><?php echo $value ?></td>
						<?php } ?>
					</tr>
					<?php } ?>

				</tbody>
			</table>

		</div>
		<div class="four wide column">
			<strong>Dataset scatter plot</strong>
			<div id="scatter-plot" style="width:350px;height:350px;"></div>
		</div>

		<div class="four wide column">
			<strong>Hasil Prediksi</strong>
			<div id="plot-result" style="width:350px;height:350px;"></div>
		</div>
	</div>
	

	<script>
		scatter = document.getElementById('scatter-plot');
		resultPlot = document.getElementById('plot-result');


		var data = {
			x: [
				<?php for ($i=1; $i < sizeof($dataset); $i++) { 
					echo $dataset[$i][0]?> ,					 
				<?php } ?>
			],
			y: [
				<?php for ($i=1; $i < sizeof($dataset); $i++) { 
					echo $dataset[$i][1]?> ,					 
					<?php } ?>
			],
			mode: 'markers',
			name : 'training',
			type: 'scatter'
			};

			var resultData = {
				x: [
					<?php for ($i=15; $i < 35; $i++) {
						echo $i?> ,					 
					<?php } ?>
				],
				y: [
					<?php for ($i=15; $i < 35; $i++) { 
						echo $regresi["constant"] + ($regresi["coeff"] * $i) ?> ,					 
					<?php } ?>
				],

				mode: 'lines',
				name : 'prediksi',
				type: 'scatter'
			};

			var resultData = [resultData,data];

			var data = [data];
			Plotly.newPlot(scatter, data);


			Plotly.newPlot(resultPlot, resultData);
			</script>


		</body>
		</html>