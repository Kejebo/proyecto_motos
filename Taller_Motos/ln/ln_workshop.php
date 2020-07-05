<?php
include 'db/db_client.php';
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
        case 'insert':
          $this->insert($_POST);
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


        case 'insert_detail':
          $this->insert_detail($_POST);
          header('Location: repairs.php');
          break;

        case 'update_work':
          $this->update_work($_POST);
          header('Location: repairs.php');

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

  function insert_detail($data)
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

  function update_work($data)
  {
    $this->db->update_work($data);
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
  function insert($data)
  {
    $this->db->close_work($data);
  }
  function get_works()
  {
    return $this->db->get_works();
  }
}
