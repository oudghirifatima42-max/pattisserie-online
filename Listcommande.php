<?php
// Connexion à la base de données avec mysqli
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patisserie";
$conn = new mysqli($servername, $username, $password, $dbname);


// Requête SQL avec jointure entre client et commandes (récupérer des données provenant de deux tables liées dans la base de données : commandes et clients.)
$sql = "
    SELECT commandes.Id_commande, clients.nom, clients.prenom, commandes.Date_commande, commandes.totale
    FROM commandes
    JOIN clients ON commandes.Id_client = clients.Id_client
    ORDER BY clients.nom";

$result = $conn->query($sql);
?>


<h2><u>Liste des commandes</u></h2>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de commande</th>
        <th>Montant total</th>
        <th>Actions</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
    <?php foreach ($result as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['nom']) ?></td>
        <td><?= htmlspecialchars($r['prenom']) ?></td>
        <td><?= htmlspecialchars($r['Date_commande']) ?></td>
        <td><?= htmlspecialchars($r['totale']) ?> dh</td>
        <td>
            <a href="modifycmd.php?id=<?= $r['Id_commande'] ?>">Modifier</a> |
            <a href="deletcmd.php?id=<?= $r['Id_commande'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?> <!-- Cette ligne est indispensable -->
<?php else: ?>
    <tr><td colspan="5">Aucune commande trouvée.</td></tr>
<?php endif; ?>
</table>

<?php
// Fermer la connexion
$conn->close();
?>
