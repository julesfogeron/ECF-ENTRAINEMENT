<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueille</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h2>Liste utilisateur</h2>
    <div class="ajouter">
        <label>Ajouter User</label>
        <IMG class="image" src="image/plus-sign-expansion.png" onclick="window.location='ajouter.php'">
    </div>
    <table id="myTable">
        <thead>
            <tr>
                <th class="barre">Nom Prenom</th>
                <th class="barre">E-mail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                // Connectez-vous à la base de données
                include('configBDD.php');
                /** @var Stringable $hostname_BDD */
                /** @var Stringable $database_BDD */
                /** @var Stringable $username_BDD */
                /** @var Stringable $password_BDD */
                $conn = new PDO("mysql:host=$hostname_BDD;dbname=$database_BDD", $username_BDD, $password_BDD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Vérifiez la connexion
                if ($conn) {
                    // Vérifiez si le nom d'utilisateur existe déjà
                    $stmt = $conn->prepare('Select nom,email From user');
                    $stmt->execute();
                    foreach ($stmt as $data) {
                        echo '<tr>';
                        echo '<td class="barre">' . $data['nom'] . '</td>';
                        echo '<td class="barre">' . $data['email'] . '</td>';
                        echo '</tr>';
                    }

                } else {
                    // Erreur de connexion
                    echo "Erreur : connexion à la base de données échouée.";
                }
            } catch (PDOException $e) {
                // Gérez les erreurs de connexion
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>

</body>
</html>