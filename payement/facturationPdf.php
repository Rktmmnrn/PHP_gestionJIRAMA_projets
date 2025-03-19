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

$stmt = $pdo->prepare("SELECT COMPTEUR.codecompteur,pu, CLIENT.codecli,nom,quartier, PAYER.datepaie,montant, RELEVE_ELEC.codeElec,valeur1,date_présentation,date_limite_paie 
                    FROM COMPTEUR JOIN CLIENT ON COMPTEUR.codecli=CLIENT.codecli 
                    JOIN PAYER ON PAYER.codecli=CLIENT.codecli 
                    JOIN RELEVE_ELEC ON RELEVE_ELEC.codecompteur=COMPTEUR.codecompteur WHERE idpaye= :idpaye");
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
$pdf->Cell(0, 10, "Date de presentation : " .$facture['date_présentation'] , 0, 1, 'R');
$pdf->Cell(0, 10, "Reference Client : " .$facture['codecli'], 0, 0);
$pdf->Cell(0, 10, "Date limite paiement : " .$facture['date_limite_paie'], 0, 1, 'R');
$pdf->Cell(0, 10, "Adress installation : " .$facture['quartier'], 0, 1);
$pdf->Cell(0, 10, "Num compteur electricite : " .$facture['codeElec'], 0, 1);
$pdf->Cell(0, 10, "Num compteur eau : " .$facture[''], 0, 1);
$pdf->Ln(5);

// Montant
$pdf->Cell(0, 10, "Votre facture en details " , 0, 1, 'C');
$pdf->SetXY(130,105);
$pdf->Cell(70, 10,"Electricite", 1, 1, 'C');
$pdf->SetXY(60,105);
$pdf->Cell(70, 10,"Eau", 1, 1, 'C');
$pdf->SetXY(10,115);
$pdf->Cell(50, 10,"PU", 1, 1, 'C');
$pdf->SetXY(60,115);
$pdf->Cell(70, 10,"no", 1, 1, 'C');
$pdf->SetXY(130,115);
$pdf->Cell(70, 10,$facture['pu'], 1, 1, 'C');
$pdf->SetXY(10,125);
$pdf->Cell(50, 10,"valeur", 1, 1, 'C');
$pdf->SetXY(60,125);
$pdf->Cell(70, 10,"no", 1, 1, 'C');
$pdf->SetXY(130,125);
$pdf->Cell(70, 10,$facture['valeur1'], 1, 1, 'C');
$pdf->SetXY(130,135);
$pdf->Cell(70, 10,$facture['valeur1']+$facture['pu'], 1, 1, 'C');
$pdf->SetXY(60,135);
$pdf->Cell(70, 10,"no", 1, 1, 'C');
$pdf->SetXY(10,135);
$pdf->Cell(50, 10,"totale", 1, 1, 'C');
$pdf->Ln(10);

$pdf->Cell(0, 10, "NET A PAYER :" .$facture['valeur1']+$facture['pu']." Ariary" , 0, 1, 'L');

// afficher le PDF dans le navigateur
// $pdf->Output("facture_{$facture['idpaye']}.pdf", 'I');
$pdf->Output();
