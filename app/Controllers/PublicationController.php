<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Publication;

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
}
