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
        $data = $this->model->orderBy('nama', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }

    public function create()
    {
        // $data = [
        //     'nama' => $this->request->getVar('nama'),
        //     'email' => $this->request->getVar('email'),
        // ];
        // $this->model->save($data);

        $data = $this->request->getPost();

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => [
                'success' => 'Berhasil memasukan data pegawai'
            ],
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $isExists = $this->model->where('id', $id)->findAll();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }

        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => false,
            'messages' => [
                'success' => "Data dengan id $id berhasil di update" 
            ]
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => false,
                'messages' => [
                    'success' => "Data berhasil dihapus"
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan");
        }
    }
}
