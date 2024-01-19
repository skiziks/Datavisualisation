<?php
require_once('./connexion.php');

$sqlTemp = "SELECT YEAR(dt_iso) AS annee, AVG(temp) AS moyenne_temp
            FROM donnee___donnee
            WHERE dt_iso BETWEEN '2003-01-01' AND '2023-12-31'
            GROUP BY annee
            ORDER BY annee;
";

$resultTemp = mysqli_query($bdd, $sqlTemp);
$dataTemp = array();

while ($row = mysqli_fetch_assoc($resultTemp)) {
    // arrondi à 2 chiffres après la virgule
    $row['moyenne_temp'] = round($row['moyenne_temp'], 2);
    array_push($dataTemp, $row);
}

// Conversion en format JSON
$dataTempJSON = json_encode($dataTemp, JSON_NUMERIC_CHECK);

// Envoi des données JSON au JavaScript
echo $dataTempJSON;
