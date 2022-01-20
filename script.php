<?php
$contentType = $_SERVER["CONTENT_TYPE"];

if ($contentType == "application/json") {
    $rawData = file_get_contents("php://input");
    $json = json_decode($rawData, true);
    $data = $json["svg"];
} else {
    $data = file_get_contents("input.svg");
}

$svgFilename = tempnam("/tmp", "svg");
file_put_contents($svgFilename, $data);

$pngFileName = tempnam("/tmp", "png");

exec("inkscape --without-gui --export-area-drawing --export-background='#ffffff' --export-png=$pngFileName $svgFilename");

$fp = fopen($pngFileName, "rb");

header("Content-Type: image/png");
header("Content-Length: " . filesize($pngFileName));

fpassthru($fp);
