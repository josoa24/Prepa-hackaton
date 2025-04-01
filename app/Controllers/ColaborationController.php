<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\ParticipationModel;
use App\Models\PublicationGroup;
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

    $participationModel = new \App\Models\ParticipationModel();

    $participationmodel = $participationModel
      ->where('id_publication', $id_publication)
      ->where('id_user', $id_user)
      ->first();

    if ($participationmodel === null) {
      $participationModel->insertParticipation([
        'id_publication' => (int) $id_publication,
        'id_user' => (int) $id_user,
      ]);

      $groupModel = (new GroupModel())
        ->where(
          'id',
          (new PublicationGroup())
            ->where('publication_id', $id_publication)
            ->first()['group_id']
        )
        ->first();

      $groupMemberModel = new \App\Models\GroupMemberModel();
      $groupMemberModel->insert([
        'user_id' => $id_user,
        'group_id' => $groupModel['id'],
        'role' => 'member',
      ]);
    } else {
      $groupModel = (new GroupModel())
        ->where(
          'id',
          (new PublicationGroup())
            ->where('publication_id', $participationmodel['id_publication'])
            ->first()['group_id']
        )
        ->first();

      $groupMemberModel = new \App\Models\GroupMemberModel();
      $groupMemberModel->insert([
        'user_id' => $id_user,
        'group_id' => $groupModel['id'],
        'role' => 'member',
      ]);
    }

    return redirect()->to('/chats/' . $groupModel['id']);
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
