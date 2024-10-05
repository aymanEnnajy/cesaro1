<?php

// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'projet_finetude';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$homes = file_get_contents('fournisseur.php');

// Get form data
$email = $conn->real_escape_string($_POST['FOURSUP']);

// Check if user exists
$query = "SELECT * FROM fournisseur WHERE MAIL_FOUR='$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // User exists, delete user
    $delete_query = "DELETE FROM fournisseur WHERE MAIL_FOUR='$email'";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Le compte est suprimé');
            document.getElementById('passwadmin_sup').value = '';
            document.getElementById('emailadmin_sup').value = '';
        </script>";
        echo $homes;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    // User does not exist
    echo "<script>alert('il y a un erreur');
        document.getElementById('passwadmin_sup').value = '';
        document.getElementById('emailadmin_sup').value = '';
    </script>";
    echo $homes;
}

// Close connection
$conn->close();
?>
