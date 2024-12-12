<?php

require('fpdf.php'); // Asegúrate de incluir la clase FPDF

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, '¡Hola, mundo!');

// Guardar el PDF en un archivo
$pdfFilePath = 'archivo.pdf';
$pdf->Output($pdfFilePath, 'F');

// Enviar el correo electrónico
$to = 'destinatario@example.com';
$subject = 'Aquí está tu PDF';
$message = 'Adjunto encontrarás el archivo PDF.';
$headers = "From: remitente@example.com\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

// Crear el cuerpo del correo
$body = "--boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $message . "\r\n";
$body .= "--boundary\r\n";
$body .= "Content-Type: application/pdf; name=\"archivo.pdf\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"archivo.pdf\"\r\n\r\n";
$body .= chunk_split(base64_encode(file_get_contents($pdfFilePath))) . "\r\n";
$body .= "--boundary--";

// Enviar el correo
mail($to, $subject, $body, $headers);

?>
