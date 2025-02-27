<?php

require '../Model/M_PDF.php';
require "../Model/M_Reservations.php";

function GetNbJours($dt1, $dt2)
{
    $date1 = new DateTime($dt1);
    $date2 = new DateTime($dt2);
    $interval = date_diff($date1, $date2);
    return $interval->format('%a');
}

if (isset($_GET["id"])) {


    $pdf = new FPDF('P', 'mm', 'A4');

    $reservation = new Reservation();

    $informations = $reservation->GetInformationPDF($_GET["id"]);

    $datesys = date("d/m/Y");

    $page = new PDF($pdf, $informations,GetNbJours($informations[15],$informations[16]) * $informations[17],GetNbJours($informations[15],$informations[16]),$datesys);


    $page->CreatePage();

    $page->AfficherPDF();


}
