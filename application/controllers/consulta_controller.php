<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("user_model","user"); //esto sirve para ponerle un pseudonimo a al modelo con el que se desea trabajar
    }
    public function ajax_listado(){
        $resultados = $this->user->get_datatables();

        $data = array();
        foreach($resultados->result() as $resultado) { //se crea un array asociativo con cada resultados de la consulta a la BDD
            $accion = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Borrar" onclick="delete_consulta('."'".$resultado->id."'".')"><i class="fas fa-trash"></i></a>';

            $data[] = array(
                $resultado->User,
                $resultado->Email,
                $resultado->Telefono,
                $resultado->Consulta,
                $accion
            );
        }

        $output = array(
            "recordsTotal" => $resultados->num_rows(),
            "recordsFiltered" => $resultados->num_rows(),
            "data" => $data // se establecen la cantidad de resultados y los filtros
        );
        echo json_encode($output); // se envian los filtros y los resultados por JSON junto con el array que contiene los datos
        exit();
    }
    public function ajax_delete($id){ // funcion para borrar por id
        $datos_Consulta = $this->user->get_by_id($id); // pide los ID dentro de la tabla "user"

        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE)); //devuelvo true al estado de eliminacion
  }
}
?>
