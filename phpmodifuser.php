<?php
session_start();
$host = 'localhost';
$dbname = 'projet_finetude';
$username = 'root';
$password = '';

// Check if the user is logged in
if (!isset($_SESSION['ID_UTIL'])) {
    $userLoggedIn = false;
} else {
    $userLoggedIn = true;
    $userId = $_SESSION['ID_UTIL'];
}

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $codepostal = $_POST['codepostal'];
    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $pass = $_POST['pass'];
    $confirmpass = $_POST['confirmpass'];

    // Prepare and execute update query
    $updateQuery = "UPDATE util SET NOM_UTLI=?, PRENOM_UTLI=?, ADRESSE__UTLI=?, email_util=?, TEL_UTLI=?, CODE_POSTAL=?, VILLE_UTIL=?, Password_uti=?, confirm_password=? WHERE ID_UTIL=?";
    $updateStmt = $conn->prepare($updateQuery);
    
    // Check if prepare() succeeded
    if ($updateStmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    // Bind parameters
    $updateStmt->bind_param('ssssissssi', $nom, $prenom, $adresse, $email, $tel, $codepostal, $ville, $pass, $confirmpass, $userId);
    
    // Execute statement
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        // Update successful
        echo '<script>
            alert("les modification sont enregistrer");
            window.location.href="profil.php";
        </script>';
    } else {
        // Update failed
        echo '<div class="alert alert-danger" role="alert">Failed to update profile.</div>';
    }

    // Close update statement
    $updateStmt->close();
}
?>
