<?php

$client = $_GET['client'] ?? 'clienta';
$carId = $_GET['car_id'] ?? null;

if (!$carId) {
    echo "No car selected.";
    exit;
}

$cars = json_decode(file_get_contents('../data/cars.json'), true);
$garages = json_decode(file_get_contents('../data/garages.json'), true);
$selectedCar = null;

foreach ($cars as $car) {
    if ($car['id'] == $carId && $car['customer'] === $client) {
        $selectedCar = $car;
        break;
    }
}

if (!$selectedCar) {
    echo "Car not found.";
    exit;
}

$garageName = null;
foreach ($garages as $garage) {
    if ($garage['id'] == $selectedCar['garageId'] && $garage['customer'] === $client) {
        $garageName = $garage['title'];
        break;
    }
}

?>

<h2>Edit Car: <?= htmlspecialchars($selectedCar['modelName']) ?></h2>
<p><strong>Brand:</strong> <?= htmlspecialchars($selectedCar['brand']) ?></p>
<p><strong>Year:</strong> <?= htmlspecialchars(date("Y", $selectedCar['year'])) ?></p>
<p><strong>Power:</strong> <?= htmlspecialchars($selectedCar['power']) ?> hp</p>
<p><strong>Color:</strong> <span style="background-color: <?= $selectedCar['colorHex'] ?>; padding: 5px 15px; border-radius: 5px;"></span></p>

<?php if ($garageName): ?>
    <p><strong>Garage:</strong> <?= htmlspecialchars($garageName) ?></p>
<?php else: ?>
    <p><strong>Garage:</strong> Not assigned</p>
<?php endif; ?>

<button onclick="loadContent()">Back</button>
