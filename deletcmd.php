<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patisserie";

$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_GET['id'])) {
    $id_commande = $_GET['id'];

    // Récupérer l'ID du client lié à cette commande
    $stmt = $conn->prepare("SELECT Id_client FROM commandes WHERE Id_commande = ?");
    $stmt->bind_param("i", $id_commande);
    $stmt->execute();
    $result = $stmt->get_result();
    $client = $result->fetch_assoc();

    if ($client) {
        $id_client = $client['Id_client'];

        // Supprimer les produits liés à la commande
        $stmt = $conn->prepare("DELETE FROM commande_produit WHERE Id_commande = ?");
        $stmt->bind_param("i", $id_commande);
        $stmt->execute();

        // Supprimer la commande
        $stmt = $conn->prepare("DELETE FROM commandes WHERE Id_commande = ?");
        $stmt->bind_param("i", $id_commande);
        $stmt->execute();

        // Supprimer le client
        $stmt = $conn->prepare("DELETE FROM clients WHERE Id_client = ?");
        $stmt->bind_param("i", $id_client);
        $stmt->execute();
    }
}

// Fermer la connexion
$conn->close();

// Rediriger vers la page de liste des commandes
header("Location: Listcommande.php");
exit();
?>
