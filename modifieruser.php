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

if ($userLoggedIn) {
    // Query to fetch user profile details
    $query = "SELECT NOM_UTLI, PRENOM_UTLI, ADRESSE__UTLI, email_util, TEL_UTLI, CODE_POSTAL, VILLE_UTIL, GENRE_UTIL, Password_uti, confirm_password FROM util WHERE ID_UTIL = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($nom, $prenom, $adresse, $email, $tel, $codepostal, $ville, $genre, $pass, $confirmpass);

    if (!$stmt) {
        die('Query failed: ' . $conn->error);
    }

    // Fetching the results
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Query to fetch latest 5 command details
    $commandQuery = "SELECT DATE_cmd, STATUT_cmd, MONTANT_CMD FROM command WHERE ID_UTIL = ? ORDER BY DATE_cmd DESC LIMIT 5";
    $commandStmt = $conn->prepare($commandQuery);
    $commandStmt->bind_param("i", $userId);
    $commandStmt->execute();
    $commandStmt->bind_result($date, $statut, $montant);

    // Fetching the results into an array
    $commands = array();
    while ($commandStmt->fetch()) {
        $commands[] = array(
            'date' => $date,
            'statut' => $statut,
            'montant' => $montant
        );
        $ht=$montant/0.2;
    }

    // Close the statement
    $commandStmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cesaro</title>

    <!-- Bootstrap CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="css/owl.css">
    <link rel="stylesheet" href="css/animate.css">
 

    <!-- External scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="log_out.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a style="color:#f35525;" href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile d'utilisateur</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="rounded-circle bg-primarys text-white d-flex justify-content-center align-items-center" style="width: 150px; height: 150px; font-size: 72px;">
                                    <?php echo strtoupper(substr($nom, 0, 1)); ?>
                                </div>
                                <div class="mt-3">
                                    <h4><?php echo $nom . ' ' . $prenom; ?></h4>
                                    <a href="panier/cart.php"><button id="buton" class="btn btn-primary">Panier</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <form action="phpmodifuser.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="nom" value="<?php echo $nom; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prenom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="prenom" value="<?php echo $prenom; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" value="<?php echo $email; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telephone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="number" name="tel" value="<?php echo $tel; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Code postal</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="number" name="codepostal" value="<?php echo $codepostal; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ville</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <script src="ville.js"></script>
                                    <select id="sville" name="ville" value="<?php echo $ville; ?>" required>
                                <option value=""> selectionez votre ville</option>
                            </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="adresse" value="<?php echo $adresse; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mot de passe</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
    <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" required>
    <i id="toggleIcon" class="fa-solid fa-eye" onclick="togglePassword()"></i>

    <script>
        function togglePassword() {
            var passField = document.getElementById("pass");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passField.type === "password") {
                passField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
       

        document.addEventListener('DOMContentLoaded', (event) => {
    const passwordInput = document.querySelector('input[name="pass"]');
    const confirmPasswordInput = document.querySelector('input[name="confirmpass"]');
    const submitButton = document.querySelector('button[type="submit"]');
    const messageElement = document.createElement('small');

    messageElement.style.color = 'red';
    confirmPasswordInput.parentNode.appendChild(messageElement);

    function validatePasswords() {
        if (passwordInput.value !== confirmPasswordInput.value) {
            messageElement.textContent = 'Password and Confirm Password do not match';
            submitButton.disabled = true;
        } else {
            messageElement.textContent = '';
            submitButton.disabled = false;
        }
    }

    passwordInput.addEventListener('input', validatePasswords);
    confirmPasswordInput.addEventListener('input', validatePasswords);
});
    </script>
</div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Confirmer Mot de passe</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="confirmpass" value="<?php echo $confirmpass; ?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                  <button type="submit" class="btn btn-primary" style="background-color:#f35525; border:#f35525;">Enregistrer</button>
                                  <button class="btn btn-primary" style="background-color:#f35525; border:#f35525;" ><a style="color:white;" href="profil.php">Retour</a></button>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="card ">
    <div class="card-body">
        <h6 class="d-flex align-items-center mb-3"><i id="tit" style="margin-right:8px;">Dernière </i> Commande</h6>
        <div class="holl">
            <?php if (empty($commands)): ?>
                <p>Vous n'avez pas encore de commande.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date commande</th>
                            <th>Statut</th>
                            <th>Montant HT</th>
                            <th>Montant TTC</th>
                        </tr>
                    </thead>
                    <tbody id="tbod">
                        <?php foreach ($commands as $command): ?>
                            <tr>
                                <td><?php echo $command['date']; ?></td>
                                <td><?php echo $command['statut']; ?></td>
                                <td><?php echo $ht; ?></td> <!-- Assuming $ht is defined correctly -->
                                <td><?php echo $command['montant']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-primarys{
            background-color: rgb(243 85 37)  ;
        }
        input {
            border-left: none;
            border-right: none;
            border-top: none;
            border-bottom: 1px solid #b9b9b9;
            box-shadow: 2px 1px 2px #8f8f8f;
        }
        th {
            text-align: center;
        }
        #tbod {
            color: black;
        }
        tbody {
            background-color: #fbf3ee;
            text-align: center;
        }
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }
        .main-body {
            padding: 15px;
        }
        #tit {
            color: #f35525;
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
        #buton {
            background-color: #f35525;
            border: #f35525;
        }
        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }
        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }
        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }
        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }
    </style>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
