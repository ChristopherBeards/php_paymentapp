<?php
  class Customer {
    // Create a private property
    private $db;

    // Create a constructor
    public function __construct() {
      // Instantiates a new Database from file pdo_db.php
      $this->db = new Database;
    }

    public function addCustomer($data) {
      // Prepare Query
      $this->db->query('INSERT INTO customers (id, first_name, last_name, email) VALUES(:id, :first_name, :last_name, :email)');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':first_name', $data['first_name']);
      $this->db->bind(':last_name', $data['last_name']);
      $this->db->bind(':email', $data['email']);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }