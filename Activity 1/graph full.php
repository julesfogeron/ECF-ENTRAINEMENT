<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graph full</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/graph full.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<?php
session_start();
?>





<?php include('headerConecter.php') ?>

<div class="frame-1">
    <div class="frame-13">
        <label class="text" id="text" ></label>
        <div class="frame-14">
            <div class="graphique" onclick="changerImageGraphique()">Graphique</div>
            <div class="line-1"></div>
            <div class="trading-view" onclick="changerImageTradingView()">Trading view</div>
        </div>
    </div>
    <div class="graph-div" id="graph-div" >
        <canvas id="graph"></canvas>
    </div>
    <div class="image-3" >
        <img class="image-6" id="image" />
    </div>
</div>
<script>
    const objet = location.search.substring(1).split('=')[1];
    console.log(objet)
    text()
    changerImageGraphique()

    function text() {
        var text = document.getElementById("text")
        text.innerHTML = objet
    }

    function changerImageGraphique() {
        document.getElementById("graph-div").hidden = false;
        graph("graph",objet);
        var img = document.getElementById("image");
        img.src = "";
    }

    function changerImageTradingView() {
        document.getElementById("graph-div").hidden = true;
        var img = document.getElementById("image");
        img.src = "image/image-"+ objet +"-Trading-View.png";
    }

    function graph(id,name){
        var reponse = fetch("https://api.coingecko.com/api/v3/coins/" + name.toLowerCase() + "/market_chart?vs_currency=eur&days=1").then(res => res.json()).then((data) => { return data; });

        function graphreponse(jsonElement) {
            let ctx = document.getElementById(id)
            var date = []
            var valeur = []
            for (let i = 1; i < jsonElement.length; i++) {
                var datee = new Date(jsonElement[i]["0"])
                date.push(datee.getHours() + "h " + datee.getMinutes() + "m " + datee.getSeconds() + "s")
                valeur.push(jsonElement[i]["1"])
            }

            let data = {
                labels: date,
                datasets: [{
                    label: name,
                    data: valeur,
                    borderColor: "#475460"
                }]
            }
            console.log(data)
            new Chart(ctx,{
                type: "line",
                data: data,
                options: {
                    responsive: true
                }
            });
        }

        reponse.then((json) => graphreponse(json["prices"]))
    }


</script>


<?php include('footer.html') ?>
</body>
</html>