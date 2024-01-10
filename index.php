<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueille</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
<?php
session_start();

// Vérifiez si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérez les données du formulaire
    $utilisateur = $_POST['utilisateur'];
    $password = $_POST['password'];

    // Effectuez la connexion à la base de données
    try {
        $conn = new PDO('mysql:host=localhost;dbname=ecf', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifiez la connexion
        if ($conn) {
            // Hachez le mot de passe
            // Vérifiez les informations de connexion
            $stmt = $conn->prepare("SELECT * FROM user WHERE utilisateur = ? AND password = ?");
            $stmt->execute(array($utilisateur, md5($password)));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Connexion réussie, redirigez vers la page principale
                $_SESSION['username'] = $utilisateur;
                header('Location: profile.php');
            } else {
                // Connexion échouée, affichez un message d'erreur
                echo "Erreur : nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            // Erreur de connexion
            echo "Erreur de connexion à la base de données.";
        }
    } catch (PDOException $e) {
        // Gérez les erreurs de connexion
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<?php include('header.html') ?>

<div class="corps">
    <div class="se-conecter">
        <form class="box" action="" method="post" name="login">
            <div class="identifient">Identifient</div>
            <input class="text-identifient" type="text" id="utilisateur" name="utilisateur">
            <div class="mot-de-passe">Mot de passe</div>
            <input class="text-password" type="password" id="password" name="password">
            <input class="button-se-connecter" type="submit" value="Se connecter" name="submit">
        </form>
    </div>
    <div class="s-inscrire">
        <input class="button-s-inscrire" type="submit" value="S'inscrire" onclick="window.location = 'inscription.php'">
    </div>
</div>

<?php include('footer.html') ?>
</body>
</html>