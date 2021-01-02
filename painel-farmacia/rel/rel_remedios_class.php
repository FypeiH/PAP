<?php 

include('../../conexao.php');

date_default_timezone_set('Europe/Lisbon');

//Carregar Dompdf
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;


//Alimentar os dados do Relatório
$html = utf8_encode(file_get_contents($url_sistema."/painel-farmacia/rel/rel_remedios.php"));


//Inicia a classe do dompdf
$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//Carregar o conteúdo html
$pdf->load_html(utf8_decode($html));

//Renderizar o pdf
$pdf->render();

//Nomear o pdf gerado
$pdf->stream(
'relatorioRemedios.pdf',
array("Attachment" => false)
);


