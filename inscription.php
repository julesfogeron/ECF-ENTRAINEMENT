<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>inscption</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inscription.css">
</head>
<body>
<?php

// Vérifiez si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérez les données du formulaire
    $nom = $_POST['nom'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $username = $_POST['utilisateur'];
    $password = $_POST['password'];
    $pass = true;

    if (empty($nom)){
        echo "Erreur : le nom ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($birthdate)) {
        echo "Erreur : le Date de naissance ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($email)) {
        echo "Erreur : le mail ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($username)) {
        echo "Erreur : le nom d'utilisateur ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($password)) {
        echo "Erreur : le mot de passe ne peut pas être vide. ";
        $pass = false;
    }


    // Si la validation est réussie, créez le compte
    if ($pass) {
        try {
            // Connectez-vous à la base de données
            include ('configBDD.php');
            /** @var Stringable $hostname_BDD */
            /** @var Stringable $database_BDD */
            /** @var Stringable $username_BDD */
            /** @var Stringable $password_BDD */
            $conn = new PDO("mysql:host=$hostname_BDD;dbname=$database_BDD", $username_BDD, $password_BDD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifiez la connexion
            if ($conn) {
                // Vérifiez si le nom d'utilisateur existe déjà
                $stmt = $conn->prepare('SELECT id FROM user WHERE utilisateur = ?');
                $stmt->execute(array($username));
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Si le nom d'utilisateur existe déjà, affichez un message d'erreur
                if ($user) {
                    echo "Erreur : le nom d'utilisateur existe déjà.";
                }

                // Si le nom d'utilisateur n'existe pas, créez un nouveau compte
                else {
                    // Créez un enregistrement pour le nouvel utilisateur
                    $stmt = $conn->prepare('INSERT INTO user (utilisateur, password, email, dateDeNaissance, nom) VALUES (?, ?, ?, ?, ?)');
                    $stmt->execute(array($username, md5($password), $email, $birthdate, $nom));

                    // Redirigez l'utilisateur vers la page de connexion
                    header('Location: index.php');
                }
            } else {
                // Erreur de connexion
                echo "Erreur : connexion à la base de données échouée.";
            }
        } catch (PDOException $e) {
            // Gérez les erreurs de connexion
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Sinon, affichez un message d'erreur
    else {
        echo "Erreur : toute les case doit être remplie";
    }
}
?>

<?php include('header.html') ?>

<div class="corps">
    <form class="box" action="" method="post" name="inscription">
        <label class="nom-pr-nom" for="nom">Nom / Prénom</label>
        <input class="text-nom" type="text" id="nom" name="nom">
        <label class="date-de-naissance" for="birthdate">Date de naissance</label>
        <input class="text-date-de-naissance" type="date" id="birthdate" name="birthdate">
        <label class="adresse-e-mail" for="email">Adresse e-mail</label>
        <input class="text-adresse-e-mail" type="email" id="email" name="email">
        <label class="nom-d-utilisateur" for="utilisateur">Nom d’utilisateur</label>
        <input class="text-nom-utilisateur" type="text" id="utilisateur" name="utilisateur">
        <label class="mot-de-passe" for="password">Mot de passe</label>
        <input class="text-password" type="password" id="password" name="password">
        <input class="button-s-inscrire" type="submit" value="s'inscrire" name="submit">
    </form>
</div>

<?php include('footer.html') ?>
</body>
</html>