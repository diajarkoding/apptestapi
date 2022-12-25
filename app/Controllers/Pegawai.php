<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ModelPegawai();
    }

    public function index()
    {
  
    }

    public function create()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
        ];
        $this->model->save($data);
        $response = [
            'status' => 200,
            'messages' => [
                'success' => 'Berhasil memasukan data pegawai'
            ],
        ];

        return $this->respond($response);
    }
}
