<?php
class Rss extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('rss_model');
	}
	public function view()
	{
	    $this->load->helper('form');
		
		$rawFeed = file_get_contents("http://prncloud.com/xml/rss_generico.php?clienteNews=277&paisNews=8");
		$xml = new SimpleXmlElement($rawFeed,LIBXML_NOCDATA);
         
		
		
		$this->rss_model->set_rss($xml);
		
		$data['title'] = "Criação de Newsletter";
		$data['content'] = $this->rss_model->get_rss();
		
        $this->load->view('templates/header', $data);
        $this->load->view('rss/home', $data);
        $this->load->view('templates/footer', $data);
	   
	}
}


