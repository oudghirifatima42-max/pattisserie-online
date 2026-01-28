<?php
require('fpdf/fpdf.php');

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patisserie";

$conn = new mysqli($servername, $username, $password, $dbname);

// Récupérer la dernière commande
$sql = "
    SELECT clients.nom, clients.prenom, clients.adresse, clients.telephone, clients.email,
           commandes.Date_commande, commandes.totale
    FROM commandes
    JOIN clients ON commandes.Id_client = clients.Id_client
    ORDER BY commandes.Id_commande DESC
    LIMIT 1
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Création du PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Logo
    $pdf->Image('Logo.png', 10, 6, 30); 
    $pdf->Ln(20);

    // Titre souligné et rose
    $pdf->SetTextColor(255, 105, 180); // Rose (pink)
    $pdf->SetFont('Arial', 'BU', 16);  // B = gras, U = souligné
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Détails de votre commande'), 0, 1, 'C');
    $pdf->Ln(10);

    // Infos client
    $pdf->SetTextColor(0, 0, 0); // Noir
    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(50, 10, 'Nom :', 0, 0);
    $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $data['nom']), 0, 1);

    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Prénom : '), 0, 0);
    $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $data['prenom']), 0, 1);



    $pdf->Cell(50, 10, 'Adresse :', 0, 0);
    $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $data['adresse']), 0, 1);

    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Téléphone : '), 0, 0);
    $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $data['telephone']), 0, 1);

    $pdf->Cell(50, 10, 'Email :', 0, 0);
    $pdf->Cell(100, 10, $data['email'], 0, 1);

    $pdf->Cell(50, 10, 'Date de commande :', 0, 0);
    $pdf->Cell(100, 10, $data['Date_commande'], 0, 1);

    $pdf->Cell(50, 10, 'Montant total :', 0, 0);
    $pdf->Cell(100, 10, $data['totale'] . ' DH', 0, 1);

    // Message de contact
    $pdf->Ln(20);
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Si vous souhaitez modifier ou supprimer votre achat, veuillez appeler le numéro suivant : 0765463487"), 0, 'C');

    // Remerciement en rose
    $pdf->Ln(10);
    $pdf->SetTextColor(255, 105, 180); // Rose
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Merci pour votre achat !'), 0, 1, 'C');

    // Affichage du PDF
    $pdf->Output('I', 'Votre_commande.pdf');
} else {
    echo "Aucune commande trouvée.";
}

$conn->close();
?>
