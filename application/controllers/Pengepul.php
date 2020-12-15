<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Pengepul extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengepul_model');
  }

  public function index_get()
  {

    $pengepul = $this->pengepul_model->getAllData();

    $data = [
      'status' => true,
      'data' => $pengepul
    ];

    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function index_delete()
  {
    $id = $this->delete('id');
    if ($id === null) {
      $this->response([
        'status' => false,
        'msg' => 'Tidak ada id yang dipilih'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->pengepul_model->deletePengepul($id) > 0) {
        $this->response([
          'status' => true,
          'id' => $id,
          'msg' => 'Data berhasil dihapus'
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'msg' => 'Id tidak ditemukan'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }

  public function index_post()
  {
    $data = [
      'ID' => $this->post('id'),
      'ID_PENG' => $this->post('id_peng'),
      'NAMA_PENG' => $this->post('nama_peng'),
      'ALAMAT_PENG' => $this->post('alamat_peng'),
      'TELP_PENG' => $this->post('telp_peng'),
      'STATUSS' => $this->post('status'),
      'TANGGAL_BUAT' => $this->post('tanggal_buat'),
      'DIBUAT_OLEH' => $this->post('dibuat_oleh'),
      'TANGGAL_UBAH' => $this->post('tanggal_ubah'),
      'DIUBAH_OLEH' => $this->post('diubah_oleh'),
    ];

    $simpan = $this->pengepul_model->tambahPengepul($data);
    
    if ($simpan['status']) {
      $this->response(['status' => true, 'msg' => 'Data telah ditambahkan'], REST_Controller::HTTP_OK);
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  public function index_put()
  {
    $data = [
      'ID' => $this->put('id'),
      'ID_PENG' => $this->put('id_peng'),
      'NAMA_PENG' => $this->put('nama_peng'),
      'ALAMAT_PENG' => $this->put('alamat_peng'),
      'TELP_PENG' => $this->put('telp_peng'),
      'STATUSS' => $this->put('status'),
      'TANGGAL_BUAT' => $this->put('tanggal_buat'),
      'DIBUAT_OLEH' => $this->put('dibuat_oleh'),
      'TANGGAL_UBAH' => $this->put('tanggal_ubah'),
      'DIUBAH_OLEH' => $this->put('diubah_oleh'),
    ];

    $id = $this->put('id');
    
    $simpan = $this->pengepul_model->updatePengepul($data, $id);

    if ($simpan['status']) {
      $status = (int) $simpan['data'];
      if ($status > 0) {
        $this->response(['status' => true, 'msg' => 'Data telah diupdate'], REST_Controller::HTTP_OK);
      } else {
        $this->response(['status' => false, 'msg' => 'Tidak ada data yang dirubah'], REST_Controller::HTTP_BAD_REQUEST);
      }
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
  

 
}
