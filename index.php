<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datavisualisation</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/regression/2.0.1/regression.min.js" integrity="sha512-0k6FXllQktdobw8Nc8KQN2WtZrOuxpMn7jC2RKCF6LR7EdOhhrg3H5cBPxhs3CFzQVlO6ni1B9SDLUPhBs0Alg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- librairie analyse de fourier -->


    <!-- <script src="https://cdn.jsdelivr.net/npm/ml-fft@2.0.3/dist/dist.min.js"></script> -->

    <link rel="stylesheet" href="./style.css">
</head>

<body class="container">
    <header class="header">
        <figure>
            <img src="./logoData.svg" alt="Paris">
        </figure>
        <section>
            <p><strong>Graphique à Bulle :</strong> <br><br> - Corrélation entre l’humidité et la pression atmosphérique en fonction de la témpétature</p>
            <br><br>
            <p><strong>Graphique en donuts :</strong> <br><br> - Répartition des différents temps au cours d’une année choisi</p>
            <br><br>
            <p><strong>Graphique en ligne :</strong> <br><br> - Évolution de la témprature et de la pression atmosphérique au cours du temps sur une plage d’années choisi</p>
            <a class="infographie" href="./Artboard.pdf" download>Infographie</a>
        </section>
    </header>
    <main>
        <button onclick="openPopup()">Exploitation des résultats</button>
        <article>
            <canvas id="bubbleChart" height="100%"></canvas>
        </article>
        <section>
            <article class="lineChart">
                <canvas id="lineChart"></canvas>
                <label for="select" class="valueSliderRange">Plage d'analyse :</label>
                <select name="select" id="select" onchange="handleSelectRangeChange()">
                    <option value="5">5 ans</option>
                    <option value="7">7 ans</option>
                    <option value="10">10 ans</option>
                    <option value="13">13 ans</option>
                    <option value="15">15 ans</option>
                    <option value="17">17 ans</option>
                    <option value="20">20 ans</option>
                </select>
            </article>

            <article class="donutChart">
                <canvas id="doughnutChart"></canvas>
                <label for="selectWeather" class="valueSelectWeather">Année d'étude :</label>
                <select name="selectWeather" id="selectWeather" onchange="handleWeatherChange()">
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                </select>
            </article>
        </section>
    </main>
    <section id="moreInfo">
        <button onclick="closePopup()" class="close">X</button>
        <article class="wrapper1">
            <div>
                <canvas id="graphiqueLineaire"></canvas>
            </div>
            <p>La variation de la température analysé sur 20 ans à une progression qui varie beaucoup mais possède une courbe de régression linéaire qui se développe petit à petit sur les années étudiés.
                <br>En effet, on peut voir une évolution d’environ 12 degrés en 2003 à environ 13,5 degrés en 2023.
                <br>On peut donc observer une augmentation de 1,5 degré sur 20 ans.
                <br>Cette augmentation risque de dépasser les 1,5 degrés tous les 20 ans si aucune action n’est faite entre temps.
            </p>
        </article>
        <article class="wrapper2">
            <p>À travers l'analyse statistique des données recueillies au cours des 20 dernières années, nous observons des tendances distinctes en ce qui concerne la température et l'humidité.
                <br>En ce qui concerne la température, la faible variance de 0,3 indique une variation relativement minime entre les années étudiées. Cette constatation est renforcée par l'écart type de 0,5, qui représente la moyenne des écarts individuels par rapport à la moyenne, démontrant ainsi une stabilité relative des températures annuelles.
                <br>En revanche, pour l'humidité, les valeurs présentent une variance significativement plus élevée de 1,87, indiquant une variabilité plus marquée entre les années. L'écart type de 1,87 confirme cette variabilité en exprimant la dispersion moyenne des valeurs d'humidité par rapport à la moyenne annuelle.
            </p>
            <aside>
                <p><strong>Variance de la température :</strong> <span class="resultVarTemp"></span></p>
                <p><strong>Écart type de la température :</strong> <span class="resultEcartTemp"></span></p>
                <p><strong>Variance de l'humidité :</strong> <span class="resultVarHum"></span></p>
                <p><strong>Écart type de l'humidité :</strong> <span class="resultEcartHum"></span></p>
            </aside>
        </article>
        <article class="wrapper3">
            <p>En analysant le graphique à bulles, une corrélation significative entre la pression atmosphérique, l'humidité et la température émerge clairement. Les enregistrements se regroupent principalement dans la plage de pression atmosphérique de 1010 à 1020 Pascal, où une tendance se dessine : les températures tendent à être plus élevées lorsque l'humidité est plus faible.
                <br>Une observation intéressante est que les valeurs de pression atmosphérique inférieures à 1010 Pascal ou supérieures à 1020 Pascal sont principalement associées à des enregistrements de température basse et d'humidité élevée. Ceci suggère que lorsque la pression atmosphérique dévie des valeurs habituelles, cela est souvent accompagné d'une baisse de température et d'une augmentation de l'humidité. Ces variations pourraient indiquer des conditions atmosphériques particulières associées à des situations de température plus fraîche et d'humidité accrue.
            </p>
        </article>
    </section>
</body>
<script src="./linechart.js"></script>
<script src="./doughnuts.js"></script>
<script src="./bubble.js"></script>
<script src="./popup.js"></script>
<script>
    // Appeler la fonction handleSliderRangeChange() au chargement de la page
    document.addEventListener("DOMContentLoaded", function() {
        handleSelectRangeChange();
        handleWeatherChange();
        handleBubbleChange();
        popupInfo();
    });
</script>

</html>