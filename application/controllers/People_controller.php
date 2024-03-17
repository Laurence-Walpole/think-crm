<?php
defined('BASEPATH') or exit('No direct script access allowed');

include "MY_controller.php";

class People_controller extends MY_Controller
{
	/**
	 * Adds a new person to the database.
	 * If the form validation fails, it reloads the add form template with errors.
	 * If the validation passes, it inserts the new person into the database and
	 * sets a flash message indicating success before redirecting to the homepage.
	 */
	public function add(): void
	{
		if ($this->validate()) {
			$this->loadWithTemplate('add');
		} else {
			$this->load->model('people_model', 'people');
			$this->people->insert($_POST['first_name'], $_POST['last_name'], $_POST['email_address'],
				$_POST['phone_number'], $_POST['notes']);
			$this->session->set_flashdata('message',"Person was added!");

			redirect('/');
		}
	}
	
	/**
	 * Edits an existing person in the database.
	 * If the form validation fails, it reloads the edit form template with the existing person's data.
	 * If the validation passes, it updates the person's information in the database and
	 * sets a flash message indicating success before redirecting to the homepage.
	 *
	 * @param string $id The unique identifier of the person to be edited.
	 */
	public function edit(string $id): void
	{
		$this->load->model('people_model', 'people');
		if ($this->validate()) {
			$person = $this->people->get($id);
			$this->loadWithTemplate('edit', ["person" => $person]);
		}else {
			$this->people->update((int) $id, $_POST['first_name'], $_POST['last_name'], $_POST['email_address'],
				$_POST['phone_number'], $_POST['notes']);
			$this->session->set_flashdata('message',"Person was updated!");
	
			redirect('/');
		}
	}

	/**
	 * Deletes a person from the database.
	 * It loads the necessary helpers and model, calls the delete method from the people_model,
	 * sets a flash message indicating success, and redirects to the homepage.
	 *
	 * @param string $id The unique identifier of the person to be deleted.
	 */
	public function delete(string $id): void
	{
		$this->load->helper('url');
		$this->load->model('people_model', 'people');
		if (!$this->people->delete($id)) {
		    $this->session->set_flashdata('message', "Person could not be deleted!");
		} else {
		    $this->session->set_flashdata('message', "Person was deleted!");
		}
	
		redirect('/');
	}

	/**
	 * Validates the input data for adding or editing a person.
	 * It loads necessary helpers, sets validation rules for each input field, and runs the validation process.
	 * The phone number validation uses a regex pattern to ensure proper format.
	 *
	 * @return bool Returns TRUE if validation fails, FALSE otherwise.
	 */
	private function validate(): bool
	{
		$this->load->helper(['form', 'url']);
		$this->load->library('form_validation');
	
		$phoneRegex = "regex_match[/^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/]";
	
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone_number', 'Phone Number', "trim|required|$phoneRegex");
	
		return !$this->form_validation->run();
	}

}
