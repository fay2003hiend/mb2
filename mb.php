<?php
$response = "";
error_reporting(7);
$imsi = trim($_POST['imsi']);

if (strlen($imsi) != 15) {
	$response = "invalid imsi! should be 15 digits";
}
else {
	$column = 0;
	$tmp = 0;
	for ($i = 0; $i < 15; $i++) {
		$imei_intA[$i] = intval($imsi[$i]);
		$tmp = ($i + 3) | ($imei_intA[$i] % 3);
		$column^= $tmp + $i;
		$column+= $imei_intA[$i];
	}

	$column_num = $column % 5;
	if ($column_num == 0) {
		for ($i = 0; $i < 9; $i++) $imei_intB[$i] = $imei_intA[$i + 6];
		for ($i = 0; $i < 6; $i++) $imei_intB[9 + $i] = $imei_intA[$i];
	}
	else
	if ($column_num == 1) {
		for ($i = 0; $i < 12; $i++) $imei_intB[$i] = $imei_intA[$i + 3];
		for ($i = 0; $i < 3; $i++) $imei_intB[12 + $i] = $imei_intA[$i];
	}
	else
	if ($column_num == 2) {
		for ($i = 0; $i < 9; $i++) $imei_intB[$i] = $imei_intA[$i + 6];
		for ($i = 0; $i < 6; $i++) $imei_intB[9 + $i] = $imei_intA[$i];
	}
	else
	if ($column_num == 3) {
		for ($i = 0; $i < 6; $i++) $imei_intB[$i] = $imei_intA[$i + 9];
		for ($i = 0; $i < 9; $i++) $imei_intB[6 + $i] = $imei_intA[$i];
	}
	else
	if ($column_num == 4) {
		for ($i = 0; $i < 3; $i++) $imei_intB[$i] = $imei_intA[$i + 12];
		for ($i = 0; $i < 12; $i++) $imei_intB[3 + $i] = $imei_intA[$i];
	}

	$code = "";
	for ($i = 0; $i < 15; $i++) {
		$imei_intC[$i] = ($imei_intA[$i] + 1) ^ ($imei_intB[$i] + 2);
		if ($imei_intC[$i] >= 10) $imei_intC[$i]%= 10;
		$code.= strval($imei_intC[$i]);
	}

	$response = "Your code is: " . $code;
}

echo $response;
?>
