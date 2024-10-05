<?php
// Database connection settings
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

// Fetch data from database
$sql = "SELECT nomdestin_cmd, STATUT_cmd, DATE_cmd, MONTANT_CMD FROM command";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">

    <title>Admin | CESARO</title>
    
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js"></script>
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
            <section id="section1">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                

    <style>
        /* Add some basic styling for the search pop-up */
        .search-popup {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
            display: none; /* Initially hidden */
        }
        .search-popup div {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .search-popup div:hover {
            background-color: #f0f0f0;
        }
        .highlight {
            background-color: yellow;
        }
    </style>

    <div class="search" style="position: relative;">
        <label>
            <input type="text" id="searchInput" placeholder="Search here">
            <button onclick="performSearch()"><ion-icon name="search-outline"></ion-icon></button>
        </label>
        <div id="searchResults" class="search-popup"></div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', showSuggestions);
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function highlightText(text, query) {
            const index = text.toLowerCase().indexOf(query.toLowerCase());
            if (index === -1) return text;
            return text.substring(0, index) + '<span class="highlight">' + text.substring(index, index + query.length) + '</span>' + text.substring(index + query.length);
        }

        function showSuggestions() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = ''; // Clear previous results

            if (query === '') {
                resultsContainer.style.display = 'none';
                return;
            }

            // List of pages to search
            const pages = ['produit.php', 'client.php', 'index.php','message_avis.php']; // Add all the pages you want to search

            // Fetch content from each page and search for the query
            pages.forEach(page => {
                fetch(page)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const textContent = doc.body.textContent.toLowerCase();
                        const queryIndex = textContent.indexOf(query);

                        if (queryIndex !== -1) {
                            // Find a snippet of text around the query
                            const snippetLength = 100;
                            const start = Math.max(0, queryIndex - snippetLength / 2);
                            const end = Math.min(textContent.length, queryIndex + snippetLength / 2);
                            let snippet = doc.body.textContent.substring(start, end);

                            // Highlight the query within the snippet
                            snippet = highlightText(snippet, query);

                            const result = document.createElement('div');
                                                        result.innerHTML = `<a style="text-decoration:none; color:#f35525" href="${page}" target="_blank">${snippet}...</a>`;

                            resultsContainer.appendChild(result);
                        }
                    })
                    .catch(error => console.error('Error fetching page:', page, error));
            });

            resultsContainer.style.display = 'block'; // Show the suggestions
        }

        function performSearch() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = ''; // Clear previous results

            if (query === '') {
                alert('Please enter a search query.');
                return;
            }

            // List of pages to search
            const pages = ['produit.php', 'client.php', 'index.php','message_avis.php']; // Add all the pages you want to search

            // Fetch content from each page and search for the query
            pages.forEach(page => {
                fetch(page)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const textContent = doc.body.textContent.toLowerCase();
                        const queryIndex = textContent.indexOf(query);

                        if (queryIndex !== -1) {
                            // Find a snippet of text around the query
                            const snippetLength = 100;
                            const start = Math.max(0, queryIndex - snippetLength / 2);
                            const end = Math.min(textContent.length, queryIndex + snippetLength / 2);
                            let snippet = doc.body.textContent.substring(start, end);

                            // Highlight the query within the snippet
                            snippet = highlightText(snippet, query);

                            const result = document.createElement('div');
                                                        result.innerHTML = `<a style="text-decoration:none; color:#f35525" href="${page}" target="_blank">${snippet}...</a>`;

                            resultsContainer.appendChild(result);
                        }
                    })
                    .catch(error => console.error('Error fetching page:', page, error));
            });

            resultsContainer.style.display = 'block'; // Show the suggestions
        }
    </script>



                <div class="user">
                    <img src="../images/ZHA.png" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <?php
                       $sql = "SELECT COUNT(DISTINCT ID_UTIL) as user_count FROM command";
                       $result = $conn->query($sql);
                       
                       if ($result->num_rows > 0) {
                           $row = $result->fetch_assoc();
                           $user_count = $row['user_count'];
                           
                       } else {
                           $user_count = 0;
                       }
                       
                       $conn->close();
                       ?>
                       
                       <?php if ($user_count > 0): ?>
                           <div>
                            <a style="color:black; text-decoration:none;" href="client.php">
                               <div class="numbers"><?php echo number_format($user_count); ?></div>
                               <div class="cardName">Nombre de client</div></a>
                           </div>
                       <?php endif; ?>
                       
                       
                       
                       
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>

                    </div>
                </div>

                <div class="card">
    <div>
    <?php
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
    $sql = "SELECT COUNT(DISTINCT ID_cmd) as commande_count FROM command";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $commande_count = $row['commande_count'];
    } else {
        $commande_count = 0;
    }
    
    $conn->close();
    ?>
    
    <div>
        <div class="numbers"><?php echo number_format($commande_count); ?></div>
        <div class="cardName">commande</div>
    </div>
    
    </div>

    <div class="iconBx">
        <ion-icon name="cart-outline"></ion-icon>
    </div>
