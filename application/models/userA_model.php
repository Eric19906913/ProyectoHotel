<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserA_model extends CI_Model{
  var $table ="usuariosa";
/*
#Esto todavia no esta implementado. es el modelo de usuarioA!

*/
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }
  public function log($nombreA, $contraA){
    $this->db->where('usuarioA', $nombreA)->('contraA',$contraA);
    $consulta = $this->db->get();

    if($consulta->num_rows > 0){
      return TRUE;
    }else{
      return 'Usuario o contraseña incorrectos';
    }

  }

?>
