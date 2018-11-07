<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckIn_model extends CI_Model{
  var $table ="checkin";
  var $column_order = array('id',null);
  var $column_search = array('checkin.id','checkin.Nombre', 'checkin.Apellido');
  var $order = array('id' => 'desc');

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function save(){
    //var_export($_POST);
    //if(!empty($_POST['user']) || !empty($_POST['correo']) || !empty($_POST['phone']) || !empty($_POST['consult'])){
    $data=array(
      'Nombre' => $nombre=$_POST['nombre'],
      'Apellido' => $apellido=$_POST['apellido'],
      'Dni' => $dni=$_POST['dni'],
      'Telefono' => $telefono=$_POST['telefono'],
      'Email' => $email=$_POST['email'],
      'FechaIngreso' => $fechaI=$_POST['fechaI'],
      'Ocupante'=> $ocupante=$_POST['ocupantes'],
      'TipoHabitacion'=>$tipoHabitacion=$_POST['tipoHabitacion']
      );
      $this->db->insert('checkin', $data);
    //}else{
      //return false;
    }

  private function _get_datatables_query()
  {

      $this->db->from($this->table);

      $i = 0;

      foreach ($this->column_search as $item) // loop column
      {
          if(isset($_POST['search']['value'])) // if datatable send POST for search
          {
              if($i===0) // first loop
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
      if(isset($_POST['length']) && $_POST['length'] != -1)
          $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query;
  }

  public function get_by_id($id)
  {
      $this->db->from($this->table);
      $this->db->where('id',$id);
      $query = $this->db->get();

      return $query->row();
  }

  public function update($where, $data)
  {
      $this->db->update($this->table, $data, $where);
      return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
      $this->db->where('id', $id);
      $this->db->delete($this->table);
  }

  public function all(){
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
  }

  public function get_area_id_by_nombre($nombre){
      $this->db->from($this->table);
      $this->db->where('nombre',$nombre);
      $query = $this->db->get();

      return $query->row();
  }
}
?>
