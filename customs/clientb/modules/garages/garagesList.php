<?php
$garages = json_decode(file_get_contents('../../../../data/garages.json'), true);

$client = $_GET['client'] ?? 'clienta';

// Only proceed if client is Client B
if ($client !== 'clientb') {
    echo "Access denied.";
    exit;
}

$clientGarages = array_filter($garages, function ($garage) use ($client) {
    return $garage['customer'] === $client;
});

// List of garages
echo "<ul>";
foreach ($clientGarages as $garage) {
    echo "<li class='garage-item' data-id='{$garage['id']}'>";
    echo "<strong>{$garage['title']}</strong> - {$garage['address']}";
    echo "</li>";
}
echo "</ul>";
?>
