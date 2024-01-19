<?php
require_once('./connexion.php');
$year = $_POST['year'];

$sql = "SELECT (COUNT(weather_main) / (SELECT COUNT(*) FROM donnee___donnee WHERE YEAR(dt_iso) = $year)) * 100 AS percentage
FROM donnee___donnee
WHERE YEAR(dt_iso) = $year
GROUP BY weather_main;";

$resultWeather = mysqli_query($bdd, $sql);
$dataWeather = array();
while ($row = mysqli_fetch_assoc($resultWeather)) {
    // transforme les données en entier et arrondi à 3 chiffres après le point
    $row['percentage'] = number_format((float)$row['percentage'], 2, '.', '');
    array_push($dataWeather, $row['percentage']);
}

echo json_encode($dataWeather);
