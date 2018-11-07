<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("user_model","user");
    }
    public function ajax_listado(){
        $resultados = $this->user->get_datatables();

        $data = array();
        foreach($resultados->result() as $resultado) {
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
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
    public function ajax_delete($id){
        $datos_Consulta = $this->user->get_by_id($id);

        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
  }
}
?>
