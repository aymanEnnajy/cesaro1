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

$total = 0; // Initialize total variable

if ($userLoggedIn) {
    // Query to retrieve products associated with the specific user
    $query = "SELECT id_adcart, pdtNam_adcart, pdtPrice_adcart, quanti_addcart, pdtmontantTotal_adcart, produit.image_pdt, produit.categorie_prod FROM panier JOIN produit ON panier.pdtNam_adcart = produit.NOM_PDT WHERE panier.ID_UTIL = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id_adcart, $pdtNam_adcart, $pdtPrice_adcart, $quanti_addcart, $pdtmontantTotal_adcart, $image, $categorie);

    if (!$stmt) {
        die('Query failed: ' . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="styles.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="log_out.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="index.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        #name {
            font-weight: bold;
            color: black;
        }
        .but {
            background-color: white;
            border: none;
            cursor: pointer;
        }
        #trash {
            color: #f35525;
            font-size: 22px;
        }
        #b1uton {
            background-color: white;
            border: none;
            cursor: pointer;
            font-size: 19px;
            font-weight: bold;
        }
        #b1uton:hover {
            color: #f35525;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #f35525;
        }
        .cart-items {
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            width: 120px;
            height: 105px;
            margin-right: 20px;
        }
        .item-details {
            flex-grow: 1;
        }
        .item-details p {
            margin: 0;
            color: #555;
        }
        .quantity {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }
        .quantity button {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
        }
        .quantity input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
        }
        .summary {
            padding: 20px;
            border-top: 1px solid #ddd;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .validate-button {
            width: 100%;
            padding: 10px;
            background-color: #f35525;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .validate-button:hover {
            background-color: #f35525ad;
        }
       .save{
        background-color:#f35525;
        color:white;
        border:#f35525;
        font-size:14px;
        border-radius:4px;
       }
    </style>
</head>
<body style="padding-top:19px">
    <div  class="container">
        <div><button type="button" id="b1uton" class="but" onclick="goBack()">Retour</button></div>
        <h1>Récapitulatif de mon panier</h1>
        
        <?php if ($userLoggedIn): ?>
            <div class="cart-items">
                <?php
                function getProductDetailsPage($productName) {
                    // Define your logic to determine the correct product details page based on product name
                    if ($productName === 'specificProductName1') {
                        return '../details-pdt_robinet.php?id=' . $id_adcart; // Replace with your actual page name
                    } elseif ($productName === 'specificProductName2') {
                        return '../Detais-prod.php?id=' . $id_adcart; // Replace with your actual page name
                    } else {
                        return 'default_details_page.php?id=' . $id_adcart; // Default page if product name doesn't match
                    }
                }
                
               
                while ($stmt->fetch()) {
                    $total += $pdtmontantTotal_adcart; // Accumulate total
                    echo '
                    <div class="cart-item">
                        <img src="../'.$image.'" alt="' . htmlspecialchars($pdtNam_adcart) . '">
                        <div class="item-details">
                            <p style="font-size:22px;" id="name_' . htmlspecialchars($id_adcart) . '">' . htmlspecialchars($pdtNam_adcart) . '</p>
                            <p id="price_' . htmlspecialchars($id_adcart) . '">' . htmlspecialchars($pdtPrice_adcart) . ' Dh</p>
                            <div class="quantity" id="quantity_' . htmlspecialchars($id_adcart) . '">
                                Qt: <span>' . htmlspecialchars($quanti_addcart) . '</span>
                            </div>
                            <p style=" font-weight:bold;" id="total_' . htmlspecialchars($id_adcart) . '">Total: ' . htmlspecialchars($pdtmontantTotal_adcart) . ' Dh</p>
                        </div>
                        <form method="post" action="delete.php">
                            <input type="hidden" name="product_id" value="' . htmlspecialchars($id_adcart) . '">
                            <button type="submit" class="but"><i id="trash" class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        <button type="button" class="but" onclick="enableEditing(' . htmlspecialchars($id_adcart) . ', \'' . htmlspecialchars($pdtNam_adcart) . '\')">
                            <i id="trash" class="fas fa-edit"></i>
                        </button>
                    </div>';
                }
                
                ?>
