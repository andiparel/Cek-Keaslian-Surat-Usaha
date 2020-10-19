<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Surat_model', 'surat');
    $this->load->library('rc4');
  }

  public function index()
  {
    $this->load->view('validasi/gagal');
  }

  public function izin_usaha($no_surat)
  {
    $x = strlen($no_surat);
    $key = '1234';
    if ($x % 2 == 0) {
      // cek apakah panjang chiphertext genap
      $dekrip = $this->rc4->dekripsi($key, $no_surat);
      $data['surat'] = $this->db->get_where('surat', ['nomer_surat' => $dekrip])->row_array();

      if ($data['surat'] != null) {
        $data['jenis'] = 'Surat Izin Usaha';
        $this->load->view('validasi/berhasil', $data);
      } else {
        $this->load->view('validasi/gagal');
      }
    } else {
      //jika panjang chiphertext ganjil maka tambahkan satu karakter (0) di belakang chiphertext
      $no_surat .= '0';
      $dekrip = $this->rc4->dekripsi($key, $no_surat);
      $data['surat'] = $this->db->get_where('surat', ['nomer_surat' => $dekrip])->row_array();

      if ($data['surat'] != null) {
        $data['jenis'] = 'Surat Izin Usaha';
        $this->load->view('validasi/berhasil', $data);
      } else {
        $this->load->view('validasi/gagal');
      }
    }
  }
}
