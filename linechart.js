function handleSelectRangeChange() {
    var select = document.getElementById("select");
    var value = select.value;

    // Mettre à jour les données du graphique
    $.ajax({
        url: "./getDataTemp.php",
        type: "POST",
        data: {
            range: value
        },
        dataType: "json",
        success: function (data) {
            myChart.data.labels = generateLabels(value);
            myChart.data.datasets[0].data = data.temp;
            myChart.data.datasets[1].data = data.humidity;
            myChart.update();

            document.querySelector(".resultVarTemp").innerHTML = data.varianceTemp;
            document.querySelector(".resultEcartTemp").innerHTML = data.stdDeviationTemp;
            document.querySelector(".resultVarHum").innerHTML = data.varianceHumidity;
            document.querySelector(".resultEcartHum").innerHTML = data.stdDeviationHumidity;

        },
        error: function (data) {
            console.log("Erreur lors de la récupération des données : " + data);
        }
    });


    // console.log(value);
}

function generateLabels(range) {
    var currentYear = 2022 - range + 1; // Calculer l'année initiale en fonction de la plage
    var labels = [];
    for (var i = 0; i <= range; i++) {
        labels.push(currentYear + i);
    }
    return labels;
}
// chart basique chart js

var ctxLineChart = document.getElementById('lineChart').getContext('2d');
var myChart = new Chart(ctxLineChart, {
    type: 'line',
    data: {
        labels: generateLabels(1),
        datasets: [{
            label: 'Température moyenne à Paris au cours des 20 dernières années (°C)',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }, {
            label: 'Humidité moyenne à Paris au cours des 20 dernières années (%)',
            data: [],
            backgroundColor: [
                'rgba(120, 90, 1, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 12, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    // min: 0,
                    // max: 30,
                }
            }]
        }
    }
});