<script>
    function enableEditing(id, productName, category) {
        var quantityElement = document.getElementById('quantity_' + id);
        var totalElement = document.getElementById('total_' + id);
        var priceElement = document.getElementById('price_' + id);
        
        // Get current values
        var currentQuantity = quantityElement.querySelector('span').innerText;
        var currentPrice = parseFloat(priceElement.innerText.split(' ')[0]); // Assuming format "X Dh"
        var currentTotal = parseFloat(totalElement.innerText.split(' ')[1]); // Assuming format "Total: X Dh"
        
        // Replace quantity text with input field
        quantityElement.innerHTML = 'Qt: <input type="number" name="quantity" id="input_quantity_' + id + '" value="' + currentQuantity + '" min="1" oninput="updateTotal(' + id + ', ' + currentPrice + ', ' + category + ', \'' + productName + '\')">';
        
        // Replace total text with input field
        totalElement.innerHTML = 'Total: <input type="text" name="total" id="input_total_' + id + '" value="' + currentTotal.toFixed(2) + '" disabled> Dh';
        
        // Add Save and Cancel buttons
        totalElement.innerHTML += ' <button class="save" id="save_' + id + '" type="button" onclick="saveChanges(' + id + ', ' + currentPrice + ', ' + category + ', \'' + productName + '\')">Save</button>';
        totalElement.innerHTML += ' <button class="save" id="cancel_' + id + '" type="button" onclick="cancelChanges(' + id + ', ' + currentQuantity + ', ' + currentTotal + ')">Cancel</button>';
    }

    function updateTotal(id, price, category, productName) {
        var newQuantity = document.getElementById('input_quantity_' + id).value;
        
        // Update total dynamically based on category
        var newTotal;
        if (category == 1) {
            newTotal = parseFloat(newQuantity) * price;
        } else if (category == 2) {
            newTotal = parseFloat(newQuantity) * price * 9;
        } else {
            console.error("Invalid category:", category);
            return;
        }
        
        // Update input field with new total
        document.getElementById('input_total_' + id).value = newTotal.toFixed(2);
    }

    function saveChanges(id, price, category, productName) {
        var newQuantity = document.getElementById('input_quantity_' + id).value;
        
        // Validate quantity (optional)
        if (newQuantity <= 0) {
            alert("Quantity must be greater than zero.");
            return;
        }
        
        // Send new values to the server using an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "modifier.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Optional: Handle response from server
                console.log(xhr.responseText);
                // Reload page after successful update
                location.reload();
            }
        };
        xhr.send("id=" + id + "&quantity=" + newQuantity + "&price=" + price + "&category=" + category + "&productName=" + encodeURIComponent(productName));
    }

    function cancelChanges(id, initialQuantity, initialTotal) {
        var quantityElement = document.getElementById('quantity_' + id);
        var totalElement = document.getElementById('total_' + id);
        
        // Restore initial values
        quantityElement.innerHTML = 'Qt: <span>' + initialQuantity + '</span>';
        totalElement.innerHTML = 'Total: ' + initialTotal.toFixed(2) + ' Dh';
        
        // Optionally, you can remove the Save and Cancel buttons here if needed
    }
</script>




            </div>
            <div class="summary">
                <!-- Assuming total values are computed from the fetched data -->
                <div class="summary-item">
                    <span>Produits</span>
                    <span id="products-total"><?php echo $total; ?> Dh</span>
                </div>
                <div class="summary-item">
                    <span>Livraison</span>
                    <span>Gratuit</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span id="cart-total"><?php echo $total; ?> Dh</span>
                </div>
                <button class="validate-button"><a href="../paiement_page.php" style="color:white; text-decoration:none">Valider ma commande</a></button>
            </div>
        <?php else: ?>
            <div style="text-align: center;">
                <p style="font-size: 20px; color: black;">Vous devez vous connecter d'abord.</p>
                <div id="loginLink" class="profile">
                    <p style="font-size:10px">cliqué ici pour connecté</p>
                    <a href="../chooselogin.html">
                        <i id="profil-icon" style="color:black; font-size:45px;" class="fa fa-user"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php
if ($userLoggedIn) {
    $stmt->close();
}
$conn->close();
?>
