<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckIn_controller extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("checkIn_model","checkIn");
    }
    public function Guardar(){
      $this->checkIn->save();
    }
    public function ajax_listado(){
        $resultados = $this->checkIn->get_datatables();

        $data = array();
        foreach($resultados->result() as $resultado) {
            $accion = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Borrar" onclick="delete_consulta('."'".$resultado->id."'".')"><i class="fas fa-trash"></i></a>
                      <a class="btn btn-sm btn-alert" href="#" title="Consumos" onclick="relocate()"><i class="fas fa-utensils"></i>';

            $data[] = array(
                $resultado->Nombre,
                $resultado->Apellido,
                $resultado->Telefono,
                $resultado->FechaIngreso,
                $resultado->Ocupante,
                $resultado->TipoHabitacion,
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
        $datos_Consulta = $this->checkIn->get_by_id($id);

        $this->checkIn->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
?>
