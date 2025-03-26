<?php
$client = $_GET['client'] ?? 'clienta';

$cars = json_decode(file_get_contents('../../../../data/cars.json'), true);

$filteredCars = array_filter($cars, fn($car) => $car['customer'] === $client);

echo "<ul>";

foreach ($filteredCars as $car) {
    echo "<li class='car-item' data-id='{$car['id']}'>";
    echo "<strong>{$car['modelName']}</strong> - {$car['brand']} ";
    echo "<span style='background-color: {$car['colorHex']}; padding: 3px 10px; border-radius: 5px;'></span>";


    echo "</li>";
}

echo "</ul>";
?>
