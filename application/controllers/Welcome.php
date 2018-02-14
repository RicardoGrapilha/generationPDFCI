<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->library('pdfgenerator');
 		
	    $html = $this->load->view('welcome_message', array(), true);
	    
		$this->load->library('pdfgenerator');
	   
	   	$this->pdfgenerator->generateMPDF($html, "meu_pdf", 'PDF Bom');
	}

}
