<?php
require_once('../libs/fpdf/fpdf.php');
require('../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si un ID de facture est fourni
if (!isset($_GET['idpaye'])) {
    die("Aucune facture sélectionnée !");
}

$id_facture = $_GET['idpaye'];

$stmt = $pdo->prepare("SELECT * FROM PAYER WHERE idpaye = :idpaye");
$stmt->execute(['idpaye' => $id_facture]);
$facture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$facture) {
    die("Facture introuvable !");
}

// Créer le PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);

// En-tête
$pdf->Cell(0, 10, "JIRO SY RANO MALAGASY", 0, 1, 'C');
$pdf->Ln(10);

$pdf->setFont('helvetica','',12);
$pdf->Cell(0, 10, "Votre facutre du: ".$facture['datepaie'], 0, 1, 'C');

// Infos Client
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Titulaire de compte : " . $facture['nom'], 0, 0);
$pdf->Cell(0, 10, "Date de presentation : " , 0, 1, 'R');
$pdf->Cell(0, 10, "Reference Client : " , 0, 0);
$pdf->Cell(0, 10, "Date limite paiement : " , 0, 1, 'R');
$pdf->Cell(0, 10, "Adress installation : " , 0, 1);
$pdf->Cell(0, 10, "Num compteur electricite : " , 0, 1);
$pdf->Cell(0, 10, "Num compteur eau : " , 0, 1);
$pdf->Ln(5);

// Montant
$pdf->Cell(0, 10, "Votre facture en details " , 0, 1, 'C');
$pdf->SetXY(130,105);
$pdf->Cell(70, 10,"Electricite", 1, 1, 'C');
$pdf->SetXY(60,105);
$pdf->Cell(70, 10,"Eau", 1, 1, 'C');
$pdf->SetXY(10,115);
$pdf->Cell(50, 10,"1", 1, 1, 'C');
$pdf->SetXY(60,115);
$pdf->Cell(70, 10,"2", 1, 1, 'C');
$pdf->SetXY(130,115);
$pdf->Cell(70, 10,"3", 1, 1, 'C');
$pdf->SetXY(10,125);
$pdf->Cell(50, 10,"4", 1, 1, 'C');
$pdf->SetXY(60,125);
$pdf->Cell(70, 10,"5", 1, 1, 'C');
$pdf->SetXY(130,125);
$pdf->Cell(70, 10,"6", 1, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(0, 10, "NET A PAYER :" .$facture['montant']." Ariary" , 0, 1, 'L');

// afficher le PDF dans le navigateur
// $pdf->Output("facture_{$facture['idpaye']}.pdf", 'I');
$pdf->Output();
