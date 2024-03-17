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

	public function update(int $id, string $first_name, string $last_name, string $email_address, string $phone_number, string $notes = ""): static
	{
		$this->first_name    = $first_name;
		$this->last_name  	 = $last_name;
		$this->email_address = $email_address;
		$this->phone_number	 = $phone_number;
		$this->notes 		 = $notes;
		$this->date     	 = time();

		$this->db->update(self::TABLE_NAME, $this, ['id' => $id]);
		return $this;
	}

	public function delete(int $id): void
	{
		$this->db->delete(self::TABLE_NAME, $id);
	}

	public function all(): array
	{
		return $this->db->get(self::TABLE_NAME)->result();
	}

}
