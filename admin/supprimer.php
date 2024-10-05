
<?php


// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'projet_finetude';

$conn = mysql_connect($db_host, $db_username, $db_password);
mysql_select_db($db_name);
$homes = file_get_contents('changepassword.html');
// Get form data
$email = mysql_real_escape_string($_POST['emailadmin_sup']);
$password = mysql_real_escape_string($_POST['passwadmin_sup']);

// Check if user exists
$query = "SELECT * FROM admine WHERE email_admin='$email' AND password_admin='$password'";
$result = mysql_query($query);

if (mysql_num_rows($result) > 0) {
    // User exists, delete user
    $delete_query = "DELETE FROM admine WHERE email_admin='$email' AND password_admin='$password'";
    $delete_result = mysql_query($delete_query);

    if ($delete_result) {
        echo "<script>alert('Le compte est suprimé');
  
        document.getElementById('passwadmin_sup').value = '';
            document.getElementById('emailadmin_sup').value = '';
        </script>";
        echo $homes;
    } else {
        echo "Error deleting user: " . mysql_error();
    }
} else {
    // User does not exist
    echo "<script>alert('Email ou mot de pass incorrect');
  
    document.getElementById('passwadmin_sup').value = '';
        document.getElementById('emailadmin_sup').value = '';
        
    </script>";
    echo $homes;
    
}

// Close connection
mysql_close($conn);
?>

