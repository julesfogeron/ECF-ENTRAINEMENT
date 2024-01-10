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
        include ('configBDD.php');
        /** @var Stringable $hostname_BDD */
        /** @var Stringable $database_BDD */
        /** @var Stringable $username_BDD */
        /** @var Stringable $password_BDD */
        $conn = new PDO("mysql:host=$hostname_BDD;dbname=$database_BDD", $username_BDD, $password_BDD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifiez la connexion
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE utilisateur = ? AND password = ?");
            // Hachez le mot de passe avec md5
            $stmt->execute(array($utilisateur, md5($password)));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Connexion réussie, redirigez vers le profil
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
        <!- envoi le formulaire avec la method post
        <form class="box" action="" method="post" name="login">
            <label class="identifient" for="utilisateur">Identifient</label>
            <input class="text-identifient" type="text" id="utilisateur" name="utilisateur">
            <label class="mot-de-passe" for="password">Mot de passe</label>
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