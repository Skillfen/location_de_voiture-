<?php

require "../Include_PDF/fpdf.php";

class PDF
{
    public $pdf;
    public $Reservation;
    public $Total;
    
    public $NBJour;
    public $Datesys;


    function __construct($pdf, $reservation,$total,$nbjour,$datesys)
    {
        $this->pdf = $pdf;
        $this->Reservation = $reservation;
        $this->Total = $total;
        $this->NBJour = $nbjour;
        $this->Datesys = $datesys;
    }

    public function CreatePage()
    {
        $this->pdf->AddPage();
        $this->pdf->SetY(10);
        $this->pdf->SetX(10);
        $this->pdf->Image('../Images/6.jpg', 15, 2, 180, 40);


        $this->pdf->SetFont('Arial', 'B', 15.5);
        $this->pdf->SetY(42);
        $this->pdf->SetX(5);
        $this->pdf->Cell(0, 10, "Le : ".$this->Datesys, 0, 1, "", 0);

        $this->pdf->SetX(20);
        $this->pdf->Cell(0, 8, "CONTRAT DE LOCATION N° ".$this->Reservation[12]+2000, 0, 1, "", 0);

        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 63, "", 1, 1, "", 0);


        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->SetY(60);
        $this->pdf->SetX(80);
        $this->pdf->Cell(0, 10, "LOCATAIRE", 0, 1, "", 0);

        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->SetY(65);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 10, "NOM : ".$this->Reservation[1], 0, 1, "", 0);
        $this->pdf->SetY(72);
        $this->pdf->Cell(0, 10, "PRENOM : ".$this->Reservation[2], 0, 1, "", 0);
        $this->pdf->SetY(79);
        $this->pdf->Cell(0, 10, "NATIONALITE : ".$this->Reservation[3], 0, 1, "", 0);
        $this->pdf->SetY(86);
        $this->pdf->Cell(0, 10,"PASSEPORT / C.I.N N° : ".$this->Reservation[0] , 0, 1, "", 0);
        $this->pdf->SetY(93);
        $this->pdf->Cell(0, 10,"PERMIS DE CONDUIRE : ".$this->Reservation[5] , 0, 1, "", 0);
        $this->pdf->SetY(100);
        $this->pdf->Cell(0, 10, "ADRESSE : ................................................................................", 0, 1, "", 0);
        $this->pdf->SetY(107);
        $this->pdf->Cell(0, 10,"DATE ET LIEU DE NAISSANCE : ............................................", 0, 1, "", 0);
        $this->pdf->SetY(114);
        $this->pdf->Cell(0, 10,  "DELIVRE LE : ............................................................................", 0, 1, "", 0);

        $this->pdf->SetY(60);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 8, "MARQUE : ".$this->Reservation[8], 1, 1, "", 0);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 8, "IMMAT : ".$this->Reservation[7], 1, 1, "", 0);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 8, "CAUTION : .......................................", 1, 1, "", 0);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 8, "TEL : ".$this->Reservation[4], 1, 1, "", 0);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 8, "TEL : ..............................................", 1, 1, "", 0);

        $this->pdf->SetY(102);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 13, "", 1, 1, "", 0);

        $this->pdf->SetY(101);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 10, "KM DEPART : .......................................", 0, 1, "", 0);
        $this->pdf->SetY(107);
        $this->pdf->SetX(130);
        $this->pdf->Cell(73, 10, "KM RETOUR : .......................................", 0, 1, "", 0);


        $this->pdf->SetY(125);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 60, "", 1, 1, "", 0);


        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->SetY(125);
        $this->pdf->SetX(60);
        $this->pdf->Cell(0, 10, "AUTRE CONDUCTEUR", 0, 1, "", 0);

        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetY(132);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 10, "NOM : .................................................................................", 0, 1, "", 0);
        $this->pdf->SetY(138);
        $this->pdf->Cell(0, 10, "PRENOM : .........................................................................", 0, 1, "", 0);
        $this->pdf->SetY(144);
        $this->pdf->Cell(0, 10, "NATIONALITE : .................................................................", 0, 1, "", 0);
        $this->pdf->SetY(150);
        $this->pdf->Cell(0, 10, "DATE ET LIEU DE NAISSANCE : ....................................", 0, 1, "", 0);
        $this->pdf->SetY(156);
        $this->pdf->Cell(0, 10, "ADRESSE : ........................................................................", 0, 1, "", 0);
        $this->pdf->SetY(162);
        $this->pdf->Cell(0, 10, "PERMIS DE CONDUIRE : .................................................", 0, 1, "", 0);
        $this->pdf->SetY(168);
        $this->pdf->Cell(0, 10, "DELIVRE LE : ....................................................................", 0, 1, "", 0);
        $this->pdf->SetY(174);
        $this->pdf->Cell(0, 10, "PASSEPORT / C.I.N N° : ...................................................", 0, 1, "", 0);


        $this->pdf->SetY(187);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 8, "DATE DE DEPART      :  ".$this->Reservation[15], 1, 1, "", 0);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 8, "HEURE                         :  ...................................................", 1, 1, "", 0);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 8, "DATE DE RETOUR      :  ".$this->Reservation[16], 1, 1, "", 0);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 8, "HEURE                         :  ...................................................", 1, 1, "", 0);
        $this->pdf->SetX(5);
        $this->pdf->Cell(120, 8, "DUREE D LOCATION  :  ".$this->NBJour." J", 1, 1, "", 0);



        
        $this->pdf->SetFont('Arial', '', 8);

        $this->pdf->Image('../Images/7.jpg', 192, 120,8,8);
        $this->pdf->Image('../Images/2.jpg', 192, 130,8,8);
        $this->pdf->Image('../Images/3.jpg', 192, 140,8,8);
        $this->pdf->Image('../Images/4.jpg', 192, 150,8,8);
        $this->pdf->Image('../Images/10.jpg', 192, 160,8,8);
        $this->pdf->Image('../Images/11.jpg', 192, 170,8,8);

        $this->pdf->SetY(120);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(124);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(120);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(124);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);


        $this->pdf->SetY(130);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(134);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(130);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(134);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);


        $this->pdf->SetY(140);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(144);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(140);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(144);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);

        $this->pdf->SetY(150);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(154);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(150);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(154);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);

        $this->pdf->SetY(160);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(164);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(160);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(164);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);

        $this->pdf->SetY(170);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(174);
        $this->pdf->SetX(175);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);

        $this->pdf->SetY(170);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);
        $this->pdf->SetY(174);
        $this->pdf->SetX(180);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);
        

        
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetY(183);
        $this->pdf->SetX(105);
        $this->pdf->Cell(0, 8, "Conditions Générale :", 0, 1, "C", 0);

        
        $this->pdf->Image('../Images/5.jpg', 130, 120, 40, 55);
        $this->pdf->Image('../Images/9.jpg',126, 190, 85, 30);
        $this->pdf->Image('../Images/1.jpg',126, 220, 84, 26);
        $this->pdf->Image('../Images/8.jpg',5, 228, 100, 18);

        
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetY(175);
        $this->pdf->SetX(126);
        $this->pdf->Cell(0, 8, "LAVAGE : ", 0, 1, "", 0);

        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->SetY(177);
        $this->pdf->SetX(145);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(177);
        $this->pdf->SetX(148);
        $this->pdf->Cell(3, 3, "OUI", 0, 1, "", 0);

        $this->pdf->SetY(177);
        $this->pdf->SetX(156);
        $this->pdf->Cell(3, 3, "", 1, 1, "C", 0);
        $this->pdf->SetY(177);
        $this->pdf->SetX(159);
        $this->pdf->Cell(3, 3, "NON", 0, 1, "", 0);

        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->SetY(247);
        $this->pdf->SetX(60);
        $this->pdf->Cell(0, 8, "TOTAL A PAYER :    ", 0, 1, "", 0);

        
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetY(247);
        $this->pdf->SetX(100);
        $this->pdf->Cell(0, 8, $this->Total." DHS", 0, 1, "", 0);

        $this->pdf->SetFont('Arial', '', 9.5);
        $this->pdf->SetY(254);
        $this->pdf->SetX(25);
        $this->pdf->Cell(0, 8, "J'ai lu, compris et j'approuve les termes et conditions d location de la société L.ZRAK CAR  SARL désignés dans le présent contrat", 0, 1, "C", 0);

     
        
        $this->pdf->Image('../Images/12.jpg',50, 260, 110, 10);

        $this->pdf->SetFont('Arial', '', 14);
        $this->pdf->SetY(268);
        $this->pdf->SetX(10);
        $this->pdf->Cell(0, 8, "Singnature de Client ", 0, 1, "", 0);

        $this->pdf->SetY(268);
        $this->pdf->SetX(70);
        $this->pdf->Cell(0, 8, "Signature de retour de voiture ", 0, 1, "", 0);

        $this->pdf->SetY(268);
        $this->pdf->SetX(150);
        $this->pdf->Cell(0, 8, "Signature de location", 0, 1, "", 0);

        
        
        



    }





    public function AfficherPDF()
    {
        $this->pdf->Output('table_service.pdf', 'I');
    }
}
