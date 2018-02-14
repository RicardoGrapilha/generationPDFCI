<?php 
 include("mpdf60/mpdf.php");
if (!defined('_MPDF_TTFONTPATH')) {
    // an absolute path is preferred, trailing slash required:
    define('_MPDF_TTFONTPATH', realpath('fonts/'));
    // example using Laravel's resource_path function:
    // define('_MPDF_TTFONTPATH', resource_path('fonts/'));
}

function add_custom_fonts_to_mpdf($mpdf, $fonts_list) {

    $fontdata = [
        'avenirbook' => [
            'R' => 'Avenir-Book.ttf',
           
        ],
        'verdana' => [
            'R' => 'Verdana.ttf',
           
        ],
        'agentorange' => [
            'R' => 'AGENTORANGE.TTF',
           
        ],
        
    ];

    foreach ($fontdata as $f => $fs) {
        // add to fontdata array
        $mpdf->fontdata[$f] = $fs;

        // add to available fonts array
        foreach (['R', 'B', 'I', 'BI'] as $style) {
            if (isset($fs[$style]) && $fs[$style]) {
                // warning: no suffix for regular style! hours wasted: 2
                $mpdf->available_unifonts[] = $f . trim($style, 'R');
            }
        }

    }

    $mpdf->default_available_fonts = $mpdf->available_unifonts;
}

 $html = "
 <fieldset>
 <h1>Comprovante de Recibo</h1>
 <p class='center sub-titulo'>
 Nº <strong>0001</strong> - 
 VALOR <strong>R$ 700,00</strong>
 </p>
 <p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
 <p>a quantia de <strong>Setecentos Reais</strong></p>
 <p>Correspondente a <strong>Serviços prestados ..<strong></p>
 <p>e para clareza firmo(amos) o presente.</p>
 <p class='direita'>Itapeva, 11 de Julho de 2017</p>
 <p>Assinatura ......................................................................................................................................</p>
 <p>Nome <strong>Alberto Nascimento Junior</strong> CPF/CNPJ: <strong>222.222.222-02</strong></p>
 <p>Endereço <strong>Rua Doutor Pinheiro, 144 - Centro, Itapeva - São Paulo</strong></p>
 </fieldset>
 <div class='creditos'>
 <p><a href='https://www.webcreative.com.br/artigo/gerar-pdf-com-php-e-html-usando-a-biblioteca-mpdf' target='_blank'>Aprenda como gerar PDF com PHP e HTML usando a biblioteca MPDF aqui</a></p>
 <p  style='font-family: freemono;     font-weight: bold;'>freemono bold</p>
 <p  style='font-family: freemono;     '>freemono </p>
 <p  style='font-family: verdana;     '>verdana </p>
 <p  style='font-family: arial;     '>arial </p>
 <p  style='font-family: calibri;     '>Calibri </p>
 <p  style='font-family: agentorange;     '>AGENTORANGE </p>



 <p  style='font-family: avenirbook;     '>avenirbook </p>
 </div>
 ";

 //$mpdf=new mPDF();
 $mpdf = new mPDF();
add_custom_fonts_to_mpdf($mpdf); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();
//echo $html;
 exit;