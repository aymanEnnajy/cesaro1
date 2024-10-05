<?php
header('Content-Type: text/html; charset=UTF-8');
session_start(); // Start the session
$page_produit = file_get_contents('produit.php');
$servername = "localhost"; // your database server
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "projet_finetude"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if session data is set for the product
if (isset($_SESSION['product'])) {
    $product = $_SESSION['product'];
    unset($_SESSION['product']); // Clear session data after retrieving
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $productName = $_POST['product_name'];
    $sql = "SELECT categorie_prod, NOM_PDT, DESCR_PDT, PRIX_PDT, image_pdt FROM produit WHERE NOM_PDT = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $productName);
    $stmt->execute();
    $stmt->bind_result($categorie_prod, $NOM_PDT, $DESCR_PDT, $PRIX_PDT, $image_pdt);
    $product = null;
    if ($stmt->fetch()) {
        $product = array(
            'categorie_prod' => $categorie_prod,
            'NOM_PDT' => $NOM_PDT,
            'DESCR_PDT' => $DESCR_PDT,
            'PRIX_PDT' => $PRIX_PDT,
            'image_pdt' => $image_pdt
        );
    }
    $stmt->close();
    
    if ($product) {
        $_SESSION['product'] = $product; // Store product data in session
        header("Location: produit.php?product=" . urlencode(json_encode($product)));
    } else {
        echo "<script>
        alert('aucun produit trouvé');
        window.location.href = 'produit.php'; // Refresh the page
        </script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $oldProductName = $_POST['old_product_name'];
    $newProductName = $_POST['product_name'];
    $categorie_prod = $_POST['categorie_prod'];
    $DESCR_PDT = $_POST['DESCR_PDT'];
    $PRIX_PDT = $_POST['PRIX_PDT'];

    $image_pdt = $_POST['existing_image']; // Default to existing image
    if (isset($_FILES['image_pdt']) && $_FILES['image_pdt']['error'] == UPLOAD_ERR_OK) {
        // Handle file upload
        $target_dir = "images/"; // Define the target directory
        $target_file = $target_dir . basename($_FILES['image_pdt']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['image_pdt']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES['image_pdt']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['image_pdt']['tmp_name'], $target_file)) {
                $image_pdt = $target_file; // Use the new image path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $sql = "UPDATE produit SET NOM_PDT=?, categorie_prod=?, DESCR_PDT=?, PRIX_PDT=?, image_pdt=? WHERE NOM_PDT=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $newProductName, $categorie_prod, $DESCR_PDT, $PRIX_PDT, $image_pdt, $oldProductName);
    
    if ($stmt->execute()) {
        echo "<script>
        alert('Produit est modifié');
        window.location.href = 'produit.php'; // Redirect to the product page
        </script>";
    } else {
        echo "Error updating product: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
