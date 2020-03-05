<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database(); //menghubungkan database
    }

    function index_get() { //fungsi menampilkan data
        $id = $this->get('id'); //memanggil/menampilkan data berdasarkan id
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result(); 
        } else {
            $this->db->where('id', $id); 
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { //fungsi menambahkan data
        $data = array(
                    'id'           => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'nomor'    => $this->post('nomor'));
        $insert = $this->db->insert('telepon', $data); //menambahkan data berdasarkan id
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() { //fungsi mengubah data
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'nomor'    => $this->put('nomor'));
        $this->db->where('id', $id);
        $update = $this->db->update('telepon', $data); //mengubah data berdasarkan id
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() { //fungsi mengjapus data 
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon'); //menghapus data berdasarkan id
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>