<?php
// Include database connection
include_once 'db_connection.php';

// Check if form is submitted for modification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve modified product information from form
    $product_name = $_POST['proddModifNom'];
    $category = $_POST['categModif'];
    $description = $_POST['prodModifDescription'];
    $price = $_POST['prodModifPrice'];
    $picture = $_POST['prodModifImage'];

    // Prepare and execute SQL query to update product information
    $stmt = $pdo->prepare("UPDATE produit SET categorie_prod=?, DESCR_PDT=?, PRIX_PDT=?, image_pdt=? WHERE NOM_PDT=?");
    $stmt->execute([$category, $description, $price, $picture, $product_name]);

    // Check if update was successful
    if ($stmt->rowCount() > 0) {
        echo "Product information updated successfully!";
    } else {
        echo "Failed to update product information.";
    }
}
?>
