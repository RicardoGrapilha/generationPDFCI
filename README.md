# generationPDFCI
Hello, this project serves to generate a PDF using the CodeIgniter framework and its MPDF library


# Project Settings
Real Estate Management

Assets/plugins/mpdf  `main library`

assets/fonts/ `where the fonts are`

application/libraries/PdfGenerator `it calls MPDF with its settings.`

   Inside it has a `generateMPDF ($ html = '', $ filename = '', $ title = '')` function where you pass the HTML, File name and Title that will appear on the page as parameters.

```php
//CONTROLLER
public function index ()
{
	//call function in library
	$this->load->library('pdfgenerator');
	//load view HTML
	$html = $this->load->view('welcome_message', array (), true);
	//Print PDF 
	$this->pdfgenerator->generateMPDF($ html, "my_pdf_for_download", 'Title Good PDF');
}
```
# Library
```php
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
		//not working
		$css = file_get_contents("assets/plugins/mpdf/css/estilo.css");
		$mpdf->WriteHTML($css,1);
		//view html
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
```
