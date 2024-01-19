function handleWeatherChange() {
    var weatherValue = document.getElementById("selectWeather").value;
    $.ajax({
        url: "./getDataWeather.php",
        type: "POST",
        data: {
            year: weatherValue
        },
        success: function (dataWeather) {
            // decode le json
            dataWeatherParse = JSON.parse(dataWeather);
            // Les données sont renvoyées en tant qu'objet, accédez à data.temp et data.humidity
            camChart.data.datasets[0].data = dataWeatherParse;
            camChart.update();
            // console.log("success " + dataWeatherParse);
        },
        error: function (data) {
            console.log("erreur" + dataWeatherParse);
        }
    });

}





var ctxLineChart = document.getElementById('doughnutChart').getContext('2d');
var camChart = new Chart(ctxLineChart, {
    type: 'doughnut',
    data: {
        labels: ['Soleil', 'Nuages', 'Pluie', 'Pluie légère', 'Vent', 'Brume', 'Neige', 'Brouillard fort', 'Tempête'],
        datasets: [{
            label: 'Temps à Paris au cours de chaque année en pourcentage (%)',
            data: [],
            backgroundColor: [
                '#E2E533',
                '#E4E5DB',
                '#2FEAD9',
                '#A9F5EE',
                '#DC9CFB',
                '#ED7A3D',
                '#FFFFFF',
                '#000000',
                '#FF0000',
            ],
        }]
    },
});