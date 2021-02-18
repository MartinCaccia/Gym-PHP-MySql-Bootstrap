<?php
include '../include/db_conn.php';
//page_protect();

require('PDF_MySQL_Table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'World populations',0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}

//Connect to database
//mysql_connect('server','login','password');
//mysql_select_db('db');

$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically
$pdf->Table($con, 'select dni, name, LastName  from Persons order by name');
$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('dni',20,'','DNI');
$pdf->AddCol('name',40,'Name');
$pdf->AddCol('LastName',40,'Pop (2001)','LastName');
$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
$pdf->Table($con, 'select dni, name, LastName  from Persons order by name',$prop);
$pdf->Output();

/* Deprecado:
$paperpdf = new paperpdf; 
$paperpdf->IncludeJS("print('true');"); 
$paperpdf->Output('doc.pdf','I');  
*/
?>