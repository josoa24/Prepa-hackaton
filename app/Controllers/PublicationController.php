<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Publication;
use \App\Models\Don;
use \App\Models\Photo;

class PublicationController extends BaseController
{
  public function index()
  {
    return view('publication'); // Vue principale
  }

  public function fetchPublications()
  {
    $offset = $this->request->getGet('offset') ?? 0;
    $limit = $this->request->getGet('limit') ?? 12;

    $publicationModel = new Publication();
    $publications = $publicationModel->getPublicationsWithPhotosAndStatus($offset, $limit);

    // Group photos by publication
    $groupedPublications = [];
    foreach ($publications as $publication) {
      $id = $publication['id'];
      if (!isset($groupedPublications[$id])) {
        $groupedPublications[$id] = $publication;
        $groupedPublications[$id]['photos'] = [];
      }
      if ($publication['photo_link']) {
        $groupedPublications[$id]['photos'][] = $publication['photo_link'];
      }
    }

    // Ajout des informations utilisateur dans la réponse
    foreach ($groupedPublications as &$publication) {
      $publication['user'] = [
        'first_name' => $publication['first_name'],
        'last_name' => $publication['last_name'],
        'email' => $publication['email'],
        'profile_picture' => $publication['profile_picture'],
      ];
      unset($publication['first_name'], $publication['last_name'], $publication['email'], $publication['profile_picture']);
    }

    return $this->response->setJSON(array_values($groupedPublications));
  }

