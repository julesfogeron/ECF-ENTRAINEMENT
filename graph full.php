<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Graph full</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/graph%20full.css">
</head>
<body>
<?php
session_start();
?>


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
        var img = document.getElementById("image");
        img.src = "image/image-"+ objet +".png";
    }

    function changerImageTradingView() {
        var img = document.getElementById("image");
        img.src = "image/image-"+ objet +"-Trading-View.png";
    }
</script>


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
    <div class="image-3" >
        <img class="image-6" src="image/image-Bitcoin.png" id="image" alt="Graphique"/>
    </div>
</div>


<?php include('footer.html') ?>
</body>
</html>