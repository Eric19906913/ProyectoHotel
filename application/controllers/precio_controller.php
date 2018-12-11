<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precio_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("precio_model","precio"); //pseudonimo para acceder al modelo
    }

    public function selectAll(){
      $result = $this->precio->getAll();
      $data = array();
      foreach($result as $resultado){ //se crea un array asociativo con los resultados
        $data[]= array(
          $resultado->producto,
          $resultado->precio

        );
      }


      echo json_encode($data); //se "devuleve" un JSON para acceder en formato CLAVE:VALOR
    }
  }
?>
