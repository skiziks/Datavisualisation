<?php
require_once('./connexion.php');

$sql = "SELECT
    ROUND(humidity, 1) AS humidite_arrondie,
    ROUND(pressure, 1) AS pression_arrondie,
    AVG(temp) AS moyenne_temp
FROM (
    SELECT
        humidity,
        pressure,
        temp,
        ROW_NUMBER() OVER (ORDER BY dt_iso) AS row_num,
        COUNT(*) OVER () AS total_count
    FROM `donnee___donnee`
) AS ranked_data
WHERE row_num % CEIL(total_count / 100) = 0
GROUP BY humidite_arrondie, pression_arrondie;";

$resultBubble = mysqli_query($bdd, $sql);

// Vérifiez si la requête s'est bien déroulée
if ($resultBubble) {
    // Récupérez les données sous forme de tableau associatif
    $data = mysqli_fetch_all($resultBubble, MYSQLI_ASSOC);

    // Encodez le tableau associatif en JSON et renvoyez-le
    $result = json_encode($data, JSON_NUMERIC_CHECK);
    echo $result;
} else {
    // En cas d'erreur dans la requête SQL
    echo json_encode(['error' => 'Erreur dans la requête SQL.']);
}
