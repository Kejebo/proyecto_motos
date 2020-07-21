<?php
require_once('db/db_workshop.php');

class ln_workshop
{
  var $db;
  function __construct()
  {
    $this->db = new db_workshop();
  }

  function action_controller()
  {
    if (isset($_GET['action'])) {
      switch ($_GET['action']) {
        case 'delete':
          $this->delete($_GET['id']);
          break;
        case 'update_repair':
          $this->insert($_POST);
          header('Location: repairs.php');
          break;
          case 'insert_detail':
            $this->update_work($_POST);
            header('Location: repairs.php');
            break;
        case 'insert_work':
          $this->insert_work($_POST);
          header('Location: workshop.php?action=update&id=' . $this->db->get_last_id());
          break;

        case 'insert_trabajo':
          $this->db->insert_work($_POST);
          header('Location: works.php');
          break;
        case 'insert_work':
          $this->insert_work($_POST);
          break;

        case 'update_work':
          $this->update_work($_POST);
          break;
      }
    }
  }

  function insert_work($data)
  {
    $this->db->insert_repair($data);

    extract($data);
    $ultima = $this->db->get_last_id();
    if (isset($materiales)) {
      foreach ($materiales as $datos) {
        $this->db->insert_material(json_decode($datos, true), $ultima);
      }
    }
    if (isset($trabajos)) {
      foreach ($trabajos as $works) {
        $this->db->insert_work_detail(json_decode($works, true), $ultima);
      }
    }
  }

  function update_work($data)
  {

    extract($data);
    $this->db->delete_works($id);
    $this->db->delete_materialwork($id);
    if (isset($materiales)) {
      foreach ($materiales as $datos) {
        $this->db->insert_material(json_decode($datos, true), $id);
      }
    }
    if (isset($trabajos)) {
      foreach ($trabajos as $works) {
        $this->db->insert_work_detail(json_decode($works, true), $id);
      }
    }
  }


  function delete($id)
  {
    $this->db->delete_work($id);
  }
  function get_repair($id)
  {
    return $this->db->get_repair($id);
  }
  function get_repairs()
  {
    return $this->db->get_repairs();
  }

  function get_reparacion_moto($id)
  {
    $data = $this->db->get_reparacion_moto($id);
    if ($data != false) {
      return $data;
    } else {
      return array();
    }
  }
  function insert($data)
  {
    $this->db->close_work($data);
  }
  function get_works()
  {
    return $this->db->get_works();
  }
}
