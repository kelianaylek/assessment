<?php
$client = $_GET['client'] ?? 'clientb';
$garageId = $_GET['garage_id'] ?? null;

if (!$garageId) {
    echo "No garage selected.";
    exit;
}

// Load the garages data
$garages = json_decode(file_get_contents('../../../../data/garages.json'), true);

// Find the selected garage
$selectedGarage = null;
foreach ($garages as $garage) {
    if ($garage['id'] == $garageId && $garage['customer'] === $client) {
        $selectedGarage = $garage;
        break;
    }
}

if (!$selectedGarage) {
    echo "Garage not found.";
    exit;
}

// Display the garage details
?>
<h2>Garage Details: <?= htmlspecialchars($selectedGarage['title']) ?></h2>
<p><strong>Address:</strong> <?= htmlspecialchars($selectedGarage['address']) ?></p>

<button id="backToList" onclick="backToGarageList()">Back to List</button>

<script>
    function backToGarageList() {
        let client = new URLSearchParams(window.location.search).get('client') || 'clienta';
        $(".dynamic-div").load(`customs/clientb/modules/garages/garagesList.php?client=clientb`);
    }
</script>
