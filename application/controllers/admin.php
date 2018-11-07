<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Admin extends CI_Controller {
    public function index(){
      $this->load->view('admin/admin');
    }
    public function CheckIn(){
      $this->load->view('admin/CheckIn');
    }
    public function consulta(){
      $this->load->view('admin/ConsultaCheckin');
    }
    public function consumos(){
      $this->load->view('admin/consumos');
    }

  }
