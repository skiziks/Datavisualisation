<?php
require_once('./connexion.php');

$range = $_POST['range'];
$beginYear = 2023 - $range;

$sqlTemp = "SELECT AVG(temp)
FROM donnee___donnee
WHERE dt_iso BETWEEN '$beginYear-01-01' AND '2023-12-31'
GROUP BY YEAR(dt_iso);
";

$resultTemp = mysqli_query($bdd, $sqlTemp);
$dataTemp = array();
while ($row = mysqli_fetch_assoc($resultTemp)) {
    $row['AVG(temp)'] = round($row['AVG(temp)'], 2);
    array_push($dataTemp, $row['AVG(temp)']);
}

$sqlHumidity = "SELECT AVG(humidity)
FROM donnee___donnee
WHERE dt_iso BETWEEN '$beginYear-01-01' AND '2023-12-31'
GROUP BY YEAR(dt_iso);
";

$resultHumidity = mysqli_query($bdd, $sqlHumidity);
$dataHumidity = array();
while ($row = mysqli_fetch_assoc($resultHumidity)) {
    $row['AVG(humidity)'] = round($row['AVG(humidity)'], 2);
    array_push($dataHumidity, $row['AVG(humidity)']);
}

// Calcul de la variance et de l'écart type
$varianceTemp = calculateVariance($dataTemp);
$stdDeviationTemp = sqrt($varianceTemp);

$varianceHumidity = calculateVariance($dataHumidity);
$stdDeviationHumidity = sqrt($varianceHumidity);

echo json_encode(array(
    'temp' => $dataTemp,
    'humidity' => $dataHumidity,
    'varianceTemp' => round($varianceTemp, 2),
    'stdDeviationTemp' => round($stdDeviationTemp, 2),
    'varianceHumidity' => round($varianceHumidity, 2),
    'stdDeviationHumidity' => round($stdDeviationHumidity, 2)
));

// Fonction pour calculer la variance
function calculateVariance($data)
{
    $mean = array_sum($data) / count($data);
    $variance = array_sum(array_map(function ($temp) use ($mean) {
        return pow($temp - $mean, 2);
    }, $data)) / count($data);

    return $variance;
}
