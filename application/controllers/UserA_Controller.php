<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserA_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("UserA_model","modeloA");//pseudonimo para modelo
    }
    public function UsuarioA(){
      $nombreA = $this->input->post('usuario');// accede a los post creados por un input y los asigna a una variable
      $contraA = $this->input->post('contraseña');
      $usuario = $this->userA_model->log($nombreA, $contraA);
      if($usuario){ // array asociativo con la informacion a recuperar
        $usuario_data = array(
          'id' => $usuario->id,
          'nombre' =>$usuario->usuarioA,
          'logeado'=> TRUE
        );
      }
    }
/*
#Esta funcion es para el login de un administrador por lo tanto no esta implementada totalmente!!!!
*/
?>
