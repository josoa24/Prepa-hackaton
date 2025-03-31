<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipationModel extends Model
{
    protected $table      = 'i_colab_colaboration';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; // Set to true to match the AUTO_INCREMENT column

    protected $allowedFields = [
        'id_publication',
        'id_user',
    ];

    public function getParticipation($idPublication, $idUser)
    {
        return $this->where('id_publication', $idPublication)
            ->where('id_user', $idUser)
            ->first();
    }

    public function getAllParticipations()
    {
        return $this->findAll();
    }

    public function insertParticipation($data)
    {
        return $this->insert($data);
    }

    public function updateParticipation($idPublication, $idUser, $data)
    {
        return $this->where('id_publication', $idPublication)
            ->where('id_user', $idUser)
            ->set($data)
            ->update();
    }

    public function deleteParticipation($idPublication, $idUser)
    {
        return $this->where('id_publication', $idPublication)
            ->where('id_user', $idUser)
            ->delete();
    }

    public function countParticipations()
    {
        return $this->countAll();
    }
}
