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

    public  function participate()
    {
        $id_user = $this->request->getPost('id_user');
        $id_publication = $this->request->getPost('id_publication');
        $data = [
            'id_user' => $id_user,
            'id_publication' => $id_publication,
        ];
        $this->participation_model->insert($data);
    }
}
