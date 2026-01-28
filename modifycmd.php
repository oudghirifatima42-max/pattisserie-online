<?php
// Création de la connexion MySQLi
$conn = new mysqli("localhost", "root", "", "patisserie");

// Récupération de l'identifiant du client depuis l'URL et le convertir en entier
$id = intval($_GET['id']);

// Exécution de la requête pour récupérer les informations du client à modifier
$result = $conn->query("SELECT * FROM clients WHERE Id_client = $id");
$client = $result->fetch_assoc(); // Récupération du résultat sous forme de tableau associatif

// Si le formulaire est soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données envoyées par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    // Préparation de la requête SQL pour mettre à jour les informations du client
    $stmt = $conn->prepare("UPDATE clients SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ? WHERE Id_client = ?");
    $stmt->bind_param("sssssi", $nom, $prenom, $email, $telephone, $adresse, $id); // Liaison des paramètres
    $stmt->execute(); // Exécution de la requête

    // Redirection vers la page de liste des commandes après la mise à jour
    header("Location: Listcommande.php");
    exit(); // Arrêt du script après la redirection
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client</title>
    <link rel="icon" type="image/png" href="Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f3ee;
            padding: 30px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color:rgb(215, 85, 161);
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #a0522d;
        }
    </style>
</head>
<body>

<h2>Modifier le client</h2>

<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>

    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>

    <label>Email :</label>
    <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>

    <label>Téléphone :</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>

    <label>Adresse :</label>
    <input type="text" name="adresse" value="<?= htmlspecialchars($client['adresse']) ?>" required>

    <input type="submit" value="Enregistrer les modifications">
</form>

</body>
</html>