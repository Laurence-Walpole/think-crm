<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 * This class extends the core CI_Controller class and provides
 * a common constructor and methods to be used across the application.
 */
class MY_controller extends CI_Controller
{
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Load With Template method
	 *
	 * This method simplifies the process of loading a view with a common header and footer. It loads the header and footer
	 * components around the specified view, effectively wrapping the view content with a consistent layout.
	 *
	 * @param string $view The name of the view file to be loaded.
	 * @param mixed $data (optional) Any data that needs to be passed to the view.
	 */
	protected function loadWithTemplate(string $view, mixed $data = null)
	{
		$this->load->view('components/header');
		$this->load->view($view, $data);
		$this->load->view('components/footer');
	}
}
