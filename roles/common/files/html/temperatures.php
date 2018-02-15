<?php
$output = [];

exec("sensors -A coretemp-isa-0000", $output);

array_shift($output);

$cpu_temps = array_map(function($core_temp) {
	return trim(str_replace("+", "", preg_split("/[\s]+/", $core_temp)[2])); 
}, $output);

$gpu_temps = [];
exec("nvidia-smi --query-gpu=temperature.gpu --format=csv,noheader", $gpu_temps);

array_pop($cpu_temps);

header('Content-Type: application/json');

echo json_encode(['cpu' => ['cores' => $cpu_temps], 'gpu' => $gpu_temps]);
?>
