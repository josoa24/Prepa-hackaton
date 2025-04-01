<?php

namespace App\Controllers;

use App\Models\Don;
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

      $userModel = new UserModel();
      $user = $userModel->find($id_user);
      $toSend = $user['email'];

      $this->sendEmail($toSend);
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

  public function participateEmail()
  {
    $id_publication = $this->request->getGet('id_publication');
    $id_user = $this->request->getGet('id_user');
    $type = $this->request->getGet('type') ?? '';

    switch ($type) {
      case 'don':
        $montant = $this->request->getPostGet('montant');

        (new Don())->insert([
          'id_publication' => $id_publication,
          'id_user' => $id_user,
          'montant' => $montant,
        ]);

        return $this->response->setJSON([
          'status' => 'success',
          'message' => 'Donation confirmed',
        ]);
    }

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

      $userModel = new UserModel();
      $user = $userModel->find($id_user);
      $toSend = $user['email'];

      $this->sendEmail($toSend);
    }

    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Participation confirmed',
    ]);
  }

  private function sendEmail($toSend)
  {
    $email = Services::email();

    $email->setTo($toSend);
    $email->setFrom('josoarazafimandimby66@gmail.com', 'I-Colab');
    $email->setSubject('Confirmation de participation');

    $data['password'] = 'JOSOA';

    $html = view('email', $data, ['saveData' => true]);

    $email->setMessage($html);

    $email->send();
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
