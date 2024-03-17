<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
	public function index()
	{
		$this->load->model('people_model', 'people');
		$people = $this->people->all();
		$this->loadWithTemplate('home', ["people" => $people]);
	}

	private function loadWithTemplate(string $view, mixed $data = null)
	{
		$this->load->view('components/header');
		$this->load->view($view, $data);
		$this->load->view('components/footer');
	}
}
