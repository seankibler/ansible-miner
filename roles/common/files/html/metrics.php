<?php

# Uptime
$uptime = [];
exec("uptime -p", $uptime);
implode($uptime);

# Hashrate

$hashrate = json_decode(file_get_contents("http://localhost:10000/api.json"));

# Get CPU data
$sensors_output = [];

exec("sensors -A", $sensors_output);

array_shift($sensors_output);
array_pop($sensors_output);

$cpu_temps = [];
for ($x = 0; $x < count($sensors_output); $x++) {
    $m = [];
    preg_match("/Core\s+[\d]+:\s+\+([\d]+\.[\d])+/", $sensors_output[$x], $m);

    if (sizeof($m) > 0) {
      $cpu_temps[] = $m[1];
    }
};

# Get GPU data
// exec("sensors -A | grep -A4 amdgpu | grep temp1 | awk '{ print $2 }'", $gpu_output);

$gpu_temps = [];
for ($x = 0; $x < count($sensors_output); $x++) {
    $m = [];
    preg_match("/temp1:\s+\+([\d]+\.[\d]+)/", $sensors_output[$x], $m);

    if (sizeof($m) > 0) {
      $gpu_temps[] = $m[1];
    }
};

# Get GPU fan speeds
// exec("sensors -A | grep -A4 amdgpu | grep fan1 | awk '{ printf \"%s %s\n\", $2, $3 }'", $gpu_output);

$gpu_fans = [];
for ($x = 0; $x < count($sensors_output); $x++) {
    $m = [];
    preg_match("/fan1:\s+([\d]+\s+RPM|N\/A)/", $sensors_output[$x], $m);

    if (sizeof($m) > 0) {
      $gpu_fans[] = $m[1];
    }
};

# Return as JSON
$data = [
  'uptime' => $uptime,
  'hashrate' => $hashrate,
  'cpu' => [
    'temps' => $cpu_temps
  ],
  'gpu' => [
    'temps' => $gpu_temps,
    'fans' => $gpu_fans
  ],
];

header('Content-Type: application/json');
echo json_encode($data, JSON_FORCE_OBJECT);
?>
