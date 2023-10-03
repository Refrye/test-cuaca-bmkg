<?php
$selected_area = isset($_GET['area']) ? $_GET['area'] : "Surabaya"; // Default ke Surabaya jika tidak ada area yang dipilih
$url = "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml";
$xml_data = file_get_contents($url);
$xml = simplexml_load_string($xml_data);
$weather_data = [];
foreach ($xml->forecast->area as $area) {
    $location_name = (string)$area['description'];
    if ($location_name === $selected_area) {
        $temperature = isset($area->parameter[0]->timerange->value) ? (string)$area->parameter[0]->timerange->value : "";
        $humidity = isset($area->parameter[1]->timerange->value) ? (string)$area->parameter[1]->timerange->value : "";
        $current_weather = isset($area->parameter[2]->timerange->value) ? (string)$area->parameter[2]->timerange->value : "";
        $current_time = date('Y-m-d H:i:s'); // Waktu saat ini
        $weather_data = [
            'location' => $location_name,
            'temperature' => $temperature,
            'humidity' => $humidity,
            'current_weather' => $current_weather,
            'time' => $current_time,
        ];
        break; // Hentikan loop setelah menemukan data untuk daerah yang dipilih
    }
}
header("Content-Type: application/json");
echo json_encode($weather_data);
?>