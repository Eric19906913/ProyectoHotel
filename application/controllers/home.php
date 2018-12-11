<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Home extends CI_Controller {
    public function index(){
      $this->load->view('principal'); //carga las vistas mediante la funcion view de CodeIgniter
    }
    public function reserva(){
      $this->load->view('reserva');//provisorio hasta hacer un index como la gente
    }
    public function eleccion(){
      $this->load->view('eleccion');
    }
  }
?>
