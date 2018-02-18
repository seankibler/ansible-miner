<?php

# Get CPU data
$output = [];

exec("sensors -A coretemp-isa-0000", $output);

array_shift($output);
array_pop($output);

$cpu_temps = [];
for ($x = 0; $x < count($output); $x++) {
    $m = [];
    preg_match("/[\d]+\.[\d]+/", $output[$x], $m);

    $cpu_temps[$x] = $m[0];
};

# Get GPU data
$gpu_temps = [];
exec("nvidia-smi --query-gpu=temperature.gpu --format=csv,noheader", $gpu_temps);

# Return as JSON
$data = [
    'cpu' => [
        'cores' => $cpu_temps
    ],
    'gpu' => $gpu_temps
];
header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
?>
