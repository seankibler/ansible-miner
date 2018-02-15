<?php
$data = file_get_contents("http://localhost:10000/api.json");

header('Content-Type: application/json');

echo $data;
