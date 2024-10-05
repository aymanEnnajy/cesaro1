<?php
header('Content-Type: text/html; charset=UTF-8');
$serveur = "localhost"; // Serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "projet_finetude"; // Nom de la base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);
if($connexion->connect_error){
    die("pas de connexion". $connexion->connect_error);
}

// Récupérer le nom du produit à supprimer
$nom_produit = $_POST['nom_produit'];

// Requête pour vérifier si le produit existe dans la base de données
$querey = "SELECT * FROM produit WHERE NOM_PDT='$nom_produit'";
$result = $connexion->query($querey);

// Exécuter la requête de suppression si le produit existe
if ($result->num_rows > 0) {
    $sql = "DELETE FROM produit WHERE NOM_PDT = '$nom_produit'";
    if ($connexion->query($sql) === TRUE) {
        echo "<script>alert('Le produit est supprimé avec succès.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression du produit : " . $connexion->error . "');</script>";
    }
} else {
    echo "<script>alert('Aucun produit trouvé avec ce nom.');</script>";
}

// Fermer la connexion
$connexion->close();
?>
