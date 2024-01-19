let popup = document.getElementById('moreInfo');

// popup.style.display = 'none';

function closePopup() {
    popup.style.opacity = '0';
}

function openPopup() {
    popup.style.opacity = '1';
    popupInfo();
    console.log("popup ouverte");
}






function popupInfo() {

    $.ajax({
        url: "./getTempYears.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Extraction des valeurs nécessaires pour la régression linéaire
            let years = data.map(entry => entry.annee);
            let temperatures = data.map(entry => entry.moyenne_temp);

            // Calcul de la régression linéaire
            let linearRegression = regression.linear(data.map(entry => [entry.annee, entry.moyenne_temp]));

            // Obtenez les coefficients de la régression linéaire
            let slope = linearRegression.equation[0];
            let intercept = linearRegression.equation[1];

            // Préparation des données pour le graphique
            let linearRegressionData = years.map(year => ({
                x: year,
                y: slope * year + intercept
            }));

            // Affichage des résultats
            console.log("Pente (slope) : " + slope);
            console.log("Intercept : " + intercept);

            // Création du graphique avec la régression linéaire
            let ctx = document.getElementById('graphiqueLineaire').getContext('2d');
            let linearChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Régression Linéaire',
                        data: linearRegressionData,
                        borderColor: 'rgba(255, 0, 0, 1)',
                        borderWidth: 2,
                        fill: false
                    }, {
                        label: 'Température Moyenne',
                        data: temperatures,
                        borderColor: 'rgba(0, 0, 255, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: 'Année',
                                font: {
                                    size: 14,
                                }
                            }
                        },
                        y: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Température Moyenne',
                                font: {
                                    size: 14,
                                }
                            }
                        }
                    }
                }
            });

        },
        error: function (data) {
            console.log("Erreur" + data);
        }
    });

}
