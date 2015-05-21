<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('cliente_model');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->lang->load('ion_auth');
		$this->lang->load('auth');
		$this->load->library('unit_test');
	}

	function index()
	{

		$prueba = $this->ion_auth->fechaI();
		$resultado = date_create(date('d-m-Y'));
		$nombre = "prueba fecha inicial";
		$data['pruebaFI'] = $this->unit->run($prueba, $resultado, $nombre);

		$prueba = $this->ion_auth->fechaF();
		$resultado = date_add(date_create(date('d-m-Y')), date_interval_create_from_date_string('10 days'));
		$nombre = "prueba fecha Final";
		$data['pruebaFF'] = $this->unit->run($prueba, $resultado, $nombre);

		$prueba = $this->ion_auth->obtenerMax();
		$resultado = $_SESSION["max"];
		$nombre = "prueba obtener Max";
		$data['pruebaoM'] = $this->unit->run($prueba, $resultado, $nombre);

		$prueba = $this->ion_auth->obtenerArray();
		$resultado = $_SESSION["array"];
		$nombre = "prueba obtener array";
		$data['pruebaoA'] = $this->unit->run($prueba, $resultado, $nombre);

		$data['title'] = "test unit";
		$data['contenido'] = "pruebas";
		$this->load->view('test',$data);
	}


}