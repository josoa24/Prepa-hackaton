<?php

namespace App\Controllers;

use App\Models\ParticipationModel;
use App\Models\UserModel;

class ColaborationController extends BaseController
{
    private $participation_model;
    public function __construct()
    {
        $this->participation_model = new ParticipationModel();
    }
    
    public function participate()
    {

        $id_user = intval($json->id_user);
        $id_publication = intval($json->id_publication);

        $this->participation_model->insert([
            'id_user' => $id_user,
            'id_publication' => $id_publication,
        ]);

        return $this->response->setJSON([
            'status' => 'added',
            'message' => 'Participation enregistrée'
        ]);
    }
}
