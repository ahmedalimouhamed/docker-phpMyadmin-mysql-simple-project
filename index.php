<!DOCTYPE html>
<html>
<head>
    <title>Consultation et ajout d'informations dans la base de données</title>
</head>
<body>
    <h2>Informations de la base de données</h2>

    <?php
    // Informations de connexion à la base de données
    $servername = 'localhost'; // Remplacez par l'adresse de votre serveur MySQL
    $username = 'root'; // Remplacez par votre nom d'utilisateur MySQL
    $password = ''; // Remplacez par votre mot de passe MySQL
    $database = 'db-test-docker'; // Remplacez par le nom de votre base de données

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $database);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les informations de la table
    $sql = "SELECT * FROM utilisateurs";
    $result = $conn->query($sql);

    // Vérifier si des résultats ont été trouvés
    if ($result->num_rows > 0) {
        // Afficher les informations dans un tableau
        echo "<table><tr><th>Nom</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nom"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Aucune information trouvée dans la base de données.";
    }

    // Formulaire d'ajout
    echo "<h2>Ajouter une nouvelle information</h2>";
    echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
    echo "<label for='name'>Nom :</label>";
    echo "<input type='text' id='name' name='name' required><br><br>";
    echo "<label for='email'>Email :</label>";
    echo "<input type='email' id='email' name='email' required><br><br>";
    echo "<input type='submit' value='Ajouter'>";
    echo "</form>";

    // Traitement du formulaire d'ajout
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];

        // Requête SQL pour insérer les nouvelles données dans la table
        $insertSql = "INSERT INTO utilisateurs (nom, email) VALUES ('$name', '$email')";
        if ($conn->query($insertSql) === TRUE) {
            echo "Nouvelle information ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'information : " . $conn->error;
        }
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
</body>
</html>