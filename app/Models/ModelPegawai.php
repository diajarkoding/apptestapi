<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelPegawai extends Model
{
    protected $useAutoIncrement = true; 
    protected $table = "pegawai";
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'email',];

    protected $validationRules = [
 
        'nama' => 'required',
        'email' => 'required|valid_email|is_unique[pegawai.email]'
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Silahkan masukkan nama'
        ],
        'email' => [
            'required' => 'Silahkan masukkan email',
            'valid_email' => 'Email yang di masukkan tidak valid',
            'is_unique' => 'Maaf. Email sudah digunakan, gunakan email lain.'
        ]
    ];
}