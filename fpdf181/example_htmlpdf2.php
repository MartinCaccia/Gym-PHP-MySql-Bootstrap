<?php
require('PDF_MySQL_Table.php');

$pdf=new PDF_HTML2();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
$pdf->Output();
?>