</div>


                <div class="card">
                    <div>
                    

<?php
// fetch_user_count.php
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

// Fetch number of unique users who have placed orders
$sql = "SELECT COUNT(DISTINCT id_contc) as contact_count FROM contact";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contact_count = $row['contact_count'];
} else {
    $user_count = 0;
}

$conn->close();
?>

<?php if ($user_count > 0): ?>
    <div><a style="color:black; text-decoration:none;" href="message_avis.php">
        <div class="numbers"><?php echo number_format($contact_count); ?></div>
        <div class="cardName">Message</div></a>
    </div>
<?php endif; ?>


                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <?php include 'calcul.php'; ?>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders" id="do">
                    <div class="cardHeader">
                        <h2>Derniere Commande</h2>
                     <!--   <a href="#" class="btn">View All</a>-->
                    </div>

<table >
    <thead>
        <tr>
            <td>Nom</td>
            <td style="text-align:center;">produit</td>
            <td>Mantant</td>
            <td>Date commande</td>
            <td>Type de paiemnt</td>
            
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
        $servername = "localhost";  // Your server name
        $username = "root";     // Your database username
        $password = "";     // Your database password
        $dbname = "projet_finetude";       // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch data
        $sql = "SELECT nomdestin_cmd,nom_pdts, MONTANT_CMD, DATE_cmd, STATUT_cmd FROM command";  // Replace 'your_table' with your actual table name
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr class='tr_tabl'>";
                echo "<td style='  padding-bottom: 28px;
                padding-top: 28px;'>" . htmlspecialchars($row["nomdestin_cmd"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nom_pdts"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["MONTANT_CMD"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["DATE_cmd"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["STATUT_cmd"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </tbody>

</table>

                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers" id="do">
                    <div class="cardHeader">
                        <h2>Dérniere Client </h2>
                    </div>
                            
                    <?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_finetude";

// Create connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data with city from the util table
$sql = "
    SELECT command.nomdestin_cmd, util.VILLE_UTIL
    FROM command
    JOIN util ON command.ID_UTIL = util.ID_UTIL
";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<table>
    <?php
    // Function to get the first letter of a string
    function getFirstLetter($string) {
        return strtoupper(substr($string, 0, 1));
    }
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td width="60px">';
        // Get the first letter of the customer's name
        $first_letter = getFirstLetter($row['nomdestin_cmd']);
        // Use the letter to dynamically load the corresponding image
        $image_path = 'assets/imgs/letters/' . $first_letter . '.jpg';
       
        echo '<div class="imgBx"> <h3 id="controlLettre">'.$first_letter.'</h3></div>';
        echo '</td>';
        echo '<td>';
        echo '<h4>' . htmlspecialchars($row['nomdestin_cmd']) . '<br> <span>' . htmlspecialchars($row['VILLE_UTIL']) . '</span></h4>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
</table>

<?php
// Close the connection
$conn->close();
?>


                </div>
            </div>
        </div>
    </div></section>
    <section id="section3">
        <div>
            <input type="text" name="" id="">
            <input type="text" name="" id="">
        </div>
    </section>

    
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
   

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>