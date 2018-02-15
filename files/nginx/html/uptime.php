<?php
$uptime = [];
exec("uptime -p", $uptime);
implode($uptime);

header('Content-Type: application/json');

echo json_encode(['uptime' => $uptime]);
