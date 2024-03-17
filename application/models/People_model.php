
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class People_model extends CI_Model
{
	public const TABLE_NAME = "people";
	public string $first_name;
	public string $last_name;
	public string $email_address;
	public string $phone_number;
	public string $notes;
	public string $date;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Retrieves a person record by ID.
	 *
	 * @param int $id The ID of the person to retrieve.
	 * @return stdClass The person object.
	 */
	public function get($id)
	{
		return json_decode(json_encode((object)$this->db->get_where(self::TABLE_NAME, "id = $id")->result()[0]), False);
	}

	/**
	 * Inserts a new person record into the database.
	 *
	 * @param string $first_name The first name of the person.
	 * @param string $last_name The last name of the person.
	 * @param string $email_address The email address of the person.
	 * @param string $phone_number The phone number of the person.
	 * @param string $notes Optional notes about the person.
	 * @return static The current instance of the model.
	 */
	public function insert(string $first_name, string $last_name, string $email_address, string $phone_number, string $notes = ""): static
	{
		$this->first_name    = $first_name;
		$this->last_name  	 = $last_name;
		$this->email_address = $email_address;
		$this->phone_number	 = $phone_number;
		$this->notes 		 = $notes;
		$this->date     	 = time();

		$this->db->insert(self::TABLE_NAME, $this);
		return $this;
	}

	/**
	 * Updates a person record in the database.
	 *
	 * @param int $id The ID of the person to update.
	 * @param string $first_name The first name of the person.
	 * @param string $last_name The last name of the person.
	 * @param string $email_address The email address of the person.
	 * @param string $phone_number The phone number of the person.
	 * @param string $notes Optional notes about the person.
	 * @return static The current instance of the model.
	 */
	public function update(int $id, string $first_name, string $last_name, string $email_address, string $phone_number, string $notes = ""): static
	{
		$this->first_name    = $first_name;
		$this->last_name  	 = $last_name;
		$this->email_address = $email_address;
		$this->phone_number	 = $phone_number;
		$this->notes 		 = $notes;

		$this->db->update(self::TABLE_NAME, $this, ['id' => $id]);
		return $this;
	}

	/**
	 * Deletes a person record from the database.
	 *
	 * @param int $id The ID of the person to delete.
	 */
	public function delete(int $id): void
	{
		$this->db->delete(self::TABLE_NAME, "id = $id");
	}

	/**
	 * Retrieves all person records from the database.
	 *
	 * @return array An array of person objects.
	 */
	public function all(): array
	{
		return $this->db->get(self::TABLE_NAME)->result();
	}

}
