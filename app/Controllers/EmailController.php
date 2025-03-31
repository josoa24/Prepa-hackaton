<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class EmailController extends Controller
{
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
