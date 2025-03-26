<?php
$cars = json_decode(file_get_contents("../../../../data/cars.json"), true);
$garages = json_decode(file_get_contents("../../../../data/garages.json"), true);

$client = $_GET['client'] ?? 'clienta';

$clientGarages = [];
foreach ($garages as $garage) {
    $clientGarages[$garage['id']] = $garage['title'];
}

$cars = array_filter($cars, function ($car) use ($client) {
    return $car['customer'] === $client;
});

echo "<ul>";
foreach ($cars as $car) {
    $garageName = $clientGarages[$car['garageId']] ?? 'Garage inconnu';
    echo "<li class='car-item' data-id='{$car['id']}'>";
    echo "<strong>{$car['modelName']}</strong> - {$car['brand']} (Garage : $garageName)";
    echo "</li>";
}
echo "</ul>";
?>
