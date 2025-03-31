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
        $id_publication = $this->request->getGet('id_publication');
        $id_user = $this->request->getGet('id_user');
        $action = $this->request->getGet('action');

        if (!$id_publication || !$id_user || !$action) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Paramètres invalides'
            ]);
        }

        $participationModel = new \App\Models\ParticipationModel();

        if ($action === 'join') {
            $exists = $participationModel
                ->where('id_publication', $id_publication)
                ->where('id_user', $id_user)
                ->countAllResults();

            if ($exists == 0) {
                $participationModel->insertParticipation([
                    'id_publication' => (int) $id_publication,
                    'id_user' => (int) $id_user,
                ]);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Participation enregistrée'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Déjà inscrit'
                ]);
            }
        } elseif ($action === 'leave') {
            $participationModel
                ->where('id_publication', $id_publication)
                ->where('id_user', $id_user)
                ->delete();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Participation annulée'
            ]);
        }

        // return $this->response->setJSON([
        //     'success' => false,
        //     'message' => 'Action non reconnue'
        // ]);
    }
}
