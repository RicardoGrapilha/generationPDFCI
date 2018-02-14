<?php

class PdfGenerator
{
	public function generateMPDF($html='',$filename='', $title='')
	{
		include("./assets/plugins/mpdf/mpdf60/mpdf.php");
 
		if (!defined('_MPDF_TTFONTPATH')) {
			// an absolute path is preferred, trailing slash required:
			define('_MPDF_TTFONTPATH', realpath('fonts/'));
		}

		$mpdf = new mPDF();
		$this->add_custom_fonts_to_mpdf($mpdf); 
		$mpdf->SetDisplayMode('fullpage');
		$css = file_get_contents("assets/plugins/mpdf/css/estilo.css");
		$mpdf->WriteHTML($css,1);
		$mpdf->WriteHTML($html);
		$mpdf->SetTitle($title);
		//comenta para teste
		$mpdf->Output("{$filename}.pdf", 'I');
		//descomenta para teste
		//echo $html;
		exit;
	}
	function add_custom_fonts_to_mpdf($mpdf=null, $fonts_list =array()) {

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
}