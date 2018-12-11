<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precio_model extends CI_Model{
 var $table ="precio";
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function getAll(){ // trae todos los precios de la BDD
    $this->db->from($this->table);
    $query = $this->db->get();
    return $query->result();
  }
}

?>
