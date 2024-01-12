<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
<?php
session_start();
$username = $_SESSION["username"];
if (empty($username)){
    header('Location: index.php');
}

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
        $stmt = $conn->prepare('SELECT * FROM user WHERE utilisateur = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["dateDeNaissance"] = $user["dateDeNaissance"];
        $_SESSION["email"] = $user["email"];

    } else {
        // Erreur de connexion
        echo "Erreur : connexion à la base de données échouée.";
    }
} catch (PDOException $e) {
    // Gérez les erreurs de connexion
    echo "Erreur : " . $e->getMessage();
}

// Vérifiez si le formulaire a été soumis
if (isset($_POST['modifier'])) {
    // Récupérez les données du formulaire
    $nom = $_POST['nom'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = true;

    //vérifier si ce n'est pas vide
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


    if ($pass){
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
                $stmt = $conn->prepare('UPDATE user SET nom = ?,dateDeNaissance = ?,email = ?,utilisateur = ? where 1');
                $stmt->execute(array($nom,$birthdate,$email,$username));

                $_SESSION["nom"] = $nom;
                $_SESSION["dateDeNaissance"] = $birthdate;
                $_SESSION["email"] = $email;
                $_SESSION["username"] = $username;
                header('Location: profile.php');
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

// Vérifiez si le formulaire a été soumis
if (isset($_POST['supprimer'])) {
    // Récupérez les données du formulaire
    $nom = $_POST['nom'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = true;

    //vérifier si ce n'est pas vide
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

    if ($pass){
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
                $stmt = $conn->prepare('DELETE FROM user where utilisateur = ?');
                $stmt->execute(array($nom));
                header('Location: index.php');
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


<?php include('headerConecter.php') ?>

<div class="frame-1">
    <div class="frame-7">
        <div class="profile">Profile </div>
        <div class="cryptomonnaies">Cryptomonnaies</div>
    </div>
    <div class="frame-8">
        <div class="frame-9">
            <div class="image">IMAGE</div>
        </div>
        <form class="frame-12" method="post">
            <div class="group-7" >
                <div class="frame-2">
                    <div class="nom-pr-nom">Nom / Prénom</div>
                    <?php
                    $id = "nom";
                    $nom = $_SESSION["nom"];
                    echo "<input class='frame-13' type=\"text\" value=\"$nom\" id=\"$id\" name=$id />"; ?>
                    <div class="date-de-naissance">Date de naissance</div>
                    <?php
                    $id = "birthdate";
                    $nom = $_SESSION["dateDeNaissance"];
                    echo "<input class='frame-22' type=\"date\" value=\"$nom\" id=\"$id\" name=$id />"; ?>
                </div>
                <div class="frame-3">
                    <div class="adresse-e-mail">Adresse e-mail</div>
                    <?php
                    $id = "email";
                    $nom = $_SESSION["email"];
                    echo "<input class='frame-5' type=\"email\" value=\"$nom\" id=\"$id\" name=$id />"; ?>
                    <div class="nom-d-utilisateur">Nom d’utilisateur</div>
                    <?php
                    $id = "username";
                    $nom = $_SESSION["username"];
                    echo "<input class='frame-4' type=\"text\" value=\"$nom\" id=\"$id\" name=$id />"; ?>
                </div>
            </div>
            <div class="frame-72">
                <input class="frame-6" type="submit" value="Modifier" name="modifier" id="modifier">
                <input class="frame-73" type="submit" value="Supprimer" name="supprimer" id="supprimer">
            </div>
        </form>
    </div>
    <div class="frame-10">
        <div class="frame-11" onclick="window.location.href='graph full.php?text=Bitcoin'">
            <div class="bitcoin">Bitcoin</div>
            <img class="image-6" src="image/image-Bitcoin.png" alt="image courbe Bitcoin" />
        </div>
        <div class="frame-122" onclick="window.location.href='graph full.php?text=Ethereum'">
            <div class="ethereum">Ethereum</div>
            <img class="image-10" src="image/image-Ethereum.png" alt="image courbe Ethereum" />
        </div>
    </div>
</div>

<?php include('footer.html') ?>
</body>
</html>