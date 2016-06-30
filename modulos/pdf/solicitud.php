
<?php
require_once("dompdf/dompdf_config.inc.php");
spl_autoload_register('DOMPDF_autoload');
function pdf_create($html, $stream=TRUE){
  $dompdf = new DOMPDF();
  $dompdf->load_html($html, 'UTF-8');
  $dompdf->set_paper("letter", "landscape");
  $dompdf->render();
  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  //$dompdf->stream("dompdf_out.pdf", $dompdf->output()); //Descarga el pdf
}
$DOMPDF = new DOMPDF();
$html = file_get_contents("http://admonkco.com/rhkarlco/modulos/solicitante/final.php");
pdf_create($html);
?>