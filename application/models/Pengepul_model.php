<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengepul_model extends CI_Model
{
  public function getAllData()
  {
    return $this->db->get('m_pengepul')->result();
  }

  public function deletePengepul($id)
  {
    $this->db->delete('m_pengepul', ['ID' => $id]);
    return $this->db->affected_rows();
  }

  public function tambahPengepul($data)
  {
    try {
      $this->db->insert('m_pengepul', $data);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }

  public function updatePengepul($data, $id)
  {
    try {
      $this->db->where('ID', $id);
      $this->db->update('m_pengepul', $data);

      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }

}