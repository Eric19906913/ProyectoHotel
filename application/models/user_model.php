<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model{
  var $table ="usuarios";
  var $column_order = array('id',null);
  var $column_search = array('usuarios.id','usuarios.User', 'usuarios.Email', 'usuarios.Telefono');
  var $order = array('id' => 'desc');

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function save(){ // Funcion para guardar los datos de los usuarios en la BDD
    var_export($_POST);
    if(!empty($_POST['user']) || !empty($_POST['correo']) || !empty($_POST['phone']) || !empty($_POST['consult'])){ //Verifica que no vengan vacios
    $data=array( // array asociativo con los datos que vienen por post
      'User' => $user=$_POST['user'], // se asigan cada variable a  cada columna de la BDD
      'Email' => $correo=$_POST['correo'],
      'Telefono' => $phone=$_POST['phone'],
      'Consulta' => $consulta=$_POST['consult']
    );
      $this->db->insert('usuarios', $data);//se insertan los datos en la BDD
    }else{
      return false;
    }
  }

  private function _get_datatables_query() // misma funcion que esta en Checkin model para crear las Datatables
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
  { //funcion para limitrar la cantidad de datos a mostrar
      $this->_get_datatables_query();
      if(isset($_POST['length']) && $_POST['length'] != -1)
          $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get();
      return $query;
  }

  public function get_by_id($id)
  {//buscar por ID
      $this->db->from($this->table);
      $this->db->where('id',$id);
      $query = $this->db->get();

      return $query->row();
  }

  public function update($where, $data)
  {//Buscar un dato para modificarlo y decirle donde esta
      $this->db->update($this->table, $data, $where);
      return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {//Borrar por ID
      $this->db->where('id', $id);
      $this->db->delete($this->table);
  }

  public function consultas(){
      $this->db->from($this->table);
      $query = $this->db->get();
      return $query->result();
  }//Trae todas las consultas de la BDD

  public function get_area_id_by_nombre($nombre){ // busca consultas basandose en el nombre
      $this->db->from($this->table);
      $this->db->where('nombre',$nombre);
      $query = $this->db->get();

      return $query->row();
  }
}
?>
