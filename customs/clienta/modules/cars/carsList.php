<?php
$cars = json_decode(file_get_contents('../../../../data/cars.json'), true);

$client = $_GET['client'] ?? 'clienta';

// Filter cars based on the client (for client A)
$clientCars = array_filter($cars, function ($car) use ($client) {
    return $car['customer'] === $client;
});

$currentYear = date("Y");

echo "<ul>";

foreach ($clientCars as $car) {
    // Calculate the car's age
    $carAge = $currentYear - date("Y", $car['year']);

    $class = '';
    if ($carAge > 10) {
        $class = 'old-car';  // Red color for cars older than 10 years
    } 
    
    if ($carAge < 2) {
        $class = 'new-car';  // Green color for cars less than 2 years old
    }

    echo "<li class='car-item $class' data-id='{$car['id']}'>";
    echo "<strong>{$car['modelName']}</strong> - ". date("Y", $car['year']) ." - {$car['brand']}";
    echo "</li>";
}

echo "</ul>";
?>