  public function storePublication()
  {
    $typepub = $this->request->getPost('typepub');
    $titre = $this->request->getPost('titre');
    $description = $this->request->getPost('description');
    $type = $this->request->getPost('categorie');
    $date = $this->request->getPost('date');
    $id_user = $this->request->getPost('id_user') ?? 1;
    $maxdonation = $this->request->getPost('maxdonation') ?? 0;

    // Handle photo upload
    $photoFile = $this->request->getFile('photo');
    if (!$photoFile) {
      log_message('error', 'No photo file received');
      return $this->response->setJSON(['error' => 'No photo file provided'])->setStatusCode(400);
    }

    if (!$photoFile->isValid()) {
      log_message('error', 'Invalid photo file: ' . $photoFile->getErrorString());
      return $this->response->setJSON(['error' => 'Invalid photo file'])->setStatusCode(400);
    }

    if ($photoFile->hasMoved()) {
      return $this->response->setJSON(['error' => 'Photo file has already been moved'])->setStatusCode(400);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($photoFile->getExtension(), $allowedExtensions)) {
      return $this->response->setJSON(['error' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed'])->setStatusCode(400);
    }

    if ($photoFile->getSize() > 2 * 1024 * 1024) { // 2MB limit
      return $this->response->setJSON(['error' => 'File size exceeds the 2MB limit'])->setStatusCode(400);
    }

    try {
      $photoName = $photoFile->getRandomName();
      $photoFile->move(WRITEPATH . 'uploads', $photoName);
      $photoPath = '/uploads/' . $photoName;
    } catch (\Exception $e) {
      return $this->response->setJSON(['error' => 'Failed to upload photo: ' . $e->getMessage()])->setStatusCode(500);
    }

    if ($typepub == 1) {
      // Handle evenement publication
      $publicationModel = new Publication();
      $data = [
        'id_user' => $id_user,
        'title' => $titre,
        'content' => $description,
        'description' => $description,
        'date_publication' => date('Y-m-d H:i:s'),
        'date_evenement' => $date,
        'type' => $type,
        'forme' => 1,
      ];
      if ($publicationModel->insert($data)) {
        $id_publication = $publicationModel->insertID();
        $this->createRelationGroup($id_publication, $id_user);
        $photoModel = new Photo();
        $photoData = [
          'id_publication' => $id_publication,
          'lien' => $photoPath,
        ];
        $photoModel->insert($photoData);
        return redirect()->to('/home');
      }
    } elseif ($typepub == 2) {
      // Handle donation publication
      $publicationModel = new Publication();
      $data = [
        'id_user' => $id_user,
        'title' => $titre,
        'content' => $description,
        'description' => $description,
        'date_publication' => date('Y-m-d H:i:s'),
        'date_evenement' => null,
        'type' => $type,
        'forme' => 2,
      ];
      if ($publicationModel->insert($data)) {
        $id_publication = $publicationModel->insertID();
        $this->createRelationGroup($id_publication, $id_user);
        $photoModel = new Photo();
        $photoData = [
          'id_publication' => $id_publication,
          'lien' => $photoPath,
        ];
        $photoModel->insert($photoData);
        $donationModel = new Don();
        $donationData = [
          'id_publication' => $id_publication,
          'montant' => $maxdonation,
          'date_don' => date('Y-m-d H:i:s'),
        ];
        $donationModel->insert($donationData);
        return redirect()->to('/home');
      }
    } elseif ($typepub == 3) {
      // Handle contribution publication
      $publicationModel = new Publication();
      $data = [
        'id_user' => $id_user,
        'title' => $titre,
        'content' => $description,
        'description' => $description,
        'date_publication' => date('Y-m-d H:i:s'),
        'date_evenement' => null,
        'type' => $type,
        'forme' => 3,
      ];
      if ($publicationModel->insert($data)) {
        $id_publication = $publicationModel->insertID();
        $this->createRelationGroup($id_publication, $id_user);
        $photoModel = new Photo();
        $photoData = [
          'id_publication' => $id_publication,
          'lien' => $photoPath,
        ];
        $photoModel->insert($photoData);
        return redirect()->to('/home');
      }
    } else {
      return $this->response->setJSON(['error' => 'Invalid publication type'])->setStatusCode(400);
    }

    return redirect()->to('/home')->with('error', 'Publication failed');
  }

  private function createRelationGroup($id_publication, $id_user)
  {
    $group = new \App\Models\GroupModel();

    $group->insert([
      'name' => 'Publication_' . $id_publication,
      'description' => 'Group for publication_' . $id_publication,
      'created_at' => date('Y-m-d H:i:s'),
    ]);

    $id_group = $group->insertID();

    $groupMember = new \App\Models\GroupMemberModel();
    $groupMember->insert([
      'user_id' => $id_user,
      'group_id' => $id_group,
      'joined_at' => date('Y-m-d H:i:s'),
    ]);

    $data = [
      'publication_id' => $id_publication,
      'group_id' => $id_group,
    ];
    $groupPublication = new \App\Models\PublicationGroup();
    $groupPublication->insert($data);
  }

  public function search()
  {
    $search = $this->request->getGet('search') ?? false;
    $page = $this->request->getGet('offset') ?? 0;
    $limit = $this->request->getGet('limit') ?? 12;

    if (!$search) {
      return $this->index();
    }

    $publicationModel = new Publication();
    $publications = $publicationModel->getPublicationsWithPhotosAndStatusSearch($page, $limit, $search);

    $groupedPublications = [];
    foreach ($publications as $publication) {
      $id = $publication['id'];
      if (!isset($groupedPublications[$id])) {
        $groupedPublications[$id] = $publication;
        $groupedPublications[$id]['photos'] = [];
      }
      if ($publication['photo_link']) {
        $groupedPublications[$id]['photos'][] = $publication['photo_link'];
      }
    }

    // Ajout des informations utilisateur dans la réponse
    foreach ($groupedPublications as &$publication) {
      $publication['user'] = [
        'first_name' => $publication['first_name'],
        'last_name' => $publication['last_name'],
        'email' => $publication['email'],
        'profile_picture' => $publication['profile_picture'],
      ];
      unset($publication['first_name'], $publication['last_name'], $publication['email'], $publication['profile_picture']);
    }

    return $this->response->setJSON(array_values($groupedPublications));
  }

  public function fetchPublicationsByUser()
  {
    $offset = $this->request->getGet('offset') ?? 0;
    $limit = $this->request->getGet('limit') ?? 12;
    $id_user = session()->get('user_id') ?? 1;

    $publicationModel = new Publication();
    $publications = $publicationModel->getUserPublications($id_user, $offset, $limit);

    // Group photos by publication
    $groupedPublications = [];
    foreach ($publications as $publication) {
      $id = $publication['id'];
      if (!isset($groupedPublications[$id])) {
        $groupedPublications[$id] = $publication;
        $groupedPublications[$id]['photos'] = [];
      }
      if ($publication['photo_link']) {
        $groupedPublications[$id]['photos'][] = $publication['photo_link'];
      }
    }

    // Ajout des informations utilisateur dans la réponse
    foreach ($groupedPublications as &$publication) {
      $publication['user'] = [
        'first_name' => $publication['first_name'],
        'last_name' => $publication['last_name'],
        'email' => $publication['email'],
        'profile_picture' => $publication['profile_picture'],
      ];
      unset($publication['first_name'], $publication['last_name'], $publication['email'], $publication['profile_picture']);
    }

    return $this->response->setJSON(array_values($groupedPublications));
  }
}
