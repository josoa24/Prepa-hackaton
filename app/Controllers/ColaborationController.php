<?php

namespace App\Controllers;

use App\Models\ParticipationModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;

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
        // $this->sendEmail();
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

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Action non reconnue'
        ]);
    }

    public function sendEmail()
    {
        $email = Services::email();

        $email->setTo('razherana@gmail.com');
        $email->setFrom('josoarazafimandimby66@gmail.com', 'I-Colab');
        $email->setSubject('Confirmation de participation');
        $data['password'] = 'JOSOA';

        $html = view('email', $data, ['saveData' => true]);

        $email->setMessage($html);

        if ($email->send()) {
            echo "E-mail envoyé avec succès 2 !";
        } else {
            echo "Erreur lors de l'envoi de l'email : " . $email->printDebugger(['headers']);
        }
    }

    function lire_fichier_view($nom_fichier)
    {
        $chemin_fichier = APPPATH . "Views/" . $nom_fichier;

        if (!file_exists($chemin_fichier)) {
            return "Erreur : Le fichier '$nom_fichier' n'existe pas.";
        }

        $contenu = file_get_contents($chemin_fichier);

        return $contenu !== false ? $contenu : "Erreur : Impossible de lire le fichier.";
    }
}
