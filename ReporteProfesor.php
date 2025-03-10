<?php
require('./fpdf.php');

class PDF extends FPDF
{
   // Cabecera de página  
   function Header()
   {
      include '../../RegistroA-Melany/Bd_registro.php';

      $this->Image('LogoCrua.png', 160, 5, 28);
      $this->Image('innovacion.png', 121, 9, 38);
      
      $this->Ln(30);

      $this->SetFont('Times', 'B', 15);
      $this->Cell(95);
      $this->Cell(110, 10, utf8_decode('UNIVERSIDAD DE PANAMÁ'), 0, 1, 'C', 0);
      $this->SetFont('Times', '', 14);
      $this->Cell(94);
      $this->Cell(110, 5, utf8_decode('Centro Regional Universitario de Azuero'), 0, 1, 'C', 0);
      $this->Cell(94);
      $this->Cell(110, 10, utf8_decode('Departamento de innovación tecnológica'), 0, 1, 'C', 0);
      $this->Ln(7);
      $this->SetTextColor(43, 66, 116);
      $this->Cell(100);
      $this->SetFont('Times', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE REGISTROS DE ENTIDAD PROFESOR "), 0, 1, 'C', 0);
      $this->Ln(20);

      // Encabezado de la tabla
      $this->SetFillColor(200, 200, 200);
      $this->SetTextColor(6, 4, 4);
      $this->SetFont('Times', 'B', 11);
      $this->SetX(5);
      $this->Cell(10, 10, utf8_decode('#'), 1, 0, 'C', 1);
      $this->Cell(34, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(36, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
      $this->Cell(34, 10, utf8_decode('Cédula'), 1, 0, 'C', 1);
      $this->Cell(39, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
      $this->Cell(34, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
      $this->Cell(34, 10, utf8_decode('Entidad'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Tipo de atención'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Detalle de atención'), 1, 1, 'C', 1); 
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Times', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $hoy = date('d/m/Y');
      $this->Cell(0, 10, utf8_decode($hoy), 0, 0, 'R'); 
   }
}

include '../../RegistroA-Melany/Bd_registro.php';

$pdf = new PDF();
$pdf->AddPage("L"); 
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Times', '', 12);
$pdf->SetDrawColor(163, 163, 163);

$sql_reporte_entidades = $conn->query("
    SELECT id, nombre, apellido, cedula, fecha, telefono, entidad, tipoatencion, otro
    FROM controlatencion
    WHERE entidad = 'Profesor'
");

while ($datos_reporte = $sql_reporte_entidades->fetch_object()) {      
   $i++;
   /* TABLA */
   $pdf->SetX(5);
   $pdf->Cell(10, 10, utf8_decode($i), 1, 0, 'C', 0);
   $pdf->Cell(34, 10, utf8_decode($datos_reporte->nombre), 1, 0, 'C', 0);
   $pdf->Cell(36, 10, utf8_decode($datos_reporte->apellido), 1, 0, 'C', 0);
   $pdf->Cell(34, 10, utf8_decode($datos_reporte->cedula), 1, 0, 'C', 0);
   $pdf->Cell(39, 10, utf8_decode($datos_reporte->telefono), 1, 0, 'C', 0);
   $pdf->Cell(34, 10, utf8_decode($datos_reporte->fecha), 1, 0, 'C', 0);
   $pdf->Cell(34, 10, utf8_decode($datos_reporte->entidad), 1, 0, 'C', 0);
   $pdf->Cell(35, 10, utf8_decode($datos_reporte->tipoatencion), 1, 0, 'C', 0);
   $pdf->Cell(35, 10, utf8_decode($datos_reporte->otro), 1, 1, 'C', 0); 
}

$pdf->Output('Reporte de Profesor.pdf', 'I');
