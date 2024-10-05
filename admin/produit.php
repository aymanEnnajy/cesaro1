

<!DOCTYPE html>
<html lang="fr">

<head>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
    

    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">

  
    <title>Admin | CESARO</title>
    <link rel="stylesheet" href="admin.css">
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation" id="menuDiv">
            <ul>
            <li>
                    <a href="#">
                        <div style="padding-left:12px;" >
                            <img style="width: 150px;" src="..\images\logo.png" >
                        </div>
                        
                       
                    </a>
                </li>

                <li>
                    <a href="index.php" id="btn1">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Acceuil</span>
                    </a>
                </li>

                <li>
                    <a href="client.php" id="btn2">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Client</span>
                    </a>
                </li>
                <li>
                    <a href="fournisseur.php" id="btn2">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Fournisseur</span>
                    </a>
                </li>

               <li>
                    <a href="message_avis.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                 <li>
                    <a href="produit.php">
                        <span class="icon">
                        <ion-icon name="cube-outline"></ion-icon>

                        </span>
                        <span class="title">Produit</span>
                    </a>
                </li>

                

                <li>
                    <a href="changepassword.html" id="btn3" data-bs-target="#section3">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password & admine</span>
                    </a>
                </li>

                <li>
                    <form action="logout.php" method="post" style="margin: 0;">
                        <a href="#" onclick="document.getElementById('logoutSubmit').click(); return false;">
                            <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Se déconnecter</span>
                        </a>
                        <input type="submit" id="logoutSubmit" style="display: none;">
                    </form>
                </li>
                
                <style>
                    #lii{
                        
                      width: 100%;
                      height: 45px;
                    }
                    #lii:hover{
                        background-color: #f35525;
                    }
                    
                    .tit{
                        margin-left: 17px;
                        display: flex;
                        width: 100%;
                      height: 25px;
                    }
                    #subi{
                        background: none;
                        cursor: pointer;
                        margin-left: 19px;
                        color: white;
                        font-size: 18px;
                        border: none;

                    }
                   
                </style>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
           
            <div class="topbar">
                
                <div class="toggle">
                    
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon style="top:10px" name="search-outline"></ion-icon>
                    </label>
                </div>
                <script>
function search() {
    var query = document.getElementById("searchInput").value;
    if (query.trim() !== "") {
        // Send AJAX request to backend
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var results = JSON.parse(xhr.responseText);
                // Handle/display search results
            }
        };
        xhr.send();
    }
}
</script>

                <div class="user">
                    <img src="../images/ZHA.png" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <script>
                $(document).ready(function() {
                    $('#but_01').click(function() {
                        $('#section1').show();
                        $('#section2').hide();
                        document.getElementById('but_o1').style.backgroundColor='#ffeee9';
                        document.getElementById('but_o1').style.color= '#f35525' ;
                        document.getElementById('but_o1').style.border= '#ffeee9' ;
                        document.getElementById('but_o2').style.backgroundColor= '#f35525';
                        document.getElementById('but_o2').style.color= '#ffeee9' ;
                        document.getElementById('but_o2').style.border= '#f35525' ;
                        
                    });
        
                    $('#but_2').click(function() {
                        $('#section1').hide();
                        $('#section2').show();
                        document.getElementById('but_o2').style.backgroundColor='#ffeee9';
                        document.getElementById('but_o2').style.color= '#f35525' ;
                        document.getElementById('but_o2').style.border= '#ffeee9' ;
                        document.getElementById('but_o1').style.backgroundColor= '#f35525';
                        document.getElementById('but_o1').style.color= '#ffeee9' ;
                        document.getElementById('but_o1').style.border= '#f35525' ;
                      
                    });
                });
                
                
            </script>
            <div class="MardBox">
                <div class="button">
                    <div class="cards">
                        <button id="but_o1" class="button_produit" onclick="showSection(1)">ajouter</button>
                    </div>
                    <div class="cards">
                        <button id="but_o2" class="button_produit" onclick="showSection(2)">Modifier</button>
                    </div>
                    <div class="cards">
                        <button id="but_o3" class="button_produit" onclick="showSection(3)">Suprimer</button>
                    </div>
                    
                    
                </div>
            </div>
            <div id="section1" class="section">
    <section id="k">
        <div class="card">
            <p class="lock-icon"><i id="icon" class="fas fa-lock"></i></p>
            <h2>Ajouter un produit</h2>
            <p>Remplir les informations suivantes</p>
            <form action="add_prod.php" method="post" enctype="multipart/form-data" id="productForm">
                <input class="passInput" type="text" id="productName" placeholder="Nom de produit" name="productName" 
                onkeyup="checkProductName(); return false;" required><br>
                <br><span id="productNameMessage"></span>
                <br><br> 


                <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_finetude";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$sql = "SELECT ID_CATE, NOM_CATE FROM Categorie";
$result = $conn->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "No categories found.";
}
$conn->close();
?>

