<?php
header('Content-Type: text/html; charset=UTF-8');
// Connexion à la base de données
$serveur = "localhost"; // Serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "projet_finetude"; // Nom de la base de données

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tele = $_POST['tele'];
    $adresse = $_POST['adresse'];

    // Vérifier si l'email existe déjà dans la base de données
    $checkEmailQuery = "SELECT MAIL_FOUR FROM fournisseur WHERE MAIL_FOUR = ?";
    if ($checkStmt = $connexion->prepare($checkEmailQuery)) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Email exists, show an alert and do not add the supplier
            echo "<script>
                    alert('Cet email existe déjà dans la base de données.');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            // Préparer la requête SQL d'insertion
            $sql = "INSERT INTO fournisseur (NOM_FOUR, PRENOM_FOUR, MAIL_FOUR, TEL_FOUR, ADRESSE_FOUR) VALUES (?, ?, ?, ?, ?)";

            if ($stmt = $connexion->prepare($sql)) {
                // Lier les variables aux paramètres de la requête préparée
                $stmt->bind_param("sssis", $nom, $prenom, $email, $tele, $adresse);

                // Exécuter la requête
                if ($stmt->execute()) {
                    echo "<script>
                            alert('Fournisseur ajouté avec succès.');
                            window.location.href = 'index.php';
                          </script>";
                } else {
                    echo "Erreur lors de l'ajout du fournisseur : " . $stmt->error;
                }

                // Fermer la requête préparée
                $stmt->close();
            } else {
                echo "Erreur lors de la préparation de la requête : " . $connexion->error;
            }
        }

        // Fermer la requête de vérification
        $checkStmt->close();
    } else {
        echo "Erreur lors de la préparation de la requête de vérification : " . $connexion->error;
    }
}

// Fermer la connexion
$connexion->close();
?>
