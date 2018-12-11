<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("user_model","user"); //pseudonimo para modelo
    }

    public function guardar(){ // accede al metodo save del modelo

       $this->user->save();


    }

  }


?>