<select id="categor" name="categorie_prod" required>
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlspecialchars($category['ID_CATE']); ?>" 
            <?php if (isset($product['categorie_prod']) && $product['categorie_prod'] == $category['ID_CATE']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($category['NOM_CATE']); ?>
        </option>
    <?php endforeach; ?>
</select>




                <textarea class="passInput" id="productDescription" placeholder="Description" name="productDescription" required></textarea><br>
                <input class="passInput" type="number" id="productPrice" placeholder="Prix Produit:" name="productPrice" step="0.01" required><br>
                <input class="passInput" type="file" id="productImage" placeholder="Image Produit:" name="productImage" accept="image/*" required><br>
                <div style="display:flex; justify-content:space-evenly; padding-top: 24px;">
                    <button id="butsub" type="submit" name="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </section>
</div>


        
      <div id="section2" class="section">
    <section id="k">
        <div class="card">
            <h2>Modifier le produit</h2>
            <form action="modif_prod.php" method="post" enctype="multipart/form-data">
                <input type="text" class="passInput" placeholder="entrez le nom du produit:" id="product_name" name="product_name" required>
                <div style="display:flex; justify-content:space-evenly; padding-top: 24px;">
                    <input id="butsub" type="submit" name="search" value="Search">                        
                </div>
            </form> 
            <br><br><br><br><br>
            <style>
                label {
                    font-size: 29px;
                    color: #0e0e0e;
                    font-weight: bold;
                }
            </style>
           
            
            <?php if (isset($_GET['product'])): ?>
                <?php $product = json_decode(urldecode($_GET['product']), true); ?>
                
                <form action="modif_prod.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_product_name" value="<?php echo htmlspecialchars($product['NOM_PDT']); ?>">
                    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product['image_pdt']); ?>">
                    
                    <label for="product_name">Nom de Produit</label>
                    <input class="passInput" type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['NOM_PDT']); ?>" required><br>
                    
                    <label for="categorie_prod">Catégorie:</label>
                    <!-- select from database -->    

                    <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_finetude";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$sql = "SELECT ID_CATE, NOM_CATE FROM Categorie";
$result = $conn->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo "No categories found.";
}
$conn->close();
?>

<select id="categor" name="categorie_prod" required>
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlspecialchars($category['ID_CATE']); ?>" 
            <?php if (isset($product['categorie_prod']) && $product['categorie_prod'] == $category['ID_CATE']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($category['NOM_CATE']); ?>
        </option>
    <?php endforeach; ?>
</select>




                    <br>
                    
                    <label for="DESCR_PDT">Description:</label>
                    <input class="passInput" type="text" id="DESCR_PDT" name="DESCR_PDT" value="<?php echo htmlspecialchars($product['DESCR_PDT']); ?>" required><br>
                    
                    <label for="PRIX_PDT">Prix:</label>
                    <input class="passInput" type="number" id="PRIX_PDT" name="PRIX_PDT" value="<?php echo htmlspecialchars($product['PRIX_PDT']); ?>" step="0.01" required><br>
                    
                    <label for="image_pdt">Image:</label>
                    <input class="passInput" type="file" id="image_pdt" name="image_pdt"><br>
                    
                    <div style="display:flex; justify-content:space-evenly; padding-top: 24px;">
                        <input id="butsub" type="submit" name="update" value="MISE À JOUR">                        
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </section>
</div>


        
            <div id="section3" class="section">
                <section id="k">
                
                    <div class="card">
                      
                        <p class="lock-icon"><i id="icon" class="fas fa-lock"></i></p>
                        <h2>Suprimer un produit</h2>
                        <p>Entrez ancien mot de passe et le nouveaux</p>
                        <form action="productfor_delete.php" method="POST">
                            <input class="passInput" type="text" placeholder="Nom du produit :" id="nom_produit" name="nom_produit" required><br><br>
                            <div style="display:flex; justify-content:space-evenly; padding-top: 24px;">
                               
                                <input id="butsub" type="submit" value="Supprimer">
                            </div>  
                     
                        </form>
                       
                    </div>
                </section>
            </div>
            <script>
                function showSection(sectionNumber) {
                    // Hide all sections
                    document.getElementById('section1').style.display = 'none';
                    document.getElementById('section2').style.display = 'none';
                    document.getElementById('section3').style.display = 'none';
                    
                    // Show the selected section
                    document.getElementById('section' + sectionNumber).style.display = 'block';
                }
            </script>
<style>
    #section1 ,  #section2 ,  #section3 {
        display: none;
    }
</style>    

<div style="    padding-left: 32px; color:#f35525;">
    <h2 style=" color:#f35525;">Nos produit</h2>
</div>
<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'projet_finetude';
$username = 'root';
$password = '';

// Create a connection to the database
$conn = mysql_connect($host, $username, $password);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname, $conn);

// Query to get products from the database
$query = "SELECT ID_PDT, NOM_PDT, DESCR_PDT, PRIX_PDT FROM produit";
$result = mysql_query($query);

if (!$result) {
    die('Query failed: ' . mysql_error());
}

// HTML and PHP to display the products in a table
echo '<div style="justify-content:center; display:flex;">
<table class="styled-table">
    <thead>
        <tr>
            <th>id Produit</th>
            <th>Nom Produit</th>
            <th>Description Produit</th>
            <th>Prix Produit (Dh)</th>
        </tr>
    </thead>
    <tbody>';

// Fetch and display each row of the result
while ($row = mysql_fetch_assoc($result)) {
    echo '<tr>
            <td>' . $row['ID_PDT'] . '</td>
            <td id="impr">' . $row['NOM_PDT'] . '</td>
            <td id="descri">' . $row['DESCR_PDT'] . '</td>
            <td>' . $row['PRIX_PDT'] . '</td>
          </tr>';
}

echo '    </tbody>
</table>  
</div>';

// Close the database connection
mysql_close($conn);
?>

        </div>
        
    </div>
    
    <script>
    // Function to check if product name exists
    function checkProductName() {
        var productName = document.getElementById("productName").value;
        var productNameMessage = document.getElementById("productNameMessage");

        // Send AJAX request to check if product name exists
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../check_info/check_name.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                productNameMessage.innerHTML = xhr.responseText;
            }
        };
        xhr.send("productName=" + productName);
    }

    // Add event listener to the product name input field
    document.getElementById("productName").addEventListener("blur", checkProductName);
</script>

    
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
   

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>