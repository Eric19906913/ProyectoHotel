<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckIn_model extends CI_Model{
  var $table ="checkin"; //nombre de la tabla para acceder con la variable $table
  var $column_order = array('id',null); // parametro para odenar la DataTabke
  var $column_search = array('checkin.id','checkin.Nombre', 'checkin.Apellido'); // Parametros para busqueda en la Datatable
  var $order = array('id' => 'desc'); // Orden de la DataTable

  public function __construct()
  {
      parent::__construct();
      $this->load->database();//caragar BDD
  }

  public function save(){ //funcion para insertar datos en la BDD

    $data=array( // crea un array asociativo con los datos que llegan por POST
      'Nombre' => $nombre=$_POST['nombre'],
      'Apellido' => $apellido=$_POST['apellido'],
      'Dni' => $dni=$_POST['dni'],
      'Telefono' => $telefono=$_POST['telefono'],
      'Email' => $email=$_POST['email'],
      'FechaIngreso' => $fechaI=$_POST['fechaI'],
      'Ocupante'=> $ocupante=$_POST['ocupantes'],
      'TipoHabitacion'=>$tipoHabitacion=$_POST['tipoHabitacion']
      );
      $this->db->insert('checkin', $data); // inserta los datos recuperados en la BDD
    //}else{
      //return false;
    }

  private function _get_datatables_query()
  {

      $this->db->from($this->table); // Selecciona la tabla de donde se van a buscar los datos

      $i = 0;

      foreach ($this->column_search as $item) // Busca en la columna cada item
      {
          if(isset($_POST['search']['value'])) // este if gestiona la busqueda una vez que la DataTable esta cargadad
          {
              if($i===0) // primer loop compara que $i sea del mismo valor y del mismo tipo que 0;
              {
                  $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                  $this->db->like($item, $_POST['search']['value']);
              }
              else
              {
                  $this->db->or_like($item, $_POST['search']['value']);
              }

              if(count($this->column_search) - 1 == $i) //last loop
                  $this->db->group_end(); //close bracket
          }
          $i++;
      }

      if(isset($_POST['order'])) // here order processing
      {
          $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else if(isset($this->order))
      {
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
      }
  }

  function get_datatables()
  {
      $this->_get_datatables_query();
      if(isset($_POST['length']) && $_POST['length'] != -1)//limitar la cantidad de datos que se muestran por pagina
          $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query;
  }

  public function get_by_id($id)
  {//Busca elementos por ID en la BDD recibiendo como parametro el ID
      $this->db->from($this->table);
      $this->db->where('id',$id);
      $query = $this->db->get();

      return $query->row();
  }

  public function update($where, $data) //actualiza los datos seleccionados pidiendo como parametro el dato y en que tabla se encuentra
  {
      $this->db->update($this->table, $data, $where);
      return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
      $this->db->where('id', $id); //borra buscando por ID
      $this->db->delete($this->table);
  }

  public function all(){//selecciona todos los datos de una tabla
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
  }

  public function get_area_id_by_nombre($nombre){ //selecciona datos de una tabla por nombre
      $this->db->from($this->table);
      $this->db->where('nombre',$nombre);
      $query = $this->db->get();

      return $query->row();
  }
}
?>
