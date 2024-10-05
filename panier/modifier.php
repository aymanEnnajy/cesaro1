<?php 
session_start();
$host = 'localhost';
$dbname = 'projet_finetude';
$username = 'root';
$password = '';

// Check if the user is logged in
if (!isset($_SESSION['ID_UTIL'])) {
    die('User not logged in.');
}

// Get parameters from POST request
if (isset($_POST['id']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['productName'])) {
    $productId = $_POST['id'];
    $newQuantity = $_POST['quantity'];
    $price = $_POST['price'];
    $productName = $_POST['productName'];

    // Create a connection to the database
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

    // Query to retrieve the category of the product based on the product name
    $categoryQuery = "SELECT categorie_prod FROM produit WHERE NOM_PDT = ?";
    $categoryStmt = $conn->prepare($categoryQuery);
    $categoryStmt->bind_param("s", $productName);
    $categoryStmt->execute();
    $categoryStmt->bind_result($category);
    $categoryStmt->fetch();
    $categoryStmt->close();

    // Check if the category is retrieved
    if (empty($category)) {
        die('Invalid product name.');
    }

    // Determine new total based on category
    if ($category == 1) {
        $newTotal = $newQuantity * $price; // Category 1: qt * prix = total
    } elseif ($category == 2) {
        $newTotal = $newQuantity * $price * 9; // Category 2: prix * 9
    } else {
        die('Invalid category.');
    }

    // Prepare update statement
    $query = "UPDATE panier SET quanti_addcart = ?, pdtmontantTotal_adcart = ? WHERE id_adcart = ? AND ID_UTIL = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ddii", $newQuantity, $newTotal, $productId, $_SESSION['ID_UTIL']);

    // Execute update
    if ($stmt->execute()) {
        echo "Database updated successfully.";
    } else {
        echo "Error updating database: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
