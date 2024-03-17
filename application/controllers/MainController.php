<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MY_controller.php";

class MainController extends MY_Controller {

	/**
	 * Index method
	 *
	 * This method is the default entry point for the application. It is responsible for loading the necessary helpers,
	 * models, retrieving all the people records, sorting them by last name, and displaying the home view with the data.
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->model('people_model', 'people');

		$people = $this->people->all();
		$message = $this->session->flashdata('message');

		usort($people, function($p1, $p2) {
			return $p1->last_name <=> $p2->last_name;
		});

		$this->loadWithTemplate('home', ["people" => $people, "message" => $message]);
	}
}
