<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patisserie";
$conn = new mysqli($servername, $username, $password, $dbname);


// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];

// Lire le panier
$panier_json = $_POST['panier'];
$panier = json_decode($panier_json, true);
if (!is_array($panier)) {
    die("Erreur : Le panier n'est pas un tableau valide.");
}


// Insérer le nouveau client
$sql_clients = "INSERT INTO clients (nom, prenom, email, telephone, adresse) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_clients);
$stmt->bind_param("sssss", $nom, $prenom, $email, $telephone, $adresse);
$stmt->execute();
$Id_client = $stmt->insert_id;

// Calculer le total
$total = 0;
foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
}
  $date_commande = date("Y-m-d");  

// Insérer la commande

$sql_commande = "INSERT INTO commandes (date_commande, totale, Id_client) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_commande);
$stmt->bind_param("sdi", $date_commande, $total, $Id_client);
$stmt->execute();
$Id_commande = $stmt->insert_id; //cle primaire

  /*Inseertion des produits 
     //Produits sucres
$produits = [
    ['Croissant au chocolat', 8],
    ['Macaron framboise', 50],
    ['Mille-Feuille Classique', 13],
    ['Mini tarte au citron', 20],
    ['Gauffre au chocolat', 29],
    ['Pancake Golden Stack', 30],
    ['Crêpe au citron', 40],
    ['Tablette chokolat lait', 20],
    ['Tartelette Noisette', 20],
    ['Craquant praline', 90],
    ['Chokolat dubai', 150],
    ['Mille-Feuille Exotique', 22],

    // Produits salés
    ['Batbout au poulet', 10],
    ['Mini Pizza végétarienne', 10],
    ['Quiche à la dinde', 12],
    ['Mini-Burger à la viande hachée', 15],
    ['Wrap au thon', 20],
    ['Brioche salée au fromage', 9],
    ['Mini-Tacos mixte', 15],
    ['Chaussons salés à la dinde', 10],
    ['Briouate à la viande hachée', 15],
    ['Msamens au poulet', 10],
    ['Mini bastilla aux fruits de mer', 25],
    ['Croissant Salé à la dinde fumée', 10],

    // Pains
    ['Baguette', 2], 
    ['Foudasse', 5],
    ['Pain de campagne', 10],
    ['Pain complet', 10],
    ['Pain d\'épeautre', 15],
    ['Pain de noix', 15],
    ['Pain de seigle', 15],
    ['Pain de mie', 10],
    ['Pain de maïs', 20],
    ['Pain ciabatta', 10],
    ['Pain au levain', 10],
    ['Pain tranché', 10],

    // Biscuits marocains (au kg)
    ['Fekass', 100],
    ['Chebakia', 110],
    ['Corne de gazelle', 130],
    ['Ghriba aux amandes', 130],
    ['Kaak', 70],
    ['Makrout', 80],
    ['Sellou', 160],
    ['Boule de coco', 80],
    ['Bahla', 80],
    ['Zellige', 90],
    ['Sablé au fraise', 90],
    ['Sablé au chocolat', 90],

    // Boissons
    ['Mojito', 50],
    ['Caramel Hazelnut Iced Coffee', 35],
    ['Soda', 40],
    ['Thé à la menthe', 40],
    ['Chocolat chaud', 40],
    ['Jus de fruits', 40],
    ['Eau de coco', 40],
    ['Bubble tea', 40],
    ['Citronnade', 40],
    ['Cidre chaud', 40],
    ['Matcha latte', 40],
    ['Lassi à la mangue', 40]
];

$stmt_insert = $conn->prepare("INSERT INTO produits (intitule, prix) VALUES (?, ?)");
foreach ($produits as $p) {
    $intitule = $p[0];
    $prix = $p[1];
    $stmt_insert->bind_param("sd", $intitule, $prix);
    $stmt_insert->execute();
} 

*/


foreach ($panier as $produit) {
    $intitule = $produit['produit'];
    $quantite = $produit['quantite'];

    $sql_find = "SELECT Id_produit FROM produits WHERE intitule = ?";
    $stmt_find = $conn->prepare($sql_find);
    $stmt_find->bind_param("s", $intitule);
    $stmt_find->execute();
    $result_find = $stmt_find->get_result();

    if ($result_find->num_rows > 0) {
        $row = $result_find->fetch_assoc();
        $Id_produit = $row['Id_produit'];

        $sql_cp = "INSERT INTO commande_produit (quantite, Id_produit, Id_commande) VALUES (?, ?, ?)";
        $stmt_cp = $conn->prepare($sql_cp);
        $stmt_cp->bind_param("iii", $quantite, $Id_produit, $Id_commande);
        $stmt_cp->execute();
    }
}

header ("Location: confirmation.php");
exit();
?>