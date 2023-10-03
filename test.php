<?php
date_default_timezone_set('Asia/Jakarta');
$url = "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml";
$xml_data = file_get_contents($url);
$xml = simplexml_load_string($xml_data);
$weather_data = [];
$current_time = date('Y-m-d H:i:s');
foreach ($xml->forecast->area as $area) {
    $location_name = (string)$area['description'];
    $temperature = isset($area->parameter[0]->timerange->value) ? (string)$area->parameter[0]->timerange->value : "";
    $humidity = isset($area->parameter[1]->timerange->value) ? (string)$area->parameter[1]->timerange->value : "";
    $current_weather = isset($area->parameter[2]->timerange->value) ? (string)$area->parameter[2]->timerange->value : "";

    $weather_data[] = [
        'location' => $location_name,
        'temperature' => $temperature,
        'humidity' => $humidity,
        'current_weather' => $current_weather,
        'time' => $current_time,
        // Tambahkan lebih banyak data cuaca ke dalam subarray ini sesuai kebutuhan.
    ];
}
header("Content-Type: application/json");
echo json_encode($weather_data);
?>
