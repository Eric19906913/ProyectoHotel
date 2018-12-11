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
    public function ajax_listado(){ //funcion para crear un listado mediante ajax
        $resultados = $this->checkIn->get_datatables();

        $data = array();
        foreach($resultados->result() as $resultado) { // crea un array asociativo para cada dato extraido de la BDD
            $accion = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Borrar" onclick="delete_consulta('."'".$resultado->id."'".')"><i class="fas fa-trash"></i></a>
                      <a class="btn btn-sm btn-alert" href="#" title="Consumos" onclick="relocate()"><i class="fas fa-utensils"></i>';

            $data[] = array( //Array asociativo
                $resultado->Nombre, // accede a cada campo dentro del $resultado y crea un array con cada juego de resultados
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
            "data" => $data //Array con la cantidad de resultados y la cantidad de filtros para la busqueda en la DataTable
        );
        echo json_encode($output); //Envia elk resultado en formato JSON para poder acceder facilmente a los valores
        exit();
    }
    public function ajax_delete($id){ // funcion para borrar por Id
        $datos_Consulta = $this->checkIn->get_by_id($id);

        $this->checkIn->delete_by_id($id);
        echo json_encode(array("status" => TRUE)); //envia un JSON cambiando el STATUS de la eliminacin
    }

}
?>
