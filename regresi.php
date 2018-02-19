<?php


function read_CSV($csvPath){
	$file = fopen($csvPath, 'r');
	$flag = true;
	while (($line = fgetcsv($file)) !== FALSE) {		 
  		$data[] = $line;
	}
	fclose($file);
	return $data;
}


function regresiLinier($dataset){
	$zigmaXSquared = 0;
	$zigmaYSquared = 0;
	$zigmaX = 0;
	$zigmay = 0;
	$zigmaXY = 0;
	$coeff = 0; // b
	$constant = 0; //a

	foreach ($dataset as $point) {
		$zigmaXSquared = $zigmaXSquared + ($point[0] * $point[0]);
		$zigmaYSquared = $zigmaYSquared + ($point[1] * $point[1]);
		$zigmaXY = $zigmaXY + ($point[0] * $point[1]);
		$zigmaX = $zigmaX + $point[0];
		$zigmay = $zigmay + $point[1];
	}

	$constant =  (($zigmay * $zigmaXSquared) - ($zigmaX * $zigmaXY)) / (sizeof($dataset) * $zigmaXSquared - $zigmaX * $zigmaX);
	$coeff = ($zigmaXY * sizeof($dataset) - $zigmaX * $zigmay ) / (sizeof($dataset) * $zigmaXSquared - $zigmaX * $zigmaX);

	$result["constant"] = $constant;
	$result["coeff"] = $coeff;

	return $result;
}




