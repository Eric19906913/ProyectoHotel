<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precio_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("precio_model","precio");
    }

    public function selectAll(){
      $result = $this->precio->getAll();
      $data = array();
      foreach($result as $resultado){
        $data[]= array(
          $resultado->producto,
          $resultado->precio

        );
      }


      echo json_encode($data);
    }
  }
?>
